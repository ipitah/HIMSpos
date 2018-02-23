<?php

class Dispstaffs extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Staffs_model');
	}	
	function index()
	{	
			$result=$this->Items_model->Get_Items();
			
$data=array("title" => "Staffs", "items" => $result);
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/stafflist");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		}
		
		
		
		public function books_page()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Staffs_model->get_books();

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                    $r->fullname,
                    $r->email,
					$r->contact,
					$r->gender,
					$r->username,
					$r->mygroup,
					$r->status,
					$r->regdate,
					'<a href="dispstaffs/update/'.$r->username.'" >Update </a>',
					'<a href="dispstaffs/delete/'.$r->username.'" >Delete </a>'
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
			
			$data=array("title" => "Update staff details", "customer"  => $this->Staffs_model->getMyStaff($id));
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/updatestaff");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
			
			}
		
		
		
		
		
		
		
		
		public function delete($id) {
  $where = array('username' => $id); 
  $det=$this->Staffs_model->deleteRecord('staff',$where);
  
  if($det)
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-success'> Successfully removed the staff. </p> </br><a href='".base_url()."stafflist' >Go back </a> ");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		
	  
  }
  else
  {
	  $data=array("title" => "Deleted", "mess"  => "<p class='alert alert-danger'> Problem in removing the staff. </p> </br><a href='".base_url()."stafflist' >Go back </a>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/receiptsdelsucc");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
  }
  
  
  
}
		
		
		
		
		
		
	
}
?>