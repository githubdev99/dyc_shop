<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_produk extends MY_Controller {

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

}