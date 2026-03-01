<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Movements extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'movement';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'source', 'sTitle' => 'Source'),

    );
    $this->form = array (
        array (
		      'name' => 'source',
		      'label'=> 'Source',
		      'options' => array(),
		      'width' => 2,
		      'attributes' => array(
		        array('data-autocomplete' => 'true'),
		        array('data-model' => 'Warehouses'),
		        array('data-field' => 'name')
			    )),
        array (
		      'name' => 'destination',
		      'label'=> 'Destination',
		      'options' => array(),
		      'width' => 2,
		      'attributes' => array(
		        array('data-autocomplete' => 'true'),
		        array('data-model' => 'Warehouses'),
		        array('data-field' => 'name')
			    )),
        array (
		      'name' => 'product',
		      'label'=> 'Product',
		      'options' => array(),
		      'width' => 2,
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
      ->select('movement.source');
    return parent::dt();
  }

	function create ($record) {
		$source = $record['source'];
		$destination = $record['destination'];
		$product = $record['product'];
		$stock = $record['stock'];
		$this->load->model('WarehouseProducts');

	  $toTake = $this->WarehouseProducts->findOne(['warehouse' => $source, 'product' => $product]);
	  $toGive = $this->WarehouseProducts->findOne(['warehouse' => $destination, 'product' => $product]);
		$toTake['stock'] -= $stock;
		$toGive['stock'] += $stock;
		$this->WarehouseProducts->update($toTake);
		$this->WarehouseProducts->update($toGive);

		return parent::create($record);
	}
}