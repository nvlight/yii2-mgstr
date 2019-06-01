<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 31.01.2019
 * Time: 13:56
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="limiter">

    <input type="hidden" name="_csrf" value="TsNz3USu-TqOMHVqiXKbj7vj6v7pb28PgIRo30uzz7ApsRicEtidWN1GAD6xPey3_ouCiYs7GVatwQPpcv_84Q==">                <span class="login100-form-title p-b-25">
                    Авторизация                </span>

    <p class="p_mb16-w100p">
                    <span class="span_message_box btn btn-warning" style="white-space: normal">
                        Вышли из системы!
                    </span>
    </p>


    <div class="natpot-page">

        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">



            <form id="w0" class="login100-form validate-form" action="/auth/login" method="post">


                <div class="form-group w100p mb0 field-struser-email required">
                    <div class="wrap-input100 validate-input " data-validate="Правильный email обязателен: ex@abc.xyz">
                        <input type="email" id="struser-email" class="input100" name="StrUser[email]" placeholder="Email" inputtemplate="<div class=&quot;input-group &quot; style=&quot;margin-bottom: 0;width: 100%;&quot;>{input}</div>" aria-required="true">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <span class="lnr lnr-envelope"></span>
                    </span>
                    </div>
                    <div class="help-block m-b-16 "></div>
                </div>
                <div class="form-group w100p mb0 field-struser-password required">
                    <div class="wrap-input100 validate-input " data-validate="Введите пароль">
                        <input type="password" id="struser-password" class="input100" name="StrUser[password]" placeholder="Пароль" inputtemplate="<div class=&quot;input-group &quot; style=&quot;margin-bottom: 0;width: 100%;&quot;>{input}</div>" aria-required="true">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <span class="lnr lnr-lock"></span>
                    </span>
                    </div>
                    <div class="help-block m-b-16 "></div>
                </div>
                <div class="contact100-form-checkbox m-l-4">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Запомнить меня
                    </label>
                </div>
                <a class="txt1 hov1" href="/auth/restore">
                    Забыли пароль?
                </a>

                <div class="container-login100-form-btn p-t-25">
                    <button type="submit" class="login100-form-btn">войти</button>                </div>

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
                    <img src="/images/icons/icon-google.png" alt="GooGle">                    Google
                </a>

                <div class="text-center w-full p-t-25">

                    <a class="txt1 bo1 hov1" href="/auth/registration">Зарегистрироваться</a>

                </div>

            </form>

        </div>

        <div>
            <h3>inted</h3>
            <p class="p_mb16-w100p">
            <span class="span_message_box ">
                <?=Html::a('Выйти',['auth/logout'],['class' => 'span_message_box btn btn-warning'])?>
            </span>
            </p>
        </div>


    </div>

</div>