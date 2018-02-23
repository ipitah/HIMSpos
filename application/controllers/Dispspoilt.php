<?php

class Dispspoilt extends CI_Controller {
               
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
	{	
			$result=$this->Items_model->Get_Items();
			
$data=array("title" => "Items", "items" => $result);
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/listitems");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		}
		
		
		
		public function books_page()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Spoilt_model->get_books();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                
                    $r->itemname,
                    $r->describe,
                    $r->quantity,
                    $r->daterecorded,
					$r->fullname,
					'<a href="dispspoilt/update/'.$r->spoiltno.'" >Update </a>',
					'<a href="dispspoilt/delete/'.$r->spoiltno.'" >Delete </a>'
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
			
			$result= $this->Spoilt_model->get_contents();

		 $page="Update Spoilt Item";
						  
$data = array('title' => $page, "id"=>$id, "items"=>$result,  "customer"  => $this->Spoilt_model->getMySpoilt($id));
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updatespoilt");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
			
			}
		
		
		
		public function delete($id) {
  $where = array('spoiltno' => $id); 
  $det=$this->Spoilt_model->deleteRecord('spoilt_items',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully deleted the spoilt item(s). </p> </br><a href='".base_url()."spoilt' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in deleting the spoilt item(s). </p> </br><a href='".base_url()."spoilt' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
		
		
		
		
		
	
}
?>