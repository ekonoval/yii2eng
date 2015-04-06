<?php
namespace common\ext\System;

use yii\base\ErrorException;

class AppException extends \Exception
{
    static function ensure($expr, $failMsg = '')
    {
        if (!$expr) {
            throw new static($failMsg);
        }
    }
}
