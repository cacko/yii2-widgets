<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{

    public $layout = 'main.twig';

    public function actionIndex(): string
    {

        return $this->render('index.twig');
    }

    public function actionError(): string
    {
        if (defined('ENV_PROD')) {
            $this->layout = 'error';
        }
        return $this->render('error');
    }
}
