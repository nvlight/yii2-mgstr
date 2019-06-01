<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StrUser */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Str Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="str-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'password',
            'name',
            'i_group',
            'restore_date',
            'restore_count',
            'restore_hash',
            'create_date',
            'update_last_date',
        ],
    ]) ?>

</div>
