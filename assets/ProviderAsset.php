<?php

namespace app\extensions\provider\assets;

use yii\web\AssetBundle;

class ProviderAsset extends AssetBundle
{
    public $sourcePath = '@app/extensions/provider/web';

    public $js = [
        'js/providers.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}