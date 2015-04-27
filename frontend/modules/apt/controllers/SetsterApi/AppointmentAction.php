<?php
namespace frontend\modules\apt\controllers\SetsterApi;

class AppointmentAction extends SetsterAction
{
    public function run()
    {
        $apiObj = $this->controller->apiObj;
        //$this->controller->regenerateAuthToken();
        $res = null;

        //--- delete ---//
        $aptID = 5794890659;
        //$res = $apiObj->appointmentDelete($aptID); pa($res);//exit;

        $locationID = $this->locationID;//-6
        $locationID = 20841;//-4

        $tzID = 320; // +10h
        //$tzID = 549;// -10h
        //$tzID = 548;// -4h
        //$tzID = 414;// +3

        //#------------------- create -------------------#//
        $aptData = array(
            "employee_id" => $this->employeeID,
            "location_id" => $locationID,
            "service_id" => $this->serviceID,
            "start_date" => "2015-05-15 08:00:00",
            //"start_date" => "2015-05-13 01:46:27",
            //"start_date" => "2015-05-13T18:50:00-04:00",
            //"start_date" => "2015-04-25 00:46:27",
            "note" => "This is a test. " . "[".time()."]",
            'status' => 10,

            "client_email" => 'ekonoval@gmail.com',
            "client_name" => '1fake EK '.uniqid(),

//            "client_email" => 'quadroval@gmail.com',
//            "client_name" => 'quadrovalAPI',
            'timezone_id' => $tzID
        );
        pa($aptData);
        //$res = $apiObj->appointmentCreate($aptData);pa($res);

        //#------------------- edit -------------------#//
        $aptData = array(
            'status' => 10,
            "note" => "This is a test. fake2222"
        );
        //$res = $apiObj->appointmentEdit(5917464746, $aptData); pa($res);

        //--- apt list ---//
        $aptFilter = array(
            //'timezone_id' => $tzID,
            //'timezone_id' => 306 // 00 00
            'id' => 6302841122
        );

        $mainParams = array(
            'timezone_id' => $tzID,
            'service_id' => $this->serviceID,
//            'num_results' => 1
            //'start_date' => '2015-04-29 08:00:00',
            //'end_date' => '2015-05-01 08:00:00',
            //'start' => 2,
            //'end' => 'all',
            //'start' => '2015-05-16T08:00:00-10:00',
            //'end' => '2015-05-18T08:00:00-10:00'
//            'start' => '2015-04-23',
//            'end' => 'www',
            //'id' => 6302841122
        );

        $list = $apiObj->appointmentsList($mainParams, $aptFilter);

        pa($list);exit;

        foreach ($list["data"] as $val) {
            $id = $val["id"];
            //$res = $apiObj->appointmentDelete($id);pa($res);
        }
        pa($list);exit;
    }
}
