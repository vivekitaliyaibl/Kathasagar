<?php
Class Video_model extends CI_Model {
	Public function __construct() { 
		parent::__construct(); 
	}

	public function insertdb($tbl, $data) {
		$query = $this->db->insert($tbl,$data); 
		return $this->db->affected_rows();
	}

	public function selectResultdb() {
		$this->db->select('*');
		$this->db->from('tbl_videos');
		$this->db->where(array('is_delete' => 1));
		return $this->db->get()->result_array();
	}

	public function update_db($where, $table, $data) {
		$this->db->where($where)->update($table, $data);
		return $this->db->affected_rows();
	}

	public function selectdb_row($table, $where) {
		return $this->db->get_Where($table, $where)->result_array();
	}
}