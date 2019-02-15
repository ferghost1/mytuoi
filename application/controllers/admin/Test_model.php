<?php
class test_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		var_dump($this->db);die;
	}
     
}