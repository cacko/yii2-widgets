<?php

namespace app\modules\monaco\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public ?UploadedFile $file = null;

    public string $example = '';

    public function rules()
    {
        return [
            [
                ['file'], 'file', 'skipOnEmpty' => false,
                'checkExtensionByMimeType' => false,
                'extensions' => join(' ', array_keys(Script::LANGUAGES))
            ],
        ];
    }

    public function load($data, $formName = null): bool
    {
        if (array_key_exists($this->formName(), (array) $data)) {
            $data[$this->formName()]['file'] = UploadedFile::getInstance($this, 'file');
        }
        if (!parent::load($data, $formName)) {
            return false;
        }
        return $this->validate();
    }
}
