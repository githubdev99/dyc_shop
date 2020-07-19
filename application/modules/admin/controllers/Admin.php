<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        redirect('admin/login','refresh');
	}

}

/* End of file Dashboard.php */