<?php

namespace app\components;

use app\modules\ExtensionModuleInterface;
use yii\base\Component;
use yii\base\Module;

/**
 * @package app\components
 * @property-read ExtensionModuleInterface[] $extensionModules
 */
class Navigation extends Component
{

    protected array $modules = [];

    public function init()
    {
        parent::init();
        $moduleIds = array_keys(\Yii::$app->modules);
        $this->modules = array_reduce($moduleIds, fn (array $res, string $moduleId) => [\Yii::$app->getModule($moduleId), ...$res], []);
    }

    public function getExtensionModules(): array
    {
        return array_filter($this->modules, fn (Module $module) => $module instanceof ExtensionModuleInterface);
    }
}
