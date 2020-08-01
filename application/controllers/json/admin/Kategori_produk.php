<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_produk extends MY_Controller {
	
	private $data = [];
	private $param = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_model');
	}

	public function list_kategori_produk()
	{
		if (!empty($_REQUEST['draw'])) {
			$draw = $_REQUEST['draw'];
		} else {
			$draw = 0;
		}

		$this->param['column_search'] = [
			'id_kategori','nama_kategori','created_datetime'
		];
		$this->param['column_order'] = [
			null,'nama_kategori',null
		];
		$this->param['field'] = 'produk_kategori.*';
		$this->param['table'] = 'produk_kategori';
		$this->param['order_by'] = [
			'nama_kategori' => 'asc'
		];

		$this->data['data_parsing'] = $this->json_model->get_datatable($this->param);
		$this->data['total_filtered'] = $this->json_model->get_total_filtered($this->param);
		$this->data['total_data'] = $this->json_model->get_total_data($this->param);

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

		$this->data['data_parsing'] = $this->json_model->select_data($this->param)->row();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_created = explode(' ', $this->data['data_parsing']->created_datetime);

				$get_data['id_kategori'] = $this->data['data_parsing']->id_kategori;
				$get_data['nama_kategori'] = $this->data['data_parsing']->nama_kategori;
				$get_data['created_date'] = $get_created[0];
				$get_data['created_time'] = $get_created[1];

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

		$this->data['data_parsing'] = $this->json_model->get_datatable($this->param);
		$this->data['total_filtered'] = $this->json_model->get_total_filtered($this->param);
		$this->data['total_data'] = $this->json_model->get_total_data($this->param);

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

		$this->data['data_parsing'] = $this->json_model->select_data($this->param)->row();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['id_sub_kategori'] = $this->data['data_parsing']->id_sub_kategori;
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