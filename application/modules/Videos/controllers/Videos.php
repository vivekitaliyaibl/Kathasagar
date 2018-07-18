<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->mdl_common->is_admin_logged_in(1);
		$this->load->model('Video_model', 'mdl_video');
	}

	public function index() {
		$data = array('main_content'=>'videos',
			'page_title'=>'Videos',
			'sub_title'=>'List',
			'video_details' => $this->mdl_video->selectResultdb(),
			'CSS' => array('plugins/bower_components/custom-select/custom-select.css',
				'plugins/bower_components/bootstrap-select/bootstrap-select.min.css',
				'plugins/bower_components/sweetalert/sweetalert.css',
			),
			'JS' => array('assets/jquery.validate.js',
				'assets/jquery-ui.js',  
				'plugins/bower_components/custom-select/custom-select.min.js',
				'plugins/bower_components/sweetalert/sweetalert.min.js',
			),
		);	
		$this->load->view('admin_template/template',$data);
	}

	public function video_upload() {

		$id = $this->input->post('hide_video_id');
		if(empty($id)) {
			$get_random_id = get_random_string('tbl_videos','id');
			$link = $this->input->post('video_link');
			$cover_image = $this->input->post('videourlid');

			if(!file_exists("uploads/videos/orignal/")) {
				mkdir("uploads/videos/orignal/", 0777, true);
			}

			$iscapture = file_put_contents('uploads/videos/orignal/'.$cover_image.'_thumb'.'.jpg', file_get_contents('http://img.youtube.com/vi/'.$cover_image."/maxresdefault.jpg"));
			if($iscapture !== FALSE){
				$sourceimage = 'uploads/videos/orignal/'.$cover_image.'_thumb'.'.jpg';
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
				if(!is_dir('uploads/videos/'.$resize['width'].'_'.$resize['height'])) {
					mkdir('uploads/videos/'.$resize['width'].'_'.$resize['height'], 0777, true);
				}

				$config = array(
					'image_library' => 'gd2',
					'source_image' => $sourceimage,
					'create_thumb' => TRUE,
					'maintain_ratio' => TRUE,
					'width' => $resize['width'],
					'height' => $resize['height']
				);
				$config['new_image'] = 'uploads/videos/'.$resize['width'].'_'.$resize['height'].'/'.$cover_image.'.jpg';

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
					'video_link' => $link,
					'viedo_image' => $cover_image.'_thumb'.'.jpg',
					'create_at' => date('Y-m-d H:i:s'),
					'create_by' => $this->session->userdata('id'),
				);
				if($this->mdl_video->insertdb('tbl_videos', $data)) {
					$where = array('id' => $get_random_id, 'is_delete' => 1);
					$arraydata = $this->mdl_video->selectdb_row('tbl_videos', $where);
					$respons['key'] = '1';
					$respons['data'] = $arraydata;
				} 
			}
			echo json_encode($respons);
		} else {
		}
	}

	public function change_status() {
		$video_id = $this->input->post('video_id');
		$status = $this->input->post('status');

		$data = array(
			'status' => $status,
		);
		$where = array('id' => $video_id);
		if($this->mdl_video->update_db($where,'tbl_videos', $data)) { 
			$flag = '1';
		} else {
			$flag = '0';
		}
		$status = array('key' => $flag);
		echo json_encode($status);
	}

	public function video_delete() {
		$video_id = $this->input->post('id');
		$deleted_by = $this->session->userdata('id');

		$account_data = array (
			'is_delete' => '0',
			'delete_at'=>date('Y-m-d H:i:s'),
			'delete_by'=>$deleted_by
		);
		$where = array('id' => $video_id);
		if($this->mdl_video->update_db($where,'tbl_videos', $account_data)) { 
			$flag = '1';
		} else {
			$flag = '0';
		}
		$deldata = array('key' => $flag);
		echo json_encode($deldata);
	}
}
