<?php
namespace backend\modules\translate\controllers;

use backend\modules\translate\controllers\Episode\EpisodeCreateAction;
use backend\modules\translate\controllers\Episode\EpisodeEditAction;
use backend\modules\translate\models\Episode\BEpisodeSave;
use backend\modules\translate\models\Episode\BEpisodeSearch;
use common\ext\Misc\FlashMessageCreator;
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
            'movieID' => $movieID,
            'filterUrl' => $filterUrl,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionDelete($id)
    {
        $episode = BEpisodeSave::findModel($id);
        $flashMsg = new FlashMessageCreator();

        $wordsCount = $episode->getWords()->count();
        if ($wordsCount > 0) {
            $flashMsg->addWarning("Can't delete episode #{$id} cause it has related words");
        } else {
            $episode->delete();
            $flashMsg->addSuccess("Episode ".$episode->composeStringRepresentation(). " has been deleted");
        }

        return $this->redirect($this->createEpisodesIndexUrl($episode->movieID));
    }

}