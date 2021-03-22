<?php

namespace app\assets;

use yii\web\AssetBundle;

class SiteAsset extends AssetBundle
{

    public $sourcePath = '@app/assets/site';

    public $css = [
        'css/yii2-widgets-embedded.css',
        'css/animate.min.css',
        'css/animation.css',
        'css/theme.scss',
        'css/site.scss'
    ];

    public $js = [
        'js/site.js'
    ];

    public $depends = [
        AppAsset::class,
        TerminalAsset::class,
    ];
}
