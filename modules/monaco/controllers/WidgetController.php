<?php

namespace app\modules\monaco\controllers;

use app\modules\monaco\models\Script;
use app\modules\monaco\models\UploadForm;
use SplFileObject;
use yii as Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class WidgetController extends Controller
{

    public function actionIndex()
    {
        $formModel = new UploadForm();

        $model = null;

        if ($this->request->isPjax && $formModel->load($this->request->post())) {
            $this->response = Response::FORMAT_RAW;
            $model = new Script(['uploadedFile' => $formModel->file]);
            return $this->render('form', ['model' => $model, 'formModel' => $formModel]);
        } else if (!$formModel->errors) {
            $model = new Script(['file' => new SplFileObject(Yii::getAlias('@app/modules/monaco/assets/monaco.js'))]);
        }
        return $this->render('monaco', ['model' => $model, 'formModel' => $formModel]);
    }
}
