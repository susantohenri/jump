<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WarehouseProduct extends MY_Controller {

	function __construct ()
	{
		$this->model = 'WarehouseProducts';
		parent::__construct();
	}

}