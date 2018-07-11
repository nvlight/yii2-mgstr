<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use snewer\images\widgets\ImageUploadWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\str\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_desc')->textInput() ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price2')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'img')->textInput() ?>

    <?= $form->field($model, 'img')->fileInput() ?>

    <div class="form-group">
        <?php
            echo Html::img('@web/'.Yii::$app->params['img_uploads'].$model->image_id,[
                'width' => '160px', 'height' => '180px'
            ])
            //echo $form->field($model, 'image_id')->textInput();
            //echo $form->field($model, 'image_id')->widget('snewer\images\widgets\ImageUploadWidget');
            //echo $form->field($model, 'image_id')->widget(ImageUploadWidget::className());
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
