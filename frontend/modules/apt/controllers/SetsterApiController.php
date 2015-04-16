<?php
namespace frontend\modules\apt\controllers;

use frontend\modules\apt\ext\Setster\StsApi;
use yii\base\Controller;

class SetsterApiController extends Controller
{
    public $serviceID = 38271;

    private $locationID = 20758;
    private $employeeID = 19294;
    private $timezoneID = 546;

    /**
     * @var StsApi
     */
    private $apiObj;

    public function init()
    {
        parent::init();
        $apiObj = new StsApi();
        $apiObj->createAndSetAuthToken();
        $this->apiObj = $apiObj;
    }


    public function actionTest()
    {
        $apiObj = $this->apiObj;

        //$services = $apiObj->getServices();
        //pa($services);

        //$accountInfo = $apiObj->getAccountInfo();
        //$subAcc = $apiObj->getSubAccounts();

        $employees = $apiObj->getEmployees(); pa($employees); exit;

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

    private function employeeCreate()
    {
        $apiObj = $this->apiObj;
        $empDataUpd = [
            'status' => 1,
            'nickname' => 'apiprov1'
        ];
        $apiObj->employeeEdit(19294, $empDataUpd);exit;

        //pa($apiObj->getEmployees()); exit;

        $empData = array(
            "first_name" => "Prov2",
            "last_name" => "Api2",
            "email" => "prov22.api@setster.com",
            "send_invite_email"=> false,
        );
        //$res = $apiObj->employeeCreate($empData);
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

    public function actionAvailability()
    {
        $apiObj = $this->apiObj;
        //pa(date('Y-m-d'));exit;

        //$tz = $apiObj->getTimezones();var_export($tz);exit;

        $res = array();
        for($day = 13; $day <= 26; $day++ ){
            $startDate = "2015-05-{$day}";

            $params = array(
                'service_id' => 38271,
                'location_id' => '20758',
                'provider_id' => '19294',
                //'start_date' => date('Y-m-d'),
                'start_date' => $startDate,
                //'start_date' => '2015-04-17',

                't' => 'weekly',
                //'t' => 'daily',

                'return' => 'times',
                //'timezone_id' => $this->timezoneID,
                //'timezone_id' => 552,
                //'timezone_id' => 546,
            );

            //$res[] = $apiObj->availabilityGet($params);
        }
        //pa($res);exit;

        $params = array(
            'service_id' => $this->serviceID,
            'location_id' => '20758',
            'provider_id' => '19294',
            'start_date' => date('Y-m-d'),
            'start_date' => '2015-05-13',
            't' => 'weekly',
            //'t' => 'daily',
            'return' => 'times',
            //'timezone_id' => $this->timezoneID,
            'timezone_id' => 552, // -6 MDT
            'timezone_id' => 164, // -2
            'timezone_id' => 306, // 0
            'timezone_id' => 422, // +1
            'timezone_id' => 320, // +10
            'timezone_id' => 414, // +3
        );
        $avail = $apiObj->availabilityGet($params);

        pa($avail);
    }
}
