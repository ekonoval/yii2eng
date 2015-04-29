<?php

namespace backend\modules\translate\controllers;

use backend\modules\translate\controllers\Movie\MovieCreateAction;
use backend\modules\translate\controllers\Movie\MovieDeleteAction;
use backend\modules\translate\controllers\Movie\MovieEditAction;
use backend\modules\translate\models\Movie\BMovieSearch;
use Yii;

class MovieController extends TranslateController
{
    public function actions()
    {
        return [
            'update' => MovieEditAction::className(),
            'create' => MovieCreateAction::className(),
            'delete' => MovieDeleteAction::className(),
        ];
    }

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
