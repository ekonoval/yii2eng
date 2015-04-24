<?php
namespace backend\modules\translate\controllers\Episode;

use backend\ext\Grid\Save\SaveAction;
use backend\modules\translate\models\Episode\BEpisodeSave;

class EpisodeSaveAction extends SaveAction
{

    public function run($id)
    {
        $this->setPk($id);
        return $this->runCustom();
    }

    protected function initCustom()
    {
        parent::initCustom();
        $this->modelClass = BEpisodeSave::className();
    }



}
