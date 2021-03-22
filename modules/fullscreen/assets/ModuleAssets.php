<?php

namespace app\modules\fullscreen\assets;

use app\assets\AppAsset;
use Cacko\Yii2\Widgets\FullScreen\FullScreenAsset;
use yii\web\AssetBundle;

class ModuleAssets extends AssetBundle
{

    public $sourcePath = __DIR__;

    public $css = ['css/module.scss'];

    public $depends = [
        AppAsset::class,
        FullScreenAsset::class,
    ];
}
