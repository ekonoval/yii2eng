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

        $empID = 19294;

        $empData = array(
            'job' => 'fake',
            'can_login' => false,
            'password' => 'risking1'
        );

        $res = $apiObj->employeeEdit($empID, $empData); pa($res); exit;

        $res = $apiObj->employeeGet(19294);

        pa($res);
    }
}
