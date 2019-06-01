<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 31.01.2019
 * Time: 13:29
 */

namespace app\controllers;

use app\components\Debug;
use app\components\myCryptFunctions;
use app\models\StrUser;
use app\models\User;
use app\models\UserRecoveryPassword;
use app\models\UserRegistration;
use Codeception\Stub\Expected;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;
use DateTime;
use yii\db\Query;

class AuthController extends Controller
{
    //
    public function actionIndex()
    {
        return $this->redirect(['auth/login']);
    }

    //
    public function actionLogin()
    {
        $this->layout = 'auth';
        //
        $session = Yii::$app->session;
        //$session->open(); $session->close(); $session->destroy();
        //echo Debug::d($session);

        if (!$session->isActive){
            $session->open();
        }

        $model = new StrUser();
        if ($model->load(Yii::$app->request->post()) && $model->validate() ){

            $user = StrUser::find()
                ->where(['email' => $model->email])
                //->asArray()
                ->one();
            if (!$user){
                $session->setFlash('wrongLogPass','error');

                return $this->render('login',['model' => $model]);
            }

            //die(debug::d($user->id,'',1));
            if ($user->active === 0){
                $session->setFlash('wrongLogPass','confirm_error');

                return $this->render('login',['model' => $model]);
            }

            $ps_check = password_verify($model->password, $user->password);
            if (!$ps_check){
                $session->setFlash('wrongLogPass','yes');

                return $this->render('login',['model' => $model]);
            }

            //
            $session->set('isLogined',1);
            //unset($user['password']);
            $session->set('user',$user);
            //die($session);

        }

        //
        if ($session->has('isLogined') && $session->get('isLogined') === 1 ){
            //return $this->redirect(['natpot/index']);
            return $this->redirect(['project/index']);
        }

        return $this->render('login',['model' => $model]);
    }

    //
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->open(); $session->destroy(); $session->close();
        //echo Debug::d($session->get('user'));
        Yii::$app->session->setFlash('isLogout','yes');

