<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->mdl_common->is_admin_logged_in(1);
		$this->load->model('Advertisement_model', 'mdl_advertisement');
	}

	/*show contactus*/
	public function index() {
		$data = array('main_content'=>'advertisement',
			'page_title'=>'Advertisement',
			'sub_title'=>'List',
			'advertise_details' => $this->mdl_advertisement->selectdb_row('tbl_advertisement', array('is_delete' =>1)),
			'CSS' => array(
				'plugins/bower_components/summernote/dist/summernote.css',
				'plugins/bower_components/cropper/cropper.min.css',
				'plugins/bower_components/sweetalert/sweetalert.css',
			),
			'JS' => array(
				'assets/jquery.validate.js',
				'assets/jquery-ui.js',
				'plugins/bower_components/summernote/dist/summernote.min.js',
				'plugins/bower_components/cropper/cropper.min.js',
				'plugins/bower_components/sweetalert/sweetalert.min.js',
			),
		);	
		$this->load->view('admin_template/template',$data);
	}

	/*advertisement upload*/
	public function advertisement_upload() {
		$id = $this->input->post('hide_id');
		$imagedata = $_POST['imageData'];
		$imagedata = str_replace('data:image/png;base64,', '', $imagedata);
		$imagedata = str_replace(' ', '+', $imagedata);
		$data = base64_decode($imagedata);
		
		if(empty($id)) {
			$get_random_id = get_random_string('tbl_advertisement','id');
			$filename = $get_random_id .'_'. time();

			if(!file_exists("uploads/valamadvertisement/orignal/")) {
				mkdir("uploads/valamadvertisement/orignal/", 0777, true);
			}
			$event_img = file_put_contents('uploads/valamadvertisement/orignal/'.$filename .'_thumb.png', $data);

			if($event_img !== FALSE){
				$sourceimage = 'uploads/valamadvertisement/orignal/'.$filename.'_thumb.png';
			}

			$thumbimagegroup = array(
				'0'=>array('width'=>120, 'height'=>90),
				'1'=>array('width'=>320, 'height'=>180),
				'2'=>array('width'=>480, 'height'=>360),
				'3'=>array('width'=>640, 'height'=>480),
				'4'=>array('width'=>1280, 'height'=>720),
				'5'=>array('width'=>1920, 'height'=>1080),
			);

			$cnt = 0;
			foreach($thumbimagegroup as $resize) {
				if(!is_dir('uploads/valamadvertisement/'.$resize['width'].'_'.$resize['height'])) {
					mkdir('uploads/valamadvertisement/'.$resize['width'].'_'.$resize['height'], 0777, true);
				}

				$config = array(
					'image_library' => 'gd2',
					'source_image' => $sourceimage,
					'create_thumb' => TRUE,
					'maintain_ratio' => TRUE,
					'width' => $resize['width'],
					'height' => $resize['height']
				);
				$config['new_image'] = 'uploads/valamadvertisement/'.$resize['width'].'_'.$resize['height'].'/'.$filename.'.png';

				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				if(!$this->image_lib->resize()){ 
					echo $this->image_lib->display_errors();
				} 
				$this->image_lib->clear();
				$cnt++;
			}
			if($cnt > 0) {
				$data = array(
					'id' => $get_random_id,
					'advertise_image' => $filename.'_thumb.png',
					'create_at' => date('Y-m-d H:i:s'),
					'create_by' => $this->session->userdata('id'),
				);
				if($this->mdl_advertisement->insertdb('tbl_advertisement', $data)) {
					$where = array('id' => $get_random_id, 'is_delete' => 1);
					$arraydata = $this->mdl_advertisement->selectdb_row('tbl_advertisement', $where);
					$respons['key'] = '1';
					$respons['data'] = $arraydata;
				}
			}
		}else {
		}
		echo json_encode($respons);
	}


	public function change_status() {
		$advertise_id = $this->input->post('advertise_id');
		$status = $this->input->post('status');

		$data = array(
			'status' => $status,
		);
		$where = array('id' => $advertise_id);
		if($this->mdl_advertisement->update_db($where,'tbl_advertisement', $data)) { 
			$flag = '1';
		} else {
			$flag = '0';
		}
		$status = array('key' => $flag);
		echo json_encode($status);
	}

	public function advertisement_delete() {
		$advertise_id = $this->input->post('id');
		$deleted_by = $this->session->userdata('id');
		$account_data = array (
			'is_delete' => '0',
			'delete_at'=>date('Y-m-d H:i:s'),
			'delete_by'=>$deleted_by
		);
		$where = array('id' => $advertise_id);
		if($this->mdl_advertisement->update_db($where,'tbl_advertisement', $account_data)) { 
			$flag = '1';
		} else {
			$flag = '0';
		}
		$deldata = array('key' => $flag);
		echo json_encode($deldata);
	}
}