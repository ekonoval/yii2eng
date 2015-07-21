<?php

namespace console\ext;

use backend\ext\User\BPhpAuthManager;
use yii\rbac\PhpManager;

class ConsoleBackendPhpAuthManager extends BPhpAuthManager
{
    /**
     * Make saving working for generating roles hierarchy via console
     * @inheritdoc
     */
    protected function saveToFile($data, $file)
    {
        @mkdir(dirname($file), 0777, true);
        PhpManager::saveToFile($data, $file);
    }

}
