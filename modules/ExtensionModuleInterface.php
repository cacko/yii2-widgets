<?php

namespace app\modules;

interface ExtensionModuleInterface
{

    public function getRepository(): string;

    public function getExtensionVersion(): string;

    public function getExtensionName(): string;

    public function getNavigationName(): string;

    public function getIcon(array $classes = []): string;
}
