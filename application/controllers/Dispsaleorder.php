<?php

class Dispsaleorder extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Sale_model');
	}	
	function index()
	{	
			
			
$data=array("title" => "Sale");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/listsale");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		}
		
		
		
		
		
		
		
		public function sales_page()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Sale_model->get_sales();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                    $r->itemname,
                    $r->sbp,
                    $r->squantity,
					$r->scustomer,
					$r->scustomerdetails,
					$r->samountgiven,
					$r->stotal,
					$r->discount,
					$r->sbalance,
					$r->spaymentmethod,
					$r->stranscno,
					$r->sreceipt,
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
		
		
		
		public function sales_receipts()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Sale_model->get_soreceipts();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
					$r->scustomer,
					$r->scustomerdetails,
					
					$r->stotal,
					$r->discount,
					$r->discreason,
					$r->vat,
					$r->bal,
					
					'<a href="'.base_url().'receipts/no'.$r->sreceipt.'.pdf" target="_blank" >'.$r->sreceipt.' </a> <a href="dispsaleorder/delete/'.$r->sreceipt.'" >Delete </a>',
			'<a href="'.base_url().'receipts/no'.$r->deliveryreceipt.'.pdf" target="_blank" >'.$r->deliveryreceipt.' </a>',
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
		
		
		public function delete($id) {
  $where = array('sreceipt' => $id); 
  $det=$this->Sale_model->deleteRecord('sale_order',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully deleted the sales order </p> </br><a href='".base_url()."soreceipts' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in deleting the sales order </p> </br><a href='".base_url()."soreceipts' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
	
}
?>