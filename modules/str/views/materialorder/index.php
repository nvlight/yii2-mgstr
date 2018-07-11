<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\str\models\MaterialorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materialorders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materialorder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Materialorder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_project',
            'id_room',
            'id_material',
            'count',
            //'price',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
