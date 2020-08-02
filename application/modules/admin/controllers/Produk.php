<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$title = 'Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['datatable', 'sweetalert', 'magnific-popup'],
            'get_script' => 'script_view',
			'modal_delete' => '
            <form action="?" method="post" enctype="multipart/form-data" name="delete_produk">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Konfirmasi Hapus Data Produk
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <input type="hidden" name="id_produk">
                            <input type="hidden" name="nama_produk">
                            <input type="hidden" name="foto">
                            <h4>Anda yakin ingin menghapus data produk <b>"<span id="nama_produk"></span>"</b> ?</h4>
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
            $this->load->view('produk/view', $data);
        } else {
            $process = TRUE;

            if ($this->input->post('delete')) {
                $param = [
                    'where' => [
                        'id_produk' => decrypt_text($this->input->post('id_produk'))
                    ],
                    'table' => 'produk'
                ];

                if ($process == TRUE) {
                    $query = $this->admin_model->delete_data($param);
                    if ($query == FALSE) {
                        $message = [
                            'name' => 'failed',
                            'swal' => [
                                'title' => 'Failed!',
                                'text' => 'Data produk '.$this->input->post('nama_produk').' gagal di hapus.',
                                'type' => 'error'
                            ]
                        ];
                        $this->alert_popup($message);
                        redirect(base_url().'admin/produk','refresh');
                    } else {
                        if (!empty($this->input->post('foto'))) {
                            unlink('assets/images/upload/'.$this->input->post('foto'));
                        }

                        $message = [
                            'name' => 'success',
                            'swal' => [
                                'title' => 'Successfull!',
                                'text' => 'Data produk '.$this->input->post('nama_produk').' berhasil di hapus.',
                                'type' => 'success'
                            ]
                        ];
                        $this->alert_popup($message);
                        redirect(base_url().'admin/produk','refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function add()
	{
		$title = 'Tambah Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['select2', 'formValidate', 'datepicker', 'sweetalert', 'magnific-popup'],
            'get_script' => 'script_form'
		];

        if (!$this->input->post()) {
            $this->load->view('produk/add', $data);
        } else {
            $process = TRUE;
            $checking = TRUE;

            // Check Data
            $lower_data = trim(strtolower($this->input->post('nama_produk')));
            $param = [
                'field' => 'nama_produk',
                'table' => 'produk',
                'where' => [
                    'LOWER(nama_produk)' => $lower_data
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
                            'text' => 'Data produk '.$this->input->post('nama_produk').' sudah pernah disimpan.',
                            'type' => 'error'
                        ]
                    ];
                    $this->alert_popup($message);
                    redirect(base_url().'admin/produk/add','refresh');
                }
            }

            if ($checking == TRUE) {
                if ($this->input->post('insert')) {
                    $config['upload_path'] = 'assets/images/upload/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_name']  = "IMG-".date("Ymd").rand(1111,9999);

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('foto')) {
                        $upload = $this->upload->data();
                        $foto = $upload['file_name'];
                    } else {
                        $foto = NULL;
                    }

                    $param = [
                        'data' => [
                            'id_produk' => $this->admin_model->generate_code('P'),
                            'id_kategori' => decrypt_text($this->input->post('id_kategori')),
                            'id_sub_kategori' => decrypt_text($this->input->post('id_sub_kategori')),
                            'kode_sku' => $this->input->post('kode_sku'),
                            'nama_produk' => $this->input->post('nama_produk'),
                            'harga' => $this->input->post('harga'),
                            'foto' => $foto,
                            'stok' => $this->input->post('stok'),
                            'deskripsi' => $this->input->post('deskripsi'),
                            'created_datetime' => date('Y-m-d H:i:s')
                        ],
                        'table' => 'produk'
                    ];

                    if ($process == TRUE) {
                        $query = $this->admin_model->send_data($param);
                        if ($query == FALSE) {
                            $message = [
                                'name' => 'failed',
                                'swal' => [
                                    'title' => 'Failed!',
                                    'text' => 'Data produk '.$this->input->post('nama_produk').' gagal di edit.',
                                    'type' => 'error'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/produk/add','refresh');
                        } else {
                            $message = [
                                'name' => 'success',
                                'swal' => [
                                    'title' => 'Successfull!',
                                    'text' => 'Data produk '.$this->input->post('nama_produk').' telah berhasil di edit.',
                                    'type' => 'success'
                                ]
                            ];
                            $this->alert_popup($message);
                            redirect(base_url().'admin/produk','refresh');
                        }
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function edit($id)
	{
        $param_get_data = [
            'table' => 'produk',
            'where' => [
                'id_produk' => decrypt_text($id)
            ]
        ];

        $get_data = $this->admin_model->get_data($param_get_data)->row();

        // Check URL
        if (decrypt_text($id) != $get_data->id_produk) {
            $message = [
                'name' => 'failed',
                'swal' => [
                    'title' => 'Failed!',
                    'text' => 'Ada kesalahan teknis',
                    'type' => 'error'
                ]
            ];
            $this->alert_popup($message);
            redirect(base_url().'admin/produk','refresh');
        }

		$title = 'Tambah Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['select2', 'formValidate', 'datepicker', 'sweetalert', 'magnific-popup'],
            'get_script' => 'script_form',
            'get_data' => $get_data,
		];

        if (!$this->input->post()) {
            $this->load->view('produk/edit', $data);
        } else {
            $process = TRUE;

            if ($this->input->post('update')) {
                $config['upload_path'] = 'assets/images/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_name']  = "IMG-".date("Ymd").rand(1111,9999);

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto')) {
                    $upload_foto = $this->upload->data();
                    $foto = $upload_foto['file_name'];
                    if (!empty($this->input->post('foto_old'))) {
                        unlink('assets/images/upload/'.$this->input->post('foto_old'));
                    }
                } else {
                    if (!empty($this->input->post('foto_old'))) {
                        $foto = $this->input->post('foto_old');
                    } else {
                        $foto = NULL;
                        unlink('assets/images/upload/'.$get_data->foto);
                    }
                }

                $param = [
                    'where' => [
                        'id_produk' => decrypt_text($id),
                    ],
                    'data' => [
                        'id_kategori' => decrypt_text($this->input->post('id_kategori')),
                        'id_sub_kategori' => decrypt_text($this->input->post('id_sub_kategori')),
                        'kode_sku' => $this->input->post('kode_sku'),
                        'nama_produk' => $this->input->post('nama_produk'),
                        'harga' => $this->input->post('harga'),
                        'foto' => $foto,
                        'stok' => $this->input->post('stok'),
                        'deskripsi' => $this->input->post('deskripsi')
                    ],
                    'table' => 'produk'
                ];

                if ($process == TRUE) {
                    $query = $this->admin_model->send_data($param);
                    if ($query == FALSE) {
                        $message = [
                            'name' => 'failed',
                            'swal' => [
                                'title' => 'Failed!',
                                'text' => 'Data produk '.$this->input->post('nama_produk').' gagal di edit.',
                                'type' => 'error'
                            ]
                        ];
                        $this->alert_popup($message);
                        redirect(base_url().'admin/produk/edit/'.$id,'refresh');
                    } else {
                        $message = [
                            'name' => 'success',
                            'swal' => [
                                'title' => 'Successfull!',
                                'text' => 'Data produk '.$this->input->post('nama_produk').' telah berhasil di edit.',
                                'type' => 'success'
                            ]
                        ];
                        $this->alert_popup($message);
                        redirect(base_url().'admin/produk','refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

}