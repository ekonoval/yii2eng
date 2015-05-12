<?php
namespace common\ext\System;

use yii\base\Module;

class AppModuleBase extends Module
{
//    public $controllerNamespace = 'backend\modules\translate\controllers';

    public function init()
    {
        $calledClass = get_called_class();
        /*
         * Remove last backslash from the fully qualified className
         * __NAMESPACE__ always points to parent class namespace
         */
        $namespace = substr($calledClass, 0, strrpos($calledClass, '\\'));

        $this->controllerNamespace = $namespace . '\controllers';

        parent::init();
    }
}
