<?php
namespace backend\modules\translate\controllers;

use backend\ext\System\BackendController;

abstract class TranslateController extends BackendController
{
    public function createEpisodesIndexUrl($movieID)
    {
        return $this->getModuleUrl('index', 'episode', ['movieID' => $movieID]);
    }

    public function createWordsListUrl($episodeID)
    {
        return $this->getModuleUrl('index', 'word', ['episodeID' => $episodeID]);
    }
}
