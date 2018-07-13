<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\str\models\Material */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-view">

    <?php //'getAlias: ' . Yii::getAlias('@web') ?>

    <p>
        <?= Html::a('В список материалов', ['/str/material']) ?>
    </p>


    <h4>Материал: <?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'name',
            'short_desc:raw',
            'description:raw',
            'price',
            'price2',
            [
                'attribute' => 'image_id',
                'label' => 'Имя картинки'
            ],
            [
                'attribute' => 'price2',
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function ($data){
                    $img = Html::img('@web/'.Yii::$app->params['img_converted'] . $data->image_id,
                    ['width' => '160px', 'height' => '180px']);
                    return $img;
                }
            ],
        ],
    ]) ?>

</div>
