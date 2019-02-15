<?php

class MY_Controller extends CI_Controller {
	protected $_layout;
	public $post_data;
	public $get_data;
	public $data;
	public $user;
	public $site_option;
	public function __construct(){
		parent::__construct();
	// Get error or notification
		$this->data['error'] = $this->session->flashdata('error');
		$this->data['noti_success'] = $this->session->flashdata('noti_success');
	//Force login
		// var_dump($this->session->userdata('user'));die;
		if(!$this->session->userdata('user')){
			$class = $this->router->fetch_class();
			$method = $this->router->fetch_method();
			if($class != 'user' || $method != 'login'){
				refresh_error('error','Cần Phải Đăng Nhập','/admin/user/login');
				exit;
			}
		}else{
			
			$this->load->library('auth');
		}
		// 
		$this->user = $this->session->userdata('user');
		$this->_layout = 'admin/master/master';
		$this->post_data = $this->input->post();
		$this->get_data = $this->input->get();
		$this->data['site_option'] = $this->db->get('site_option')->result();
		foreach($this->data['site_option'] as $k => $v){
			unset($this->data['site_option'][$k]);
			$this->data['site_option'][$v->field_key] = $v->val;
		}
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
	}
}