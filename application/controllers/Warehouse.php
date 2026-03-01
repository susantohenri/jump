<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends MY_Controller {

	function __construct ()
	{
		$this->model = 'Warehouses';
		parent::__construct();
	}

}