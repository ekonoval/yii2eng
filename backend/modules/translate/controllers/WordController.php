<?php
namespace backend\modules\translate\controllers;

use backend\modules\translate\models\Word\BWordSearch;
use Yii;

class WordController extends TranslateController
{
    public function actionIndex($episodeID)
    {
        $searchModel = new BWordSearch();
        $searchModel->setEpisodeID($episodeID);
        //$dataProvider = $searchModel->search(Yii::$app->request->post());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        $filterUrl = $this->createWordsListUrl($episodeID);

        return $this->renderActionTpl([
            'filterUrl' => $filterUrl,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}
