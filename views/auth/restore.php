<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\Debug;

/* @var $this yii\web\View */

$this->title = 'Восстановление пароля';
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">

            <span class="login100-form-title p-b-25">
                <?=$this->title?>
            </span>

            <?php
            // тут опищу обработку успешности восстановления пароля...
            $rest_output_str = ""; $rest_output_str_class = '';
            if (Yii::$app->session->hasFlash('restore')):
                //echo Debug::d();
                $sw_rest = Yii::$app->session->getFlash('restore');
                $sw_succ  = $sw_rest['success'];
                $sw_messg = $sw_rest['message'];
                switch ($sw_succ){
                    case 0: $rest_output_str = $sw_messg;
                            $rest_output_str_class = 'btn-danger';
                            break;
                    case 1: $rest_output_str = $sw_messg;
                            $rest_output_str_class = 'btn-success';
                            break;
                    default:
                }
                ?>
            <p class="p_mb16-w100p">
                <span class="span_message_box btn <?=$rest_output_str_class?>" style="white-space: normal" ><?=$rest_output_str?></span>
            </p>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(['options' => ['class' => 'login100-form validate-form'] ]); ?>

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
                //->textInput()
                ->input('email', ['placeholder' => "Email",
                    'inputTemplate' => '<div class="input-group " style="margin-bottom: 0;width: 100%;">{input}</div>',
                    //'autofocus' => true,
                    'class' => 'input100',
                ])
                ->label(false)
            ?>

            <?= $form->field($model, 'captcha', ['options' => ['class' => 'form-group w100p mb0'] ]
            )->widget(\yii\captcha\Captcha::classname(),
                [
                    // <span class="focus-input100"></span><span class="symbol-input100"><span class="lnr lnr-lock"></span></span>
                    'template' => '                        
                        <div class="wrap-input100">
                            <div class="captcha_div">{image}</div>
                            {input}
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <span class="lnr lnr-chevron-right-circle"></span>
                            </span>
                        </div>                        
                    ',
                    'options' => ['placeholder' => 'Капча', 'class' => 'form-group input100 w100p mb0'],
                ])
                //->textInput()
                ->label(false)
            ?>

            <?= Html::submitButton('Восстановить', ['class' => 'login100-form-btn']) ?>

            <?php ActiveForm::end(); ?>

            <div class="text-center w-full p-t-25">

                <a class="txt1 bo1 hov1" href="<?=\yii\helpers\Url::to(['auth/registration'])?>">Зарегистрироваться</a>

            </div>

        </div>
    </div>
</div>

<!--<script src="vendor/bootstrap/js/popper.js"></script>-->
<!--<script src="vendor/select2/select2.min.js"></script>-->
