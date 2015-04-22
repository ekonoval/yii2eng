<?php
namespace backend\modules\translate\controllers;

use backend\modules\translate\models\Word\BWordSearch;
use common\models\Translate\TrEpisode;
use common\models\Translate\TrMovie;
use Yii;
use yii\db\ActiveQuery;

class WordController extends TranslateController
{
    protected function breadcrumps()
    {
        parent::breadcrumps();

        //$this->bcMovieEpisodes();
        $episodeID = yR()->get('episodeID');
        pa($episodeID);

        if ($episodeID > 0) {
            /** @var TrEpisode $episode */
            $episode = TrEpisode::find()
                //->with('movie')
                ->where('episodeID = :episodeID', [':episodeID' => $episodeID])
                ->one()
            ;

            if (!empty($episode)) {
                $this->bcMovieEpisodes($episode->movieID);

                $this->addBreadcrump(
                    "S{$episode->seasonNum}-E{$episode->episodeNum}",
                    $this->composeModuleUrl(null, 'word', ['episodeID' => $episodeID])
                );
            }
        }
    }


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
