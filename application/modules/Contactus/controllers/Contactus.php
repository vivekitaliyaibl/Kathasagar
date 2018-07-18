<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->mdl_common->is_admin_logged_in(1);
		$this->load->model('Contactus_model', 'mdl_contactus');
	}

	/*show contactus*/
	public function index() {
		$data = array('main_content'=>'contactus',
			'page_title'=>'Contactus',
			'sub_title'=>'List',
			'contact_details' => $this->mdl_contactus->selectdb_row('tbl_contactus', array('is_delete' =>1)),
			'CSS' => array(
				'plugins/bower_components/summernote/dist/summernote.css',
			),
			'JS' => array(
				'assets/jquery.validate.js',
				'assets/jquery-ui.js',
				'assets/location_map.js',
				'plugins/bower_components/summernote/dist/summernote.min.js',
			),
		);	
		$this->load->view('admin_template/template',$data);
	}

	/*add edit contactus*/
	public function add_edit_contactus() {
		$id = $this->input->post('hide_id');
		$name = $this->input->post('name');
		$phone_number = $this->input->post('phone_number');
		$address = $this->input->post('address');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		if(empty($id)) {
			$get_random_id = get_random_string('tbl_contactus','id');
			$data = array(
				'id' => $get_random_id,
				'name' => $name,
				'address' => $address,
				'phone_number' => $phone_number,
				'lat' => $latitude,
				'lng' => $longitude,
				'create_at' => date('Y-m-d H:i:s'),
				'create_by' => $this->session->userdata('id'),
			);
			if($this->mdl_contactus->insertdb('tbl_contactus', $data)) {
				$where = array('id' => $get_random_id, 'is_delete' => 1);
				$arraydata = $this->mdl_contactus->selectdb_row('tbl_contactus', $where);
				$respons['key'] = '1';
				$respons['data'] = $arraydata;
			} else {
				
			}
		} else {

			$data = array(
				'name' => $name,
				'address' => $address,
				'phone_number' => $phone_number,
				'lat' => $latitude,
				'lng' => $longitude,
				'update_at' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);
			$where = array('id' => $id);
			if($this->mdl_contactus->update_db($where,'tbl_contactus', $data)) {
				$wheres = array('id' => $id, 'is_delete' => 1);
				$arraydata = $this->mdl_contactus->selectdb_row('tbl_contactus', $wheres);
				$respons['key'] = '2';
				//$respons['data'] = $arraydata;
			} else {
				echo "0";
			}
		}
		echo json_encode($respons);
	}
}