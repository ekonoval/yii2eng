<?php

namespace backend\modules\translate\controllers;

use backend\modules\translate\models\Movie\BMovieSearch;
use Yii;

class MovieController extends TranslateController
{
    public function actionIndex()
    {
        $searchModel = new BMovieSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->renderActionTpl([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}
