<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/glyphicons.css',
        'bootstrap-4.4.1-dist/css/bootstrap.min.css',
        'css/site.css',
    ];
    public $js = [
        'https://code.jquery.com/jquery-3.4.1.js',
        'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
        //'bootstrap-4.4.1-dist/js/bootstrap.bundle.js',
        //'bootstrap-4.4.1-dist/js/bootstrap.bundle.js',
        //'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
        //'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
