<?php

class Deletesale extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Sale_model');
	}	
	
		
		public function delete($id) {
  $where = array('sreceipt' => $id); 
  $det=$this->Sale_model->deleteRecord('sale',$where);
  
  if($det)
  {
	  $data=array("title" => "Sale", "mess"  => "<p class='alert alert-success'> Successfully deleted the sales </p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/listreceipts");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Sale", "mess"  => "<p class='alert alert-danger'> Problem in deleting the sales </p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/listreceipts");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
	
}
?>