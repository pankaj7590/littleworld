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
        'css/reset.css',
        'css/style.css',
        'css/grid_12.css',
        'css/site.css',
    ];
    public $js = [
		'js/jquery-1.7.min.js',
		'js/jquery.easing.1.3.js',
		'js/uCarousel.js',
		'js/tms-0.4.1.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
