<?php

class Dispcustomer extends CI_Controller {
               
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
$data=array("title" => "Customers");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/customers");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		}
		
		
		
		public function books_page()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Customer_model->get_books();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                
                    $r->cid,
                    $r->cname,
                    $r->caddress,
					$r->cphone,
					$r->cdesc,
					$r->fullname,
					'<a href="dispcustomer/update/'.$r->cid.'" >Update </a>',
					'<a href="dispcustomer/delete/'.$r->cid.'" >Delete </a>'
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $books->num_rows(),
                 "recordsFiltered" => $books->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
		
		
		
		
		public function update($id) {
			
			$data=array("title" => "Update customer details", "customer"  => $this->Customer_model->getMyCustomer($id));
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updatecustomer");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
			
			}
		
		
		
		public function delete($id) {
  $where = array('cid' => $id); 
  $det=$this->Customer_model->deleteRecord('customer',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully deleted the customer. </p> </br><a href='".base_url()."customers' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in deleting the customer. </p> </br><a href='".base_url()."customers' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
		
		
		
		
		
	
}
?>