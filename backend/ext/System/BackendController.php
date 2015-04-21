<?php
namespace backend\ext\System;

use backend\ext\User\BUserRbac;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class BackendController extends Controller
{
    /**
     * Breadcrumps
     * @var array
     */
    protected $bc;

    public function addBreadcrump($label, $url, $key = null)
    {
        $item = ['label' => $label, 'url' => $url];

        if (!is_null($key)) {
            $this->bc[$key] = $item;
        } else {
            $this->bc[] = $item;
        }
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

    public function renderActionTpl($params = [])
    {
        $view = "{$this->action->id}_tpl";
        return parent::render($view, $params);
    }

    public function getModuleUrl($action = null, $ctrl = null, $params = [], $module = null)
    {
        if (is_null($action)) {
            $action = $this->action->id;
        }

        if (is_null($ctrl)) {
            $ctrl = $this->id;
        }

        if (is_null($module)) {
            $module = $this->module->id;
        }

        $path = "/{$module}/{$ctrl}/{$action}";
        $res = [$path] + $params;

        return Url::to($res);
    }


}
