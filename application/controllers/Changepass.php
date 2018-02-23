<?php

class Changepass extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Staffs_model');
		$this->load->library('session');
	}	
	function index()
	{			
		$this->form_validation->set_rules('oldpass', 'Old password', 'required');
		$this->form_validation->set_rules('newpass', 'New password', 'required');
		$this->form_validation->set_rules('confirm', 'Confirm new password', 'required|matches[newpass]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		
	
		if ($this->form_validation->run() == FALSE || $_SESSION['pass']!=$this->input->post("oldpass")) // validation hasn't been passed
		{
			$data=array("title" => "Change password", "mess" => "<p class='alert alert-danger'> Kindly fix the following errors and submit again if none confirm the old password again</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/changepassword");	
		  $this->load->view("template/footer");	
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'password' => md5(set_value('newpass'))
						);
					
			// run insert model to write data to db
		
			if ($this->Staffs_model->UpdatePass($_SESSION['username'],$form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
			
			$data=array("title" => "Change password", "mess" => "<p class='alert alert-success'> Your have successfully updated your password. It will take effect from the next login.</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/changepassword");	
		  $this->load->view("template/footer");	
		  
			}
			else
			{
				
			$data=array("title" => "Change password", "mess" => "<p class='alert alert-danger'> Error: When Updating your password.</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/changepassword");	
		  $this->load->view("template/footer");	
		  
			}
		}
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
}
?>