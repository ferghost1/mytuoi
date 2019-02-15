<?php

class Customer_model extends CI_Model
{
	private $table = 'customer';
	private $data;
	private $req;
	private $CI;
	// private $get_data;
	function __construct(){
		parent::__construct();
		$this->CI =& get_instance();
	}

	public function fill_data(){
		$this->req['name'] = $this->post_data['name'];
		$this->req['address'] = $this->post_data['address'];
		$this->req['phone'] = $this->post_data['phone'];
		$this->req['email'] = $this->post_data['email'];
		if(isset($this->post_data['avatar']))
			$this->req['avatar'] = $this->post_data['avatar'];
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
		$this->req['name'] = $this->post_data['name'];
		$this->req['email'] = $this->post_data['email'];
		$this->req['phone'] = $this->post_data['phone'];
		$this->req['address'] = $this->post_data['address'];
		if(isset($this->post_data['avatar']))
			$this->req['avatar'] = $this->post_data['avatar'];
		return $this->db->where('id',$id)
			->update($this->table,$this->req);
	}
	// Change cate of product to 0 before delete cate
	public function delete($id){
		return $this->db->where('id',$id)->delete($this->table);
	}

	public function pay_debt($cus_id){
		$ins_arr = [
			'money' => $this->post_data['money'],
			'cus_id' => $cus_id
		];
		$this->db->trans_start();
		$this->db->insert('paid_history',$ins_arr);
		$this->db->set('debt',"debt + {$ins_arr['money']}",false)
			->where('id',$cus_id)
			->update('customer');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function get_paid_history($cus_id){
		$all_paid = $this->db->where('cus_id',$cus_id)->get('paid_history');
		return $all_paid->result();
	}

	public function delete_paid_history($paid_id){
		$this->db->trans_start();
		$this->db->query("update customer c, paid_history ph set c.debt = c.debt - ph.money where c.id = ph.cus_id and ph.id = {$paid_id} ");
		$this->db->where('id',$paid_id)->delete('paid_history');
		$this->db->trans_complete();
		return $this->db->trans_status();
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