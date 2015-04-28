<?php
namespace backend\modules\translate\controllers\Movie;

use backend\ext\Grid\Crud\DeleteAction;
use backend\modules\translate\models\Movie\BMovieSave;

class MovieDeleteAction extends DeleteAction
{
    protected function initConfig()
    {
        parent::initConfig();

        $this->modelClass = BMovieSave::className();
    }

    public function run()
    {
        return $this->runCustom();
    }

}
