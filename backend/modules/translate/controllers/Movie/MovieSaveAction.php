<?php
namespace backend\modules\translate\controllers\Movie;

use backend\ext\Grid\Crud\SaveAction;
use backend\modules\translate\models\Movie\BMovieSave;

class MovieSaveAction extends SaveAction
{
    protected function initCustom()
    {
        parent::initCustom();
        $this->modelClass = BMovieSave::className();
    }

    protected function redirectAfterSave()
    {
        $this->controller->redirect('index');
    }


}
