<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Envelopes extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'envelope';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'name', 'sTitle' => 'Name'),
      (object) array('mData' => 'income', 'sTitle' => 'Income'),
      (object) array('mData' => 'spending', 'sTitle' => 'Spending'),
      (object) array('mData' => 'balance', 'sTitle' => 'Balance'),
    );
    $this->form = array (
        array (
				      'name' => 'name',
				      'width' => 2,
		      		'label'=> 'Name',
					  ),
        array (
		      'name' => 'balance',
		      'label'=> 'Balance',
		      'width' => 2,
		      'attributes' => array(
		        array('data-number' => 'true')
			    )),
    );
    $this->childs = array (
        array (
				      'label' => 'Spending',
				      'controller' => 'Spending',
				      'model' => 'Spendings'
					  ),
    );
  }

  function dt () {
    $this->datatables
      ->select("{$this->table}.uuid")
      ->select("{$this->table}.orders")
      ->select('envelope.name')
      ->select('envelope.income')
      ->select('envelope.spending')
      ->select('envelope.balance');
    return parent::dt();
  }

  function save($record) {
    $uuid = parent::save($record);
    $this->calculateBalance($uuid);
    return $uuid;
  }

  function calculateBalance ($uuid) {
    $income = 0;
    $spent = 0;
    $this->load->model(['Alocations', 'Spendings']);
    $alocations = $this->Alocations->find(['envelope' => $uuid]);
    $spendings = $this->Spendings->find(['envelope' => $uuid]);
    foreach ($alocations as $alocation) $income += $alocation->amount;
    foreach ($spendings as $spending) $spent += $spending->amount;
    $this->db->where('uuid', $uuid)
      ->set('income', $income)
      ->set('spending', $spent)
      ->set('balance', $income - $spent)
      ->update($this->table);
  }

}