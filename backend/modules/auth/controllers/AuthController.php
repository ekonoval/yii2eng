<?php

namespace backend\modules\auth\controllers;

use backend\ext\System\BackendController;
use backend\ext\User\BIdentity;
use backend\modules\auth\models\BLoginForm;
use Yii;
use yii\helpers\ArrayHelper;

class AuthController extends BackendController
{

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
                        ],
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest()
    {
        /** @var BIdentity $identity */
        $identity = Yii::$app->user->getIdentity();
//        $identity->generateAuthKey();
//        $identity->save();

        pa($_SESSION, $_COOKIE);

        echo "<h2>auth test  </h2>\n";
    }

}
