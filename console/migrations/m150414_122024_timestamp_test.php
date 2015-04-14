<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_122024_timestamp_test extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `tm1` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `col` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `cmnt` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;
        ");
    }

    public function safeDown()
    {
        $this->truncateTable('tm1');
    }

}
