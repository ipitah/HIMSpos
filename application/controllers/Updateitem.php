<?php

class Updateitem extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Items_model');
	}	
	function index()
	{	$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('itemname', 'Item name', 'required');			
		$this->form_validation->set_rules('itemdesc', 'Item description', '');			
		$this->form_validation->set_rules('bp', 'Buying price', 'required|is_numeric');			
		$this->form_validation->set_rules('sp', 'Selling price', 'required|is_numeric');
		$this->form_validation->set_rules('category', 'Item category', 'required');	
		$this->form_validation->set_rules('vat', 'Taxed', 'required');	
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$result= $this->Items_model->get_contents();
		
		
		 $page="Update Item";
						  
$data = array('title' => $page, "items"=>$result, "mess" => "<p class='alert alert-danger'> Kindly fix the following errors and submit again</p>");
		
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updateitem");	
		  $this->load->view("template/footer");	
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'itemname' => set_value('itemname'),
					       	'itemdesc' => set_value('itemdesc'),
					       	'bp' => set_value('bp'),
					       	'sp' => set_value('sp'),
							'category' => set_value('category'),
							'vat' => set_value('vat'),
							'user' => $_SESSION['username']
						);
					
			// run insert model to write data to db
		
			if ($this->Items_model->UpdateItem($this->input->post("id"),$form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				$result= $this->Items_model->get_contents();
		
		
		 $page="Update Item";
						  
$data = array('title' => $page, "items"=>$result,"mess" => "<p class='alert alert-success'> Your have successfully added an item</p>");
				
			
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updateitem");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			}
			else
			{
				
		$result= $this->Items_model->get_contents();
		
		
		 $page="Update Item";
						  
$data = array('title' => $page, "items"=>$result,"mess" => "<p class='alert alert-danger'> Error: When saving your item.</p>");
				
		
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updateitem");	
		  $this->load->view("template/footer");	
			}
		}
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
	
	
	
	
	
	public function load()
	{
		$result= $this->Items_model->get_contents();
		
		
		 $page="Add Item";
						  
		$data = array('title' => $page, "items"=>$result);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/additem');	
		  $this->load->view("template/footer");
		
		
	}
	
	
}
?>