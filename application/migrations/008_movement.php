<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_movement extends CI_Migration {

  function up () {

    $this->db->query("
      CREATE TABLE `movement` (
        `uuid` varchar(36) NOT NULL,
        `orders` INT(11) UNIQUE NOT NULL AUTO_INCREMENT,
        `createdAt` datetime DEFAULT NULL,
        `updatedAt` datetime DEFAULT NULL,
        `source` varchar(36) NOT NULL,
        `destination` varchar(36) NOT NULL,
        `product` varchar(36) NOT NULL,
        `stock` INT(11) NOT NULL,
        PRIMARY KEY (`uuid`),
        KEY `source` (`source`),
        KEY `destination` (`destination`),
        KEY `product` (`product`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8
    ");

  }

  function down () {
    $this->db->query("DROP TABLE IF EXISTS `movement`");
  }

}