<?php

namespace app\modules\monaco\models;

use SplFileObject;
use yii\base\Model;
use yii\web\UploadedFile;

class Script extends Model
{

    public ?SplFileObject $file = null;

    public ?UploadedFile $uploadedFile = null;

    public string $script = '';

    public string $type = '';

    public string $name = '';

    const LANGUAGES = [
        'html' => 'html',
        'css' => 'css',
        'py' => 'python',
        'js' => 'javascript',
        'ts' => 'typescript',
        'java' => 'java',
        'php' => 'php',
        'md' => 'markdown',
    ];

    public function init()
    {
        if ($this->uploadedFile) {
            $file = $this->uploadedFile;
            $this->type = $this->getTypeByExt($file->getExtension());
            $this->file = new SplFileObject($file->tempName);
            $this->name = $file->name;
        } else if ($this->file) {
            $this->type = $this->getTypeByExt($this->file->getExtension());
            $this->name = $this->file->getBaseName();
        }

        $file = $this->file;
        $this->script = $file->fread(($file->getSize()));

        parent::init();
    }

    protected function getTypeByExt(string $ext): string
    {
        return array_key_exists($ext, static::LANGUAGES) ? static::LANGUAGES[$ext] : '';
    }
}
