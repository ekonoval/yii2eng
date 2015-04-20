<?php
namespace frontend\modules\apt\controllers;

use frontend\modules\apt\controllers\SetsterApi\AppointmentAction;
use frontend\modules\apt\controllers\SetsterApi\AvailabilityAction;
use frontend\modules\apt\controllers\SetsterApi\EmployeeAction;
use frontend\modules\apt\ext\Setster\StsApi;
use Yii;
use yii\base\Controller;

class SetsterApiController extends Controller
{
    public $serviceID = 38271;

    public $locationID = 20758;
    public $location4 = 20841;//-4

    public $employeeID = 19294;
    public $timezoneID = 546;

    /**
     * @var StsApi
     */
    public $apiObj;

    public function actions()
    {
        return [
            'employee' => EmployeeAction::className(),
            'appointment' => AppointmentAction::className(),
            'availability' => AvailabilityAction::className(),
        ];
    }

    public function init()
    {
        parent::init();
        $apiObj = new StsApi();
        $session = Yii::$app->session;

        //$newToken = $apiObj->createAndSetAuthToken(); $session->set('setster_auth', $newToken);
        //$this->regenerateAuthToken();

        $token = '2ncu523rlnu8ojfsng7afkgbj6';
        $token = $session->get('setster_auth');

        $apiObj->setAuthToken($token);
        $this->apiObj = $apiObj;
        //$this->regenerateAuthToken();
    }

    public function regenerateAuthToken()
    {
        $newToken = $this->apiObj->createAndSetAuthToken();
        Yii::$app->session->set('setster_auth', $newToken);
    }


    public function actionTest()
    {
        $apiObj = $this->apiObj;

        //$services = $apiObj->getServices();
        //pa($services);

        //$accountInfo = $apiObj->getAccountInfo();
        //$subAcc = $apiObj->getSubAccounts();

        $employees = $apiObj->employeeGet(); pa($employees); exit;

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
        //$availability = $apiObj->getAvailability($params);

        //$tz = $apiObj->getTimezones();
        //pa($tz);
    }

    private function location()
    {
        $apiObj = $this->apiObj;

        $locData = array(
            'name' => 'Location in TZ "CDT"',
            'timezone' => 546,
            'timezone_id' => 546
        );
        //$res = $apiObj->locationCreate($locData);
        //pa($res);


        // 19295 20757
        $locationID = 20758;
        $employeeID = 19294;

        $locData = array(
            'timezone_id' => 546,
            'links' => array(
                $employeeID => array(
                    $this->serviceID => 1
                )
            ),

            'links' => array(
                $employeeID => 'all'
            ),
        );


        $apiObj->locationEdit($locationID, $locData);

        pa($apiObj->locationsGet());
    }

    public function actionRegister()
    {
        $apiObj = $this->apiObj;

        //$this->employeeCreate();
        $this->location();

        //pa($res);
    }

    public function actionClients()
    {
        $apiObj = $this->apiObj;

        $clientID = 534636;

        $res = $apiObj->clientDelete($clientID); pa($res);exit;

        $res = $apiObj->clientsGet();
        pa($res);
    }
}
