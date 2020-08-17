<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!empty($this->input->get('kategori'))) {
			if (!empty($this->input->get('sub_kategori'))) {
				$produk = $this->master_model->select_data([
					'field' => '*',
					'table' => 'produk',
					'where' => [
						'id_kategori' => decrypt_text(($this->input->get('kategori'))),
						'id_sub_kategori' => decrypt_text(($this->input->get('sub_kategori')))
					],
					'order_by' => [
						'nama_produk' => 'asc'
					]
				]);
			} else {
				$produk = $this->master_model->select_data([
					'field' => '*',
					'table' => 'produk',
					'where' => [
						'id_kategori' => decrypt_text(($this->input->get('kategori')))
					],
					'order_by' => [
						'nama_produk' => 'asc'
					]
				]);
			}
		} else {
			$produk = $this->master_model->select_data([
				'field' => '*',
				'table' => 'produk',
				'order_by' => [
					'nama_produk' => 'asc'
				]
			]);
		}

		$title = 'Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_produk',
			'get_script' => 'home/script_produk',
			'get_data' => [
				'produk' => $produk
			]
		];

		$this->master->template_home($data);
	}

	public function detail($id)
	{
		$get_data = $this->master_model->select_data([
			'field' => 'produk.*, produk_kategori.nama_kategori, produk_sub_kategori.nama_sub_kategori',
			'table' => 'produk',
			'join' => [
				[
					'table' => 'produk_kategori',
					'on' => 'produk_kategori.id_kategori = produk.id_kategori',
					'type' => 'inner'
				],
				[
					'table' => 'produk_sub_kategori',
					'on' => 'produk_sub_kategori.id_sub_kategori = produk.id_sub_kategori',
					'type' => 'inner'
				]
			],
			'where' => [
				'id_produk' => decrypt_text($id)
			]
		])->row();

		$title = 'Detail Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_detail_produk',
			'get_script' => 'home/script_detail_produk',
			'get_data' => $get_data
		];

		$this->master->template_home($data);
	}

}