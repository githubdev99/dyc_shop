<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json_admin extends MY_Controller {
	
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
			null,'nama_kategori',null,null
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

				if ($key->icon != NULL) {
					$url_icon = base_url().'assets/images/upload/kategori_produk/'.$key->icon;
				} else {
					$url_icon = base_url().'assets/images/img-thumbnail.svg';
				}

				$nested_data[] = $no;
				$nested_data[] = '
				<a href="javascript:;" onclick="modal_edit('."'".$key->id_kategori."'".')">
					'.$key->nama_kategori.'
				</a><br>
				<span class="text-muted">
					'.date_indo($get_created[0]).' '.$get_created[1].'
				</span>';
				$nested_data[] = '
				<a class="image-popup" href="'.$url_icon.'">
					<img class="img-thumbnail" width="100" src="'.$url_icon.'" data-holder-rendered="true">
				</a>';
				$nested_data[] = '
				<a href="javascript:;" class="btn btn-success waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Edit Data" onclick="modal_edit('."'".$key->id_kategori."'".')">
					<i class="fas fa-edit"></i>
				</a>
				<a href="javascript:;" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="modal_delete('."'".$key->id_kategori."'".')"><i class="far fa-trash-alt"></i>
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

		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

	public function get_kategori_produk()
	{
		$this->param['field'] = 'produk_kategori.*';
		$this->param['table'] = 'produk_kategori';
		$this->param['where'] = array(
			'produk_kategori.id_kategori' => $this->input->post('id')
		);
		$this->param['order_by'] = [
			'nama_kategori' => 'asc'
		];

		$this->data['data_parsing'] = $this->json_model->select_data($this->param)->result();

		$get_data = [];
		if (!empty($this->data['data_parsing'])) {
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				foreach ($this->data['data_parsing'] as $key) {
					$nested_data = [];

					$get_created = explode(' ', $key->created_datetime);
	
					$nested_data['id_kategori'] = $key->id_kategori;
					$nested_data['nama_kategori'] = $key->nama_kategori;
					$nested_data['icon'] = $key->icon;
					$nested_data['created_date'] = $get_created[0];
					$nested_data['created_time'] = $get_created[1];
	
					$get_data[] = $nested_data;
				}

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

}

/* End of file Json_admin.php */