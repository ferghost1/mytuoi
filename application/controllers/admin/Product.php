<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller{
	private $controller = '/admin/product';
	public function __construct(){
		parent::__construct();
		$this->data['controller'] = $this->controller;
		$this->data['js_script']  = 'admin/product/product_script';
 		$this->load->model('admin/product/product_model','model');
 		$this->load->model('admin/cate_product/cate_model');

	}

	public function index()
	{
		$this->data['all_items'] = $this->model->get_all();
		$this->data['main'] = 'admin/product/product_view';
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}
	public function create()
	{
		if(isset($_POST['submit_add'])){
			$this->form_validation->set_rules('name','Product Name','required|max_length[100]');
			$this->form_validation->set_rules('price','Price','required|is_natural_no_zero');
			$this->form_validation->set_rules('cate_id','Category Name','required|is_natural_no_zero');
			//start upload img
		
			if($_FILES['main_img']['name']){
				$config['upload_path']   = './public/images/uploads';
			  	$config['allowed_types'] = 'jpg|png|jpeg';
			 	$config['max_size']      = '2000';
			 	$this->load->library('upload',$config);
			 	if(!$this->upload->do_upload('main_img')){
			 		// error of upload
		 			$this->data['error'] = $this->upload->display_errors();
				}
				$this->post_data['main_img'] = $this->upload->data('file_name');
			}
			if($this->form_validation->run()){
				$res = $this->model->create();
				if(!$res)
					$this->data['error'] = 'Không Thể Tạo';
				else
					$this->data['noti_success'] = 'Tạo Thành Công';
			}
		}
		$this->data['all_cate'] = $this->cate_model->get_all();
		$this->data['main'] = 'admin/product/product_create';
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}

	public function edit($id){
		if(!is_numeric($id))
			// Save error dang session flash, contruct của ctrler sẽ ktra tồn tại r lấy truyền vào data khi render view
			redirect($this->controller);
		if(isset($_POST['submit_btn'])){
			$this->form_validation->set_rules('name','Product Name','required|max_length[100]');
			$this->form_validation->set_rules('cate_id','Category Name','required|is_natural_no_zero');
			//start upload img
		
			if($_FILES['main_img']['name']){
				$config['upload_path']   = './public/images/uploads';
			  	$config['allowed_types'] = 'jpg|png|jpeg';
			 	$config['max_size']      = '2000';
			// Remove old img
			 	$old_img = $this->db->where('id',$id)->get('product');
			 	$old_img = $old_img->row()->main_img;
			 	unlink('public/images/uploads/'.$old_img);
			// Do upload new image
			 	$this->load->library('upload',$config);
			 	if(!$this->upload->do_upload('main_img')){
			 		// error of upload
		 			refresh_error('error','Không upload hình được');
				}
				$this->post_data['main_img'] = $this->upload->data('file_name');
			}
			if($this->form_validation->run()){
				$res = $this->model->edit($id);
				if(!$res)
					refresh_error('error','Không Save Được Thử Lại');
				else
					refresh_error('success','Sửa Thành Công');
			}
		}
		$this->data['mitem'] = $this->model->get_one($id);
		$this->data['main'] = 'admin/product/product_edit';
		$this->data['all_cate'] = $this->cate_model->get_all();
		$this->load->vars($this->data);
		$this->load->view($this->_layout);

	}

	public function delete($id)
	{
		if(empty($id))
			$this->data['error'] = 'Không Có Dữ Liệu';
		else
			$this->model->delete($id);

		// $this->db->last_query();die;
		$this->index();
	}
}
