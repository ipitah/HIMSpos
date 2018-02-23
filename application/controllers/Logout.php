<?php

class Logout extends CI_Controller {
               
	function __construct()
	{
 		 parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
       $this->load->library('session');
          $this->load->helper('html');
          $this->load->model('Login_model');
	}	
	function index()
	{			
		$user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    $this->session->sess_destroy();
    redirect('login');
	}
}
?>