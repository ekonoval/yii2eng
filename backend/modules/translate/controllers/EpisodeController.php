<?php
namespace backend\modules\translate\controllers;

use backend\modules\translate\models\Episode\BEpisodeSearch;
use Yii;

class EpisodeController extends TranslateController
{
    public function actionIndex($movieID = null)
    {
        $searchModel = new BEpisodeSearch();
        $searchModel->setMovieID($movieID);
        //$dataProvider = $searchModel->search(Yii::$app->request->post());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        $filterUrl = $this->createEpisodesIndexUrl($movieID);

        return $this->renderActionTpl([
            'filterUrl' => $filterUrl,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}
