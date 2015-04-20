<?php
namespace frontend\modules\apt\controllers\SetsterApi;

use frontend\modules\apt\controllers\SetsterApiController;
use frontend\modules\apt\ext\Setster\StsApi;
use yii\base\Action;

/**
 * @property SetsterApiController $controller
 */
class SetsterAction extends Action
{
    protected $employeeID;
    protected $locationID;
    protected $location4;

    protected $serviceID;

    /**
     * @var StsApi
     */
    protected $apiObj;

    public function init()
    {
        parent::init();
        $this->employeeID = $this->controller->employeeID;
        $this->locationID = $this->controller->locationID;
        $this->serviceID = $this->controller->serviceID;
        $this->location4 = $this->controller->location4;

        $this->apiObj = $this->controller->apiObj;
    }
}
