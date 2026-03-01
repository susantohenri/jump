<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spendings extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'spending';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'envelope', 'sTitle' => 'Envelope'),

    );
    $this->form = array (
        array (
				      'name' => 'name',
				      'width' => 5,
		      		'label'=> 'Name',
					  ),
        array (
		      'name' => 'amount',
		      'label'=> 'Amount',
		      'width' => 3,
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
      ->select('spending.envelope');
    return parent::dt();
  }

}