<?php
namespace backend\modules\translate\controllers\Movie;

use backend\ext\Grid\Crud\DeleteAction;
use backend\modules\translate\models\Movie\BMovieSave;
use common\ext\System\ActiveRecordCustom;

class MovieDeleteAction extends DeleteAction
{
    protected function initConfig()
    {
        parent::initConfig();

        $this->modelClass = BMovieSave::className();
    }

    /**
     * @param BMovieSave $model
     */
    protected function deleteCustom($model)
    {
        if ($model->getEpisodes()->count() > 0 == false) {
            parent::deleteCustom($model);
        }
    }


    public function run()
    {
        return $this->runCustom();
    }

}
