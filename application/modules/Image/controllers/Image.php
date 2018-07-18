<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->mdl_common->is_admin_logged_in(1);
	}

	public function index() {
		$data = array('main_content'=>'image',
			'page_title'=>'Image',
			'sub_title'=>'List',
			'sucess_msg'=>$sucess_msg,
			'error_msg'=>$error_msg,
			'CSS' => array('plugins/bower_components/cropper/cropper.min.css'),
			'JS' => array('plugins/bower_components/cropper/cropper.min.js',
				// 'plugins/bower_components/cropper/cropper-init.js',
				'assets/jquery.validate.js',
				'assets/jquery-ui.js'
			),
		);	
		$this->load->view('admin_template/template',$data);
	}
}
