<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\str\models\Materialorder */

$this->title = 'Update Materialorder: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Materialorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="materialorder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
