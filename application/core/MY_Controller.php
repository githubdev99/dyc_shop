<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	private $data = [];
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->module('master');
		$this->load->model('master/master_model');
	}

	public function setup_app($title)
	{
		$this->data['main_icon'] = base_url().'assets/admin/images/logo-mini.png';
		$this->data['app_name'] = 'DYC Shop';
		$this->data['title_page'] = $title.' | '.$this->data['app_name'];
		$this->data['ajax_error'] = '
		Swal.mixin({
			toast: true,
			position: "top",
			showCloseButton: !0,
			showConfirmButton: false,
			timer: 4000,
			onOpen: (toast) => {
				toast.addEventListener("mouseenter", Swal.stopTimer)
				toast.addEventListener("mouseleave", Swal.resumeTimer)
			}
		}).fire({
			icon: "error",
			title: "Ada kesalahan teknis"
		});
		';

		// Session Admin
		if ($this->session->userdata('admin')) {
			$this->data['data_session'] = $this->master_model->select_data(
				[
					'field' => '*',
					'table' => 'admin',
					'where' => [
						'id_admin' => $this->session->userdata('admin')['id']
					]
				]
			)->row();
		} elseif ($this->session->userdata('customer')) {
			# code...
		}

		return $this->data;
	}

	public function alert_popup($message)
	{
		$sweet_alert = '
		Swal.mixin({
			toast: true,
			position: "top",
			showCloseButton: !0,
			showConfirmButton: false,
			timer: 4000,
			onOpen: (toast) => {
				toast.addEventListener("mouseenter", Swal.stopTimer)
				toast.addEventListener("mouseleave", Swal.resumeTimer)
			}
		}).fire({
			icon: "'.$message['swal']['type'].'",
			title: "'.$message['swal']['text'].'"
		});
		';
		
		$this->session->set_flashdata($message['name'], $sweet_alert);
	}

	public function has_login_admin()
	{
		if (!empty($this->session->userdata('admin'))) {
			redirect('admin/dashboard','refresh');
		}
	}

	public function not_login_admin()
	{
		if (empty($this->session->userdata('admin'))) {
			redirect('admin/login','refresh');
		}
	}

	public function has_login_customer()
	{
		if (!empty($this->session->userdata('customer'))) {
			redirect('home','refresh');
		}
	}

	public function not_login_customer()
	{
		if (empty($this->session->userdata('customer'))) {
			redirect('auth/login','refresh');
		}
	}

}