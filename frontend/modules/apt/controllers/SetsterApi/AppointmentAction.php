<?php
namespace frontend\modules\apt\controllers\SetsterApi;

class AppointmentAction extends SetsterAction
{
    public function run()
    {
        $apiObj = $this->controller->apiObj;
        $res = null;

        //--- delete ---//
        $aptID = 5794890659;
        //$res = $apiObj->appointmentDelete($aptID); pa($res);//exit;

        $locationID = $this->locationID;//-6
        $locationID = 20841;//-4

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
            'timezone_id' => 320
        );

        $list = $apiObj->appointmentsList($aptFilter);
        foreach ($list["data"] as $val) {
            $id = $val["id"];
            //$res = $apiObj->appointmentDelete($id);pa($res);
        }
        pa($list);exit;
    }
}
