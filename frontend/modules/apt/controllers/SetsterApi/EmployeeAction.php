<?php
namespace frontend\modules\apt\controllers\SetsterApi;

use frontend\modules\apt\controllers\SetsterApiController;
use yii\base\Action;
use yii\web\Response;

/**
 * @property SetsterApiController $controller
 */
class EmployeeAction extends Action
{

    public function run()
    {
        $apiObj = $this->controller->apiObj;

        $res = $apiObj->employeeGet(19294);

        pa($res);
    }
}
