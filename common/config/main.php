<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        //--- pretty urls ---//
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ],
    ],


];
