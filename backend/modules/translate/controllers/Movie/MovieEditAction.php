<?php
namespace backend\modules\translate\controllers\Movie;

class MovieEditAction extends MovieSaveAction
{
    public function run($id)
    {
        $this->setPk($id);
        return $this->runCustom();
    }
}
