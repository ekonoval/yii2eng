<?php
namespace backend\ext\System;

use yii\widgets\Pjax;

class BPjax extends Pjax
{

//    public function __construct($config = [])
//    {
//        parent::__construct($config);
//    }

    public function init()
    {
        parent::init();

        $this->id = \Yii::$app->controller->id . '_pjax';
        $this->timeout = false;
        $this->enablePushState = false;
        $this->clientOptions = ['method' => 'POST'];
    }


}
