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
							'title' => 'Failed!',
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
									'title' => 'Failed!',
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

	public function profil()
	{
		$this->not_login_customer();

		$title = 'Profil Saya';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_profil',
			'get_script' => 'home/script_profil'
		];

		if (!$this->input->post()) {
            $this->master->template_home($data);
        } else {
            $process = TRUE;

			if ($this->input->post('update')) {
                if ($process == TRUE) {
                    $query = $this->master_model->send_data([
                        'where' => [
                            'id_customer' => $this->session->userdata('customer')['id'],
                        ],
                        'data' => [
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
								'title' => 'Failed!',
                                'text' => 'Profil gagal di edit!',
                                'type' => 'error'
                            ]
                        ]);
                        redirect(base_url().'home/profil','refresh');
                    } else {
                        $this->alert_popup2([
                            'name' => 'success',
                            'swal' => [
								'title' => 'Successfull!',
                                'text' => 'Profil berhasil di edit!',
                                'type' => 'success'
                            ]
                        ]);
                        redirect(base_url().'home/profil','refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
	}

	public function pesanan()
	{
		$this->not_login_customer();

		$title = 'Pesanan Saya';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_pesanan',
			'get_script' => 'home/script_pesanan'
		];

		$this->master->template_home($data);
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
					$selected = (decrypt_text($this->input->post('province_id')) == $key->province_id) ? 'selected' : '';

					$get_data['html'] .= '
					<option value="'.encrypt_text($key->province_id).'" '.$selected.'>'.$key->province.'</option>
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
					$selected = (decrypt_text($this->input->post('city_id')) == $key->city_id) ? 'selected' : '';

					$get_data['html'] .= '
					<option value="'.encrypt_text($key->city_id).'" '.$selected.'>'.$key->city_name.'</option>
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
					$selected = (decrypt_text($this->input->post('subdistrict_id')) == $key->subdistrict_id) ? 'selected' : '';

					$get_data['html'] .= '
					<option value="'.encrypt_text($key->subdistrict_id).'" '.$selected.'>'.$key->subdistrict.'</option>
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

	public function list_pesanan()
	{
		$data_distinct = $this->master_model->select_data([
			'distinct' => 'id_transaksi',
			'table' => 'transaksi',
			'where' => [
				'id_customer' => $this->session->userdata('customer')['id'],
				'status' => $this->input->post('status')
			],
			'order_by' => [
				'no_order' => 'asc'
			]
		])->result();

		$get_data = [];
		$get_data['html'] = '';
		if (empty($data_distinct)) {
			if ($this->input->post('status') == 'Belum Dibayar') {
				$get_data['html'] = 'Kamu tidak memiliki pesanan yang belum dibayar.';
			} elseif ($this->input->post('status') == 'Menunggu Konfirmasi') {
				$get_data['html'] = 'Kamu tidak memiliki pesanan yang menunggu konfirmasi.';
			} elseif ($this->input->post('status') == 'Sudah Dibayar') {
				$get_data['html'] = 'Kamu tidak memiliki pesanan yang sudah dibayar.';
			}
		} else {
			foreach ($data_distinct as $key_distinct) {
				$this->param['field'] = 'transaksi_detail.*, transaksi.*, produk.nama_produk, produk.foto, produk.harga, produk.kode_sku';
				$this->param['table'] = 'transaksi_detail';
				$this->param['join'] = [
					[
						'table' => 'transaksi',
						'on' => 'transaksi.id_transaksi = transaksi_detail.id_transaksi',
						'type' => 'inner'
					],
					[
						'table' => 'produk',
						'on' => 'produk.id_produk = transaksi_detail.id_produk',
						'type' => 'inner'
					]
				];
				$this->param['where'] = [
					'transaksi_detail.id_transaksi' => $key_distinct->id_transaksi
				];

				$this->data['data_parsing'] = $this->master_model->select_data($this->param)->result();

				if (!empty($this->data['data_parsing'])) {
					if ($this->data['data_parsing'] == FALSE) {
						$this->data['output'] = [
							'error' => true,
							'data' => $get_data
						];
					} else {
						if ($key_distinct->status == 'Belum Dibayar') {
							$status_pesanan = '<span class="badge badge-pill badge-secondary float-right">'.$key_distinct->status.'</span>';
						} elseif ($key_distinct->status == 'Menunggu Konfirmasi') {
							$status_pesanan = '<span class="badge badge-pill badge-warning float-right">'.$key_distinct->status.'</span>';
						} elseif ($key_distinct->status == 'Sudah Dibayar') {
							$status_pesanan = '<span class="badge badge-pill badge-success float-right">'.$key_distinct->status.'</span>';
						}

						$get_data['html'] .= '
						<div class="card mb-4">
							<div class="card-header">
								<b class="float-left">'.$key_distinct->no_order.'</b>
								'.$status_pesanan.'
								<div class="clearfix"></div>
							</div>
						';
						foreach ($this->data['data_parsing'] as $key) {
							$get_data['html'] .= '
							<div class="card-body">
								<div class="d-flex float-left">
									<a class="pr-4 hidden-xs-down search-products" href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">
										<img src="'.base_url().'assets/admin/images/upload/'.$key->foto.'">
									</a>
									<div>
										<h5><a class="navi-link" href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">'.shorten_name($key->nama_produk).'</a></h5>
										<h6>
											'.rupiah($key->harga).' x '.$key->qty.'
										</h6>
										<p>Kode SKU : '.$key->kode_sku.'</p>
									</div>
								</div>
								<div class="float-right">
									Subtotal : <b>'.rupiah($key->harga * $key->qty).'</b>
								</div>
								<div class="clearfix"></div>
							</div>
							<hr>
							';
						}
						$get_data['html'] .= '
							<div class="text-right p-3">
								<p style="font-size: 16px;">
									Pengiriman Oleh '.$key->ongkir.' : '.rupiah($key->harga_ongkir).'<br>
									Tipe Pengiriman : '.$key->jenis_ongkir.'
								</p>
								<p><i class="fas fa-shipping-fast mr-2"></i> Estimasi : '.$key->etd_ongkir.' kedepan</p>
								<hr>
								<p class="mt-2" style="font-size: 20px;">
									Total Pembayaran : <span style="color: #ff54a3; border: #ff54a3 dashed 1px; padding: 2px 5px; background: #ffdeed; border-radius: 3px;">'.rupiah($key->total_transaksi).'</span>
								</p>
							</div>
							<hr>
							<div class="p-3">
								<button class="btn btn-primary" type="button" name="konfirmasi">
									<i class="fas fa-receipt mr-2"></i> Konfirmasi Pembayaran
								</button>
							</div>
						</div>
						';
					}
				}
			}
		}
		

		$this->data['output'] = [
			'error' => false,
			'data' => $get_data
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

}