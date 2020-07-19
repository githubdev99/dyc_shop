<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$title = 'Dashboard';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['sweetalert', 'apexcharts', 'pages-dashboard']
		];

		$this->load->view('dashboard/view', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */