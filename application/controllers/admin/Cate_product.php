<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cate_product extends MY_Controller{
	private $controller = '/admin/cate_product';
	public function __construct(){
		parent::__construct();
		$this->data['controller'] = $this->controller;
		$this->data['js_script']  = 'admin/cate_product/cate_script';
 		$this->load->model('admin/cate_product/cate_model');
	}

	public function index()
	{
		$this->data['all_items'] = $this->cate_model->get_all();
		$this->data['main'] = 'admin/cate_product/cate_view';
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}
	public function create()
	{
		if(!isset($_POST['submit_add']))
			redirect($this->controller);
		$this->form_validation->set_rules('cate_name','Category Name','required|max_length[60]');
		if($this->form_validation->run()){
			$res = $this->cate_model->create();
			if(!$res)
				$this->data['error'] = 'Không Thể Tạo';
			else
				$this->data['noti_success'] = 'Tạo Thành Công';
		}
		$this->index();
	}

	public function ajax_edit(){
		if(!isset($this->post_data['cate_id'])){
			die(json_encode(array(1,'Không Có Đối Tượng')));
		}
		$this->form_validation->set_rules('cate_name','Category Name','required|max_length[60]');
		if(!$this->form_validation->run()){
			die(json_encode(array(1,'Tên Danh Mục Không Hơp Lệ')));	
		}
		$res = $this->cate_model->edit($this->post_data['cate_id']);
		if(!$res)
			die(json_encode(array(1,'Lỗi, Không Sửa Được')));
		else
			die(json_encode(array(0,'Sửa Thành Công')));
		
	}

	public function delete($id)
	{
		if(empty($id))
			$this->data['error'] = 'Không Có Dữ Liệu';
		else
			$this->cate_model->delete($id);

		// $this->db->last_query();die;
		$this->index();
	}
}
