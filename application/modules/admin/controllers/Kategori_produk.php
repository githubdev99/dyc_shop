<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_produk extends MY_Controller {

    private $data = [];
	private $param = [];

	public function __construct()
	{
        parent::__construct();
        $this->not_login();
	}

	public function index()
	{
		$title = 'Kategori Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['datatable', 'sweetalert'],
            'get_view' => 'admin/kategori_produk/view',
            'get_script' => 'admin/kategori_produk/script_view'
		];

        if (!$this->input->post()) {
            $this->master->template_admin($data);
        } else {
            $process = TRUE;
            $checking = TRUE;

            // Check Data
            $lower_data = trim(strtolower($this->input->post('nama_kategori')));
            $param = [
                'field' => 'nama_kategori',
                'table' => 'produk_kategori',
                'where' => [
                    'LOWER(nama_kategori)' => $lower_data
                ]
            ];

            $check_data = $this->master_model->select_data($param)->result();

            if (!empty($check_data)) {
                if ($this->input->post('insert') || $this->input->post('update')) {
                    $checking = FALSE;
                    $message = [
                        'name' => 'failed',
                        'swal' => [
                            'text' => 'Data kategori '.$this->input->post('nama_kategori').' sudah pernah disimpan.',
                            'type' => 'error'
                        ]
                    ];
                    $this->alert_popup($message);
                    redirect(base_url().'admin/kategori_produk','refresh');
                }
            }

            if ($checking == TRUE) {
                if ($this->input->post('insert')) {
                    $param = [
                        'data' => [
                            'id_kategori' => $this->master_model->generate_code('K'),
                            'nama_kategori' => $this->input->post('nama_kategori'),
                            'created_datetime' => date('Y-m-d H:i:s')
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' gagal ditambahkan.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk','refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' telah berhasil ditambahkan.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk','refresh');
                        }
                    }
                } elseif ($this->input->post('update')) {
                    $param = [
                        'where' => [
                            'id_kategori' => decrypt_text($this->input->post('id_kategori'))
                        ],
                        'data' => [
                            'nama_kategori' => $this->input->post('nama_kategori'),
                            'created_datetime' => date('Y-m-d H:i:s')
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' gagal di edit.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk','refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' telah berhasil di edit.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk','refresh');
                        }
                    }
                } elseif ($this->input->post('delete')) {
                    $param = [
                        'where' => [
                            'id_kategori' => decrypt_text($this->input->post('id_kategori'))
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->delete_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' gagal di hapus.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk','refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' berhasil di hapus.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk','refresh');
                        }
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }
    
    public function detail($id)
    {
        $param_get_data = [
            'table' => 'produk_kategori',
            'where' => [
                'id_kategori' => decrypt_text($id)
            ]
        ];

        $get_data = $this->master_model->get_data($param_get_data)->row();

        // Check URL
        if (decrypt_text($id) != $get_data->id_kategori) {
            $message = [
                'name' => 'failed',
                'swal' => [
                    'text' => 'Ada kesalahan teknis',
                    'type' => 'error'
                ]
            ];
            $this->alert_popup($message);
            redirect(base_url().'admin/kategori_produk','refresh');
        }

        $title = 'Kategori Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['datatable', 'sweetalert'],
            'get_view' => 'admin/kategori_produk/detail',
            'get_script' => 'admin/kategori_produk/script_detail',
            'get_data' => $get_data
        ];
        
        if (!$this->input->post()) {
            $this->master->template_admin($data);
        } else {
            $process = TRUE;
            $checking = TRUE;

            // Check Data
            $lower_data = trim(strtolower($this->input->post('nama_sub_kategori')));
            $param = [
                'field' => 'nama_sub_kategori',
                'table' => 'produk_sub_kategori',
                'where' => [
                    'LOWER(nama_sub_kategori)' => $lower_data
                ]
            ];

            $check_data = $this->master_model->select_data($param)->result();

            $lower_data2 = trim(strtolower($this->input->post('nama_kategori')));
            $param2 = [
                'field' => 'nama_kategori',
                'table' => 'produk_kategori',
                'where' => [
                    'LOWER(nama_kategori)' => $lower_data2
                ]
            ];

            $check_data2 = $this->master_model->select_data($param2)->result();

            if (!empty($check_data)) {
                if ($this->input->post('insert') || $this->input->post('update')) {
                    $checking = FALSE;
                    $message = [
                        'name' => 'failed',
                        'swal' => [
                            'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' sudah pernah disimpan.',
                            'type' => 'error'
                        ]
                    ];
                    $this->alert_popup($message);
                    redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                }
            } elseif (!empty($check_data2)) {
                if ($this->input->post('update_kategori')) {
                    $checking = FALSE;
                    $message = [
                        'name' => 'failed',
                        'swal' => [
                            'text' => 'Data kategori '.$this->input->post('nama_kategori').' sudah pernah disimpan.',
                            'type' => 'error'
                        ]
                    ];
                    $this->alert_popup($message);
                    redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                }
            }

            if ($checking == TRUE) {
                if ($this->input->post('insert')) {
                    $param = [
                        'data' => [
                            'id_sub_kategori' => $this->master_model->generate_code('KS'),
                            'id_kategori' => decrypt_text($id),
                            'nama_sub_kategori' => $this->input->post('nama_sub_kategori')
                        ],
                        'table' => 'produk_sub_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' gagal ditambahkan.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' telah berhasil ditambahkan.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        }
                    }
                } elseif ($this->input->post('update')) {
                    $param = [
                        'where' => [
                            'id_sub_kategori' => decrypt_text($this->input->post('id_sub_kategori'))
                        ],
                        'data' => [
                            'nama_sub_kategori' => $this->input->post('nama_sub_kategori')
                        ],
                        'table' => 'produk_sub_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' gagal di edit.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' telah berhasil di edit.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        }
                    }
                } elseif ($this->input->post('delete')) {
                    $param = [
                        'where' => [
                            'id_sub_kategori' => decrypt_text($this->input->post('id_sub_kategori'))
                        ],
                        'table' => 'produk_sub_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->delete_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' gagal di hapus.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' berhasil di hapus.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        }
                    }
                } elseif ($this->input->post('update_kategori')) {
                    $param = [
                        'where' => [
                            'id_kategori' => decrypt_text($this->input->post('id_kategori'))
                        ],
                        'data' => [
                            'nama_kategori' => $this->input->post('nama_kategori'),
                            'created_datetime' => date('Y-m-d H:i:s')
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' gagal di edit.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' telah berhasil di edit.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        }
                    }
                } elseif ($this->input->post('delete_kategori')) {
                    $param = [
                        'where' => [
                            'id_kategori' => decrypt_text($this->input->post('id_kategori'))
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->master_model->delete_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' gagal di hapus.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail/'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data kategori '.$this->input->post('nama_kategori').' berhasil di hapus.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk','refresh');
                        }
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function list_kategori_produk()
	{
		if (!empty($_REQUEST['draw'])) {
			$draw = $_REQUEST['draw'];
		} else {
			$draw = 0;
		}

		$this->param['column_search'] = [
			'id_kategori','nama_kategori'
		];
		$this->param['column_order'] = [
			null,'nama_kategori',null
		];
		$this->param['field'] = 'produk_kategori.*';
		$this->param['table'] = 'produk_kategori';
		$this->param['order_by'] = [
			'nama_kategori' => 'asc'
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

				$nested_data[] = $no;
				$nested_data[] = '
				<a href="'.base_url().'admin/kategori_produk/detail/'.encrypt_text($key->id_kategori).'">
					'.$key->nama_kategori.'
				</a><br>
				<span class="text-muted">
					'.date_indo($get_created[0]).' '.$get_created[1].'
				</span>';
				$nested_data[] = '
				<a href="'.base_url().'admin/kategori_produk/detail/'.encrypt_text($key->id_kategori).'" class="btn btn-info waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Detail Data">
					<i class="fas fa-info"></i>
				</a>
				<a href="javascript:;" class="btn btn-success waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Edit Data" onclick="modal_edit('."'".encrypt_text($key->id_kategori)."'".')">
					<i class="fas fa-edit"></i>
				</a>
				<a href="javascript:;" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="modal_delete('."'".encrypt_text($key->id_kategori)."'".')"><i class="far fa-trash-alt"></i>
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

	public function get_kategori_produk()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'produk_kategori';
		$this->param['where'] = [
			'id_kategori' => decrypt_text($this->input->post('id'))
		];
		$this->param['order_by'] = [
			'nama_kategori' => 'asc'
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
				$get_data['id_kategori'] = encrypt_text($this->data['data_parsing']->id_kategori);
				$get_data['nama_kategori'] = $this->data['data_parsing']->nama_kategori;

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

	public function list_sub_kategori_produk()
	{
		if (!empty($_REQUEST['draw'])) {
			$draw = $_REQUEST['draw'];
		} else {
			$draw = 0;
		}

		$this->param['column_search'] = [
			'id_sub_kategori','id_kategori','nama_sub_kategori'
		];
		$this->param['column_order'] = [
			null,'nama_sub_kategori',null
		];
		$this->param['field'] = 'produk_sub_kategori.*';
		$this->param['table'] = 'produk_sub_kategori';
		$this->param['where'] = [
			'id_kategori' => decrypt_text($this->input->post('id_kategori'))
		];
		$this->param['order_by'] = [
			'nama_sub_kategori' => 'asc'
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

				$nested_data[] = $no;
				$nested_data[] = '
				<a href="javascript:;" onclick="modal_edit('."'".encrypt_text($key->id_sub_kategori)."'".')">
					'.$key->nama_sub_kategori.'
				</a>';
				$nested_data[] = '
				<a href="javascript:;" class="btn btn-success waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Edit Data" onclick="modal_edit('."'".encrypt_text($key->id_sub_kategori)."'".')">
					<i class="fas fa-edit"></i>
				</a>
				<a href="javascript:;" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="modal_delete('."'".encrypt_text($key->id_sub_kategori)."'".')"><i class="far fa-trash-alt"></i>
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

	public function get_sub_kategori_produk()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'produk_sub_kategori';
		$this->param['where'] = [
			'id_sub_kategori' => decrypt_text($this->input->post('id'))
		];
		$this->param['order_by'] = [
			'nama_sub_kategori' => 'asc'
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
				$get_data['id_sub_kategori'] = encrypt_text($this->data['data_parsing']->id_sub_kategori);
				$get_data['nama_sub_kategori'] = $this->data['data_parsing']->nama_sub_kategori;

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

}