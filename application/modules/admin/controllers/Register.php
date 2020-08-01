<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$title = 'Register';
		$data = [
			'setup_app' => $this->setup_app($title)
		];
		
		$this->load->view('register/view', $data);
	}

}