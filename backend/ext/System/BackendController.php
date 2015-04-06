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
                    //--- allows admin-->>adminSuper ---//
                    'allowAdmins' => [
                        'allow' => true,
                        'roles' => [BUserRbac::ROLE_ADMIN]
                    ],

                    /*
                     * Disables those, who are below admin (oper) - first rule isn't applied
                     * !! Warning if we disable operator directly then the whole tree (oper-->>admin-->>super)
                     * will be disabled
                     */
                    [
                        'allow' => false,
                        'roles' => []
                    ]
                ]
            ]
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
