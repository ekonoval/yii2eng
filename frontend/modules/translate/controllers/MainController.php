<?php

namespace frontend\modules\translate\controllers;

use frontend\ext\System\FrontendController;
use frontend\modules\translate\models\FMovieSearch;
use frontend\modules\translate\models\FWordSearch;
use Yii;
use yii\helpers\Url;

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

    public function actionWords($movieID)
    {
        $searchModel = new FWordSearch();
        $dataProvider = $searchModel->search(yR()->get());

        return $this->renderActionTpl([
            'movieID' => $movieID,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionTest()
    {
        echo "<h2>Vasya test  </h2>\n"; exit;
    }

    public function composeWordsUrl($movieID)
    {
        return Url::to(['/translate/words', 'movieID' => $movieID]);
    }
}
