<?php

class Category extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Category_model');
	}	
	function index()
	{			
		$this->form_validation->set_rules('category', 'Category', 'required|max_length[50]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$data=array("title" => "Add category", "mess" => "<p class='alert alert-danger'> Kindly fix the following errors and submit again</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addcategory");	
		  $this->load->view("template/footer");	
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'category' => set_value('category'),
							'addedby' => $_SESSION['username']
						);
					
			// run insert model to write data to db
		
			if ($this->Category_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
			
			$data=array("title" => "Add item", "mess" => "<p class='alert alert-success'> Your have successfully a category</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addcategory");	
		  $this->load->view("template/footer");	
		  
			}
			else
			{
				
			$data=array("title" => "Add item", "mess" => "<p class='alert alert-danger'> Error: When saving your category.</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/addcategory");	
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