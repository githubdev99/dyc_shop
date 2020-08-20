<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	private $data = [];
	private $param = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$title = 'Home';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_home'
		];

		$this->master->template_home($data);
	}

	public function login()
	{
		$this->has_login_customer();

		$title = 'Login';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_login',
			'get_script' => 'home/script_login'
		];

		if (!$this->input->post()) {
			$this->master->template_home($data);
		} else {
			$process = TRUE;

			if ($process == TRUE) {
				$query = $this->master_model->select_data([
					'field' => '*',
					'table' => 'customer',
					'where' => [
						'username' => $this->input->post('username')
					]
				])->row();

				if ($query == FALSE) {
					$output = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Akun tidak ditemukan!',
						'type' => 'warning'
					];
				} elseif ($query->username != $this->input->post('username') || !password_verify($this->input->post('password'), $query->password)) {
					$output = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Username atau password salah!',
						'type' => 'error'
					];
				} else {
					$this->session->set_userdata([
						'customer' => [
							'id' => $query->id_customer
						]
					]);

					$output = [
						'error' => false,
						'title' => 'Successfull!',
						'text' => 'Anda berhasil login!<br>Halaman akan otomatis berpindah',
						'type' => 'success',
						'callback' => base_url()
					];
				}
			} else {
				$process = FALSE;
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
    }
    
    public function daftar()
	{
		$this->has_login_customer();

		$title = 'Daftar';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_daftar',
			'get_script' => 'home/script_daftar'
		];

		if (!$this->input->post()) {
            $this->master->template_home($data);
        } else {
            $process = TRUE;
            $checking = TRUE;

            // Check Data
            $check_data = $this->master_model->select_data([
                'field' => 'username',
                'table' => 'customer',
                'where' => [
                    'LOWER(username)' => trim(strtolower($this->input->post('username')))
                ]
            ])->result();

            if (!empty($check_data)) {
                if ($this->input->post('insert')) {
					$checking = FALSE;
					$this->alert_popup2([
						'name' => 'failed',
						'swal' => [
							'title' => 'Successfull!',
							'text' => 'Akun telah terdaftar, silahkan coba lagi',
							'type' => 'error'
						]
					]);
                    redirect(base_url().'home/daftar','refresh');
                }
            }

            if ($checking == TRUE) {
                if ($this->input->post('insert')) {
                    if ($process == TRUE) {
                        $query = $this->master_model->send_data([
                            'data' => [
                                'id_customer' => $this->master_model->generate_code('C'),
                                'username' => $this->input->post('username'),
                                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                                'nama_lengkap' => $this->input->post('nama_lengkap'),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                                'email' => $this->input->post('email'),
								'no_telp' => $this->input->post('no_telp'),
								'province_id' => decrypt_text($this->input->post('province_id')),
                                'city_id' => decrypt_text($this->input->post('city_id')),
                                'subdistrict_id' => decrypt_text($this->input->post('subdistrict_id')),
                                'alamat' => $this->input->post('alamat')
                            ],
                            'table' => 'customer'
                        ]);
                        if ($query == FALSE) {
							$this->alert_popup2([
								'name' => 'failed',
								'swal' => [
									'title' => 'Successfull!',
									'text' => 'Akun gagal didaftarkan, silahkan coba lagi',
									'type' => 'error'
								]
							]);
                            redirect(base_url().'home/daftar','refresh');
                        } else {
							$this->alert_popup2([
								'name' => 'success',
								'swal' => [
									'title' => 'Successfull!',
									'text' => 'Akun berhasil didaftarkan, silahkan login',
									'type' => 'success'
								]
							]);
                            redirect(base_url().'home/login','refresh');
                        }
                    }
                }
            } else {
                $process = FALSE;
            }
        }
	}

	public function logout()
	{
		$this->session->unset_userdata('customer');
		$this->alert_popup2([
			'name' => 'success',
			'swal' => [
				'title' => 'Successfull!',
				'text' => 'Anda berhasil logout!',
				'type' => 'success'
			]
		]);
		redirect('home','refresh');
	}

	public function option_province()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'data_province';
		$this->param['order_by'] = [
			'province' => 'asc'
		];

		$this->data['data_parsing'] = $this->master_model->select_data($this->param)->result();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['html'] = '<option hidden>Pilih salah satu</option>';
				foreach ($this->data['data_parsing'] as $key) {
					$get_data['html'] .= '
					<option value="'.encrypt_text($key->province_id).'">'.$key->province.'</option>
					';
				}

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
    }
    
    public function option_city()
	{
		$this->param['field'] = '*';
        $this->param['table'] = 'data_city';
        $this->param['where'] = [
			'province_id' => decrypt_text($this->input->post('province_id'))
		];
		$this->param['order_by'] = [
			'city_name' => 'asc'
		];

		$this->data['data_parsing'] = $this->master_model->select_data($this->param)->result();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['html'] = '<option hidden>Pilih salah satu</option>';
				foreach ($this->data['data_parsing'] as $key) {
					$get_data['html'] .= '
					<option value="'.encrypt_text($key->city_id).'">'.$key->city_name.'</option>
					';
				}

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
    }
    
    public function option_subdistrict()
	{
		$this->param['field'] = '*';
        $this->param['table'] = 'data_subdistrict';
        $this->param['where'] = [
			'city_id' => decrypt_text($this->input->post('city_id'))
		];
		$this->param['order_by'] = [
			'subdistrict' => 'asc'
		];

		$this->data['data_parsing'] = $this->master_model->select_data($this->param)->result();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['html'] = '<option hidden>Pilih salah satu</option>';
				foreach ($this->data['data_parsing'] as $key) {
					$get_data['html'] .= '
					<option value="'.encrypt_text($key->subdistrict_id).'">'.$key->subdistrict.'</option>
					';
				}

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

}