<?php

namespace app\modules\video\controllers;

use yii\web\Controller;
use app\modules\video\models\Video;

class WidgetController extends Controller
{

    public function actionIndex()
    {

        $model = new Video([
            'url' => Video::getRandomDefaultVideo(),
            'placeholderImage' => 'https://' . SERVER_HOSTNAME . '/images/start.webp',
            'placeholderEndImage' => 'https://' . SERVER_HOSTNAME . '/images/end.webp',
            'autoPlay' => true,
            'hideControls' => true,
            'loop' => false,
            'startTimestamp' => strtotime('+' . rand(10, 30) . ' second'),
            'startPosition' => rand(1, 6),
        ]);

        if ($this->request->isAjax) {
            $model->load($this->request->post());
        }

        return $this->render('index', ['model' => $model]);
    }
}
