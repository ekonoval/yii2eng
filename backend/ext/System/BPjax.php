<?php
namespace backend\ext\System;

use yii\widgets\Pjax;

class BPjax extends Pjax
{

    public function init()
    {
        parent::init();

        $this->id = \Yii::$app->controller->id . '_pjax';
        $this->timeout = false;
        $this->enablePushState = false;

        /*
         * When using post method pagination doesn't preserve input filter values when pagination links are clicked
         */
        //$this->clientOptions = ['method' => 'POST'];
    }


}
