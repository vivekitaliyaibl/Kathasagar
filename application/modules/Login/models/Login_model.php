<?php
Class Login_model extends CI_Model {

  Public function __construct() { 
    parent::__construct(); 
  } 

  public function getLoginUser($email,$pass) {
    $data_array=array('email' => $email,
      'password' => md5($pass),
    );
    $query = $this->db->get_where('tbl_admin',$data_array);
    return $query->row();
  }
  public function updatedb($id, $table, $data) {
    $this->db->where($id);
    $this->db->update($table, $data);
    return $this->db->affected_rows();
  }
}