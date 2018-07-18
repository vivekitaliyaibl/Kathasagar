<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Login_model','mdl_login');
	}

	public function index() {
		if($this->session->userdata('logged_in')!="") {
			redirect('dashboard');
		} else {
			$error_msg=$this->session->flashdata('error_msg');
			$data=array('error_msg'=>$error_msg);
			$this->load->view('login',$data);    
		}
	}

	public function check_login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$data = $this->mdl_login->getLoginUser($email,$password);
		if($data){
			$sess_data = array( 
				'email'     => $data->email,
				'name'  => $data->admin_name,
				'id'   => $data->id,
				'logged_in' => 1,
			);
			$this->session->set_userdata($sess_data);
			redirect('dashboard');
		} else {
			$data=array('err_in_login' => 1);
			$this->load->view('login',$data);
		}
	}


	public function change_password() {
		if($this->input->is_ajax_request()){
			$password = $this->input->post('password');
			$id =  $this->session->userdata('id');
			$data = array(
				'password' => md5($password),
			);
			$res = $this->mdl_login->updatedb('id = "'.$id.'"', 'tbl_admin', $data);
			if($res > 0) {
				$flag = "1";
			} else {
				$flag = "0";
			}
			$response = array("key" => $flag);
			echo json_encode($response);
			exit(0);
		} else {
			$data = array(
				'main_content' => 'change_password',
				'page_title' => 'Users',
				'sub_title' => 'Password change',
				'action'=>'view',
				'JS' => array('plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js',
					'plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js',)
			);
			$this->load->view('admin_template/template',$data);
		}
	}
	
	public function logout() {
		$str = $this->uri->segment(2);
		$this->session->unset_userdata('email'); 
		$this->session->unset_userdata('logged_in'); 
		$this->session->unset_userdata('user_id'); 
		if(!empty($str)) {
			$this->session->set_flashdata('success_msg','Password change successfully, Now you are with new password...!');
		}
		redirect(site_url('login'));
	}
}	
