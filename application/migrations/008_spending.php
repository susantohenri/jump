<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_spending extends CI_Migration {

  function up () {

    $this->db->query("
      CREATE TABLE `spending` (
        `uuid` varchar(36) NOT NULL,
        `orders` INT(11) UNIQUE NOT NULL AUTO_INCREMENT,
        `createdAt` datetime DEFAULT NULL,
        `updatedAt` datetime DEFAULT NULL,
        `envelope` varchar(36) NOT NULL,
        `name` varchar(255) NOT NULL,
        `amount` INT(11) NOT NULL,
        PRIMARY KEY (`uuid`),
        KEY `envelope` (`envelope`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8
    ");

  }

  function down () {
    $this->db->query("DROP TABLE IF EXISTS `spending`");
  }

}