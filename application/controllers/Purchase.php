<?php

class Purchase extends CI_Controller {
               
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
	
	$namec="";
	if($this->input->post("psupplier")!="")
			{
			$cname['records']= $this->Purchase_model->get_supplier($this->input->post("psupplier"));
			$namec=(String)$cname['records'][0]['cname'];
			}
	
	$customer= $this->Purchase_model->get_suppliers();
	
	
	$countItems=$this->input->post("countItems");
	
	$countItems=(int)$countItems;
		$items=array(); $bp=array(); $quantity=array();
		for($i=1; $i<= ($countItems+5) ; $i++)
		{
		$items[$i]=	$this->input->post("pitemid".$i);
		$quantity[$i]=$this->input->post("pquantity".$i);
		$bp[$i]=$this->input->post("pbp".$i);
		}
	
	if(isset($_POST["addmore"])){
		$countItems=$countItems+5;
		$result= $this->Purchase_model->get_contents();
		
		
		 $page="Add Stock";
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>$countItems,"itemids"=>$items,"quntitys"=>$quantity,"buyingp"=>$bp);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addstockpage');	
		  $this->load->view("template/footer");
		  return;
  }   
	$sc=0;
	$mystarray=array();
	
	
	for($i=1; $i<= $countItems ; $i++)
		{
			
	$sel=$this->input->post("pitemid".$i);
	if($sel!=0 && $sel!="" && $sel!="0")
	{
		
		$this->form_validation->set_rules('pitemid'.$i, 'Item', 'required|max_length[10]');			
		$this->form_validation->set_rules('pbp'.$i, 'Buying price', 'required|is_numeric|max_length[10]');					
		$this->form_validation->set_rules('pquantity'.$i, 'Quantity', 'required|is_numeric|max_length[5]');
		
		
		array_push($mystarray, array(
                'pitemid' => $this->input->post("pitemid".$i),
                'pquantity' => $this->input->post("pquantity".$i),
				 'pbp' => $this->input->post("pbp".$i),
				  'preceipt' => $this->input->post("preceipt"),
				   'psupplier' => $this->input->post("psupplier"),
				    'psupplierdetails' => $namec,
					'total' => $this->input->post("pquantity".$i)*$this->input->post("pbp".$i),
					'pservedby' => $_SESSION['username'],
                'discount' => $this->input->post("discount")));
		
		$sc++;
		
		
	}
		
		}
		
		
		$this->form_validation->set_rules('discount', 'Discount', '');	
		$this->form_validation->set_rules('total', 'Total', 'required|is_numeric');	
		$this->form_validation->set_rules('preceipt', 'RECEIPT NO.', 'required');	
		$this->form_validation->set_rules('psupplier', 'Supplier ID', 'required');			
		//$this->form_validation->set_rules('psupplierdetails', 'Supplier description', 'max_length[300]');
		
		
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
	
	
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$result= $this->Purchase_model->get_contents();
			 $page="Add Stock";
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>$countItems,"mess" =>"<p class='alert alert-danger'> Attend the following issues before saving </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addstockpage');	
		  $this->load->view("template/footer");
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = $mystarray;
					
			// run insert model to write data to db
		
			if ($this->Purchase_model->SaveForm($form_data) == $sc) // the information has therefore been successfully saved in the db
			{
				$result= $this->Purchase_model->get_contents();
		
		
		 $page="Add Stock";
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>2,"mess" =>"<p class='alert alert-success'> Data successfully saved </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addstockpage');	
		  $this->load->view("template/footer");
		  
		  
			}
			else
			{
				
			$result= $this->Purchase_model->get_contents();
		
		
		 $page="Add Stock";
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>2,"mess" =>"<p class='alert alert-danger'> Some errors occurred during saving!! </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addstockpage');	
		  $this->load->view("template/footer");
		  
			}
		}
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
	
	
	public function load()
	{
		$result= $this->Purchase_model->get_contents();
		$customer= $this->Purchase_model->get_suppliers();
		
		
		 $page="Add Stock";
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>2);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addstockpage');	
		  $this->load->view("template/footer");
		
		
	}
	
	
	
	public function loadmore($countItems)
	{
		$countItems=(int)$countItems+5;
		
		$result= $this->Purchase_model->get_contents();
		$customer= $this->Purchase_model->get_suppliers();
		
		
		 $page="Add Stock";
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>$countItems);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addstockpage');	
		  $this->load->view("template/footer");
		
		
	}
	
}
?>