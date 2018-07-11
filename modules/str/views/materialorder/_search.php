<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\str\models\MaterialorderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materialorder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_project') ?>

    <?= $form->field($model, 'id_room') ?>

    <?= $form->field($model, 'id_material') ?>

    <?= $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
