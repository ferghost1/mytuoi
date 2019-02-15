<?php

class Cate_Model extends CI_Model
{
	private $table = 'product_cates';
	private $data;
	private $req;
	private $CI;
	// private $get_data;
	function __construct(){
		parent::__construct();
		$this->CI =& get_instance();
	}

	public function fill_data(){
		$this->data['name'] = $this->post_data['cate_name'];
		$this->data['description'] = $this->post_data['description'];
	}
	public function get_all(){
		$all = $this->db->where('id!=',2)->order_by('id','desc')
			->get($this->table);
		return $all->result();
	}

	public function create(){
		$this->fill_data();
		return $this->db->insert($this->table,$this->data);
	}

	public function edit($id){
		// Id 2 là Unknow dùng khi xóa cate, product sẽ chuyển về
		if($id == 1)
			return;
		$this->data['name'] = $this->post_data['cate_name'];
		$this->data['description'] = $this->post_data['cate_des'];
		return $this->db->where('id',$id)
			->update($this->table,$this->data);
	}
	// Change cate of product to 1 before delete cate
	public function delete($id){
		$CI =& get_instance();
		if($id == 1){
			$CI->data['error'] = 'Không Được Xóa Danh Mục Này';
			return;
		}
		$change = $this->db->where('cat_id',$id)
			->update('product',array('cat_id'=>2));
		if(!$change){
			$CI->data['error'] = 'Không Thể Thay Đổi SP Trong Danh Mục Này';
			return;
		}
		$del = $this->db->where('id',$id)->delete($this->table);
		if(!$del){
			$CI->data['error'] = 'Không Xóa Được';
			return;
		}else
			$CI->data['noti_success'] = 'Xóa Thành Công';
	}

	// Get all or certain categories and their children
	public function get_cates_children($id=0){
		$cates = $this->db->from($this->talbe)
			->where('parent_id',$id)
			->get();
		$cates = $cates->result();
		// Find category which is children of these $cates
		$parent_id = array_column($cates, 'id');  
		$continue_flag = true;
		while($continue_flag){
			$this->db->from($this->table)
				->where_in('parent_id',$parent_id)
				->get();
			$res = $this->db->result();
			foreach($res as $v)
				$cates[] = $v;
			if(!empty($res))
				$parent_id = array_column($res,'id');
			else
				$continue_flag = false;
		}
		return $cates;
	}

	public function cates_in_tree($id=0){
		$cates = $this->get_cates_children($id);
		if(empty($cates))
			return array();
		// make new array with key as id 
		$new_cates = array_combine(array_column($cates,'id'),$cates);
		// Revere array and Loop until certain root
		// Loop from lowest children and add to key ['children'] of their parent 
		$reverse_arr = array_reverse($new_cates,true);
		while(end($reverse_arr)->id != $id){
			$current_item = array_pop($reverse_arr);
			$current_parent = $current_item->parent_id;
			$reverse_arr[$current_parent]['children'][] = $current_item;
		}
		// Return array with tree parent to children
		return $reverse_arr;
	}	
}