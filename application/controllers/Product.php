<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	function __construct ()
	{
		$this->model = 'Products';
		parent::__construct();
	}

}