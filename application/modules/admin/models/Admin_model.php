<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->db->db_debug = FALSE;
	}

	public function generate_code($param)
	{
		$code_rand = rand(1111,9999);
		$generate = $param."-".date("Ymd").$code_rand;
		return $generate;
	}

	public function select_data($param)
	{
		$this->db->select($param['field']);
		$this->db->from($param['table']);
		if (!empty($param['where'])) {
			$this->db->where($param['where']);
		}
		return $this->db->get();
	}

	public function get_data($param)
	{
		if (!empty($param['where'])) {
			$this->db->where($param['where']);
		}
		if (!empty($param['order_by'])) {
			$this->db->order_by($param['order_by'], $param['order_type']);
		}
		
		return $this->db->get($param['table']);
	}

	public function send_data($param)
	{
		if (!empty($param['where'])) {
			try {
				$this->db->where($param['where']);
				return $this->db->update($param['table'], $param['data']);

				$db_error = $this->db->error();
				if (!empty($db_error)) {
					return FALSE;
				}
			} catch (Exception $e) {
				return FALSE;
			}
		} else {
			try {
				return $this->db->insert($param['table'], $param['data']);
				
				$db_error = $this->db->error();
				if (!empty($db_error)) {
					return FALSE;
				}
			} catch (Exception $e) {
				return FALSE;
			}
		}
	}

	public function delete_data($param)
	{
		try {
			$this->db->where($param['where']);
			return $this->db->delete($param['table']);

			$db_error = $this->db->error();
			if (!empty($db_error)) {
				return FALSE;
			}
		} catch (Exception $e) {
			return FALSE;
		}
	}

}

/* End of file Admin_model.php */