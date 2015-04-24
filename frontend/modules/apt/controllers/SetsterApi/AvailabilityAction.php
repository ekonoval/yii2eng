<?php
namespace frontend\modules\apt\controllers\SetsterApi;

class AvailabilityAction extends SetsterAction
{
    public function run()
    {
        $apiObj = $this->apiObj;
        //pa(date('Y-m-d'));exit;

        //$tz = $apiObj->getTimezones();var_export($tz);exit;

        $locationID = $this->locationID;
        //$locationID = $this->location4;

        $res = array();
        for($day = 13; $day <= 26; $day++ ){
            $startDate = "2015-04-{$day}";

            $params = array(
                'service_id' => $this->serviceID,
                'location_id' => $locationID,
                'provider_id' => $this->employeeID,
                //'start_date' => date('Y-m-d'),
                'start_date' => $startDate,
                //'start_date' => '2015-04-17',

                't' => 'weekly',
                //'t' => 'daily',

                'return' => 'times',
                //'timezone_id' => $this->timezoneID,
                //'timezone_id' => 552,
                //'timezone_id' => 546,
                'timezone_id' => 164, // -2
            );

            $res[] = $apiObj->availabilityGet($params);
        }
        pa($res);exit;

        $locationID = $this->locationID;
        $params = array(
            'service_id' => $this->serviceID,
            'location_id' => $locationID,
            'provider_id' => $this->employeeID,
            'start_date' => date('Y-m-d'),
            'start_date' => '2015-05-12',
            't' => 'weekly',
            //'t' => 'daily',
            'return' => 'times',
            //'timezone_id' => $this->timezoneID,
//            'timezone_id' => 552, // -6 MDT
            'timezone_id' => 164, // -2
//            'timezone_id' => 306, // 0
//            'timezone_id' => 422, // +1
            //'timezone_id' => 320, // +10
            //'timezone_id' => 414, // +3
        );
        var_export($params);
        //$avail = $apiObj->employeeAvailabilityGet($this->employeeID);
        $avail = $apiObj->availabilityGet($params);

        pa($avail);
    }
}
