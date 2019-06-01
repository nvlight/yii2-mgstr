<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\Debug;

/* @var $this yii\web\View */

$this->title = 'Авторизация';
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">

            <?php
            $session = Yii::$app->session;
            if (!$session->isActive){
                $session->open();
            }
            //
            $isLogined = 0;
            if ($session->has('isLogined') && $session->get('isLogined') === 1 ){
                $isLogined = 1;
                $user = $session->get('user');
            }
            //echo Debug::d($session->get('isLogined'),'in view...');
            ?>

            <?php if ($isLogined === 1): ?>
                <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-success">
                        <?=$user['email']?> успешно вошел в систему!
                    </span>
                </p>
                <p class="p_mb16-w100p">
                    <span class="span_message_box ">
                        <?=Html::a('Выйти',['auth/logout'],['class' => 'span_message_box btn btn-warning'])?>
                    </span>
                </p>
            <?php else: ?>

                <?php $form = ActiveForm::begin(['options' => ['class' => 'login100-form validate-form'] ]); ?>
                <span class="login100-form-title p-b-25">
                    <?=$this->title?>
                </span>

                <?php if (Yii::$app->session->hasFlash('restore')): ?>
                    <p class="p_mb16-w100p">
                        <span class="span_message_box btn btn-warning" style="white-space: normal">
                            <?=Yii::$app->session->getFlash('restore')['message']?>
                        </span>
                    </p>
                <?php endif; ?>

                <?php
                if (Yii::$app->session->hasFlash('userAdd') &&
                    Yii::$app->session->getFlash('userAdd') === 'yes'):
                ?>
                <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-success" style="white-space: normal">
                        Регистрация прошла успешно! <br/>
                        Ссылка для подтверждения регистрации отправлена на вашу почту
                    </span>
                </p>
                <?php
                endif;
                ?>

                <?php
                // тут опищу обработку успешности восстановления пароля...
                $rest_output_str = ""; $rest_output_str_class = '';
                if (Yii::$app->session->hasFlash('confirm')):
                    //echo Debug::d();
                    $sw_rest = Yii::$app->session->getFlash('confirm');
                    $sw_succ  = $sw_rest['success'];
                    $sw_messg = $sw_rest['message'];
                    switch ($sw_succ){
                        case 0: $rest_output_str = $sw_messg;
                            $rest_output_str_class = 'btn-danger';
                            break;
                        case 1: $rest_output_str = $sw_messg;
                            $rest_output_str_class = 'btn-warning';
                            break;
                        case 2: $rest_output_str = $sw_messg;
                            $rest_output_str_class = 'btn-success';
                            break;
                        default:
                    }
                    ?>
                    <p class="p_mb16-w100p">
                        <span class="span_message_box btn <?=$rest_output_str_class?>" style="white-space: normal" >
                            <?=$rest_output_str?>
                        </span>
                    </p>
                <?php endif; ?>

                <?php
                if (Yii::$app->session->hasFlash('isLogout') &&
                    Yii::$app->session->getFlash('isLogout') === 'yes'):
                    ?>
                    <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-warning" style="white-space: normal">
                        Вышли из системы!
                    </span>
                    </p>
                <?php
                endif;
                ?>

                <?php
                if ($session->hasFlash('wrongLogPass') &&
                    Yii::$app->session->getFlash('wrongLogPass') === 'yes'):
                    ?>
                    <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-danger" style="white-space: normal">
                        Неправильный логин и/или пароль
                    </span>
                    </p>
                <?php
                elseif ($session->hasFlash('wrongLogPass') &&
                    Yii::$app->session->getFlash('wrongLogPass') === 'confirm_error'):
                    ?>
                    <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-danger" style="white-space: normal">
                        Регистрация не подтверждена!
                    </span>
                    </p>
                <?php
                    elseif ($session->hasFlash('wrongLogPass') &&
                        Yii::$app->session->getFlash('wrongLogPass') === 'error'):
                ?>
                    <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-danger" style="white-space: normal">
                        Неправильный логин и/или пароль!
                    </span>
                    </p>
                <?php
                endif;
                ?>

                <?= $form->field($model, 'email',
                [
                    'template' => '<div class="wrap-input100 validate-input " data-validate = "Правильный email обязателен: ex@abc.xyz">
                    {input}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-envelope"></span>
                    </span>                    
                    </div>
                    <div class="help-block m-b-16 "></div>',
                    'options' => [ 'class' => 'form-group w100p mb0'],
                ]
                )
                ->input('email', ['placeholder' => "Email",
                    'inputTemplate' => '<div class="input-group " style="margin-bottom: 0;width: 100%;">{input}</div>',
                    //'autofocus' => true,
                    'class' => 'input100',
                ])
                ->label(false)
                ?>

                <?= $form->field($model, 'password',
                [
                    'template' => '<div class="wrap-input100 validate-input " data-validate = "Введите пароль">
                    {input}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-lock"></span>
                    </span>                    
                    </div>
                    <div class="help-block m-b-16 "></div>',
                    'options' => [ 'class' => 'form-group w100p mb0'],
                ]
                )
                //->textInput()
                ->input('password', ['placeholder' => "Пароль",
                    'inputTemplate' => '<div class="input-group " style="margin-bottom: 0;width: 100%;">{input}</div>',
                    //'autofocus' => true,
                    'class' => 'input100',
                ])
                ->label(false)
                ?>

                <div class="contact100-form-checkbox m-l-4">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Запомнить меня
                    </label>
                </div>
                <a class="txt1 hov1" href="<?=\yii\helpers\Url::to(['auth/restore'])?>">
                    Забыли пароль?
                </a>

                <div class="container-login100-form-btn p-t-25">
                    <?= Html::submitButton('войти', ['class' => 'login100-form-btn']) ?>
                </div>

                <div class="text-center w-full p-t-42 p-b-22">
						<span class="txt1">
							Или войти с
						</span>
                </div>

                <a href="#" class="btn-face m-b-10">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    Facebook
                </a>

                <a href="#" class="btn-google m-b-10">
                    <?php echo Html::img('@web/images/icons/icon-google.png',['alt' => 'GooGle']) ?>
                    Google
                </a>

                <div class="text-center w-full p-t-25">

                    <a class="txt1 bo1 hov1" href="<?=\yii\helpers\Url::to(['auth/registration'])?>">Зарегистрироваться</a>

                </div>

                <?php ActiveForm::end(); ?>

            <?php
                // $isLogined
                endif;
            ?>

        </div>
    </div>
</div>

<!--<script src="vendor/bootstrap/js/popper.js"></script>-->
<!--<script src="vendor/select2/select2.min.js"></script>-->
