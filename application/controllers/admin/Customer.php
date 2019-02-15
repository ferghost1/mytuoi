<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller{
	public $controller = '/admin/customer';
	public function __construct(){
		parent::__construct();
		$this->data['controller'] = $this->controller;
		$this->data['js_script']  = 'admin/customer/customer_script';
 		$this->load->model($this->controller.'/customer_model','model');
 		$this->load->model('admin/order/order_model');
	}

	public function index()
	{
		$this->data['all_items'] = $this->model->get_all();
		$this->data['main'] = "{$this->controller}/customer_view";
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}
	public function create()
	{
		if(isset($_POST['submit_add'])){
			//Validate and upload
			$this->form_validation->set_rules('name','Customer Name','required|max_length[100]');
			$this->form_validation->set_rules('email','Email','valid_email|is_unique[customer.email]');
			$this->form_validation->set_rules('phone','Sdt','is_natural_no_zero|min_length[10]|max_length[11]');
			//start upload img
			if($_FILES['avatar']['name']){
				$config['upload_path']   = './public/images/avatar';
			  	$config['allowed_types'] = 'jpg|png|jpeg';
			 	$config['max_size']      = '2000';
			 	$this->load->library('upload',$config);
			 	if(!$this->upload->do_upload('avatar')){
		 			refresh_error('error',$this->upload->display_errors());
				}
				$this->post_data['avatar'] = $this->upload->data('file_name');
			}
			if(!$this->form_validation->run())
				refresh_error('error',validation_errors());

			// Start to create
			$res = $this->model->create();
			if(!$res)
				refresh_error('error','Không Thể Tạo');
			else
				refresh_error('success','Tạo Thành Công');
		}

		// Render layout
		$this->data['main'] = "{$this->controller}/customer_create";
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}

	public function edit($id){
		if(!is_numeric($id))
			// Save error dang session flash, contruct của ctrler sẽ ktra tồn tại r lấy truyền vào data khi render view
			ctrler_redirect('error','Dữ Liệu Không Hợp Lệ');
		//Get Main Item
		$this->data['mitem'] = $this->model->get_one($id);
		$this->data['list_order']= $this->order_model->get_cate_by_cusid($id);
		$this->data['paid_history']= $this->model->get_paid_history($id);
		// If have update signal
		if(isset($_POST['submit_btn'])){
			//Validate and upload
			$this->form_validation->set_rules('name','Customer Name','required|max_length[100]');
			$this->form_validation->set_rules('phone','Sdt','is_natural_no_zero|min_length[10]|max_length[11]');
			// Check if change email
			$is_unique = '';
			if($this->data['mitem']->email != $this->post_data['email'])
				$is_unique = '|is_unique[customer.email]';
			$this->form_validation->set_rules('email','Email','valid_email'.$is_unique);
			//start upload img
		
			if($_FILES['avatar']['name']){
				$config['upload_path']   = './public/images/avatar';
			  	$config['allowed_types'] = 'jpg|png|jpeg';
			 	$config['max_size']      = '2000';
			 	$this->load->library('upload',$config);
			// Delete old image
			 	$old_img = $this->db->where('id',$id)->get('customer');
			 	$old_img = $old_img->row()->avatar;
			 	unlink('public/images/avatar/'.$old_img);
			// Do upload new avatar
			 	if(!$this->upload->do_upload('avatar')){
			 		// error of upload
		 			refresh_error('error',$this->upload->display_errors());
				}
				$this->post_data['avatar'] = $this->upload->data('file_name');

			}
			if($this->form_validation->run()){
				$res = $this->model->edit($id);
				if(!$res)
					refresh_error('error','Không Save Được Thử Lại');
				else
					refresh_error('success','Sửa Thành Công');
			}
		}
		// Load variable for view
		
		$this->data['main'] = 'admin/customer/customer_edit';
		$this->load->vars($this->data);
		$this->load->view($this->_layout);

	}

	public function pay_debt($cus_id){
		if(empty($cus_id)||!is_numeric($cus_id) || !$this->post_data['money'])
			ctrler_redirect('error','Dữ Liệu Không Đúng');
		if(isset($this->post_data['btn_submit'])){
			if($this->model->pay_debt($cus_id))
				redirect_with('success','Thêm Thành Công','/admin/customer/edit/'.$cus_id);
			else
				redirect_with('error','Thêm Thành Công','/admin/customer/edit/'.$cus_id);
		}
	}

	public function delete_paid_history($paid_id,$cus_id){
		if(!is_numeric($paid_id))
			ctrler_redirect('error','Dữ Liệu Không Đúng');
		if($this->model->delete_paid_history($paid_id))
			redirect_with('success','Xóa Thành Công','/admin/customer/edit/'.$cus_id);
		else
			redirect_with('success','Xóa Thành Công','/admin/customer/edit/'.$cus_id);
	}



	public function delete($id)
	{
		if(!is_numeric($id))
			ctrler_redirect('error','Dữ liệu ko hợp lệ');
		if($this->model->delete($id))
			ctrler_redirect('success','Xóa Thành Công');
		// $this->db->last_query();die;

	}
}
