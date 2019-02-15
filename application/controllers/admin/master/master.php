<?php
	$this->load->view("admin/master/head");
	if(isset($js_script))
		$this->load->view($js_script);
	$this->load->view("admin/master/header");
	$this->load->view("admin/master/left");
	$this->load->view($main);
	// $this->load->view("admin/master/right");
	
	$this->load->view("admin/master/footer");