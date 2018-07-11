<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\str\models\Material;

/* @var $this yii\web\View */
/* @var $model app\modules\str\models\Materialorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materialorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'id_project')->textInput() ?>

    <?php //echo $form->field($model, 'id_room')->textInput() ?>

    <?php // echo $form->field($model, 'id_material')->textInput()->label('Материал') ?>

    <?php
    $params = [
        'class' => 'form-control dropdown_class-id_job',
        'id' => 'dropdown_id-id_job',
        'prompt'=>'Выберите материал'
    ];
    echo $form->field($model, 'id_material')->dropDownList(
        Material::find()->select(['short_desc','id'])->indexBy('id')->column(),
        $params
    )->label('Материал');

    ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?php echo $form->field($model, 'price')->textInput()->label('Цена - установка вручную') ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
