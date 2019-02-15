<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends MY_Controller{
	public $controller = '/admin/option';
	public function __construct(){
		parent::__construct();
		$this->data['controller'] = $this->controller;
		$this->data['js_script']  = 'admin/option/option_script';
 		$this->load->model('admin/option/option_model','model');
 		$this->load->model('admin/user/user_model');
	}

	public function index()
	{
		// $this->data['all_items'] = $this->model->get_all();
		$this->data['main'] = "{$this->controller}/option_view";
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}

	public function change_admin(){
		if(isset($_POST['submit_btn'])){
		//Validate and upload
			$this->form_validation->set_rules('email','Email',"trim|valid_email|unique_except[users||email||{$this->user->email}]");
			$this->form_validation->set_rules('name','Customer Name','trim|required|max_length[255]');
			$this->form_validation->set_rules('phone','Sdt','trim|is_natural_no_zero|min_length[10]|max_length[11]');
		//If change password
			if(isset($this->post_data['change_pass'])){
				$this->post_data['username'] = $this->user->username;
				if(!$this->user_model->check_pass($this->post_data))
					refresh_error('error','Password Không Đúng');
				$this->form_validation->set_rules('password','Password','required');
				$this->form_validation->set_rules('new_password','Re Password','required');
				$this->form_validation->set_rules('renew_password','Re New Password','required|matches[new_password]');
			}
		//start upload img
			if($_FILES['avatar']['name']){
				$config['upload_path']   = './public/images/avatar';
			  	$config['allowed_types'] = 'jpg|png|jpeg';
			 	$config['max_size']      = '2000';
			 	$this->load->library('upload',$config);
			
			// Do upload new avatar
			 	if(!$this->upload->do_upload('avatar')){
		 		// error of upload
		 			refresh_error('error',$this->upload->display_errors(),'admin/option');
				}
			// Delete old image
			 	$old_img = $this->user->avatar;
			 	unlink('public/images/avatar/'.$old_img);
				$this->post_data['avatar'] = $this->upload->data('file_name');

			}
			if($this->form_validation->run()){
				$res = $this->model->change_admin($this->post_data);
				if(!$res)
					refresh_error('error','Không Save Được Thử Lại','admin/option');
				else{
					$new_ad = $this->db->where('username','admin')->get('users')->row();
					$this->session->set_userdata('user',$new_ad);
					refresh_error('success','Sửa Thành Công','admin/option');
				}
			}
		}
	}

	public function change_logo(){
		if(!isset($this->post_data['submit_btn']))
			refresh_error('error','Không Đúng','admin/option');
	//start upload img
		if($_FILES['logo']['name']){
			$config['upload_path']   = './public/images/layout';
		  	$config['allowed_types'] = 'jpg|png|jpeg';
		 	$config['max_size']      = '3000';
		 	$this->load->library('upload',$config);
		
		// Do upload new avatar
		 	if(!$this->upload->do_upload('logo')){
	 		// error of upload
	 			refresh_error('error',$this->upload->display_errors(),'admin/option');
			}
		// Delete old image
		 	$old_img = $this->db->where('field_key','logo')->get('site_option')->row();
		 	$old_img = $old_img->val;
		 	unlink('public/images/layout/'.$old_img);
		 	$img_name = $this->upload->data('file_name');
			$this->db->query("insert into site_option (field_key,val) values ('logo','{$img_name}')
				on duplicate key update val = '{$img_name}'");
			refresh_error('success','Đổi Thành Công','admin/option');

		}

	}

	public function create()
	{
		if(isset($_POST['submit_add'])){
		//Validate and upload
			$this->form_validation->set_rules('username','Username','trim|required|max_length[100]|is_unique[users.username]');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('repassword','Re Password','required|matches[password]');
			$this->form_validation->set_rules('email','Email','trim|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('level','Type Admin',"trim|required|is_natural_no_zero|greater_than[{$this->user->level}]",['greater_than' => 'Không Đủ Quyền Tạo User Này']
			);
			$this->form_validation->set_rules('name','Customer Name','trim|required|max_length[255]');
			$this->form_validation->set_rules('phone','Sdt','trim|is_natural_no_zero|min_length[10]|max_length[11]');
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
			$res = $this->model->create($this->post_data);
			if(!$res)
				refresh_error('error','Không Thể Tạo');
			else
				refresh_error('success','Tạo Thành Công');
		}

		// Render layout
		$this->data['main'] = "{$this->controller}/user_create";
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}

	public function edit($id){
		if(!is_numeric($id))
			refresh_error('error','Dữ Liệu Không Hợp Lệ',$this->controller);

	//Get Main Item
		$this->data['mitem'] = $this->model->get_one($id);
	// If have update signal
		if(isset($_POST['submit_btn'])){
		//Validate and upload
			$this->form_validation->set_rules('email','Email',"trim|valid_email|unique_except[users||email||{$this->data['mitem']->email}]");
			$this->form_validation->set_rules('level','Type Admin',"trim|required|is_natural_no_zero|greater_than[{$this->user->level}]");
			$this->form_validation->set_rules('name','Customer Name','trim|required|max_length[255]');
			$this->form_validation->set_rules('phone','Sdt','trim|is_natural_no_zero|min_length[10]|max_length[11]');
		//If change password
			if(isset($this->post_data['change_pass'])){
				$this->post_data['username'] = $this->data['mitem']->username;
				if(!$this->model->check_pass($this->post_data))
					refresh_error('error','Password Không Đúng');
				$this->form_validation->set_rules('password','Password','required');
				$this->form_validation->set_rules('new_password','Re Password','required');
				$this->form_validation->set_rules('renew_password','Re New Password','required|matches[new_password]');
			}
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
				$res = $this->model->edit($id,$this->post_data);
				if(!$res)
					refresh_error('error','Không Save Được Thử Lại');
				else
					refresh_error('success','Sửa Thành Công');
			}
		}
		// Load variable for view
		$this->data['main'] = 'admin/user/user_edit';
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}

	public function delete($id)
	{
		if(!is_numeric($id))
			ctrler_redirect('error','Dữ liệu ko hợp lệ');
		if($this->model->delete($id))
			ctrler_redirect('success','Xóa Thành Công');
		// $this->db->last_query();die;

	}

	public function block($id){
		if(!is_numeric($id))
			ctrler_redirect('error','Dữ liệu ko hợp lệ');
		$this->db->query("update users set active = if(active = 1, 0, 1) where id = $id and level > {$this->user->level} ");
			ctrler_redirect('success','Đã Chuyển Trạng Thái User');
	}

	public function ajax_change_status(){
		if(empty($this->post_data['arr_change']) || !is_array($this->post_data['arr_change']))
			die(json_encode(['error','Không Đủ Dữ Liệu']));
	
		$this->db->set('active','if(active = 0,1,0)',false)
			->where_in('id',$this->post_data['arr_change'])
			->where('level >',$this->user->level)
			->update('users');
		die(json_encode(['success','Xóa Thành Công']));
	}

	public function ajax_delete_all(){
		if(empty($this->post_data['arr_delete']) || !is_array($this->post_data['arr_delete']))
			die(json_encode(['error','Không Đủ Dữ Liệu']));
	
		$this->db->where_in('id',$this->post_data['arr_delete'])
			->where('level >',$this->user->level)
			->delete('users');
		die(json_encode(['success','Xóa Thành Công']));
	}

}
