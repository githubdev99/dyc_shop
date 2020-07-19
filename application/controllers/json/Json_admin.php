<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json_admin extends MY_Controller {
	
	private $data = [];
	private $param = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_model');
	}

}

/* End of file Json_admin.php */