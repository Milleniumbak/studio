<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "blueimp-gallery/css/site.css",
        "blueimp-gallery/css/blueimp-gallery.css",
        "blueimp-gallery/css/blueimp-gallery-indicator.css",
        "blueimp-gallery/css/blueimp-gallery-video.css",
        "blueimp-gallery/css/demo.css",
    ];
    public $js = [
        "blueimp-gallery/js/blueimp-helper.js",
        "blueimp-gallery/js/blueimp-gallery.js",
        "blueimp-gallery/js/blueimp-gallery-fullscreen.js",
        "blueimp-gallery/js/blueimp-gallery-indicator.js",
        "blueimp-gallery/js/blueimp-gallery-video.js",
        "blueimp-gallery/js/blueimp-gallery-vimeo.js",
        "blueimp-gallery/js/blueimp-gallery-youtube.js",
        "blueimp-gallery/js/vendor/jquery.js",
        "blueimp-gallery/js/jquery.blueimp-gallery.js",
        "blueimp-gallery/js/demo.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
