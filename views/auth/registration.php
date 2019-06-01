<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Регистрация';
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
            <?php $form = ActiveForm::begin(['options' => ['class' => 'login100-form validate-form0'] ]); ?>
            <span class="login100-form-title p-b-25">
                <?=$this->title?>
            </span>
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
            elseif (Yii::$app->session->hasFlash('userAdd') &&
                Yii::$app->session->getFlash('userAdd') === 'double'):
                ?>
                <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-danger">Данный email занят!</span>
                </p>
            <?php
            elseif (Yii::$app->session->hasFlash('userAdd') &&
                Yii::$app->session->getFlash('userAdd') === 'no'):
                ?>
                <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-warning">Данный email занят!</span>
                </p>
            <?php
            elseif (Yii::$app->session->hasFlash('userAdd') &&
                Yii::$app->session->getFlash('userAdd') === 'save_error'):
                ?>
            <p class="p_mb16-w100p">
                <span class="span_message_box btn btn-warning">Ошибка регистрации!</span>
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
                //->textInput()
                ->input('email', ['placeholder' => "Email",
                    'inputTemplate' => '<div class="input-group " style="margin-bottom: 0;width: 100%;">{input}</div>',
                    //'autofocus' => true,
                    'class' => 'input100',
                ])
                ->label(false)
            ?>

            <?= $form->field($model, 'password',
                [
                    'template' => '<div class="wrap-input100 validate-input " data-validate = "Правильный email обязателен: ex@abc.xyz">
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

            <?= $form->field($model, 'password_re',
                [
                    'template' => '<div class="wrap-input100 validate-input " data-validate = "Правильный email обязателен: ex@abc.xyz">
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
                ->input('password', ['placeholder' => "Повторите пароль",
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

            <div class="container-login100-form-btn p-t-11">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'login100-form-btn']) ?>
            </div>

            <div class="container m-t-15">
                <div class="row">
                    <div class="col-xs-6"><a class="txt1 w-full hov1" href="<?=\yii\helpers\Url::to(['auth/restore'])?>">Забыли пароль?</a></div>
                    <div class="col-xs-6"><a class="txt1 bo1 hov1" href="<?=\yii\helpers\Url::to(['auth/login'])?>">Войти в систему</a></div>
                </div>
            </div>


            <?php ActiveForm::end(); ?>

            <?php

            ?>
        </div>
    </div>
</div>

<!--<script src="vendor/bootstrap/js/popper.js"></script>-->
<!--<script src="vendor/select2/select2.min.js"></script>-->
