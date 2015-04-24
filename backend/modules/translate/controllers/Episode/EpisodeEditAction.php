<?php
namespace backend\modules\translate\controllers\Episode;

use backend\ext\Grid\Save\SaveAction;
use common\ext\System\ActiveRecordCustom;

class EpisodeEditAction extends SaveAction
{
    public $modelClass;

    /**
     * @var ActiveRecordCustom
     */
    protected $model;

    protected $pk;

    protected function prepareModel($modelClass)
    {
        $this->model = $modelClass::findModel($this->id);
    }

    protected function setPk($id)
    {
        $this->pk = $id;
    }

    protected function redirectAfterSave()
    {
        return $this->redirect($this->composeWordsIndex($this->model->movieID));
    }

    public function run($id)
    {
        $this->setPk($id);
        return $this->runCustom();
    }

    public function runCustom()
    {
        $this->prepareModel($this->modelClass);

        if (
            $this->model->load(yR()->post())
            && $this->model->save()
        ) {
            return $this->redirectAfterSave();
        } else {
            //pa($model->getErrors());
            return $this->render('edit_tpl', [
                'model' => $this->model,
                'title' => 'title1'
            ]);
        }
    }

}
