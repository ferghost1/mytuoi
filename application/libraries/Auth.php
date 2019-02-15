<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
	public $arr_user;
	public function __construct(){
	//Array store all privilege of all level user
		$this->arr_user = array(
			1 => array(
				'user_type' => 'Admin',
				'welcome' => ['*'],
				'option' => ['*'],
 				'user' => ['*'],
				'cate_product' => ['*'],
				'ajax' => ['*'],
				'customer' => ['*'],
				'order' => ['*'],
				'product' => ['*'],
				'test' => ['*'],
			),
			2 => array(
				'user_type' => 'Quản Lý',
				'welcome' => ['*'],
				'user' => ['*'],
				'cate_product' => ['*'],
				'ajax' => ['*'],
				'customer' => ['*'],
				'order' => ['*'],
				'product' => ['*'],
				'user' => ['*'],
			),
			3 => array(
				'user_type' => 'Nhân Viên',
				'welcome' => ['*'],
				'cate_product' => ['*'],
				'ajax' => ['*'],
				'customer' => ['*'],
				'order' => ['*'],
				'product' => ['*'],
				'user' => ['logout'],
			)
		);
	
		$this->check_privil();
	}

//Check if curent user has privilege to access controler
	public function check_privil(){
		$CI =& get_instance();
		$current_arr = $this->arr_user[$CI->session->userdata('user')->level];
		$class = $CI->router->fetch_class();
		$method = $CI->router->fetch_method();
		if(!array_key_exists($class, $current_arr)){
			redirect('admin/user/logout');
		}
	//* is full privil
		if(!in_array('*', $current_arr[$class]) && !in_array($method, $current_arr[$class])){
			redirect('admin/user/logout');
		}
	}
}