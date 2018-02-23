<?php

class Dispremstock extends CI_Controller {
               
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
			
			
$data=array("title" => "Remainig items in stock");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/liststockitems");	
		  $this->load->view("template/footer");		 // or whatever logic needs to occur
			
		}
		
		
		
		public function stock_page()
     {

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Purchase_model->get_remainingitems();
		  $Eballons=$this->Purchase_model->get_usedballoons();
		  $cylinders=$this->Purchase_model->get_boughtGas();
		  $gasin=0;
		  
		  foreach($cylinders->result() as $c) {
			  
			   if( $c->itemname=='Small Cylinder')
			  {
			  $gasin+=$c->prem*150;
			  }
			  
			   if( $c->itemname=='Big Cylinder')
			  {
			  $gasin+=$c->prem*300;
			  }
			  
			  
		  }
		  

          $data = array();

          foreach($books->result() as $r) {
			  
			  $broughtballoon=$r->prem;
			  $remballoon=$r->rem;
			   $srem=$r->srem;
			   $item=$r->itemname;
			   
			  if( $r->itemname=='Inflated Balloons')
			  {
				  $item="GAS";
			  $broughtballoon=($gasin/150).' Small cylinder';
			 // $remballoon=(($gasin-$r->srem-$r->sprem)/150).' Small cylinder';
			   $remballoon=(($gasin-$r->srem-$r->sprem)).' Ballons';
			  // $srem=($r->srem/150).' Small cylinder';
			   $srem=($r->srem).' Ballons';
			  }
			  
			  if( $r->itemname=='Empty Balloons')
			  {
			  $srem=$Eballons[0]['brem'];
			  $remballoon=$r->prem-(int)$Eballons[0]['brem'];
			  }
			  
			  

               $data[] = array(
                     $item,
                   // $r->bp,
                  //  $r->sp,
					$broughtballoon,
					$srem,
					$r->sprem,
					$remballoon
                    
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
		
		
		
		
		
	
}
?>