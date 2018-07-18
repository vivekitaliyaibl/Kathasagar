<?php
Class Contactus_model extends CI_Model {
	Public function __construct() { 
		parent::__construct(); 
	}
	public function insertdb($tbl, $data) {
		$query = $this->db->insert($tbl,$data); 
		return $this->db->affected_rows();
	}
	Public function slectdb($tbl, $where){
		$this->db->select('*')->from($tbl)->where($where);
		return $this->db->get()->result_array();
	}

	public function update_db($where, $table, $data) {
		$this->db->where($where)->update($table, $data);
		return $this->db->affected_rows();
	}
	
	public function selectdb_row($table, $where) {
		return $this->db->get_Where($table, $where)->row_array();
	}
}