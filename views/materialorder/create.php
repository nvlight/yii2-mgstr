<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\str\models\Materialorder */

$this->title = 'Добавить материал';
$this->params['breadcrumbs'][] = ['label' => 'Materialorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materialorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
