<?php

namespace frontend\modules\translate\controllers;

use common\models\Translate\TrEpisode;
use frontend\ext\System\FrontendController;
use frontend\modules\translate\models\FMovieSearch;
use frontend\modules\translate\models\FWordSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class MainController extends FrontendController
{
    public function actionMovies()
    {
        $searchModel = new FMovieSearch();
        $dataProvider = $searchModel->search(yR()->get());

        return $this->render('movies-index_tpl',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionWords($movieID)
    {
        $searchModel = new FWordSearch();
        $dataProvider = $searchModel->search($movieID, yR()->get());

        //--- get seasons available ---//
        //$episodes = $this->getEpisodesAvailable($movieID);
        $episodes = $this->getEpisodesAvailableGroupped($movieID);

        return $this->renderActionTpl([
            'movieID' => $movieID,
            'episodes' => $episodes,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    private function getEpisodesAvailableGroupped($movieID)
    {
        $episodesRaw = TrEpisode::find()
            ->andFilterWhere(['movieID' => $movieID])
            ->addOrderBy([
                'seasonNum' => SORT_ASC,
                'episodeNum' => SORT_ASC,
            ])
            ->asArray()
            ->all()
        ;
        //pa($episodesRaw);

        $episodes = [];
        foreach ($episodesRaw as $epVal) {
            $seasonNum = $epVal["seasonNum"];
            $episodes[$seasonNum][$epVal["episodeID"]] = "s{$seasonNum}.e{$epVal["episodeNum"]}";
        }

        return $episodes;
    }

    private function getEpisodesAvailable($movieID)
    {
        $episodesRaw = TrEpisode::find()
            ->andFilterWhere(['movieID' => $movieID])
            ->addOrderBy([
                'seasonNum' => SORT_ASC,
                'episodeNum' => SORT_ASC,
            ])
            ->asArray()
            ->all()
        ;
        //pa($episodesRaw);

        $episodes = [];
        foreach ($episodesRaw as $epVal) {
            $episodes[$epVal["episodeID"]] = "s{$epVal["seasonNum"]}.e{$epVal["episodeNum"]}";
        }

        return $episodes;
    }

    public function actionTest()
    {
        echo "<h2>Vasya test  </h2>\n"; exit;
    }

    public function composeWordsUrl($movieID)
    {
        return Url::to(['/translate/words', 'movieID' => $movieID]);
    }
}
