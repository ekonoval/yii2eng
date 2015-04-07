<?php

namespace frontend\modules\apt\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWidget()
    {
        return $this->render('widget');
    }

    public function actionAptCom()
    {
        //better var_dump readability in browser window
        function pre_dump($data)
        {
            echo "<pre>";
            var_dump($data);
            echo "</pre>";
        }

        //settings
        define('SOAP_SERVER', 'https://www.appointment.com/webservice/index.php?wsdl');
        define('USERNAME', 'quadro');
        define('PASSWORD', 'ekgwg');
        //make a connection
        $appointments = new \SoapClient(SOAP_SERVER);

//datils taken from admin panel:
//product_id = XXXXXX
//customer_id = XXXXXX
//service_id = XXXXX
//lid = XXXXX

//this works -> $result = $appointments->tGetLocations(USERNAME, PASSWORD);
//this works -> $result = $appointments->tGetCustomer(USERNAME, PASSWORD, XXXXXX);
//this seems to work fine (no bookings - empty result) -> $result = $appointments->tGetBookings(USERNAME, PASSWORD, 'test','2010-11-01','2010-11-30');
//this works -> $result = $appointments->tGetSchedules(USERNAME, PASSWORD);
//this works -> $result = $appointments->tGetServices(USERNAME, PASSWORD);
//this works -> $result = $appointments->tGetAvailableTimeSlots(USERNAME, PASSWORD,XXXXX,'2010-10-30');

        //$result = $appointments->tGetServices(USERNAME, PASSWORD);
        $result = $appointments->tGetTimezones(USERNAME, PASSWORD);
        //show response result details
        pre_dump($result);

//loop the results (if any)
//        foreach ($result as $item) {
//            pre_dump($item);
//        }
    }
}
