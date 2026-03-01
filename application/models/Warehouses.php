<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouses extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'warehouse';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'name', 'sTitle' => 'Name'),

    );
    $this->form = array (
        array (
				      'name' => 'name',
				      'width' => 2,
		      		'label'=> 'Name',
					  ),
    );
    $this->childs = array (
        array (
				      'label' => 'Stock',
				      'controller' => 'WarehouseProduct',
				      'model' => 'WarehouseProducts'
					  ),
    );
  }

  function dt () {
    $this->datatables
      ->select("{$this->table}.uuid")
      ->select("{$this->table}.orders")
      ->select('warehouse.name');
    return parent::dt();
  }

}