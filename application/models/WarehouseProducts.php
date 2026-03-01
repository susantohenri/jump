<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WarehouseProducts extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'warehouseproduct';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'product', 'sTitle' => 'Product'),

    );
    $this->form = array (
        array (
		      'name' => 'product',
		      'label'=> 'Product',
		      'options' => array(),
		      'width' => 5,
		      'attributes' => array(
		        array('data-autocomplete' => 'true'),
		        array('data-model' => 'Products'),
		        array('data-field' => 'name')
			    )),
        array (
		      'name' => 'stock',
		      'label'=> 'Stock',
		      'width' => 2,
		      'attributes' => array(
		        array('data-number' => 'true')
			    )),
    );
    $this->childs = array (
    );
  }

  function dt () {
    $this->datatables
      ->select("{$this->table}.uuid")
      ->select("{$this->table}.orders")
      ->select('warehouseproduct.product');
    return parent::dt();
  }

}