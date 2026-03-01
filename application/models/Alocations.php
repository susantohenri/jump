<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Alocations extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'alocation';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'income', 'sTitle' => 'Income'),

    );
    $this->form = array (
        array (
		      'name' => 'envelope',
		      'label'=> 'Envelope',
		      'options' => array(),
		      'width' => 5,
		      'attributes' => array(
		        array('data-autocomplete' => 'true'),
		        array('data-model' => 'Envelopes'),
		        array('data-field' => 'name')
			    )),
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
      ->select('alocation.income');
    return parent::dt();
  }

  function save($record) {
    $uuid = parent::save($record);
    $this->load->model('Envelopes');
    $this->Envelopes->calculateBalance($record['envelope']);
    return $uuid;
  }

}