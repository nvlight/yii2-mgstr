<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <style>
        /* ====  Preloader styles ==== */
        #hola{
            width: 100vw;
            height: 100vh;
            background-color: #fff;
            position: fixed;
            z-index: 999;
        }
        #preloader {
            position:relative;
            width: 80px;
            height: 80px;
            top: 45%;
            margin: 0 auto;
        }
        #preloader span{
            border:8px solid #416C5F;
            position:absolute;
            border-top:33px solid transparent;
            border-radius:999px;
        }
        #preloader span:nth-child(1){
            width:80px;
            height:80px;
            animation: spin-1 2s infinite linear;
        }
        #preloader span:nth-child(2){
            top: 20px;
            left: 20px;
            width:40px;
            height:40px;
            animation: spin-2 1s infinite linear;
        }
        @keyframes spin-1 {
            0% {transform: rotate(360deg); opacity: 1;}
            50% {transform: rotate(180deg); opacity: 0.5;}
            100% {transform: rotate(0deg); opacity: 1;}
        }
        @keyframes spin-2 {
            0% {transform: rotate(0deg); opacity: 0.5;}
            50% {transform: rotate(180deg); opacity: 1;}
            100% {transform: rotate(360deg); opacity: 0.5;}
        }
    </style>

</head>
<body>
<?php $this->beginBody() ?>



<div id="hola">
    <div id="preloader">
        <span></span>
        <span></span>
    </div>
</div>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center" style="padding-top: 21px;">MG-Строй-Сервис</h2>
                <h3 class="text-center" style="">Дом под ключ</h3>
                <h4 class="text-center" style="">Быстро, качественно и дешево!</h4>
            </div>
            <div class="col-md-3">
                <?=Html::img('@web/img/logo-01.jpg',['class' => 'logo-top img-responsive'])?>
            </div>
        </div>
        <p class="pull-left">
            <?=Html::a('На главную',['/str/project'])?>
        </p>

    </div>

</div>

<div class="container">
    <?= $content ?>
</div>

<div style="min-height: 43px;"></div>

<footer class="footer">
    <div class="container">
        <div class="">
            <p class="">
                <span class="text" style="">&copy; Martin German <?= date('Y') ?></span>
            </p>
        </div>
    </div>
</footer>

<?php
    $js1 = <<<JS
$("#hola").delay(150).fadeOut("slow"),$("body").delay(0).css({overflow:"visible"})
JS;

$this->registerJs($js1);

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
