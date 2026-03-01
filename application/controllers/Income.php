<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends MY_Controller {

	function __construct ()
	{
		$this->model = 'Incomes';
		parent::__construct();
	}

}