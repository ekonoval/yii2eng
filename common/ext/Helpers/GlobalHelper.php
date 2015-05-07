<?php
namespace common\ext\Helpers;

class GlobalHelper
{
    public static function getClassNameWithoutNamespace($fullyQualifiedClassName)
    {
        return substr($fullyQualifiedClassName, strrpos($fullyQualifiedClassName, '\\') + 1);;
    }
}
