<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\str\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?= Html::a('Создать новый вид материала', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'format' => 'raw',
                'attribute' => 'short_desc',
                'value' => function ($data){
                    return <<<HTML
<strong>{$data['short_desc']}</strong>
HTML;
                }
            ],
            'description:raw',
            'price',
            //'price2',
            [
                'label' => 'картинка',
                'attribute' => 'image_id',
                'format' => 'raw',
                'value' => function ($data){
                    return Html::img('@web/'.Yii::$app->params['img_converted'] . $data->image_id,
                        ['width' => '70px', 'height' => '60px', 'class' => 'img-center']
                    );
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
