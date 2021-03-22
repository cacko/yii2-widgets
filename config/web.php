<?php

use app\components\Navigation;
use yii\web\AssetConverter;

$params = require __DIR__ . '/params.php';

define('SERVER_HOSTNAME', $_SERVER['HTTP_HOST']);

if (SERVER_HOSTNAME === 'yii.cacko.net') {
    define("ENV_PROD", 1);
}

return [
    'id' => 'home',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => 'Yii2 Extensions',
    'layout' => 'main.twig',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],

    'modules' => [
        'video' => [
            'class' => 'app\modules\video\Module'
        ],
        'monaco' => [
            'class' => 'app\modules\monaco\Module'
        ],
        'fullscreen' => [
            'class' => 'app\modules\fullscreen\Module'
        ]
    ],
    'components' => [
        'redis' => [
            'class' => 'yii\redis\Connection',
            'unixSocket' => '/var/run/redis/redis-server.sock',
            'database' => 1
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => 'redis',
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => 'redis',
        ],
        'request' => [
            'cookieValidationKey' => 'A423423423424-Gcd4YrU5t9K5',
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'assetManager' => [
            'forceCopy' => !defined('ENV_PROD'),
            'converter' => [
                'class' => AssetConverter::class,
                'commands' => [
                    'scss' => ['css', '@vendor/bin/pscss --sourcemap  {from} > {to}']
                ]
            ]
        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => getenv("TWIG_CACHE") ?: '@runtime/Twig/cache',
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => '\yii\helpers\Html',
                        'Yii' => ['class' => \yii\BaseYii::class],
                        'theme' => isset($_COOKIE['theme']) && in_array($_COOKIE['theme'], ['light', 'dark']) ? $_COOKIE['theme'] : 'dark',
                        'themeLearn' => array_key_exists("learn", $_COOKIE) ? $_COOKIE['learn'] : "learn"
                    ],
                    'functions' => [
                        'instanceof' => fn($object, $className) => $object instanceof $className,
                    ],
                    'uses' => ['yii\bootstrap'],
                ],
            ],
        ],
        'navigation' => [
            'class' => Navigation::class,
        ],
        'youtubeApi' => [
            'class' => 'Cacko\Yii2\Widgets\Video\Components\YouTube\Api',
            'youtubeKey' => getenv('YOUTUBE_KEY'),
        ],
        'twitchApi' => [
            'class' => 'Cacko\Yii2\Widgets\Video\Components\Twitch\Api',
            'clientId' => getenv('TWITCH_CLIENT_ID'),
            'secretId' => getenv('TWITCH_SECRET_ID'),
        ],
    ],
    'params' => $params,
];
