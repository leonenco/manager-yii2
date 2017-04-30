<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/manager.css',
        'css/m-media.css',
        //'css/bootstrap-datepicker3.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
    ];
    public $js = [
    	//'js/jquery-ui.min.js',
        'https://code.highcharts.com/highcharts.js',
        'https://code.highcharts.com/modules/exporting.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        'js/admin.js',
        'js/nav.js',
        'js/modals.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
