<?php
namespace backend\modules\translate\controllers\Episode;

class EpisodeEditAction extends EpisodeSaveAction
{
    protected function prepareModel()
    {
        parent::prepareModel();

        $this->controller->bcMovieEpisodes($this->model->movieID);
    }

    public function run($id)
    {
        $this->setPk($id);
        return $this->runCustom();
    }


}
