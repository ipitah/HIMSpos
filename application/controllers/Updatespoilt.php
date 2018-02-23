<?php

class Updatespoilt extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Spoilt_model');
	}	
	function index()
	{	$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('itemno', 'Item name', 'required');			
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|is_numeric');			
		$this->form_validation->set_rules('describe', 'Description of damage', '');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$result= $this->Spoilt_model->get_contents();
		
		
		 $page="Update Spoilt Items";
						  
$data = array('title' => $page, "items"=>$result,"mess"=>'<p class="alert alert-danger"> Fill all details and submit again</p>');
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/updatespoilt');	
		  $this->load->view("template/footer");
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'itemno' => set_value('itemno'),
					       	'quantity' => set_value('quantity'),
							'recordedby' => $_SESSION['username'],
					       	'describe' => set_value('describe')
						);
					
			// run insert model to write data to db
		$result= $this->Spoilt_model->get_contents();
		
			if ($this->Spoilt_model->UpdateSpoilt($this->input->post("id"),$form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				$page="Update Spoilt Items";
						  
$data = array('title' => $page, "items"=>$result,"mess"=>'<p class="alert alert-success"> Update saved successfully</p>');
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/updatespoilt');	
		  $this->load->view("template/footer");
			}
			else
			{
			$page="Update Spoilt Items";
						  
$data = array('title' => $page, "items"=>$result,"mess"=>'<p class="alert alert-danger"> Error. Did not Update, submit again</p>');
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/updatespoilt');	
		  $this->load->view("template/footer");
			}
		}
	}
	
	
	public function load()
	{
		$result= $this->Spoilt_model->get_contents();
		
		
		 $page="Update Spoilt Items";
						  
		$data = array('title' => $page, "items"=>$result);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addspoilt');	
		  $this->load->view("template/footer");
		
		
	}
}
?>