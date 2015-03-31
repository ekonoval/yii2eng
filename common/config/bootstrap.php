<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');

function pa()
{
    $backtrace = debug_backtrace();
    $args = func_get_args();
    $matches = array();
    preg_match('|.*[\/\\\](.+)$|', $backtrace[0]['file'], $matches);
    $res = array($matches[1] . ': ' . $backtrace[0]['line'], $args);
    echo "<pre>";
    print_r($res);
    echo "</pre>";
}