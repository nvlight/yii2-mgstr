<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 31.01.2019
 * Time: 15:55
 */

namespace app\assets;

use yii\web\AssetBundle;


class NatpotAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'auth_fonts/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
        //'auth_fonts/fonts/font-awesome-4.7.0/css/font-awesome.css',
        'css/main-natpot.css',
        //'css/natpot_addon.css',
    ];
    public $js = [
        'js/main-natpot.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset', // подлючает и ксс и джс бутстрапа
        //'rmrevin\yii\fontawesome\AssetBundle',
        //'\delocker\animate\AnimateAssetBundle',

    ];

}