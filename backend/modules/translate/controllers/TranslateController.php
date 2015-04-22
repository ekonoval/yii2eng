<?php
namespace backend\modules\translate\controllers;

use backend\ext\System\BackendController;
use common\models\Translate\TrMovie;
use Yii;

abstract class TranslateController extends BackendController
{
    public function createEpisodesIndexUrl($movieID)
    {
        return $this->composeModuleUrl('index', 'episode', ['movieID' => $movieID]);
    }

    public function createWordsListUrl($episodeID)
    {
        return $this->composeModuleUrl('index', 'word', ['episodeID' => $episodeID]);
    }

    protected function breadcrumps()
    {
        parent::breadcrumps();
        $this->bcMovieIndex();
    }


    protected function bcMovieIndex()
    {
        $this->addBreadcrump('Movies', $this->composeModuleUrl(null, 'movie'));
    }

    protected function bcMovieEpisodes($movieID = null)
    {
        if (is_null($movieID)) {
            $movieID = Yii::$app->request->get('movieID');
            $movieID = intval($movieID);
        }

        if ($movieID > 0) {
            $movie = TrMovie::find()
                ->select('movieID, movieName')
                ->where('movieID = :movieID', [':movieID' => $movieID])
                ->one()
            ;
            if ($movie) {
                $this->addBreadcrump(
                    "Episodes of '{$movie->movieName}'",
                    $this->createEpisodesIndexUrl($movieID)
                );
            }
        }
    }
}
