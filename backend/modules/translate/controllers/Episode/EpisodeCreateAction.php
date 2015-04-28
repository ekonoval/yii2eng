<?php
namespace backend\modules\translate\controllers\Episode;

class EpisodeCreateAction extends EpisodeSaveAction
{
    private $movieID;

    protected function initCustom()
    {
        parent::initCustom();
        $this->actionType = self::ACTION_TYPE_CREATE;
    }


    public function run($movieID)
    {
        $this->movieID = @intval($movieID);

        return $this->runCustom();
    }

    protected function prepareModel()
    {
        parent::prepareModel();

        $this->model->movieID = $this->movieID;
    }


}
