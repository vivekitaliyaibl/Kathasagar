<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->mdl_common->is_admin_logged_in(1);
		$this->load->model('Aboutus_model', 'mdl_aboutus');
	}

	public function index() {
		$data = array('main_content'=>'aboutus',
			'page_title'=>'Aboutus',
			'sub_title'=>'List',
			'notes_details' => $this->mdl_aboutus->slectdb('tbl_aboutus', array('is_delete' =>1)),
			'CSS' => array(
				'plugins/bower_components/summernote/dist/summernote.css',
				'plugins/bower_components/sweetalert/sweetalert.css',
			),
			'JS' => array(
				'assets/jquery.validate.js',
				'assets/jquery-ui.js',
				'plugins/bower_components/summernote/dist/summernote.min.js',
				'plugins/bower_components/sweetalert/sweetalert.min.js',
			),
		);	
		$this->load->view('admin_template/template',$data);
	}

	public function add_edit_notes() {
		$id = $this->input->post('hide_id');
		$notes = $this->input->post('about_us_notes');
		if(empty($id)) {
			$get_random_id = get_random_string('tbl_aboutus','id');
			$data = array(
				'id' => $get_random_id,
				'notes' => $notes,
				'create_at' => date('Y-m-d H:i:s'),
				'create_by' => $this->session->userdata('id'),
			);
			if($this->mdl_aboutus->insertdb('tbl_aboutus', $data)) {
				$where = array('id' => $get_random_id, 'is_delete' => 1);
				$arraydata = $this->mdl_aboutus->selectdb_row('tbl_aboutus', $where);
				$respons['key'] = '1';
				$respons['data'] = $arraydata;
			} else {
				
			}
		} else {

			$data = array(
				'notes' => $notes,
				'update_at' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);
			$where = array('id' => $id);
			if($this->mdl_aboutus->update_db($where,'tbl_aboutus', $data)) {
				$wheres = array('id' => $id, 'is_delete' => 1);
				$arraydata = $this->mdl_aboutus->selectdb_row('tbl_aboutus', $wheres);
				$respons['key'] = '2';
				$respons['data'] = $arraydata;
			} else {
				echo "0";
			}
		}
		echo json_encode($respons);
	} 

	public function change_status() {
		$notes_id = $this->input->post('notes_id');
		$status = $this->input->post('status');

		$data = array(
			'status' => $status,
		);
		$where = array('id' => $notes_id);
		if($this->mdl_aboutus->update_db($where,'tbl_aboutus', $data)) { 
			$flag = '1';
		} else {
			$flag = '0';
		}
		$status = array('key' => $flag);
		echo json_encode($status);
	}

	public function delete_notes() {
		$id = $this->input->post('id');
		$deleted_by = $this->session->userdata('id');

		$data = array (
			'is_delete' => '0',
			'delete_at'=>date('Y-m-d H:i:s'),
			'delete_by'=>$deleted_by
		);
		$where = array('id' => $id);
		if($this->mdl_aboutus->update_db($where,'tbl_aboutus', $data)) { 
			$flag = '1';
		} else {
			$flag = '0';
		}
		$deldata = array('key' => $flag);
		echo json_encode($deldata);
	}
}