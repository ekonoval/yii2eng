<?php
namespace common\ext\System;

use yii\helpers\Url;
use yii\web\Controller;

class AppController extends Controller
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

    public function composeModuleUrl($action = null, $ctrl = null, $params = [], $module = null)
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