<?php

class Option_model extends CI_Model
{
	private $table = 'site_option';
	private $data;
	private $req;
	private $CI;
	// private $get_data;
	function __construct(){
		parent::__construct();
	}

	public function fill_data($data){
		$this->req['name'] = $data['name'];
		$this->req['address'] = $data['address'];
		$this->req['phone'] = $data['phone'];
		$this->req['email'] = $data['email'];
		if(isset($data['avatar']))
			$this->req['avatar'] = $data['avatar'];
	}

	public function get_one($id){
		$item = $this->db->where('id',$id)->get($this->table);
		return $item->row();
	}

	public function get_all(){
		$all = $this->db->order_by('id','desc')
			->where('level >',$this->user->level)
			->get($this->table);
		return $all->result();
	}

	public function check_pass($data){
		$this->db->where('username',$data['username']);
		$res = $this->db->get($this->table);
		if(!$res->num_rows()){
			return false;
		}
		$res = $res->row();
		if(password_verify($data['password'],$res->password))
			return $res;
		return false;
	}
 	
	public function create($data){
		$this->fill_data($data);
		$this->req['username'] = $data['username'];
		if(!$pass = password_hash($data['password'],PASSWORD_DEFAULT))
			return false;
		$this->req['password'] = $pass;
		return $this->db->insert($this->table,$this->req);
	}

	public function change_admin($data){
		$this->fill_data($data);
		if(isset($data['change_pass'])){
			if(!$pass = password_hash($data['new_password'],PASSWORD_DEFAULT))
				return false;
			$this->req['password'] = $pass;	
		}
		return $this->db->where('username','admin')
			->update('users',$this->req);
	}
	
	public function delete($id){
		return $this->db->where('id',$id)
			->where('level >',$this->user->level)
			->delete($this->table);
	}

}