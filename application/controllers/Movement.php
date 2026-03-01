<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Movement extends MY_Controller {

	function __construct ()
	{
		$this->model = 'Movements';
		parent::__construct();
	}

}