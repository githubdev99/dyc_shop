<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_produk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$title = 'Kategori Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['datatable', 'sweetalert'],
            'get_script' => 'script_view',
            'modal_add' => '
            <form action="?" method="post" enctype="multipart/form-data" name="add_kategori">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Tambah Data Kategori
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-md-3 col-xs-12">
                                Kategori <span class="text-danger">*</span>
                                <br>
                                <span class="help-block" style="font-weight: normal;">
                                    <small><i>Nama kategori produk</i></small>
                                </span>
                            </label>
                            <div class="col-sm-9 col-md-9 col-xs-12">
                                <input name="nama_kategori" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="insert" value="insert" class="btn btn-info waves-effect waves-light">
                            <i class="fas fa-save mr-2"></i>Simpan Data
                        </button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </form>
            ',
			'modal_edit' => '
            <form action="?" method="post" enctype="multipart/form-data" name="edit_kategori">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Edit Data Kategori
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-md-3 col-xs-12">
                                Kategori <span class="text-danger">*</span>
                                <br>
                                <span class="help-block" style="font-weight: normal;">
                                    <small><i>Nama kategori produk</i></small>
                                </span>
                            </label>
                            <div class="col-sm-9 col-md-9 col-xs-12">
                                <input type="hidden" name="id_kategori">
                                <input name="nama_kategori" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update" value="update" class="btn btn-success waves-effect waves-light">
                            <i class="fas fa-edit mr-2"></i>Edit Data
                        </button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </form>
            ',
			'modal_delete' => '
            <form action="?" method="post" enctype="multipart/form-data" name="delete_kategori">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Konfirmasi Hapus Data Kategori
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <input type="hidden" name="id_kategori">
                            <input type="hidden" name="nama_kategori">
                            <h4>Anda yakin ingin menghapus data kategori <b>"<span id="nama_kategori"></span>"</b> ?</h4>
                            <p>Data yang sudah dihapus tidak dapat dikembalikan!</p>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete" value="delete" class="btn btn-danger waves-effect waves-light">
                            <i class="far fa-trash-alt mr-2"></i>Hapus Data
                        </button>
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </form>
            '
		];

        if (!$this->input->post()) {
            $this->load->view('kategori_produk/view', $data);
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

            $check_data = $this->admin_model->select_data($param)->result();

            if (!empty($check_data)) {
                if ($this->input->post('insert')) {
                    $checking = FALSE;
                    $message = [
                        'name' => 'failed',
                        'swal' => [
                            'title' => 'Failed!',
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
                            'id_kategori' => $this->admin_model->generate_code('K'),
                            'nama_kategori' => $this->input->post('nama_kategori'),
                            'created_datetime' => date('Y-m-d H:i:s')
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->admin_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'title' => 'Failed!',
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
                                    'title' => 'Successfull!',
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
                            'id_kategori' => $this->input->post('id_kategori')
                        ],
                        'data' => [
                            'nama_kategori' => $this->input->post('nama_kategori'),
                            'created_datetime' => date('Y-m-d H:i:s')
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->admin_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'title' => 'Failed!',
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
                                    'title' => 'Successfull!',
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
                            'id_kategori' => $this->input->post('id_kategori')
                        ],
                        'table' => 'produk_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->admin_model->delete_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'title' => 'Failed!',
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
                                    'title' => 'Successfull!',
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
    
    public function detail()
    {
        $id = $this->input->get('get');

        $param_get_data = [
            'table' => 'produk_kategori',
            'where' => [
                'id_kategori' => decrypt_text($id)
            ]
        ];

        $get_data = $this->admin_model->get_data($param_get_data)->row();

        // Check URL
        if (decrypt_text($id) != $get_data->id_kategori) {
            $message = [
                'name' => 'failed',
                'swal' => [
                    'title' => 'Failed!',
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
            'get_script' => 'script_detail',
            'modal_add' => '
            <form action="?" method="post" enctype="multipart/form-data" name="add_sub_kategori">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Tambah Data Sub Kategori
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-md-3 col-xs-12">
                                Kategori <span class="text-danger">*</span>
                                <br>
                                <span class="help-block" style="font-weight: normal;">
                                    <small><i>Nama kategori produk</i></small>
                                </span>
                            </label>
                            <div class="col-sm-9 col-md-9 col-xs-12">
                                <input name="nama_sub_kategori" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="insert" value="insert" class="btn btn-info waves-effect waves-light">
                            <i class="fas fa-save mr-2"></i>Simpan Data
                        </button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </form>
            ',
			'modal_edit' => '
            <form action="?" method="post" enctype="multipart/form-data" name="edit_sub_kategori">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Edit Data Sub Kategori
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-md-3 col-xs-12">
                                Kategori <span class="text-danger">*</span>
                                <br>
                                <span class="help-block" style="font-weight: normal;">
                                    <small><i>Nama kategori produk</i></small>
                                </span>
                            </label>
                            <div class="col-sm-9 col-md-9 col-xs-12">
                                <input type="hidden" name="id_sub_kategori">
                                <input name="nama_sub_kategori" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update" value="update" class="btn btn-success waves-effect waves-light">
                            <i class="fas fa-edit mr-2"></i>Edit Data
                        </button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </form>
            ',
			'modal_delete' => '
            <form action="?" method="post" enctype="multipart/form-data" name="delete_sub_kategori">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Konfirmasi Hapus Data Sub Kategori
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <input type="hidden" name="id_sub_kategori">
                            <input type="hidden" name="nama_sub_kategori">
                            <h4>Anda yakin ingin menghapus data kategori <b>"<span id="nama_sub_kategori"></span>"</b> ?</h4>
                            <p>Data yang sudah dihapus tidak dapat dikembalikan!</p>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete" value="delete" class="btn btn-danger waves-effect waves-light">
                            <i class="far fa-trash-alt mr-2"></i>Hapus Data
                        </button>
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </form>
            '
        ];
        
        if (!$this->input->post()) {
            $this->load->view('kategori_produk/detail', $data);
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

            $check_data = $this->admin_model->select_data($param)->result();

            if (!empty($check_data)) {
                if ($this->input->post('insert')) {
                    $checking = FALSE;
                    $message = [
                        'name' => 'failed',
                        'swal' => [
                            'title' => 'Failed!',
                            'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' sudah pernah disimpan.',
                            'type' => 'error'
                        ]
                    ];
                    $this->alert_popup($message);
                    redirect(base_url().'admin/kategori_produk/detail?get'.$id,'refresh');
                }
            }

            if ($checking == TRUE) {
                if ($this->input->post('insert')) {
                    $param = [
                        'data' => [
                            'id_sub_kategori' => $this->admin_model->generate_code('KS'),
                            'id_kategori' => decrypt_text($id),
                            'nama_sub_kategori' => $this->input->post('nama_sub_kategori')
                        ],
                        'table' => 'produk_sub_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->admin_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'title' => 'Failed!',
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' gagal ditambahkan.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail?get'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'title' => 'Successfull!',
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' telah berhasil ditambahkan.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail?get'.$id,'refresh');
                        }
                    }
                } elseif ($this->input->post('update')) {
                    $param = [
                        'where' => [
                            'id_sub_kategori' => $this->input->post('id_sub_kategori')
                        ],
                        'data' => [
                            'nama_sub_kategori' => $this->input->post('nama_sub_kategori')
                        ],
                        'table' => 'produk_sub_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->admin_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'title' => 'Failed!',
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' gagal di edit.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail?get'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'title' => 'Successfull!',
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' telah berhasil di edit.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail?get'.$id,'refresh');
                        }
                    }
                } elseif ($this->input->post('delete')) {
                    $param = [
                        'where' => [
                            'id_sub_kategori' => $this->input->post('id_sub_kategori')
                        ],
                        'table' => 'produk_sub_kategori'
                    ];

                    if ($process == TRUE) {
                        $query = $this->admin_model->delete_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'title' => 'Failed!',
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' gagal di hapus.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail?get'.$id,'refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'title' => 'Successfull!',
                                    'text' => 'Data kategori '.$this->input->post('nama_sub_kategori').' berhasil di hapus.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/kategori_produk/detail?get'.$id,'refresh');
                        }
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

}

/* End of file Kategori_produk.php */