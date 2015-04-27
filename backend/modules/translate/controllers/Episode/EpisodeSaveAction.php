<?php
namespace backend\modules\translate\controllers\Episode;

use backend\ext\Grid\Crud\SaveAction;
use backend\modules\translate\controllers\EpisodeController;
use backend\modules\translate\models\Episode\BEpisodeSave;

/**
 * @property EpisodeController $controller
 * @property BEpisodeSave $model
 */
class EpisodeSaveAction extends SaveAction
{

    protected function initCustom()
    {
        parent::initCustom();
        $this->modelClass = BEpisodeSave::className();
    }

    protected function redirectAfterSave()
    {
        return $this->controller->redirect($this->controller->createEpisodesIndexUrl($this->model->movieID));
    }



}
