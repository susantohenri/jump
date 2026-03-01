<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alocation extends CI_Migration {

  function up () {

    $this->db->query("
      CREATE TABLE `alocation` (
        `uuid` varchar(36) NOT NULL,
        `orders` INT(11) UNIQUE NOT NULL AUTO_INCREMENT,
        `createdAt` datetime DEFAULT NULL,
        `updatedAt` datetime DEFAULT NULL,
        `income` varchar(36) NOT NULL,
        `envelope` varchar(36) NOT NULL,
        `amount` INT(11) NOT NULL,
        PRIMARY KEY (`uuid`),
        KEY `income` (`income`),
        KEY `envelope` (`envelope`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8
    ");

  }

  function down () {
    $this->db->query("DROP TABLE IF EXISTS `alocation`");
  }

}