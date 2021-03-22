<?php

namespace app\modules\fullscreen;

use app\modules\ExtensionModuleInterface;
use app\modules\fullscreen\assets\ModuleAssets;
use yii\base\Module as BaseModule;
use yii as Yii;
use yii\bootstrap4\Html;
use yii\web\View;

class Module extends BaseModule implements ExtensionModuleInterface
{
    const GITHUB_REPO = 'https://github.com/cacko/yii2-widget-fullscreen.git';

    const COMPOSER_NAME = 'cacko/yii2-widget-fullscreen';

    public $defaultRoute = '/fullscreen/widget';

    public function getIcon(array $classes = []): string
    {
        return Html::tag('i', '', ['class' => ['icon-widgets-resize-full', ...$classes]]);
    }

    public function beforeAction($action)
    {
        Yii::$container->set(View::class, ['title' => $this->getExtensionName()]);
        ModuleAssets::register(Yii::$app->controller->view);
        return parent::beforeAction($action);
    }

    public function getExtensionName(): string
    {

        return 'FullScreen Widget';
    }

    public function getNavigationName(): string
    {
        return 'Fullscreen';
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
