<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	private $data = [];
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function setup_app($title)
	{
		$this->data['main_icon'] = base_url().'assets/images/logo-mini.png';
		$this->data['app_name'] = 'DYC Shop';
		$this->data['title_page'] = $title.' | '.$this->data['app_name'];
		$this->data['copyright_auth'] = '<p>Copyright &copy; 2020 All Right Reserved <br>DYC Shop.</p>';
		$this->data['copyright_app'] = '
		<footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						Copyright &copy; 2020 All Right Reserved
					</div>
					<div class="col-sm-6">
						<div class="text-sm-right d-none d-sm-block">
							DYC Shop
						</div>
					</div>
				</div>
			</div>
		</footer>
		';
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

	public function has_login()
	{
		if ($this->session->userdata('get_session') == 'admin') {
			redirect('admin/dashboard','refresh');
		} elseif ($this->session->userdata('get_session') == 'customer') {
			redirect('home','refresh');
		}
	}

	public function not_login()
	{
		if (!$this->session->userdata('get_session') == 'admin') {
			redirect('admin/login','refresh');
		} elseif (!$this->session->userdata('get_session') == 'customer') {
			redirect('auth/login','refresh');
		}
	}

}

/* End of file MY_Controller.php */