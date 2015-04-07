<?php
namespace frontend\modules\apt\controllers;

use frontend\modules\apt\ext\Setster\StsApi;
use yii\base\Controller;

class SetsterApiController extends Controller
{
    public function actionTest()
    {
        $apiObj = new StsApi();
        $authKey = $apiObj->createAndSetAuthToken();

        //$services = $apiObj->getServices();
        //pa($services);

        //$accountInfo = $apiObj->getAccountInfo();
        //$subAcc = $apiObj->getSubAccounts();

        //$employees = $apiObj->getEmployees();

        //$clients = $apiObj->getClients();

        $serviceID = 38271;
        $providerID = 19237; // 19230

        $params = array(
            'service_id' => $serviceID,
            //'provider_id' => $providerID,
            'start_date' => '2015-04-07',
            'return' => 'times',
            't' => 'daily'
        );
        $availability = $apiObj->getAvailability($params);
    }
}
