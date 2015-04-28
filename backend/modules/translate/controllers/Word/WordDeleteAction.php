<?php
namespace backend\modules\translate\controllers\Word;

use backend\ext\Grid\Crud\DeleteAction;
use backend\modules\translate\models\Word\BWordSave;

class WordDeleteAction extends DeleteAction
{
    protected $episodeID;

    protected function initConfig()
    {
        parent::initConfig();
        $this->modelClass = BWordSave::className();

        $this->episodeID = yR()->get('episodeID', 0);
    }

    protected function redirectSingle()
    {
        return $this->controller->redirect($this->controller->composeWordsIndex($this->episodeID));
    }


    public function run()
    {
        return $this->runCustom();
    }
}
