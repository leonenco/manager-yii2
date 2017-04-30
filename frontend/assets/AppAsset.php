<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/manager.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
    ];
    public $js = [
    	'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'js/jquery-ui-timepicker-addon.js',
        'https://code.highcharts.com/highcharts.js',
        'https://code.highcharts.com/modules/exporting.js',
        'js/admin.js',
        'js/nav.js',
        'js/modals.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
