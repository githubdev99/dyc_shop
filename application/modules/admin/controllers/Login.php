<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->has_login_admin();
	}

	public function index()
	{
		$title = 'Login';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['sweetalert'],
            'get_script' => 'admin/login/script_login'
		];
		
		if (!$this->input->post()) {
			$this->load->view('login/view', $data);
		} else {
			$process = TRUE;

			if ($process == TRUE) {
				$query = $this->master_model->select_data([
					'field' => '*',
					'table' => 'admin',
					'where' => [
						'username' => $this->input->post('username')
					]
				])->row();

				if ($query == FALSE) {
					$output = [
						'error' => true,
						'text' => 'Akun tidak ditemukan!',
						'type' => 'warning'
					];
				} elseif ($query->username != $this->input->post('username') || !password_verify($this->input->post('password'), $query->password)) {
					$output = [
						'error' => true,
						'text' => 'Username atau password salah!',
						'type' => 'error'
					];
				} else {
					$this->session->set_userdata([
						'admin' => [
							'id' => $query->id_admin
						]
					]);

					$output = [
						'error' => false,
						'text' => 'Anda berhasil login!<br>Halaman akan otomatis berpindah',
						'type' => 'success',
						'callback' => base_url().'admin/dashboard'
					];
				}
			} else {
				$process = FALSE;
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
	}

}