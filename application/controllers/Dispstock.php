<?php

class Dispstock extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Purchase_model');
	}	
	function index()
	{	
			
			
$data=array("title" => "Stock");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/liststock");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		}
		
		
		
		public function stock_page()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Purchase_model->get_stock();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                    $r->itemname,
                    $r->pbp,
                    $r->pquantity,
					$r->psupplier,
					$r->psupplierdetails,
					$r->total,
					$r->preceipt,
                    
                    $r->fullname
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
		
		
		
		
		
		
		
			public function stock_receipts()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Purchase_model->get_receipts();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
					$r->psupplier,
					$r->psupplierdetails,
					$r->total,
					$r->discount,
					$r->bal,
					$r->preceipt,
                    $r->fullname,
					'<a href="dispstock/delete/'.$r->preceipt.'" >Delete </a>'
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
		
		
		public function delete($id) {
  $where = array('preceipt' => $id); 
  $det=$this->Purchase_model->deleteRecord('purchase',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully deleted the stock </p> </br><a href='".base_url()."stockreceipts' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in deleting the stock </p> </br><a href='".base_url()."stockreceipts' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
		
		
	
}
?>