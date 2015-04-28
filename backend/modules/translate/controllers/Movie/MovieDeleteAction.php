<?php
namespace backend\modules\translate\controllers\Movie;

use backend\ext\Grid\Crud\DeleteAction;
use backend\modules\translate\models\Word\BWordSave;

class MovieDeleteAction extends DeleteAction
{
    protected function initConfig()
    {
        parent::initConfig();

        $this->modelClass = BWordSave::className();
    }

    public function run()
    {
        return $this->runCustom();
    }

}
