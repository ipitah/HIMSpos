<?php

class Staffs extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Staffs_model');
	}	
	function index()
	{			
		$this->form_validation->set_rules('fullname', 'Full name', 'required');			
		$this->form_validation->set_rules('email', 'Email', 'valid_email');			
		$this->form_validation->set_rules('contact', 'Contact', 'required|is_numeric');			
		$this->form_validation->set_rules('gender', 'Gender', 'required');			
		$this->form_validation->set_rules('mygroup', 'Level', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$data=array("title" => "Add Staff", "mess" => "<p class='alert alert-danger'> Kindly fix the following errors and submit again</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addstaff");	
		  $this->load->view("template/footer");	
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'fullname' => set_value('fullname'),
					       	'email' => set_value('email'),
					       	'contact' => set_value('contact'),
					       	'gender' => set_value('gender'),
							'username' => set_value('username'),
							'password' => md5(set_value('password')),
					       	'mygroup' => set_value('mygroup')
						);
					
			// run insert model to write data to db
		
			if ($this->Staffs_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				
				$data=array("title" => "Add Staff", "mess" => "<p class='alert alert-success'> User added successfully</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addstaff");	
		  $this->load->view("template/footer");	
		  
		  
			}
			else
			{
			
			
			$data=array("title" => "Add Staff", "mess" => "<p class='alert alert-danger'> Error: User failed to be added.</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addstaff");	
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