        return $this->redirect(['auth/login']);
    }

    //
    public function actionRegistration(){

        $model0 = new StrUser();
        $model = new UserRegistration();

        $rs = ['type' => 1, 'message' => 'Registration', 'success' => 2];

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //
            $rs['success'] = 1;
            try{
                //echo Debug::d($model);
                $doubleMail = StrUser::find()->where(['email' => $model->email])->count();
                //echo Debug::d($doubleMail,'doubleMail');
                if ($doubleMail){
                    //die('Mail is already taken!');
                    Yii::$app->session->setFlash('userAdd','double');
                    $rs['success'] = 0;
                    $rs['message'] = 'this email is already in use';
                }else{
                    $model0->email = $model->email;
                    $model0->password = myCryptFunctions::hashPassword2($model->password);
                    $model0->confirm = myCryptFunctions::hashPassword2($model->email);
                    $r = $model0->save();
                    if (!$r) {
                        $rs['success'] = 0;
                        $rs['message'] = 'error on save';
                        Yii::$app->session->setFlash('userAdd', 'save_error');
                    }else{
                        Yii::$app->session->setFlash('userAdd', 'yes');
                        // отправка на почту пользователю ссылку для подтверждения пароля
                        // важно, тут нужно отправить на мой существующий email...
                        // иначе останемся без ссылки восстановления...
                        $p[1] = $model0->email;
                        $p[21] = Yii::$app->params['sw_frommail'];
                        $p[22] = Yii::$app->params['my_name'];
                        $mail_block_action = 'Подтверждение регистрации';
                        $p[3] = "Events. $mail_block_action";

                        $real_link = Url::to(['auth/confirm','hash' => $model0->confirm ], true);

                        $res = Yii::$app->mailer->compose('confirm',[
                            'real_link' => $real_link,
                            'mail_block_title' => Yii::$app->params['app_name'],
                            'mail_block_action' => $mail_block_action,
                            'app_copyright' => Yii::$app->params['app_copyright'],
                        ])->setTo($p[1])->setFrom([$p[21] => $p[22]])->setSubject($p[3])->send();
                    }
                }

            }catch (e $exception){
                Yii::$app->session->setFlash('userAdd','no');
                $rs['success'] = 0;
                $rs['message'] = 'something gone wrong!';
            }
            //echo Debug::d($res);
            //echo 'nice! data is coming'; die;

            //
            //echo Debug::d($model0);
            //die('we in!');
            if ($rs['success'] === 1){
                return $this->redirect(['auth/login']);
            }
        }

        $this->layout = 'auth';
        return $this->render('registration',['model' => $model,'rs' => $rs]);
    }

    //
    public function actionRestore()
    {
        $validationRestoreForm = new UserRecoveryPassword();
        if ($validationRestoreForm->load(Yii::$app->request->post()) && $validationRestoreForm->validate() )
        {
            $s = null;
            // раз мы получили нормальную почту, нужно отправить туда урл с хешом для восстановления
            $mail = Yii::$app->request->post('UserRecoveryPassword')['email'];
            //echo $mail; die;
            $s = StrUser::findOne(['email' => $mail]);
            if (!$s){
                $this->layout = 'for_auth';
                $rest_rs = ['success' => 0, 'message' => 'Email не найден!'];
                Yii::$app->session->setFlash('restore', $rest_rs);
                //die('User with this email does not exists!!!');
                $this->layout = 'auth';
                return $this->render('restore',['model' => $validationRestoreForm]);
                //return $this->render('restore',compact('model','mail'));
            }
            $s->restore_flag = 1;
            //print $when->format('Y-m-d H:i:s'); echo "<br>";
            $when = new DateTime(); $when->modify('+ 3 hour'); $curr_dt = new DateTime();
            $curr_dt = $curr_dt->format('Y-m-d H:i:s');
            $s->restore_date = $when->format('Y-m-d H:i:s');
            $restore_hash = sha1($mail . Yii::$app->params['mail_restore_salt'] . $curr_dt);
            $s->restore_hash = $restore_hash;
            $s->update();

            // важно, тут нужно отправить на мой существующий email...
            // иначе останемся без ссылки восстановления...
            $p[1] = $s->email;
            $p[21] = Yii::$app->params['sw_frommail'];
            $p[22] = Yii::$app->params['my_name'];
            $p[3] = "Events. Восстановление пароля";

            $real_link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']
                .'/do-restore?'.'hash='.$restore_hash;
            $real_link = Url::to(['auth/do-restore','hash' => $restore_hash ], true);

            $res = Yii::$app->mailer->compose('restore',[
                'real_link' => $real_link,
                'mail_block_title' => Yii::$app->params['app_name'],
                'mail_block_action' => 'Сброс пароля',
                'app_copyright' => Yii::$app->params['app_copyright'],
            ])->setTo($p[1])->setFrom([$p[21] => $p[22]])->setSubject($p[3])->send();

            //
            $rest_rs = ['success' => 1, 'message' =>
                "Ссылка на восстановления пароля отправлена на вашу почту. <br/>" .
                "Она будет активна в течении " . Yii::$app->params['restore_end_hours'] . " часа(ов)."
            ];
            Yii::$app->session->setFlash('restore', $rest_rs);
        }
        $this->layout = 'auth';
        return $this->render('restore',['model' => $validationRestoreForm]);
    }

    //
    public function actionTestmail(){

        echo 'test mail';

        $p[1] = 'iduso@mail.ru';
        $p[21] = Yii::$app->params['sw_frommail'];
        $p[22] = Yii::$app->params['my_name'];
        $p[3] = "Events. Восстановление пароля";

        $real_link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']
            .'/do-restore?'.'hash='.'blabalbla';
        $real_link = Url::to(['user/do-restore','hash' => 'restore_hash' ], true);

        $res = Yii::$app->mailer->compose('restore',[
            'real_link' => $real_link
        ])->setTo($p[1])->setFrom([$p[21] => $p[22]])->setSubject($p[3])->send();

        die;
    }

    //
    public function actionDoRestore($hash=null)
    {
        $validationRestoreForm = new UserRecoveryPassword();
        // здесь мы должны получить хеш
        //$hash = "a33f9ebb21932b71fb26614313e96b3fd22d0807";
        $hash = Yii::$app->request->get('hash');
        $err_msg = '';
        // #1 часть 2 - поле ресторе = 1 ??
        $rs = StrUser::findOne(['restore_hash' => $hash, 'restore_flag' => 1]);
        if (!$rs){
            // отказано в сбросе, ресторе <> 1
            $err_msg = 'Сброс пароля не был запрошен и/или недействительный hash!';
            $rs_dorest = ['success' => 0, 'message' => $err_msg];
            Yii::$app->session->setFlash('dorestore', $rs_dorest);
            $this->layout = 'auth';
            return $this->render('dorestore',[]);
        }

        // если прошло больше 3-х часов с момента запроса на восстановление пароля - сброс
        // select time_format(SUM(abs(timediff(restore_date,now()))), '%H') as `diff` from user;
        $sql = "select time_format(SUM(abs(timediff(restore_date,now()))), '%H') as `diff` from user";
        $hours_diff = Yii::$app->db->createCommand($sql)->queryScalar();
        $hours_diff = intval($hours_diff);
        //echo 'time_diff: ' . $hours_diff;
        $restore_end_hours = Yii::$app->params['restore_end_hours'];
        //if ($hours_diff >= $restore_end_hours) echo 'pichal - time is up!';die;
        if ($hours_diff >= $restore_end_hours)
        {
            $rest_rs = ['success' => 0, 'message' =>
                "Время для восстановления пароля -  <br/>" .
                 Yii::$app->params['restore_end_hours'] . " часа(ов) истекли! ",
            ];
            Yii::$app->session->setFlash('dorestore', $rest_rs);
            $this->layout = 'auth';
            return $this->render('dorestore',['model' => $validationRestoreForm]);
        }


        // сброс пароля и ресторе = 0, чтобы исключить дальнейшие сбрасывания на этом же скрипте
        $temp_password = rand(1000,9999);
        $hashed_password= myCryptFunctions::hashPassword2($temp_password);
        $rs->restore_flag = 0;
        $rs->password = $hashed_password;
        //
        if (!$rs->validate()){
            //
            $rest_rs = ['success' => 0, 'message' => 'Ошибка при работе с БД!'];
            Yii::$app->session->setFlash('dorestore', $rest_rs);
            $this->layout = 'auth';
            return $this->render('restore',['model' => $validationRestoreForm]);
        }
        $rs->save(false);
        //
        $tmp_email = $rs->email;
        $tmp_password = $temp_password;

        $p[1] = $rs->email;
        $p[21] = Yii::$app->params['sw_frommail'];
        $p[22] = Yii::$app->params['my_name'];
        $p[3] = "Events. Сброс пароля";

        $res = Yii::$app->mailer->compose('dorestore',[
            'tmp_email' => $tmp_email,
            'tmp_password' => $tmp_password,
            'mail_block_title' => Yii::$app->params['app_name'],
            'mail_block_action' => 'Сброс пароля',
            'app_copyright' => Yii::$app->params['app_copyright'],
        ])->setTo($p[1])->setFrom([$p[21] => $p[22]])->setSubject($p[3])->send();
        //
        $err_msg = 'Пароль был сброшен и отправлен на вашу почту';
        $rs_dorest = ['success' => 2, 'message' => $err_msg];
        Yii::$app->session->setFlash('restore', $rs_dorest);
        //

        $this->layout = 'auth';
        return $this->redirect(['login']);
    }

    //
    public function actionConfirm()
    {
        $hash = Yii::$app->request->get('hash');
        $this->layout = 'auth';
        //
        $rs = StrUser::findOne(['confirm' => $hash]);
        if (!$rs){
            //
            $err_msg = 'Хэш не найден!';
            $rs_dorest = ['success' => 0, 'message' => $err_msg];
            Yii::$app->session->setFlash('confirm', $rs_dorest);
            return $this->render('confirm',[]);
        }

        $rs->active = 1;
        if ($rs->save()){
            $rs_dorest = ['success' => 2, 'message' => 'Регистрация подтверждена!'];
            Yii::$app->session->setFlash('confirm', $rs_dorest);
        }else{
            $rs_dorest = ['success' => 1, 'message' => 'ошибка при сохранении записи!'];
            Yii::$app->session->setFlash('confirm', $rs_dorest);
            return $this->render('confirm',[]);
        }

        return $this->redirect(['login']);
    }

}