<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Incomes extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'income';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'name', 'sTitle' => 'Name'),
      (object) array('mData' => 'amount', 'sTitle' => 'Amount'),
      (object) array('mData' => 'balance', 'sTitle' => 'Balance'),
    );
    $this->form = array (
        array (
				      'name' => 'name',
				      'width' => 2,
		      		'label'=> 'Name',
					  ),
        array (
		      'name' => 'amount',
		      'label'=> 'Amount',
		      'width' => 2,
		      'attributes' => array(
		        array('data-number' => 'true')
			    )),
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
				      'label' => 'Alocation',
				      'controller' => 'Alocation',
				      'model' => 'Alocations'
					  ),
    );
  }

  function dt () {
    $this->datatables
      ->select("{$this->table}.uuid")
      ->select("{$this->table}.orders")
      ->select('income.name')
      ->select('income.amount')
      ->select('income.balance');
    return parent::dt();
  }

  function save($record) {
    $uuid = parent::save($record);
    $this->calculateBalance($uuid);
    return $uuid;
  }

  function calculateBalance ($uuid) {
    $income = $this->findOne($uuid);
    $this->load->model('Alocations');
    $balance = $income['amount'];
    foreach($this->Alocations->find(['income' => $uuid]) as $alocation) {
      $balance -= $alocation->amount;
    }
    $this->db->where('uuid', $uuid)->set('balance', $balance)->update($this->table);
  }
}