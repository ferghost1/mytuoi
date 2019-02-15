<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller{
	public $controller = '/admin/ajax';
	public function __construct(){
		parent::__construct();
		$this->data['controller'] = $this->controller;
		$this->load->model('admin/order/order_model');
	}

	public function delete_all_order(){
		if(empty($this->post_data['arr_delete']) || !is_array($this->post_data['arr_delete']))
			die(json_encode(['error','Không Đủ Dữ Liệu']));
		foreach($this->post_data['arr_delete'] as $value){
			if(!$this->order_model->delete($value))
				die(json_encode(['error','Có Lỗi']));
		}
		die(json_encode(['success','Xóa Thành Công']));
	}
}
