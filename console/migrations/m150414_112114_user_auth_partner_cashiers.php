<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_112114_user_auth_partner_cashiers extends Migration
{
    public function safeUp()
    {
        //--- user_auth ---//
        $this->execute("
            CREATE TABLE IF NOT EXISTS `user_auth` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `entity_id` int(11) NOT NULL,
              `login` varchar(255) NOT NULL,
              `pwd` varchar(255) NOT NULL,
              `type` tinyint(4) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `entity_id` (`entity_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
        ");

        $this->execute("
            INSERT INTO `user_auth` (`id`, `entity_id`, `login`, `pwd`, `type`) VALUES
            (5, 3, 'Lrockyou', '1', 3),
            (6, 1, 'comilfo', '2', 4),
            (7, 4, 'partner2', '1', 3);
        ");

        //--- partner ---//
        $this->execute("
            CREATE TABLE IF NOT EXISTS `partner` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `slug` varchar(50) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
        ");

        $this->execute("
            INSERT INTO `partner` (`id`, `name`, `slug`) VALUES
            (3, 'Рокью', 'rockyou'),
            (4, 'Partner 2', 'partner2');
        ");

        //--- cashier ---//
        $this->execute("
            CREATE TABLE IF NOT EXISTS `cashbox` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `map_widget` mediumtext NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
        ");

        $this->execute("
            INSERT INTO `cashbox` (`id`, `name`, `map_widget`) VALUES
            (1, 'Комильфо', 'googlemap url');
        ");
    }

    public function safeDown()
    {
        $this->execute("DROP TABLE `cashbox`");
        $this->execute("DROP TABLE `partner`");
        $this->execute("DROP TABLE `user_auth`");
        //echo "m150414_112114_user_auth_partner_cashiers cannot be reverted.\n";

        //return false;
    }
    
}
