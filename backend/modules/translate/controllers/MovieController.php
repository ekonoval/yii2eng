<?php

namespace backend\modules\translate\controllers;

use backend\ext\System\BackendController;
use backend\modules\translate\models\Movie\BMovieSearch;
use common\models\Translate\TrMovie;
use Yii;
use yii\web\Controller;

class MovieController extends BackendController
{
    public function actionIndex()
    {
        $searchModel = new BMovieSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->renderActionTpl([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}
