<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StrUser */

$this->title = 'Update Str User: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Str Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="str-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
