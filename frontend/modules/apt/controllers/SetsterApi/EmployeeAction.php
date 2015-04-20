<?php
namespace frontend\modules\apt\controllers\SetsterApi;

use frontend\modules\apt\controllers\SetsterApiController;
use yii\base\Action;
use yii\web\Response;

class EmployeeAction extends SetsterAction
{

    public function run()
    {
        $apiObj = $this->controller->apiObj;

        $empID = 19294;
        $location4 = 20841;

        //$apiObj->createAndSetAuthToken();

        $links = array(
            $this->locationID => [$this->serviceID => 1],
            $location4 => [$this->serviceID => 1],
        );

        //$links = array('location_links' => $links);
        //$links = json_encode($links);
        //pa($links);

        $empData = array(
            'job' => 'fake2',
            'can_login' => true,
            //'password' => 'risking1',
            'links' => $links,
        );
        pa($empData);

        $res = $apiObj->employeeEdit($empID, $empData); pa($res); //exit;

        $res = $apiObj->employeeGet(19294);

        pa($res);
    }
}
