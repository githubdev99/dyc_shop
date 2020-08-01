<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$title = 'Login';
		$data = [
			'setup_app' => $this->setup_app($title)
		];
		
		$this->load->view('login/view', $data);
	}

}