<?php

namespace app\modules\video\assets;

use yii\web\AssetBundle;

class MomentJsAsset extends AssetBundle
{

    public $sourcePath = '@npm/moment/min';

    public $js = ['moment-with-locales.min.js'];

}