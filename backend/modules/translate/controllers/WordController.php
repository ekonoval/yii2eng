<?php
namespace backend\modules\translate\controllers;

use backend\modules\translate\models\Word\BWordSearch;
use common\models\Translate\TrEpisode;
use Yii;

class WordController extends TranslateController
{
    /**
     * @var TrEpisode
     */
    public $episodeCurrent;

    protected function breadcrumps()
    {
        parent::breadcrumps();

        $episodeID = yR()->get('episodeID');

        if ($episodeID > 0) {
            /** @var TrEpisode $episode */
            $episode = TrEpisode::find()
                //->with('movie')
                ->where('episodeID = :episodeID', [':episodeID' => $episodeID])
                ->one()
            ;

            if (!empty($episode)) {
                $this->episodeCurrent = $episode;
                $this->bcMovieEpisodes($episode->movieID);

                $this->addBreadcrump(
                    $this->composeEpisodePlusSeasonString($episode),
                    $this->composeModuleUrl(null, 'word', ['episodeID' => $episodeID])
                );
            }
        }
    }

    public function composeEpisodePlusSeasonString(TrEpisode $episode)
    {
        return "S{$episode->seasonNum}-E{$episode->episodeNum}";
    }

    public function actionIndex($episodeID)
    {
        $searchModel = new BWordSearch();
        $searchModel->setEpisodeID($episodeID);
        //$dataProvider = $searchModel->search(Yii::$app->request->post());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        $filterUrl = $this->createWordsListUrl($episodeID);

        return $this->renderActionTpl([
            'title' => $this->composeEpisodePlusSeasonString($this->episodeCurrent),
            'filterUrl' => $filterUrl,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}
