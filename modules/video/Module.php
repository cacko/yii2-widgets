<?php

namespace app\modules\video;

use app\modules\ExtensionModuleInterface;
use app\modules\video\assets\MomentJsAsset;
use yii\base\Module as BaseModule;
use yii as Yii;
use yii\bootstrap4\Html;
use yii\web\View;

class Module extends BaseModule implements ExtensionModuleInterface
{

    const GITHUB_REPO = 'https://github.com/cacko/yii2-widget-video.git';

    const COMPOSER_NAME = 'cacko/yii2-widget-video';

    public $defaultRoute = '/video/widget';

    public function getNavigationName(): string
    {
        return 'Video';
    }

    public function getIcon(array $classes = []): string
    {
        return Html::tag('i', '', ['class' => ['icon-widgets-video-circled', ... $classes]]);
    }


    public function init()
    {
        parent::init();
        \Yii::configure($this, require __DIR__ . '/config.php');
    }

    public function beforeAction($action)
    {
        Yii::$container->set(View::class, ['title' => $this->getExtensionName()]);
        MomentJsAsset::register(Yii::$app->controller->view);
        return parent::beforeAction($action);
    }

    public function getExtensionName(): string
    {

        return 'Video Widget';
    }

    public function getRepository(): string
    {

        return static::GITHUB_REPO;
    }

    public function getExtensionVersion(): string
    {
        return Yii::$app->extensions[static::COMPOSER_NAME]['version'];
    }
}
