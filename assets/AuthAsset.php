<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 31.01.2019
 * Time: 15:55
 */

namespace app\assets;

use yii\web\AssetBundle;


class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'auth_fonts/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
        'auth_fonts/fonts/font-awesome-4.7.0/css/font-awesome.css',
        'auth_css/util.css',
        'auth_css/main.css',
    ];
    public $js = [
        'auth_js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset', // подлючает и ксс и джс бутстрапа
        //'rmrevin\yii\fontawesome\AssetBundle',
        '\delocker\animate\AnimateAssetBundle',

    ];

//<!--===============================================================================================-->
//<!--===============================================================================================-->
//<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
//<!--===============================================================================================-->
//<!--===============================================================================================-->
//<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
//<!--===============================================================================================-->
//<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
//<!--===============================================================================================-->

}