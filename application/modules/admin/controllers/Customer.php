<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MY_Controller {

    private $data = [];
	private $param = [];

	public function __construct()
	{
        parent::__construct();
        $this->not_login_admin();
	}

	public function index()
	{
		$title = 'Customer';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['datatable', 'sweetalert', 'magnific-popup'],
            'get_view' => 'admin/customer/view',
            'get_script' => 'admin/customer/script_view'
		];

        if (!$this->input->post()) {
            $this->master->template_admin($data);
        } else {
            $process = TRUE;

            if ($this->input->post('delete')) {
                if ($process == TRUE) {
                    $query = $this->master_model->delete_data([
                        'where' => [
                            'id_customer' => decrypt_text($this->input->post('id_customer'))
                        ],
                        'table' => 'customer'
                    ]);
                    if ($query == FALSE) {
                        $this->alert_popup([
                            'name' => 'failed',
                            'swal' => [
                                'text' => 'Data customer '.$this->input->post('username').' gagal di hapus.',
                                'type' => 'error'
                            ]
                        ]);
                        redirect(base_url().'admin/customer','refresh');
                    } else {
                        $this->alert_popup([
                            'name' => 'success',
                            'swal' => [
                                'text' => 'Data customer '.$this->input->post('username').' berhasil di hapus.',
                                'type' => 'success'
                            ]
                        ]);
                        redirect(base_url().'admin/customer','refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function add()
	{
		$title = 'Tambah Customer';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['select2', 'formValidate', 'datepicker', 'sweetalert', 'magnific-popup'],
            'get_view' => 'admin/customer/add',
            'get_script' => 'admin/customer/script_form'
		];

        if (!$this->input->post()) {
            $this->master->template_admin($data);
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
                    $this->alert_popup([
                        'name' => 'failed',
                        'swal' => [
                            'text' => 'Data customer '.$this->input->post('username').' sudah pernah disimpan.',
                            'type' => 'error'
                        ]
                    ]);
                    redirect(base_url().'admin/customer/add','refresh');
                }
            }

            if ($checking == TRUE) {
                if ($this->input->post('insert')) {
                    if ($process == TRUE) {
                        $query = $this->master_model->send_data([
                            'data' => [
                                'id_customer' => $this->master_model->generate_code('C'),
                                'username' => $this->input->post('username'),
                                'password' => $this->input->post('password'),
                                'nama_lengkap' => $this->input->post('nama_lengkap'),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                                'email' => $this->input->post('email'),
                                'no_telp' => $this->input->post('no_telp'),
                                'alamat' => $this->input->post('alamat')
                            ],
                            'table' => 'customer'
                        ]);
                        if ($query == FALSE) {
                            $this->alert_popup([
                                'name' => 'failed',
                                'swal' => [
                                    'text' => 'Data customer '.$this->input->post('username').' gagal ditambahkan.',
                                    'type' => 'error'
                                ]
                            ]);
                            redirect(base_url().'admin/customer/add','refresh');
                        } else {
                            $this->alert_popup([
                                'name' => 'success',
                                'swal' => [
                                    'text' => 'Data customer '.$this->input->post('username').' telah berhasil ditambahkan.',
                                    'type' => 'success'
                                ]
                            ]);
                            redirect(base_url().'admin/customer','refresh');
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
        $get_data = $this->master_model->get_data([
            'table' => 'customer',
            'where' => [
                'id_customer' => decrypt_text($id)
            ]
        ])->row();

        // Check URL
        if (decrypt_text($id) != $get_data->id_customer) {
            $this->alert_popup([
                'name' => 'failed',
                'swal' => [
                    'text' => 'Ada kesalahan teknis',
                    'type' => 'error'
                ]
            ]);
            redirect(base_url().'admin/customer','refresh');
        }

		$title = 'Edit Customer';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['select2', 'formValidate', 'datepicker', 'sweetalert', 'magnific-popup'],
            'get_view' => 'admin/customer/edit',
            'get_script' => 'admin/customer/script_form',
            'get_data' => $get_data,
		];

        if (!$this->input->post()) {
            $this->master->template_admin($data);
        } else {
            $process = TRUE;

            if ($this->input->post('update')) {
                if ($process == TRUE) {
                    $query = $this->master_model->send_data([
                        'where' => [
                            'id_customer' => decrypt_text($id),
                        ],
                        'data' => [
                            'username' => $this->input->post('username'),
                            'nama_lengkap' => $this->input->post('nama_lengkap'),
                            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                            'email' => $this->input->post('email'),
                            'no_telp' => $this->input->post('no_telp'),
                            'alamat' => $this->input->post('alamat')
                        ],
                        'table' => 'customer'
                    ]);
                    if ($query == FALSE) {
                        $this->alert_popup([
                            'name' => 'failed',
                            'swal' => [
                                'text' => 'Data customer '.$this->input->post('username').' gagal di edit.',
                                'type' => 'error'
                            ]
                        ]);
                        redirect(base_url().'admin/customer/edit/'.$id,'refresh');
                    } else {
                        $this->alert_popup([
                            'name' => 'success',
                            'swal' => [
                                'text' => 'Data customer '.$this->input->post('username').' telah berhasil di edit.',
                                'type' => 'success'
                            ]
                        ]);
                        redirect(base_url().'admin/customer','refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function detail($id)
	{
        $get_data = $this->master_model->get_data([
            'table' => 'customer',
            'where' => [
                'id_customer' => decrypt_text($id)
            ]
        ])->row();

        // Check URL
        if (decrypt_text($id) != $get_data->id_customer) {
            $this->alert_popup([
                'name' => 'failed',
                'swal' => [
                    'text' => 'Ada kesalahan teknis',
                    'type' => 'error'
                ]
            ]);
            redirect(base_url().'admin/customer','refresh');
        }

		$title = 'Detail Customer';
		$data = [
			'setup_app' => $this->setup_app($title),
            'plugin' => ['sweetalert'],
            'get_view' => 'admin/customer/detail',
            'get_script' => 'admin/customer/script_detail',
            'get_data' => $get_data,
		];

        if (!$this->input->post()) {
            $this->master->template_admin($data);
        } else {
            $process = TRUE;

            if ($this->input->post('delete')) {
                if ($process == TRUE) {
                    $query = $this->master_model->delete_data([
                        'where' => [
                            'id_customer' => decrypt_text($this->input->post('id_customer'))
                        ],
                        'table' => 'customer'
                    ]);
                    if ($query == FALSE) {
                        $this->alert_popup([
                            'name' => 'failed',
                            'swal' => [
                                'text' => 'Data customer '.$this->input->post('username').' gagal di hapus.',
                                'type' => 'error'
                            ]
                        ]);
                        redirect(base_url().'admin/customer','refresh');
                    } else {
                        $this->alert_popup([
                            'name' => 'success',
                            'swal' => [
                                'text' => 'Data customer '.$this->input->post('username').' berhasil di hapus.',
                                'type' => 'success'
                            ]
                        ]);
                        redirect(base_url().'admin/customer','refresh');
                    }
                }
            } else {
                $process = FALSE;
            }
        }
    }

    public function list_customer()
	{
		if (!empty($_REQUEST['draw'])) {
			$draw = $_REQUEST['draw'];
		} else {
			$draw = 0;
		}

		$this->param['column_search'] = [
			'username','nama_lengkap','jenis_kelamin','email','no_telp','alamat'
		];
		$this->param['column_order'] = [
			null,'nama_lengkap','username','jenis_kelamin','email',null
		];
		$this->param['field'] = 'customer.*';
        $this->param['table'] = 'customer';
        
		$this->param['order_by'] = [
			'nama_lengkap' => 'asc'
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
				<a href="'.base_url().'admin/customer/detail/'.encrypt_text($key->id_customer).'">
					'.$key->nama_lengkap.'
				</a>';
                $nested_data[] = $key->username;
                $nested_data[] = $key->jenis_kelamin;
                $nested_data[] = $key->email;
				$nested_data[] = '
				<a href="'.base_url().'admin/customer/detail/'.encrypt_text($key->id_customer).'" class="btn btn-info waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Detail Data">
					<i class="fas fa-info"></i>
                </a>
				<a href="'.base_url().'admin/customer/edit/'.encrypt_text($key->id_customer).'" class="btn btn-success waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Edit Data">
					<i class="fas fa-edit"></i>
				</a>
                <a href="javascript:;" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="modal_delete('."'".encrypt_text($key->id_customer)."'".')">
                    <i class="far fa-trash-alt"></i>
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

	public function get_customer()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'customer';
		$this->param['where'] = [
			'id_customer' => decrypt_text($this->input->post('id'))
		];
		$this->param['order_by'] = [
			'nama_lengkap' => 'asc'
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
				$get_data['id_customer'] = encrypt_text($this->data['data_parsing']->id_customer);
				$get_data['username'] = $this->data['data_parsing']->username;

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

}