<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->db->db_debug = FALSE;
	}

	public function count_data()
	{
		return [
			'produk_kategori' => $this->db->count_all_results('produk_kategori'),
			'produk' => $this->db->count_all_results('produk')
		];
	}

}