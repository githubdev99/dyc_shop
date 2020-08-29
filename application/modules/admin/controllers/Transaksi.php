<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends MY_Controller {

    private $data = [];
	private $param = [];

	public function __construct()
	{
        parent::__construct();
        $this->not_login_admin();
	}

	public function index()
	{
		$title = 'Transaksi';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['datatable', 'sweetalert', 'magnific-popup'],
            'get_view' => 'admin/transaksi/view',
            'get_script' => 'admin/transaksi/script_view'
		];

        if (!$this->input->post()) {
            $this->master->template_admin($data);
        } else {
            $process = TRUE;

            if ($this->input->post('delete')) {
                if ($process == TRUE) {
                    $query = $this->master_model->delete_data([
                        'where' => [
                            'id_produk' => decrypt_text($this->input->post('id_produk'))
                        ],
                        'table' => 'produk'
                    ]);
                    if ($query == FALSE) {
                        $this->alert_popup([
                            'name' => 'failed',
                            'swal' => [
                                'text' => 'Data produk '.$this->input->post('nama_produk').' gagal di hapus.',
                                'type' => 'error'
                            ]
                        ]);
                        redirect(base_url().'admin/produk','refresh');
                    } else {
                        if (!empty($this->input->post('foto'))) {
                            unlink('assets/images/upload/'.$this->input->post('foto'));
                        }
                        $this->alert_popup([
                            'name' => 'success',
                            'swal' => [
                                'text' => 'Data produk '.$this->input->post('nama_produk').' berhasil di hapus.',
                                'type' => 'success'
                            ]
                        ]);
                        redirect(base_url().'admin/produk','refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function detail($id)
	{
        $get_data = $this->master_model->select_data([
            'field' => 'transaksi.*, customer.nama_lengkap',
            'table' => 'transaksi',
            'join' => [
                [
                    'table' => 'customer',
                    'on' => 'transaksi.id_customer = customer.id_customer',
                    'type' => 'inner'
                ],
            ],
            'where' => [
                'id_transaksi' => decrypt_text($id)
            ]
        ])->row();

        // Check URL
        if (decrypt_text($id) != $get_data->id_transaksi) {
            $this->alert_popup([
                'name' => 'failed',
                'swal' => [
                    'text' => 'Ada kesalahan teknis',
                    'type' => 'error'
                ]
            ]);
            redirect(base_url().'admin/transaksi','refresh');
        }

		$title = 'Detail Transaksi';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['sweetalert', 'magnific-popup', 'datatable'],
            'get_view' => 'admin/transaksi/detail',
            'get_script' => 'admin/transaksi/script_detail',
            'get_data' => $get_data
        ];
        
        if (!$this->input->post()) {
            $this->master->template_admin($data);
        } else {
            $process = TRUE;

            if ($this->input->post('confirm')) {
                if ($process == TRUE) {
                    $query = $this->master_model->send_data([
                        'where' => [
                            'id_transaksi' => decrypt_text($this->input->post('id_transaksi'))
                        ],
                        'data' => [
                            'status' => 'Sudah Dibayar'
                        ],
                        'table' => 'transaksi'
                    ]);
                    if ($query == FALSE) {
                        $this->alert_popup([
                            'name' => 'failed',
                            'swal' => [
                                'text' => 'Data transaksi gagal di konfirmasi.',
                                'type' => 'error'
                            ]
                        ]);
                        redirect(base_url().'admin/transaksi/detail/'.$id,'refresh');
                    } else {
                        $this->alert_popup([
                            'name' => 'success',
                            'swal' => [
                                'text' => 'Data transaksi berhasil di konfirmasi.',
                                'type' => 'success'
                            ]
                        ]);
                        redirect(base_url().'admin/transaksi/detail/'.$id,'refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function list_transaksi()
	{
		if (!empty($_REQUEST['draw'])) {
			$draw = $_REQUEST['draw'];
		} else {
			$draw = 0;
		}

		$this->param['column_search'] = [
			'no_order', 'nama_lengkap', 'no_telp', 'province', 'city_name', 'subdistrict', 'alamat', 'total_transaksi', 'status', 'ongkir', 'jenis_ongkir', 'etd_ongkir'
		];
		$this->param['column_order'] = [
			null,'no_order','nama_lengkap','jenis_ongkir','total_transaksi','status',null
		];
		$this->param['field'] = 'transaksi.*, customer.*, data_province.province, data_city.city_name, data_subdistrict.subdistrict';
        $this->param['table'] = 'transaksi';

        $this->param['join'] = [
            [
                'table' => 'customer',
                'on' => 'customer.id_customer = transaksi.id_customer',
                'type' => 'inner'
            ],
            [
                'table' => 'data_province',
                'on' => 'customer.province_id = data_province.province_id',
                'type' => 'inner'
            ],
            [
                'table' => 'data_city',
                'on' => 'customer.city_id = data_city.city_id',
                'type' => 'inner'
            ],
            [
                'table' => 'data_subdistrict',
                'on' => 'customer.subdistrict_id = data_subdistrict.subdistrict_id',
                'type' => 'inner'
            ]
        ];

		$this->param['order_by'] = [
			'no_order' => 'asc'
		];

		$this->data['data_parsing'] = $this->master_model->get_datatable($this->param);
		$this->data['total_filtered'] = $this->master_model->get_total_filtered($this->param);
		$this->data['total_data'] = $this->master_model->get_total_data($this->param);

		$get_data = [];
		if (!empty($this->data['data_parsing'])) {
			$no = $_REQUEST['start'];
			foreach ($this->data['data_parsing'] as $key) {
				$nested_data = [];
				$no++;

                $get_created = explode(' ', $key->created_datetime);
                
                if ($key->status == 'Belum Dibayar') {
                    $status = '<span class="badge badge-secondary">'.$key->status.'</span>';
                } elseif ($key->status == 'Menunggu Konfirmasi') {
                    $status = '<span class="badge badge-warning">'.$key->status.'</span>';
                } elseif ($key->status == 'Sudah Dibayar') {
                    $status = '<span class="badge badge-success">'.$key->status.'</span>';
                }

                $nested_data[] = $no;
                $nested_data[] = $key->no_order.'<br>
                <span class="text-muted">
					'.date_indo($get_created[0]).' '.$get_created[1].'
				</span>';
                $nested_data[] = $key->nama_lengkap.
                '<br><br>
                <span class="text-muted">Alamat:</span>'.$key->alamat.'<br>'.$key->subdistrict.', Kec. '.$key->city_name.', '.$key->province;
                $nested_data[] = rupiah($key->total_transaksi);
                $nested_data[] = $key->ongkir.'<br>'.$key->jenis_ongkir.'<br>'.$key->etd_ongkir;
                $nested_data[] = $status;
				$nested_data[] = '
				<a href="'.base_url().'admin/transaksi/detail/'.encrypt_text($key->id_transaksi).'" class="btn btn-info waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Detail Data">
					<i class="fas fa-info"></i>
				</a>';

				$get_data[] = $nested_data;
			}
		}

		$this->data['output'] = [
			'draw' => intval($draw),
			'recordsTotal' => intval($this->data['total_data']),
			'recordsFiltered' => intval($this->data['total_filtered']),
			'data' => $get_data
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

	public function get_produk()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'produk';
		$this->param['where'] = [
			'id_produk' => decrypt_text($this->input->post('id'))
		];
		$this->param['order_by'] = [
			'nama_produk' => 'asc'
		];

		$this->data['data_parsing'] = $this->master_model->select_data($this->param)->row();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['id_produk'] = encrypt_text($this->data['data_parsing']->id_produk);
				$get_data['nama_produk'] = $this->data['data_parsing']->nama_produk;
				$get_data['foto'] = $this->data['data_parsing']->foto;

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
    }
    
    public function list_transaksi_produk()
	{
		if (!empty($_REQUEST['draw'])) {
			$draw = $_REQUEST['draw'];
		} else {
			$draw = 0;
		}

		$this->param['column_search'] = [
			'id_produk','kode_sku','nama_produk','harga','qty'
		];
		$this->param['column_order'] = [
			null,null,'nama_produk','harga',null
		];
		$this->param['field'] = 'produk.*, transaksi_detail.*';
        $this->param['table'] = 'transaksi_detail';

        $this->param['join'] = [
            [
                'table' => 'produk',
                'on' => 'produk.id_produk = transaksi_detail.id_produk',
                'type' => 'inner'
            ]
        ];

        $this->param['where'] = [
            'id_transaksi' => decrypt_text($this->input->post('id_transaksi'))
        ];
        
		$this->param['order_by'] = [
			'nama_produk' => 'asc'
		];

		$this->data['data_parsing'] = $this->master_model->get_datatable($this->param);
		$this->data['total_filtered'] = $this->master_model->get_total_filtered($this->param);
		$this->data['total_data'] = $this->master_model->get_total_data($this->param);

		$get_data = [];
		if (!empty($this->data['data_parsing'])) {
			$no = $_REQUEST['start'];
			foreach ($this->data['data_parsing'] as $key) {
				$nested_data = [];
				$no++;
                
                if ($key->foto != NULL) {
					$url_foto = base_url().'assets/admin/images/upload/'.$key->foto;
				} else {
					$url_foto = base_url().'assets/admin/images/img-thumbnail.svg';
				}

                $nested_data[] = $no;
                $nested_data[] = '
				<a class="image-popup" href="'.$url_foto.'">
					<img class="img-thumbnail" width="100" src="'.$url_foto.'" data-holder-rendered="true">
				</a>';
				$nested_data[] = '
				<a href="'.base_url().'admin/produk/detail/'.encrypt_text($key->id_produk).'">
					'.$key->nama_produk.'
				</a><br>
				<span class="text-muted">
                    Kode SKU : '.$key->kode_sku.'
                </span>';
                $nested_data[] = rupiah($key->harga).' x '.$key->qty;
                $nested_data[] = rupiah($key->harga * $key->qty);

				$get_data[] = $nested_data;
			}
		}

		$this->data['output'] = [
			'draw' => intval($draw),
			'recordsTotal' => intval($this->data['total_data']),
			'recordsFiltered' => intval($this->data['total_filtered']),
			'data' => $get_data
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
    }
    
    public function get_konfirmasi()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'konfirmasi';
		$this->param['where'] = [
			'id_transaksi' => decrypt_text($this->input->post('id'))
		];

		$this->data['data_parsing'] = $this->master_model->select_data($this->param)->row();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['no_rek'] = $this->data['data_parsing']->no_rek;
				$get_data['atas_nama'] = $this->data['data_parsing']->atas_nama;
				$get_data['nama_bank'] = $this->data['data_parsing']->nama_bank;
				$get_data['foto_bukti'] = $this->data['data_parsing']->foto_bukti;

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
    }

}