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

	public function logout()
	{
		$this->session->unset_userdata('admin');
		$this->alert_popup([
			'name' => 'success',
			'swal' => [
				'text' => 'Anda berhasil logout!',
				'type' => 'success'
			]
		]);
		redirect('admin/login','refresh');
	}

}