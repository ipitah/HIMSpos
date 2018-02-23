<?php

class Dispitem extends CI_Controller {
               
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


          $books = $this->Items_model->get_books();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                
                    $r->itemname,
                    $r->itemdesc,
                    $r->bp,
                    $r->sp,
					$r->category,
					$r->vat,
					'<a href="dispitem/update/'.$r->itemid.'" >Update </a>',
					'<a href="dispitem/delete/'.$r->itemid.'" >Delete </a>'
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
			
			$result= $this->Items_model->get_contents();

		 $page="Update Item";
						  
$data = array('title' => $page, "id"=>$id, "items"=>$result,  "customer"  => $this->Items_model->getMyItem($id));
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updateitem");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
			
			}
		
		
		
		public function delete($id) {
  $where = array('itemid' => $id); 
  $det=$this->Items_model->deleteRecord('items',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully deleted the item. </p> </br><a href='".base_url()."listitems' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in deleting the item. </p> </br><a href='".base_url()."listitems' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
		
		
		
		
		
	
}
?>