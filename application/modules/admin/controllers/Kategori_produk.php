<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_produk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$title = 'Kategori Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['datatable', 'sweetalert', 'magnific-popup'],
			'get_script' => 'script_view'
		];

		$this->load->view('kategori_produk/view', $data);
	}

}

/* End of file Kategori_produk.php */