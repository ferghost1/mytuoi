<?php

class Product_model extends CI_Model
{
	private $table = 'product';
	private $data;
	private $req = array();
	private $CI;
	// private $get_data;
	function __construct(){
		parent::__construct();
		$this->CI =& get_instance();
	}

	public function fill_data(){
		
		$this->req['name'] = $this->post_data['name'];
		$this->req['price'] = $this->post_data['price'];
		$this->req['description'] = $this->post_data['description'];
		$this->req['cat_id'] = $this->post_data['cate_id'];
		if(isset($this->post_data['main_img']))
			$this->req['main_img'] = $this->post_data['main_img'];
	}

	public function get_one($id){
		$item = $this->db->where('id',$id)->get($this->table);
		return $item->row();
	}

	public function get_all(){
		$all = $this->db->order_by('id','desc')->get($this->table);
		return $all->result();
	}

	public function create(){
		$this->fill_data();
		return $this->db->insert($this->table,$this->req);
	}

	public function edit($id){
		// Id 2 là Unknow dùng khi xóa cate, product sẽ chuyển về
		$this->fill_data();
		return $this->db->where('id',$id)
			->update($this->table,$this->req);

	}
	// Change cate of product to 0 before delete cate
	public function delete($id){
		$CI =& get_instance();
		$del = $this->db->where('id',$id)->delete($this->table);
		if(!$del){
			$CI->data['error'] = 'Không Xóa Được';
			return;
		}else
			$CI->data['noti_success'] = 'Xóa Thành Công';
	}
}