<?php

//rmrevin\yii\fontawesome\AssetBundle::register($this);
use yii\helpers\Html;
use yii\grid\GridView;
use kv4nt\owlcarousel\OwlCarouselWidget;
use rmrevin\yii\fontawesome\FontAwesome;
use rmrevin\yii\fontawesome\FAR;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\str\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php

        //echo FontAwesome::icon('angle-double-left');
//
//        echo FontAwesome::icon('home'); // <i class="FontAwesome fa-home"></i>
//        // normal use
//        echo FontAwesome::icon('home'); // <i class="FontAwesome fa-home"></i>
//
//        // shortcut
//        echo FontAwesome::i('home'); // <i class="FontAwesome fa-home"></i>
//
//        // icon with additional attributes
//        echo FontAwesome::icon(
//            'arrow-left',
//            ['class' => 'big', 'data-role' => 'arrow']
//        ); // <i class="big FontAwesome fa-arrow-left" data-role="arrow"></i>
//
//        // icon in button
//        echo Html::submitButton(
//            Yii::t('app', '{icon} Save', ['icon' => FontAwesome::icon('check')])
//        ); // <button type="submit"><i class="FontAwesome fa-check"></i> Save</button>
//
//        // icon with additional methods
//        echo FontAwesome::icon('cog')->inverse();    // <i class="FontAwesome fa-cog fa-inverse"></i>
//        echo FontAwesome::icon('cog')->spin();       // <i class="FontAwesome fa-cog fa-spin"></i>
//        echo FontAwesome::icon('cog')->fixedWidth(); // <i class="FontAwesome fa-cog fa-fw"></i>
//        echo FontAwesome::icon('cog')->li();         // <i class="FontAwesome fa-cog fa-li"></i>
//        echo FontAwesome::icon('cog')->border();     // <i class="FontAwesome fa-cog fa-border"></i>
//        echo FontAwesome::icon('cog')->pullLeft();   // <i class="FontAwesome fa-cog pull-left"></i>
//        echo FontAwesome::icon('cog')->pullRight();  // <i class="FontAwesome fa-cog pull-right"></i>
//
//        // icon size
//        echo FontAwesome::icon('cog')->size(FontAwesome::SIZE_3X);
//        // values: FontAwesome::SIZE_LARGE, FontAwesome::SIZE_2X, FontAwesome::SIZE_3X, FontAwesome::SIZE_4X, FontAwesome::SIZE_5X
//        // <i class="FontAwesome fa-cog fa-size-3x"></i>
//
//        // icon rotate
//        echo FontAwesome::icon('cog')->rotate(FontAwesome::ROTATE_90);
//        // values: FontAwesome::ROTATE_90, FontAwesome::ROTATE_180, FontAwesome::ROTATE_180
//        // <i class="FontAwesome fa-cog fa-rotate-90"></i>
//
//        // icon flip
//        echo FontAwesome::icon('cog')->flip(FontAwesome::FLIP_VERTICAL);
//        // values: FontAwesome::FLIP_HORIZONTAL, FontAwesome::FLIP_VERTICAL
//        // <i class="FontAwesome fa-cog fa-flip-vertical"></i>
//
//        // icon with multiple methods
//        echo FontAwesome::icon('cog')
//            ->spin()
//            ->fixedWidth()
//            ->pullLeft()
//            ->size(FontAwesome::SIZE_LARGE);
//        // <i class="FontAwesome fa-cog fa-spin fa-fw pull-left fa-size-lg"></i>
//
//        // icons stack
//        echo FontAwesome::stack()
//            ->icon('twitter')
//            ->on('square-o');
//        // <span class="fa-stack">
//        //   <i class="FontAwesome fa-square-o fa-stack-2x"></i>
//        //   <i class="FontAwesome fa-twitter fa-stack-1x"></i>
//        // </span>
//
//        // icons stack with additional attributes
//        echo FontAwesome::stack(['data-role' => 'stacked-icon'])
//            ->on(FontAwesome::Icon('square')->inverse())
//            ->icon(FontAwesome::Icon('cog')->spin());
//        // <span class="fa-stack" data-role="stacked-icon">
//        //   <i class="FontAwesome fa-square-o fa-inverse fa-stack-2x"></i>
//        //   <i class="FontAwesome fa-cog fa-spin fa-stack-1x"></i>
//        // </span>
//
//        // unordered list icons
//        echo FontAwesome::ul(['data-role' => 'unordered-list'])
//            ->item('Bullet item', ['icon' => 'circle'])
//            ->item('Checked item', ['icon' => 'check']);
//        // <ul class="fa-ul" data-role="unordered-list">
//        //   <li><i class="FontAwesome fa-circle fa-li"></i>Bullet item</li>
//        //   <li><i class="FontAwesome fa-check fa-li"></i>Checked Item</li>
//        // </span>
//
//        // autocomplete icons name in IDE
//        echo FontAwesome::icon(FontAwesome::_COG);
//        echo FontAwesome::icon(FontAwesome::_DESKTOP);
//        echo FontAwesome::stack()
//            ->on(FontAwesome::_CIRCLE)
//            ->icon(FontAwesome::_TWITTER);

    ?>

    <?php
        OwlCarouselWidget::begin([
            'container' => 'div',
            'containerOptions' => [
                'id' => 'container-id',
                'class' => 'container-class'
            ],
            'pluginOptions'    => [
                //'autoplay'          => true,
                'autoplayTimeout'   => 3000,
                'items'             => 3,
                'loop'              => true,
                //'itemsDesktop'      => [1199, 3],
                //'itemsDesktopSmall' => [979, 3]
                'margin' => 10,
                'nav' => 'true',
            ]
        ]);
    ?>

    <div class="item"><?=Html::img('@web/img/slider/img1.png')?></div>
    <div class="item"><?=Html::img('@web/img/slider/img2.png')?></div>
    <div class="item"><?=Html::img('@web/img/slider/img3.png')?></div>
    <div class="item"><?=Html::img('@web/img/slider/img4.png')?></div>
    <div class="item"><?=Html::img('@web/img/slider/img5.png')?></div>

    <?php OwlCarouselWidget::end(); ?>


    <p><span class="h3"><?= Html::encode($this->title) ?></span></p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'content' => function($model, $key, $index, $column){
                    return $model->id;
                }
            ],
//            [
//                //'header' => 'Rank',
//                'attribute' => 'id',
//                'label' => 'id',
//                'value' => function($data){
//                    return $data->id;
//                }
//            ],
            [
                'attribute' => 'name',
                'content' => function($model, $key, $index, $column){
                    return Html::a($model->name,'/str/project/view?id='.$model->id);
                }
            ],
            'location',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
