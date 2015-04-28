<?php
namespace backend\ext\Grid\Crud;

use backend\ext\System\BackendController;
use common\ext\System\ActiveRecordCustom;
use common\ext\System\AppException;
use yii\base\Action;

/**
 * @property BackendController $controller
 */
class DeleteAction extends Action
{
    const TYPE_SINGLE = 2;
    const TYPE_MULTI = 3;

    protected $deleteType;

    protected $ids;
    protected $idSingle;

    public $modelClass;

    /**
     * @var ActiveRecordCustom
     */
    protected $model;

    public function init()
    {
        parent::init();
        $this->initConfig();
        $this->initCustom();
    }

    protected function initConfig()
    {
        //init model class
    }

    protected function initCustom()
    {
        $this->deleteType = self::TYPE_SINGLE;

        $ids = yR()->get('ids', null);
        $this->idSingle = yR()->get('id', null);

        AppException::ensure(!is_null($ids) || !is_null($this->idSingle), "No delete id provided");

        if (!is_null($ids)) {
            AppException::ensure(is_array($ids), "Incorrect 'ids' param on deleting");
            $this->deleteType = self::TYPE_MULTI;
            $this->ids = $ids;
        }
    }

    protected function runCustom()
    {
        switch ($this->deleteType) {
            case self::TYPE_SINGLE:
                $this->deleteSingle($this->id);
                break;

            case self::TYPE_MULTI:
                $this->deleteMulti();
                break;
        }

        return $this->redirectAfterDelete();
    }

    protected function deleteMulti()
    {
        foreach ($this->ids as $id) {
            $id = @intval($id);
            if ($id > 0 == false) {
                continue;
            }

            $this->deleteSingle($id);
        }
    }

    protected function deleteSingle($id)
    {
        $model = call_user_func([$this->modelClass, 'findModel'], $id);
        //$model = BWordSave::findModel($id);

        if ($model) {
            $model->delete();
        }
    }

    protected function redirectAfterDelete()
    {
        return $this->controller->redirect('/');
    }
}
