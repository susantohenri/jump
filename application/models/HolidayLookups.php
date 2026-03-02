<?php defined('BASEPATH') OR exit('No direct script access allowed');

class HolidayLookups extends MY_Model {

  function __construct () {
    parent::__construct();
    $this->table = 'holidaylookup';
    $this->thead = array(
      (object) array('mData' => 'orders', 'sTitle' => 'No', 'visible' => false),
      (object) array('mData' => 'name', 'sTitle' => 'Name'),
      (object) array('mData' => 'howManyDaysFromNow', 'sTitle' => 'How many days from now'),
    );
    $this->form = array (
        array (
				      'name' => 'name',
				      'label'=> 'Name',
				      'width' => 2,
		      		'options' => array(
				      )
					  ),
        array (
          'type' => 'hidden',
		      'name' => 'holidayDate',
		      'label'=> 'HolidayDate',
		      'width' => 2,
		      'attributes' => array(
		        array('data-date' => 'datepicker')
			    )),
        array (
          'type' => 'hidden',
		      'name' => 'howManyDaysFromNow',
		      'label'=> 'HowManyDaysFromNow',
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
      ->select('holidaylookup.name')
      ->select('holidaylookup.howManyDaysFromNow');
    return parent::dt();
  }

  function getForm($uuid = false, $isSubform = false) {
    $form = parent::getForm($uuid, $isSubform);
    $content = json_decode(file_get_contents('https://date.nager.at/api/v3/publicholidays/2026/US'));

    foreach($content as $holiday) {
      $form[0]["options"][] = [
        "text" => $holiday->name,
        "value" => $holiday->name
      ];
    }

    return $form;
  }

  function save ($record) {
    $content = json_decode(file_get_contents('https://date.nager.at/api/v3/publicholidays/2026/US'));
    $selected = array_values(array_filter($content, function ($holiday) use ($record) {
      return $holiday->name === $record['name'];
    }));

    $now = time();
    $your_date = strtotime($selected[0]->date);
    $datediff = $now - $your_date;
    $record['howManyDaysFromNow'] =  round($datediff / (60 * 60 * 24));
    return parent::create($record);
  }

}