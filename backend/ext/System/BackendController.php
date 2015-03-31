<?php
namespace backend\ext\System;

use backend\ext\User\BUserRbac;
use yii\filters\AccessControl;
use yii\web\Controller;

class BackendController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //'actions' => ['logout', 'index'],
                        'actions' => [],
                        'allow' => true,
                        'roles' => [BUserRbac::ROLE_ADMIN],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
