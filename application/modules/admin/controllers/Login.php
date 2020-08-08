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
				if ($process == TRUE) {
					$query = $this->master_model->select_data([
							'field' => '*',
							'table' => 'admin',
							'where' => [
								'username' => $this->input->post('username')
							]
						])->row();

					if ($query == FALSE) {
						$this->alert_popup([
							'name' => 'failed',
							'swal' => [
								'text' => 'Akun tidak ditemukan!',
								'type' => 'warning'
							]
						]);
						redirect(base_url().'admin/login','refresh');
					} elseif ($query->username != $this->input->post('username') || !password_verify($this->input->post('password'), $query->password)) {
						$this->alert_popup([
							'name' => 'failed',
							'swal' => [
								'text' => 'Username atau password salah!',
								'type' => 'error'
							]
						]);
						redirect(base_url().'admin/login','refresh');
					} else {
						$this->session->set_userdata([
							'level' => 'admin',
							'id' => $query->id_admin
						]);

						$this->alert_popup([
							'name' => 'success',
							'swal' => [
								'text' => 'Anda berhasil login!',
								'type' => 'success'
							]
						]);
						redirect(base_url().'admin/dashboard','refresh');
					}
				} else {
					$process = FALSE;
				}
			}
		}
	}

}