<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_warehouseproduct extends CI_Migration {

  function up () {

    $this->db->query("
      CREATE TABLE `warehouseproduct` (
        `uuid` varchar(36) NOT NULL,
        `orders` INT(11) UNIQUE NOT NULL AUTO_INCREMENT,
        `createdAt` datetime DEFAULT NULL,
        `updatedAt` datetime DEFAULT NULL,
        `product` varchar(36) NOT NULL,
        `warehouse` varchar(36) NOT NULL,
        `stock` INT(11) NOT NULL,
        PRIMARY KEY (`uuid`),
        KEY `product` (`product`),
        KEY `warehouse` (`warehouse`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8
    ");

  }

  function down () {
    $this->db->query("DROP TABLE IF EXISTS `warehouseproduct`");
  }

}