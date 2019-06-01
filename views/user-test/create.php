<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StrUser */

$this->title = 'Create Str User';
$this->params['breadcrumbs'][] = ['label' => 'Str Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="str-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
