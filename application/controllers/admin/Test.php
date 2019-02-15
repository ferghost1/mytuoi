<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller{
	public $controller = '/admin/test';
	public function __construct(){
		parent::__construct();
		$this->data['controller'] = $this->controller;
		// $this->data['js_script']  = 'admin/customer/customer_script';
 		// $this->load->model('admin/user/user_model','model');
 		
	}
	public function index(){
		if(isset($this->post_data['submit_btn'])){
			$this->form_validation->set_rules('test','Test field','unique_except[customer||email||xxaaaaa@hotmail.com]');
			$this->form_validation->run();
		}
		$this->data['main'] = "{$this->controller}/test_view";
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}

	// public function test_validate($str){
	// 	die('zo'.$str);
	// }
}