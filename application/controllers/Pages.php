<?php

 class Pages extends CI_Controller {
	 
	 function view ($page = "index"){
		 $this->load->helper("url");
		 $this->load->helper('form');
		$this->load->helper('url');
       $this->load->library('session');
          $this->load->helper('html');
		  $this->load->library('form_validation');
		 
		 if(!file_exists('application/views/pages/'.$page.'.php'))
		 {
			 show_404();
		 }
		 $data["title"]=$page;
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/".$page);	
		  $this->load->view("template/footer");	 
	 }
	  
	 
 }
 

?>