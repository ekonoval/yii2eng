<?php
namespace backend\ext\Grid\Save;

use common\ext\System\ActiveRecordCustom;
use yii\base\Action;

class SaveAction extends Action
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
        return $this->redirect('/');
    }

    public function init()
    {
        parent::init();
        $this->initCustom();
    }

    protected function initCustom()
    {
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
