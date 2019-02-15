<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller{
	public $controller = '/admin/order';
	public function __construct(){
		parent::__construct();
		$this->data['controller'] = $this->controller;
		$this->data['js_script']  = $this->controller.'/order_script';
 		$this->load->model('admin/order/order_model','model');
 		$this->load->model('admin/customer/customer_model');
 		$this->load->model('admin/product/product_model');
	}

	public function index()
	{
		$this->data['all_items'] = $this->model->get_all($this->get_data);
		$this->data['total_money'] = 0;
		$this->data['debt'] = 0;
		$this->data['total_amount'] = 0;
		if(!empty($this->get_data['time_from']) && !empty($this->get_data['time_to']))
			$this->data['chart'] = $this->model->get_chart($this->get_data['time_from'],$this->get_data['time_to']);
		foreach ($this->data['all_items'] as $key => $value) {
			$this->data['total_money'] += $value->sum;
			$this->data['debt'] += $value->sum - $value->pre_paid;
			$this->data['total_amount'] += $value->sum_qty;
		}
		$this->data['main'] = "{$this->controller}/order_view";
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}
	public function create()
	{	
		if(isset($_POST['submit_btn'])){
			$res = $this->model->create();
			if(!$res)
				refresh_error('error','Không Thể Tạo');
			else{
				$insert_id = $this->db->order_by('id','desc')->limit(1)->get('orders');
				
				$insert_id = $insert_id->row()->id;
				// die($this->db->last_query());
				$mes = "Tạo Thành Công <a href='/admin/order/edit/$insert_id'>Chi tiết</a>";
				refresh_error('success',$mes);
			}
		}

		$this->data['all_customer'] = $this->customer_model->get_all();
		$this->data['all_shipper'] = $this->db->where('level',4)->where('active',1)->get('users')->result();
		$this->data['all_product'] = $this->product_model->get_all();
		// Render layout
		$this->data['main'] = "{$this->controller}/order_create";
		$this->load->vars($this->data);
		$this->load->view($this->_layout);
	}

	public function edit($id){
		if(!is_numeric($id))
		// Save error dang session flash, contruct của ctrler sẽ ktra tồn tại r lấy truyền vào data khi render view
			ctrler_redirect('error','Dữ Liệu Không Hợp Lệ');
	//Get Main Item
		$this->data['mitem'] = $this->model->get_one($id);
	// If have update signal
		if(isset($_POST['submit_btn'])){
			echo '<pre>';		
				$res = $this->model->edit($id);
				if(!$res)
					refresh_error('error','Không Save Được Thử Lại');
				else
					refresh_error('success','Sửa Thành Công');
			}
		
	// Load variable for view
		$this->data['all_customer'] = $this->customer_model->get_all();
		$this->data['all_shipper'] = $this->db->where('level',4)->where('active',1)->get('users')->result();
		$this->data['all_product'] = $this->product_model->get_all();
		$this->data['product_detail'] = $this->model->get_detail($id);
		$this->data['main'] = 'admin/order/order_edit';
		$this->load->vars($this->data);
		// echo '<pre>';
		// var_dump($this->data);
		$this->load->view($this->_layout);

	}

	public function delete($id)
	{
		if(!is_numeric($id))
			ctrler_redirect('error','Dữ liệu ko hợp lệ');
		if($this->model->delete($id))
			ctrler_redirect('success','Xóa Thành Công');
	}
}
