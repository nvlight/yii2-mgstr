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
                    <span class="span_message_box btn <?=$rest_output_str_class?>" style='white-space: normal' ><?=$rest_output_str?></span>
                </p>
            <?php endif; ?>

            <div class="text-center w-full p-t-25">

                <div class="col-xs-6"><a class="txt1 bo1 hov1" href="<?=\yii\helpers\Url::to(['auth/registration'])?>">Зарегистрироваться</a></div>
                <div class="col-xs-6"><a class="txt1 bo1 hov1" href="<?=\yii\helpers\Url::to(['auth/login'])?>">Войти в систему</a></div>

            </div>

        </div>
    </div>
</div>

<!--<script src="vendor/bootstrap/js/popper.js"></script>-->
<!--<script src="vendor/select2/select2.min.js"></script>-->
