<?php

class Dispsale extends CI_Controller {
               
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


          $books = $this->Sale_model->get_receipts();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
					$r->scustomer,
					$r->scustomerdetails,
					$r->samountgiven,
					$r->stotal,
					$r->discount,
					$r->discreason,
					$r->vat,
					$r->bal,
					$r->sbalance,
					$r->spaymentmethod,
					$r->stranscno,
					'<a href="'.base_url().'receipts/no'.$r->sreceipt.'.pdf" target="_blank" >'.$r->sreceipt.' </a> <a href="dispsale/delete/'.$r->sreceipt.'" >Delete </a>',
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
	 
	 
	 
	 
	 public function sales_invoices()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Sale_model->get_invoices();

          $data = array();

          foreach($books->result() as $r) {
			  
			  $receipt=$r->sreceipt;
			  if($receipt=="")
			  $receipt="No receipt";
			  $stotal=$r->stotal;
			  if($stotal=="")
			  $stotal=0;
			  $discount=$r->discount;
			  if($discount=="")
			  $discount=0;
			  $vat=$r->vat;
			  if($vat=="")
			  $vat=0;
			  $discreason=$r->discreason;
			  if($discreason=="")
			  $discreason="No Discount";
			  $scustomer=$r->scustomer;
			  if($scustomer=="")
			  $scustomer="No Customer";
			  

               $data[] = array(
					$r->scustomer,
					$r->scustomerdetails,
					
					$r->stotal,
					$r->discount,
					$r->discreason,
					$r->vat,
					$r->bal,
					
					'<a href="'.base_url().'receipts/no'.$receipt.'.pdf" target="_blank" >'.$receipt.' </a> <a href="dispsale/delete/'.$receipt.'" >Receipt </a>',
					
					
					' <a href="dispsale/finalise/'.$receipt.'/'.$stotal.'/'.$discount.'/'.$vat.'/'.$discreason.'/'.$scustomer.'" >Finalise </a>',
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
	 
	 
	 
	 
	 
	 public function finalise($id,$total,$discount,$vat,$discreason,$psupplier) {
			
			$data=array("title" => "Finalise sale", "id"  => $id, "total"  => $total, "discount"  => $discount, "vat"  => $vat, "discreason"  => $discreason, "psupplier"  => $psupplier);
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/finalisesale");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
			
			}
		
	 
	 
	 
	 
	 
	 
		
		
		public function delete($id) {
  $where = array('sreceipt' => $id); 
  $det=$this->Sale_model->deleteRecord('sale',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully deleted the sales </p> </br><a href='".base_url()."listreceipts' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in deleting the sales </p> </br><a href='".base_url()."listreceipts' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
	
}
?>