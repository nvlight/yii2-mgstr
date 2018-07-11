<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\components\Debug;

/* @var $this yii\web\View */
/* @var $model app\modules\str\models\Materialorder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Materialorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$m2 = \app\modules\str\models\Room::find()->where(['id' => $model->id_room])->with('project')->one();
//echo Debug::d($m2,'$m2'); die;
if ($m2){
    $links[] = [$m2->project->name,Url::to(['/str/project/view?id='.$m2->project->id],true), 'Проект' ];
    $links[] = [$m2->name,Url::to(['/str/room/view?id='.$m2->id],true), 'Комната' ];

    // надо вместо титла вывести тип материала
    $material = \app\modules\str\models\Material::find()->where(['id' => $model->id_material])->one();
    if ($material){
        $this->title = $material->name;
    }
}

?>
<div class="materialorder-view">

    <?php if (isset($links) && is_array($links) && count($links) ): ?>
        <?php foreach($links as $k => $v): ?>
            <p><?=$v[2]?>: <?= Html::a($v[0], $v[1], ['class' => '']) ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <h4>Заказанный материал: <?= Html::encode($this->title) ?></h4>

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
            //'id_project',
            [
                'attribute' => 'id_project',
                'value' => function ($data){
                    $project = \app\modules\str\models\Project::find()->where(['id' => $data->id_project])->one();
                    //echo Debug::d($project,'$project');
                    if ($project) {return $project->name;}
                    return $data->id_room;
                }
            ],
            [
                'attribute' => 'id_room',
                'value' => function ($data){
                    $room = \app\modules\str\models\Room::find()->where(['id' => $data->id_room])->one();
                    //echo Debug::d($room,'room');
                    if ($room) {return $room->name;}
                    return $data->id_room;
                }
            ],
            //'id_material',
            [
//                'attribute' => 'id_material',
//                'value' => function ($data){
//                    $material = \app\modules\str\models\Material::find()->where(['id' => $data->id_material])->one();
//                    if ($material) {return $material->name;}
//                    return $data->id_material;
//                }
                'attribute' => 'id_material',
                'format' => 'raw',
                'value' => function ($data){
                    return Html::a($data->material->name,['/str/material/view?id='.$data->id_material],['target' => '_blank']);
                }

            ],
            'count',
            'price',
            'note',
        ],
    ]) ?>

</div>
