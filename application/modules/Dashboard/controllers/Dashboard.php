<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this->mdl_common->is_admin_logged_in(1);
	}

	public function index() {
		$sucess_msg=$this->session->flashdata('success_msg');
		$error_msg="No Data Found";
		$error_msg=$this->session->flashdata('error_msg');

		$data = array('main_content'=>'dashboard',
			'page_title'=>'Dashboard',
			'sub_title'=>'List',
			'sucess_msg'=>$sucess_msg,
			'error_msg'=>$error_msg,
			'CSS'=>array()
		);	
		$this->load->view('admin_template/template',$data);
	}
}
