<?php

namespace frontend\modules\translate\controllers;

use yii\web\Controller;

class MainController extends Controller
{
    public function actionMoviesIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {

        echo "<h2>Vasya test  </h2>\n"; exit;
    }
}
