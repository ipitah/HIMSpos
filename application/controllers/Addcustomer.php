<?php

class Addcustomer extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Customer_model');
	}	
	function index()
	{			
		$this->form_validation->set_rules('cid', 'ID NO./Passport', 'required');
		$this->form_validation->set_rules('cname', 'Full name', 'required');			
		$this->form_validation->set_rules('cdesc', 'Customer description', '');			
		$this->form_validation->set_rules('caddress', 'Address');			
		$this->form_validation->set_rules('cphone', 'Phone Number', 'required|is_numeric');
		
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
		 $page="Add Customer";			  
$data = array('title' => $page,  "mess" => "<p class='alert alert-danger'> Kindly fix the following errors and submit again</p>");
		
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addcustomer");	
		  $this->load->view("template/footer");	
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'cid' => set_value('cid'),
					       	'cname' => set_value('cname'),
					       	'cdesc' => set_value('cdesc'),
					       	'caddress' => set_value('caddress'),
							'cphone' => set_value('cphone'),
							'user' => $_SESSION['username']
						);
					
			// run insert model to write data to db
		
			if ($this->Customer_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				$page="Add Customer";
						  
$data = array('title' => $page,"mess" => "<p class='alert alert-success'> Your have successfully added a customer</p>");
				
			
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addcustomer");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			}
			else
			{
			 $page="Add Customer";
						  
$data = array('title' => $page, "mess" => "<p class='alert alert-danger'> Error: When saving your customer details.</p>");
				
		
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addcustomer");	
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