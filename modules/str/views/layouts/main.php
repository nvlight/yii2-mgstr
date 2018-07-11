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
</head>
<body>
<?php $this->beginBody() ?>

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

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            <span class="text" style="">&copy; Martin German <?= date('Y') ?></span>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
