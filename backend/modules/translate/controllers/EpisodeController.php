<?php
namespace backend\modules\translate\controllers;

use backend\modules\translate\controllers\Episode\EpisodeCreateAction;
use backend\modules\translate\controllers\Episode\EpisodeEditAction;
use backend\modules\translate\models\Episode\BEpisodeSearch;
use common\models\Translate\TrMovie;
use Yii;

class EpisodeController extends TranslateController
{
    protected function breadcrumps()
    {
        parent::breadcrumps();

        $this->bcMovieEpisodes();
    }

    public function actions()
    {
        return [
            'update' => EpisodeEditAction::className(),
            'create' => EpisodeCreateAction::className()
        ];
    }


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