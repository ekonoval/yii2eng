<?php
namespace backend\modules\translate\controllers\Movie;

class MovieCreateAction extends MovieSaveAction
{
    protected function initCustom()
    {
        parent::initCustom();
        $this->actionType = self::ACTION_TYPE_CREATE;
    }

    public function run()
    {
        return $this->runCustom();
    }
}
