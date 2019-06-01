<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StrUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Str Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="str-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Str User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'password',
            'name',
            'i_group',
            //'restore_date',
            //'restore_count',
            //'restore_hash',
            //'create_date',
            //'update_last_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
