<?php

namespace frontend\modules\translate\controllers;

use frontend\ext\System\FrontendController;
use frontend\modules\translate\models\FMovieSearch;
use Yii;

class MainController extends FrontendController
{
    public function actionMoviesIndex()
    {
        $searchModel = new FMovieSearch();
        $dataProvider = $searchModel->search(yR()->get());

        return $this->renderActionTpl([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionWords()
    {

    }

    public function actionTest()
    {
        echo "<h2>Vasya test  </h2>\n"; exit;
    }
}
