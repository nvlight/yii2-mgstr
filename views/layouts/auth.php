<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 31.01.2019
 * Time: 13:56
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AuthAsset;

use kartik\select2\Select2;

//use delocker\animate\AnimateAssetBundle;

AuthAsset::register($this);
//AnimateAssetBundle::register($this);

//use app\assets\AppAsset;
//
//AppAsset::register($this);


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
    <link rel="icon" type="image/png" href="<?php echo Url::to('@web/img/favicon.png',true)?>" />
</head>
<body>
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
