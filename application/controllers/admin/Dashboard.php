<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashBoard extends MY_Controller{
	private $_data;
	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->_data['main'] = 'admin/dashboard/dashboard';
		$this->load->vars($this->_data);
		$this->load->view($this->_layout);
	}
}
