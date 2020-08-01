<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->db->db_debug = FALSE;
	}

	public function query_datatable($param)
	{
		$column_order = $param['column_order'];

		$this->db->select($param['field']);
		$this->db->from($param['table']);

		$i = 0;
		foreach ($param['column_search'] as $item) {
			if (!empty($_REQUEST['search']['value'])) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_REQUEST['search']['value']);
				} else {
					$this->db->or_like($item, $_REQUEST['search']['value']);
				}

				if (count($param['column_search']) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (!empty($param['join'])) {
			for ($i=0; $i < count($param['join']); $i++) {
				$this->db->join($param['join'][$i]['table'], $param['join'][$i]['on'], $param['join'][$i]['type']);
			}
		}
		if (!empty($param['where'])) {
			$this->db->where($param['where']);
		}
		if (!empty($_REQUEST['order'])) {
			$this->db->order_by($column_order[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		}
		if (!empty($param['order_by'])) {
			$this->db->order_by(key($param['order_by']), $param['order_by'][key($param['order_by'])]);
		}
	}

	public function get_datatable($param)
	{
		$this->query_datatable($param);
		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_filtered($param)
	{
		$this->query_datatable($param);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_total_data($param)
	{
		$this->db->from($param['table']);
		return $this->db->count_all_results();
	}

	public function get_data($param)
	{
		if (!empty($param['where'])) {
			$this->db->where($param['where']);
		}
		if (!empty($param['order_by'])) {
			$this->db->order_by(key($param['order_by']), $param['order_by'][key($param['order_by'])]);
		}
		
		return $this->db->get($param['table']);
	}

	public function select_data($param)
	{
		try {
			$this->db->select($param['field']);
			$this->db->from($param['table']);
			if (!empty($param['join'])) {
				for ($i=0; $i < count($param['join']); $i++) {
					$this->db->join($param['join'][$i]['table'], $param['join'][$i]['on'], $param['join'][$i]['type']);
				}
			}
			if (!empty($param['where'])) {
				$this->db->where($param['where']);
			}
			if (!empty($param['order_by'])) {
				$this->db->order_by(key($param['order_by']), $param['order_by'][key($param['order_by'])]);
			}

			return $this->db->get();

			$db_error = $this->db->error();
			if (!empty($db_error)) {
				return FALSE;
			}
		} catch (Exception $e) {
			return FALSE;
		}
	}

	public function generate_code($param)
	{
		$code_rand = rand(1111,9999);
		$generate = $param."-".date("Ymd").$code_rand;
		return $generate;
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

}

/* End of file Json_model.php */