<?php

namespace app\modules\fullscreen\controllers;

use app\components\Navigation;
use yii\web\Controller;
use Faker;
use app\modules\fullscreen\components\LoremFlickrProvider;

class WidgetController extends Controller
{

    public function actionIndex(): string
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new LoremFlickrProvider($faker));
        return $this->render('index.twig', ['faker' => $faker]);
    }

}