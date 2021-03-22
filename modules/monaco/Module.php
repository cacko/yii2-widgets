<?php

namespace app\modules\monaco;

use app\modules\ExtensionModuleInterface;
use app\modules\monaco\assets\ModuleAsset;
use yii\base\Module as BaseModule;
use yii as Yii;
use yii\bootstrap4\Html;
use yii\web\View;

class Module extends BaseModule implements ExtensionModuleInterface
{

    const GITHUB_REPO = 'https://github.com/cacko/yii2-widget-monaco.git';

    const COMPOSER_NAME = 'cacko/yii2-widget-monaco';

    public $defaultRoute = '/monaco/widget';

    public function getIcon(array $classes = []): string
    {
        return Html::tag('i', '', ['class' => ['icon-widgets-code', ...$classes]]);
    }


    public function init()
    {
        parent::init();
    }

    public function beforeAction($action)
    {
        Yii::$container->set(View::class, ['title' => $this->getExtensionName()]);
        return parent::beforeAction($action);
    }

    public function getExtensionName(): string
    {

        return 'Monaco Editor/Diff Widget';
    }

    public function getNavigationName(): string
    {
        return 'Monaco';
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
