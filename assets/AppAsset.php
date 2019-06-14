<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/compress/site.css',
        'css/compress/adaptive.css',
    ];
    public $js = [
        'js/compress/common.js',
        'js/compress/site.js',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Disable standard asset bundles
        Yii::$app->assetManager->bundles = [
            'yii\bootstrap\BootstrapPluginAsset' => [
                'js' => []
            ],
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
            ],
        ];
    }
}
