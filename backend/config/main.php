<?php
use backend\ext\User\BIdentity;
use backend\ext\User\BPhpAuthManager;
use backend\ext\User\BWebUser;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'auth' => [
            'class' => 'backend\modules\auth\Auth',
        ],
        'translate' => [
            'class' => 'backend\modules\translate\TranslateMod',
        ],
    ],
    'components' => [
        'user' => [
            'class' => BWebUser::className(),
            //'identityClass' => 'common\models\User',
            'identityClass' => BIdentity::className(),
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => BPhpAuthManager::className(),
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array(
                '/auth/<a:\w+>' => 'auth/auth/<a>',
                '/translate/episode/index/movieID/<movieID:\d+>' => 'translate/episode/index',
                '/translate/word/index/episodeID/<episodeID:\d+>' => 'translate/word/index',

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
        'formatter' => [
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:Y-m-d H:i:s'
        ]
    ],
    'params' => $params,
];
