<?php

namespace backend\modules\auth\controllers;

use backend\ext\System\BackendController;
use backend\modules\auth\models\BLoginForm;
use Yii;
use yii\helpers\ArrayHelper;

class AuthController extends BackendController
{
//    public function actionIndex()
//    {
//        return $this->render('index');
//    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'rules' => [
                        [
                            'actions' => ['login'],
                            'allow' => true,
                            'roles' => ['?']
                        ]
                    ]
                ]
            ]
        );
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new BLoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionTest()
    {

        echo "<h2>Vasya   </h2>\n";
    }
}
