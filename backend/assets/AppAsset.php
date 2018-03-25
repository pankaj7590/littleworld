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
        'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/metisMenu/metisMenu.min.css',
        'css/sb-admin-2.css',
        'vendor/morrisjs/morris.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'css/site.css',
    ];
    public $js = [
		'vendor/metisMenu/metisMenu.min.js',
		'vendor/raphael/raphael.min.js',
		'vendor/morrisjs/morris.min.js',
		// 'data/morris-data.js',
		'vendor/sb-admin-2.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
