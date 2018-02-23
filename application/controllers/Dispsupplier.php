<?php

class Dispsupplier extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Supplier_model');
	}	
	function index()
	{		
$data=array("title" => "Suppliers");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/suppliers");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		}
		
		
		
		public function books_page()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Supplier_model->get_books();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                
                    $r->cid,
                    $r->cname,
                    $r->caddress,
					$r->cphone,
					$r->cdesc,
					$r->fullname,
					'<a href="dispsupplier/update/'.$r->cid.'" >Update </a>',
					'<a href="dispsupplier/delete/'.$r->cid.'" >Delete </a>'
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
			
			$data=array("title" => "Update supplier details", "customer"  => $this->Supplier_model->getMySupplier($id));
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updatesupplier");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
			
			}
		
		
		
		
		
		
		
		
		public function delete($id) {
  $where = array('cid' => $id); 
  $det=$this->Supplier_model->deleteRecord('supplier',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully deleted the supplier. </p> </br><a href='".base_url()."suppliers' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in deleting the supplier. </p> </br><a href='".base_url()."suppliers' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
		
		
		
		
		
	
}
?>