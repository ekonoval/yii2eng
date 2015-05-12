<?php
namespace backend\controllers;

use backend\ext\System\BackendController;
use common\ext\Misc\FlashMessageCreator;
use kartik\growl\GrowlAsset;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends BackendController
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
                        'actions' => ['login', 'error',],
                        'allow' => true,
                    ],
                    [
                        //'actions' => ['logout', 'index'],
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGrowlTest()
    {
        GrowlAsset::register($this->view);

        $fm = new FlashMessageCreator();
        //$fm->addSuccess('hey hey php');

        $growlVar = 'var growl_ba94427d = {"delay":3000,"placement":{"from":"top","align":"right"},"type":"success","template":"<div id=\"w0\" class=\"alert col-xs-10 col-sm-10 col-md-3\"><button type=\"button\" class=\"close\" data-growl=\"dismiss\"><span aria-hidden=\"true\">&times;</span></button>\n<span data-growl=\"icon\"></span>\n<span data-growl=\"title\"></span>\n<span data-growl=\"message\"></span>\n<a href=\"#\" data-growl=\"url\"></a></div>"};';
        $js =<<<JS
$growlVar
$.growl({"message":"hey hey","icon":"glyphicon glyphicon-ok-sign","title":"","url":""}, growl_ba94427d);
JS;

        $this->view->registerJs($js);

        return $this->render('index');
    }
}
