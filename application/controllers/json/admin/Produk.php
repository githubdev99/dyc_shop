<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends MY_Controller {
	
	private $data = [];
	private $param = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_model');
	}

	public function list_produk()
	{
		if (!empty($_REQUEST['draw'])) {
			$draw = $_REQUEST['draw'];
		} else {
			$draw = 0;
		}

		$this->param['column_search'] = [
			'id_produk','nama_kategori','nama_sub_kategori','kode_sku','nama_produk','harga','stok','deskripsi'
		];
		$this->param['column_order'] = [
			null,null,'nama_produk','nama_kategori','harga','stok',null
		];
		$this->param['field'] = 'produk.*, produk_kategori.nama_kategori, produk_sub_kategori.nama_sub_kategori';
        $this->param['table'] = 'produk';
        
        $this->param['join'][0]['table'] = 'produk_kategori';
		$this->param['join'][0]['on'] = 'produk_kategori.id_kategori = produk.id_kategori';
        $this->param['join'][0]['type'] = 'inner';
        
        $this->param['join'][1]['table'] = 'produk_sub_kategori';
		$this->param['join'][1]['on'] = 'produk_sub_kategori.id_sub_kategori = produk.id_sub_kategori';
		$this->param['join'][1]['type'] = 'inner';
        
		$this->param['order_by'] = [
			'nama_produk' => 'asc'
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
                
                if ($key->foto != NULL) {
					$url_foto = base_url().'assets/images/upload/'.$key->foto;
				} else {
					$url_foto = base_url().'assets/images/img-thumbnail.svg';
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
                    Kode SKU : '.$key->kode_sku.'<br>
                    '.date_indo($get_created[0]).' '.$get_created[1].'
                </span>';
                $nested_data[] = $key->nama_kategori.' -> '.$key->nama_sub_kategori;
                $nested_data[] = rupiah($key->harga);
                $nested_data[] = $key->stok;
				$nested_data[] = '
				<a href="'.base_url().'admin/produk/detail/'.encrypt_text($key->id_produk).'" class="btn btn-info waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Detail Data">
					<i class="fas fa-info"></i>
				</a>
				<a href="'.base_url().'admin/produk/edit/'.encrypt_text($key->id_produk).'" class="btn btn-success waves-effect waves-light mt-2 mr-2 mb-2" data-toggle="tooltip" data-placement="top" title="Edit Data">
					<i class="fas fa-edit"></i>
				</a>
				<a href="javascript:;" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="modal_delete('."'".encrypt_text($key->id_produk)."'".')"><i class="far fa-trash-alt"></i>
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

		$this->data['data_parsing'] = $this->json_model->select_data($this->param)->row();

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

	public function option_kategori()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'produk_kategori';
		$this->param['order_by'] = [
			'nama_kategori' => 'asc'
		];

		$this->data['data_parsing'] = $this->json_model->select_data($this->param)->result();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['html'] = '<option value=""></option>';
				foreach ($this->data['data_parsing'] as $key) {
					$selected = (decrypt_text($this->input->post('id_kategori')) == $key->id_kategori) ? 'selected' : '';

					$get_data['html'] .= '
					<option value="'.encrypt_text($key->id_kategori).'" '.$selected.'>'.$key->nama_kategori.'</option>
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

	public function option_sub_kategori()
	{
		$this->param['field'] = '*';
		$this->param['table'] = 'produk_sub_kategori';
		$this->param['where'] = [
			'id_kategori' => decrypt_text($this->input->post('id_kategori'))
		];
		$this->param['order_by'] = [
			'nama_sub_kategori' => 'asc'
		];

		$this->data['data_parsing'] = $this->json_model->select_data($this->param)->result();

		if (!empty($this->data['data_parsing'])) {
			$get_data = [];
			if ($this->data['data_parsing'] == FALSE) {
				$this->data['output'] = [
					'error' => true,
					'data' => $get_data
				];
			} else {
				$get_data['html'] = '<option value=""></option>';
				foreach ($this->data['data_parsing'] as $key) {
					$selected = (decrypt_text($this->input->post('id_sub_kategori')) == $key->id_sub_kategori) ? 'selected' : '';

					$get_data['html'] .= '
					<option value="'.encrypt_text($key->id_sub_kategori).'" '.$selected.'>'.$key->nama_sub_kategori.'</option>
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