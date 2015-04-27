<?php
namespace backend\modules\translate\controllers\Episode;

class EpisodeEditAction extends EpisodeSaveAction
{
    public function run($id)
    {
        $this->setPk($id);
        return $this->runCustom();
    }


}
