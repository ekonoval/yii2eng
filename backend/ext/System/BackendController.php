<?php
namespace backend\ext\System;

use backend\ext\User\BUserRbac;
use common\ext\System\AppController;
use yii\filters\AccessControl;

class BackendController extends AppController
{
    /**
     * Breadcrumps
     * @var array
     */
    public $bc = [];

    public function addBreadcrump($label, $url, $key = null)
    {
        $item = ['label' => $label, 'url' => $url];

        if (!is_null($key)) {
            $this->bc[$key] = $item;
        } else {
            $this->bc[] = $item;
        }
    }

    protected function breadcrumps(){}

    public function beforeAction($action)
    {
        $this->breadcrumps();
        return parent::beforeAction($action);
    }


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

}
