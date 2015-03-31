<?php
namespace common\ext\Helpers;

class DateHelper
{
    const MYSQL_DATE_TIME = "Y-m-d H:i:s";

    static function phpDate2MysqlDate($phpdate)
    {
        return date(self::MYSQL_DATE_TIME, $phpdate);
    }
}
