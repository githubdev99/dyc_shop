<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$title = 'Home';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_home',
			'get_script' => 'home/script_home'
		];

		$this->master->template_home($data);
	}

	public function logout()
	{
		$this->session->unset_userdata('customer');
		$this->alert_popup([
			'name' => 'success',
			'swal' => [
				'text' => 'Anda berhasil logout!',
				'type' => 'success'
			]
		]);
		redirect('home','refresh');
	}

}