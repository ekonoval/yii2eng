<?php
namespace common\ext\Helpers;

class DateHelper
{
    const FORMAT_JQ_DATE_PICKER = 'd.m.Y H:i';
    const FORMAT_JQ_DATE_PICKER_NO_TIME = 'd.m.Y';

    const MYSQL_DATE_TIME = "Y-m-d H:i:s";

    static function phpDate2MysqlDate($phpdate)
    {
        return date(self::MYSQL_DATE_TIME, $phpdate);
    }

    static function convertJqDatePickerDate2MysqlDate($jq_picker_date, $has_time = true)
    {
        //--- convert datepicker date to proper mysql formated date ---//
        $tstmp = strtotime($jq_picker_date);
        $mysql_date = "";

        if ($tstmp !== FALSE) {
            $mysql_date = self::phpDate2MysqlDate($tstmp);
            if ($has_time == false) {
                $mysql_date = self::getDateFromMysqlDatetime($mysql_date);
            }
        }
        return $mysql_date;
    }

    static function getDateFromMysqlDatetime($mysql_datetime)
    {
        $res = explode(" ", $mysql_datetime);
        if (count($res) == 2) {
            return $res[0];
        }
        return false;
    }


}
