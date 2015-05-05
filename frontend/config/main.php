<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',

    'modules' => [
        'translate' => [
            'class' => 'frontend\modules\translate\TranslateFrontMod',
        ],
    ],

    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],

        'urlManager' => [
            'rules' => array(
                '/translate' => 'translate/main/movies-index',
                '/translate/<a:(?!main)[\w+\-]+>' => 'translate/main/<a>',
                //'/translate/test/movieID/<id:\d+>' => 'translate/main/test',
            )
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
