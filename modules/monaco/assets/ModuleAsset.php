<?php

namespace app\modules\monaco\assets;

use Cacko\Yii2\Widgets\FullScreen\FullScreenAsset;
use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{

    public $sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'module';

    public $css = ['css/view.scss'];

    public $depends = [FullScreenAsset::class];

    public static function register($view)
    {

        $am = $view->assetManager;

        $bundle = $am->getBundle(__CLASS__);

        $view->registerJs(file_get_contents($am->getAssetPath($bundle, 'js/view.js')));

        return parent::register($view);
    }
}
