<?php
namespace backend\ext\Grid\Crud;

use backend\ext\System\BackendController;
use common\ext\System\ActiveRecordCustom;
use yii\base\Action;

/**
 * @property BackendController $controller
 */
class SaveAction extends Action
{
    const ACTION_TYPE_UPDATE = 2;
    const ACTION_TYPE_CREATE = 3;

    public $actionType = self::ACTION_TYPE_UPDATE;

    //public $viewTplPath = '@backend/views/default/edit_tpl';
    public $viewTplPath = '//default/edit_tpl';

    public $modelClass;

    /**
     * @var ActiveRecordCustom
     */
    protected $model;

    protected $pk;

    protected function prepareModel()
    {
        $modelClass = $this->modelClass;

        if ($this->actionType == self::ACTION_TYPE_UPDATE) {
            $this->model = $modelClass::findModel($this->pk);
        } elseif ($this->actionType == self::ACTION_TYPE_CREATE) {
            $this->model = new $modelClass();
        }
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

    protected function composeViewParams()
    {

        $editFormViewPath = "@backend/modules/{$this->controller->module->id}/views/{$this->controller->id}/".
            "_edit_form_tpl";

        return [
            'editFormViewPath' => $editFormViewPath,
            'data' => [
                'model' => $this->model,
                'title' => 'title1'
            ]
        ];
    }

    public function runCustom()
    {
        $this->prepareModel();

        if (
            yR()->isPost
            && $this->model->load(yR()->post())
            && $this->model->save()
        ) {
            return $this->redirectAfterSave();
        } else {
            //pa($model->getErrors());
            return $this->controller->render($this->viewTplPath, $this->composeViewParams());
        }
    }


}
