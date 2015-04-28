<?php
namespace common\ext\Misc;

use kartik\growl\Growl;
use yii\base\Object;

class FlashMessageCreator extends Object
{
    public function pushMessage($options, $key = null)
    {
        if (is_null($key)) {
            $key = uniqid('', true);
        }
        ySession()->setFlash($key, $options);
    }

    public function addWarning($message, $key = null)
    {
        $params = [
            'type' => Growl::TYPE_WARNING,
            'title' => 'Warning!',
            'icon' => 'glyphicon glyphicon-exclamation-sign',
            'message' => $message,
            'showSeparator' => true,
            'duration' => 8000
        ];
        $this->pushMessage($params, $key);
    }

    public function addFailed($message, $key = null)
    {
        $params = [
            'type' => Growl::TYPE_DANGER,
            'title' => 'Failed',
            'icon' => 'glyphicon glyphicon-remove-sign',
            'message' => $message,
            'showSeparator' => true,
            'duration' => 15000
        ];
        $this->pushMessage($params, $key);
    }

    public function addSuccess($message, $key = null)
    {
        $params = [
            'type' => Growl::TYPE_SUCCESS,
            'title' => 'Success',
            'icon' => 'glyphicon glyphicon-ok-sign',
            'message' => $message,
            'showSeparator' => true,
        ];
        $this->pushMessage($params, $key);
    }

    public function addInfo($message, $key = null)
    {
        $params = [
            'type' => Growl::TYPE_INFO,
            'title' => 'Info',
            'icon' => 'glyphicon glyphicon-info-sign',
            'message' => $message,
            'showSeparator' => true,
        ];
        $this->pushMessage($params, $key);
    }

}
