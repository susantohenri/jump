<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spending extends MY_Controller {

	function __construct ()
	{
		$this->model = 'Spendings';
		parent::__construct();
	}

}