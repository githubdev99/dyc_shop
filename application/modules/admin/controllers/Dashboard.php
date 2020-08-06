<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->not_login();
	}

	public function index()
	{
		$title = 'Dashboard';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['sweetalert'],
			'count_data' => [
				'produk_kategori' => $this->master_model->count_data('produk_kategori'),
				'produk' => $this->master_model->count_data('produk'),
			],
			'get_view' => 'admin/dashboard/view'
		];

		$this->master->template_admin($data);
	}

}