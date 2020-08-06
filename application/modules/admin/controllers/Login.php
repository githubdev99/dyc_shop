<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->has_login();
	}

	public function index()
	{
		$title = 'Login';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['sweetalert']
		];
		
		if (!$this->input->post()) {
			$this->load->view('login/view', $data);
		} else {
			$process = TRUE;

			if ($this->input->post('login')) {
				$param = [
					'field' => '*',
					'table' => 'admin',
					'where' => [
						'username' => $this->input->post('username')
					]
				];
	
				if ($process == TRUE) {
					$query = $this->master_model->select_data($param)->row();

					if ($query == FALSE) {
						$message = [
							'name' => 'failed',
							'swal' => [
								'title' => 'Not Found!',
								'text' => 'Akun tidak ditemukan!',
								'type' => 'warning'
							]
						];
						$this->alert_popup($message);
						redirect(base_url().'admin/login','refresh');
					} elseif ($query->username != $this->input->post('username') || !password_verify($this->input->post('password'), $query->password)) {
						$message = [
							'name' => 'failed',
							'swal' => [
								'title' => 'Failed!',
								'text' => 'Username atau password salah!',
								'type' => 'error'
							]
						];
						$this->alert_popup($message);
						redirect(base_url().'admin/login','refresh');
					} else {
						$message = [
							'name' => 'success',
							'swal' => [
								'title' => 'Successfull!',
								'text' => 'Anda berhasil login!',
								'type' => 'success'
							]
						];

						$this->session->set_userdata([
							'get_session' => 'admin',
							'id_admin' => $query->id_admin,
							'nama_admin' => $query->nama_admin,
							'username' => $query->username,
							'password' => $query->password
						]);

						$this->alert_popup($message);
						redirect(base_url().'admin/dashboard','refresh');
					}
				} else {
					$process = FALSE;
				}
			}
		}
	}

}