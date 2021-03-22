<?php

namespace app\assets;

use yii\web\AssetBundle;

class TerminalAsset extends AssetBundle
{

    public $sourcePath = '@app/assets/terminal';

    public $css = [
        'css/normalize.min.css',
        'css/terminal.min.css',
    ];
}
