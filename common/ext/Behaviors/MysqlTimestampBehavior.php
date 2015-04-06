<?php
namespace common\ext\Behaviors;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MysqlTimestampBehavior extends TimestampBehavior
{
    public $updatedAtAttribute = false;

    public function init()
    {
        $this->value = new Expression('NOW()');

        parent::init();
    }

}
