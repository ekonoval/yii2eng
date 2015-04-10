<?php
namespace frontend\controllers;

use DateTime;
use DateTimeZone;
use frontend\models\Tm1;
use Yii;
use yii\db\Connection;
use yii\web\Controller;

class DbTestController extends Controller
{
    const MYSQL_FORMAT = 'Y-m-d H:i:s';

    public function  actionTest()
    {
        pa(Yii::$app->user->getIdentity()->username);
        $username = Yii::$app->user->getIdentity()->username;

        $tz = 'AKDT';
        //$tz = 'Europe/Kiev';
        //date_default_timezone_set($tz);

//        $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');
//        pa($timezone_identifiers);exit;

        //pa(date('Y-m-d H:i:s'));exit;

        pa(DateTimeZone::listAbbreviations());
        pa(\DateTimeZone::listIdentifiers());exit;

        $tzMap = array(
            'west' => ''
        );

        $db  = Yii::$app->db;
        //$db->createCommand('SELECT NOW()')->queryAll();
        $res = $db->createCommand('SELECT * FROM tm1')
                    ->queryAll();

        //pa($res);

        return $this->render('test_tpl');
    }

    public function actionTest1()
    {
        function timezone_list() {
            static $timezones = null;

            if ($timezones === null) {
                $timezones = [];
                $offsets = [];
                $now = new DateTime();

                //foreach (DateTimeZone::listIdentifiers() as $timezone) {
                foreach (DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US') as $timezone) {
                    $now->setTimezone(new DateTimeZone($timezone));
                    $offsets[] = $offset = $now->getOffset();
                    $timezones[$timezone] = '(' . format_GMT_offset($offset) . ') ' . format_timezone_name($timezone);
                }

                array_multisort($offsets, $timezones);
            }

            return $timezones;
        }

        function format_GMT_offset($offset) {
            $hours = intval($offset / 3600);
            $minutes = abs(intval($offset % 3600 / 60));
            return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
        }

        function format_timezone_name($name) {
            $name = str_replace('/', ', ', $name);
            $name = str_replace('_', ' ', $name);
            $name = str_replace('St ', 'St. ', $name);
            return $name;
        }

        $res = timezone_list();
        pa($res);
    }

    public function actionTest2()
    {

//        $winter = new DateTime('2010-12-21', new DateTimeZone('America/New_York'));
//        $summer = new DateTime('2008-06-21', new DateTimeZone('America/New_York'));
//
//        echo $winter->getOffset() . "\n";
//        echo $summer->getOffset() . "\n";
//
//        $winter = new DateTime('2010-12-21', new DateTimeZone('Europe/London'));
//        $summer = new DateTime('2008-06-21', new DateTimeZone('Europe/London'));
//
//        echo $winter->getOffset() . "\n";
//        echo $summer->getOffset() . "\n";
//        exit;


        $ukr = new DateTimeZone("Europe/Kiev");
        $utc = new DateTimeZone("UTC");

        // Create two DateTime objects that will contain the same Unix timestamp, but
        // have different timezones attached to them.
        $dateTimeUkr = new DateTime("now", $ukr);
        $dateTimeUtc = new DateTime("now", $utc);

        // Calculate the GMT offset for the date/time contained in the $dateTimeTaipei
        // object, but using the timezone rules as defined for Tokyo
        // ($dateTimeZoneJapan).
        $timeOffset = $utc->getOffset($dateTimeUkr);

        //pa($timeOffset);exit;

        // http://php.net/manual/en/timezones.america.php#114694  - US zones
        $zones = array();
        $zones['Pacific/Honolulu'] = 'Hawaii-Aleutian Standard Time (HAST)';
        $zones['US/Aleutian'] = 'Hawaii-Aleutian with Daylight Savings Time (HADT)';
        $zones['Etc/GMT+9'] = 'Alaska Standard Time (AKST)';
        $zones['America/Anchorage'] = 'Alaska with Daylight Savings Time (AKDT)';
        $zones['America/Dawson_Creek'] = 'Pacific Standard Time (PST)';
        $zones['PST8PDT'] = 'Pacific with Daylight Savings Time (PDT)';
        $zones['MST'] = 'Mountain Standard Time (MST)';
        $zones['MST7MDT'] = 'Mountain with Daylight Savings Time (MDT)';
        $zones['Canada/Saskatchewan'] = 'Central Standard Time (CST)';
        $zones['CST6CDT'] = 'Central with Daylight Savings Time (CDT)';

        $zones['EST'] = 'Eastern Standard Time (EST)';
        $zones['EST5EDT'] = 'Eastern with Daylight Savings Time (EDT)';

        $zones['America/Puerto_Rico'] = 'Atlantic Standard Time (AST)';
        $zones['America/Halifax'] = 'Atlantic with Daylight Savings Time (ADT)';

//        $zones["Europe/Kiev"] = "Kiev";
//        $zones["UTC"] = "Utc";

        foreach ($zones as $k => &$val) {
            date_default_timezone_set($k);
            $dtz = new DateTimeZone($k);

            $dt = new DateTime(date('Y').'-01-01', new DateTimeZone('UTC'));
            //pa($dt);exit;

            $offset = $dtz->getOffset($dt);
            $offsetHr = $offset / 3600;
            //pa($offset);exit;

            $val .= " [{$offsetHr}]";

            pa($k, $offsetHr, date('Y-m-d H:i:s'));
        }

        pa($zones);
    }

    public function actionInsert()
    {
        $zones = array('EST', 'EST5EDT');

        foreach ($zones as $zone) {
            date_default_timezone_set($zone);

            $mysqlDate = date('Y-m-d H:i:s');

            $dt = new DateTime();

            $dtUtc = clone $dt;

            $local = $dt->format(self::MYSQL_FORMAT);
            $utc = $dtUtc->setTimezone(new DateTimeZone('UTC'))->format(self::MYSQL_FORMAT);

            $tm1 = new Tm1();
            $tm1->cmnt = "[L] $local / [U] {$utc}";
            $tm1->col = $utc;
            $tm1->save();
        }
    }

    public function actionFetch()
    {
        $db  = Yii::$app->db;
        //$db->createCommand('SELECT NOW()')->queryAll();
        $res = $db->createCommand('SELECT * FROM tm1')->queryAll();

        foreach ($res as &$val) {
            $dtBack = new DateTime($val["col"]);
            $dtBack->setTimezone(new DateTimeZone('EST'));

            $val["back"] = $dtBack->format(self::MYSQL_FORMAT);
        }

        pa($res);
    }


}
