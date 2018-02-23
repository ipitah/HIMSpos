<?php
	 define('FPDF_FONTPATH',APPPATH .'plugins/font/');
      require(APPPATH .'plugins/fpdf.php');
    
      ///////////////////////

class PDF extends FPDF
				{
					
			function Header()
				{
   				 // Logo
   			 $this->Image(base_url().'/images/image.jpg',60);
   			 // Arial bold 15
   			 $this->SetFont('Arial','B',14);
   			 // Move to the right
   				 $this->Cell(10);
    			// Title
   				 $this->Cell(100,5,'Heliums Inventory Management System(HIMS)',0,1,'C');
    			// Line break
    			$this->Ln(5);
				}

				// Page footer
				function Footer()
				{
	    $this->Image(base_url().'/images/footer.png',40);
    
   $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
}


}




class Finalisesale extends CI_Controller {
               
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
	$proc="RECEIPTED";
	$rno="Receipt";
	$namec="";
	$tot=0;
	$receipt="S".rand(100, 1000)."PS".Date("Y").Date("m").Date("d");
	
	////////////////////////////////PDF
	 $pagesize = array(150, 150);
				
			$pdf = new PDF( 'P', 'mm', $pagesize );

			//$pdf=new FPDF();
			//var_dump(get_class_methods($pdf));

			$pdf->AddPage();

			$pdf->SetFont('Arial','','8');  // SetFont('family','Type','Size');

			$pdf->Cell(0,3,'P.O Box 15280-00100 Nairobi-Kenya',0,1,'C');
			
			$pdf->SetFont('Times','','11');
			
			$pdf->Cell(20,5,'',0,1,'C');
			
			if($this->input->post("psupplier")!="")
			{
			$cname['records']= $this->Sale_model->get_customer($this->input->post("psupplier"));
			$pdf->Cell(0,3,"Customer Name :   ".$cname['records'][0]['cname'],0,1,'C');
			$namec=(String)$cname['records'][0]['cname'];
			}
			
						
			
			
			$pdf->Cell(20,5,'',0,1,'C');
	
	//$pdf->Cell(0,5,'Item   Qty Sp Total',1,1,'C');
	
	$pdf->Cell(100,5,$rno.' No.',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,5,'#'.$receipt,0,1,'C');
	$pdf->SetFont('','');
	$pdf->Cell(20,3,'',0,1,'C');
	$pdf->SetFont('','B');
	     $pdf->Cell(80,15,'Item name',1,0,'C');
		
		$pdf->Cell(10,15,'Qty',1,0,'C');
		$pdf->Cell(20,15,'Sp',1,0,'C');
		$pdf->Cell(20,15,'Total',1,1,'C');
	
	$pdf->SetFont('','');
	
	
	
		
		
	
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
   
    // Data
    $fill = true;
			
			$books= $this->Sale_model->get_soldItems($this->input->post("id"));
			
	foreach($books->result() as $r) {
		
		$pdf->Cell(80,5,$r->itemname,1,0,'C',$fill);
		$tot+=$r->squantity*$r->sbp;
		$pdf->Cell(10,5,$r->squantity,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->sbp,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->squantity*$r->sbp,1,1,'C',$fill);
		
		
		}
		
		$this->form_validation->set_rules('id', 'ID.', 'required');
		$this->form_validation->set_rules('discount', 'Discount', '');	
		$this->form_validation->set_rules('total', 'Total', 'required|is_numeric');	
		$this->form_validation->set_rules('vat', 'VAT.', 'required');	
		$this->form_validation->set_rules('psupplier', 'Customer ID', 'required');			
	//	$this->form_validation->set_rules('psupplierdetails', 'Customer description', 'max_length[300]');
	if($this->input->post("process")!="CANCELED")
	{
		$this->form_validation->set_rules('amountgiven', 'Amount given', 'required|is_numeric');	
		$this->form_validation->set_rules('balance', 'Balance', 'required|is_numeric');	
	}
		if($this->input->post("process")!="CANCELED")
		$this->form_validation->set_rules('paymentmethod', 'Payment Method', 'required');
		$this->form_validation->set_rules('process', 'Process', 'required');
		
		if($this->input->post("paymentmethod")!="CASH" && $this->input->post("process")!="CANCELED")
		$this->form_validation->set_rules('transcno', '<small>If Bank, Receipt No. if MPESA, transacrion No. </small>', 'required');
		
		if($this->input->post("discount")!="")
		$this->form_validation->set_rules('discreason', '<small>If discount, state reason. </small>', 'required');
		
		
		$pdf->SetFont('','B');
		$fill = !$fill;
		$pdf->Cell(80,5,'Discount',1,0,'C',$fill);
		
		$pdf->Cell(10,5,$this->input->post("discount"),1,0,'C',$fill);
		$pdf->Cell(20,5,'VAT',1,0,'C',$fill);
		$pdf->Cell(20,5,$this->input->post("vat"),1,1,'C',$fill);
		
		$fill = !$fill;
		$pdf->Cell(80,5,'TOTAL',1,0,'C',$fill);
		
		$pdf->Cell(10,5,$tot,1,0,'C',$fill);
		$pdf->Cell(20,5,'Net amount',1,0,'C',$fill);
		$pdf->Cell(20,5,$this->input->post("netTotal"),1,1,'C',$fill);
		
		$fill = !$fill;
		$pdf->Cell(80,5,'Amount received',1,0,'C',$fill);
		
		$pdf->Cell(10,5,$this->input->post("amountgiven"),1,0,'C',$fill);
		$pdf->Cell(20,5,'Balance',1,0,'C',$fill);
		$pdf->Cell(20,5,$this->input->post("balance"),1,1,'C',$fill);
		
		$pdf->SetFont('','');
		
		
		
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
	
	
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			 $page="Finalise sale";
						  
		$data = array('title' => $page,"mess" =>"<p class='alert alert-danger'> Attend the following issues before saving </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/finalisesale');	
		  $this->load->view("template/footer");
		}
		else // passed validation proceed to post success logic
		{
			
			$form_data = array(
					       	'samountgiven' => set_value('amountgiven'),
					       	'discount' => set_value('discount'),
					       	'sbalance' => set_value('balance'),
					       	'vat' => set_value('vat'),
							'status' => set_value('process'),
							'spaymentmethod' => set_value('paymentmethod'),
					       	'stranscno' => set_value('transcno'),
							'discreason' => set_value('discreason'),
							 'sreceipt' => $receipt,
							'sservedby' => $_SESSION['username']
						);
			
			
					
			// run insert model to write data to db
		
			if ($this->Sale_model->UpdateFinalise($this->input->post("id"),$form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				
				
			$pdf->SetFont('Arial','','8');
			
		//	$pdf->Cell(200,5,"Served by , ".$_SESSION['membername'],0,1,'C',0);
		$pdf->Cell(20,3,'',0,1,'C');
		
		if($this->input->post("process")=="CANCELED")
		{
			$pdf->Cell(100,3,'Payment , ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,"Canceled",0,1,'C');
	$pdf->SetFont('','');
		}
		
		else
		{
			$pdf->Cell(100,3,'Fully paid through, ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,$this->input->post("paymentmethod"),0,1,'C');
	$pdf->SetFont('','');
		}
		
			$pdf->Cell(20,3,'',0,1,'C');
			
			$pdf->Cell(100,3,'Served by, ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,$_SESSION['membername'],0,1,'C');
	$pdf->SetFont('','');
	
			
			
			// $pdf->Cell(200,5,"Printed on, ".date("F j, Y, H:i:s"),0,1,'C',0);
			 
			 $pdf->Cell(100,3,'Printed on, ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,date("F j, Y, H:i:s"),0,1,'C');
	$pdf->SetFont('','');
	
			 
   
  			 // $pdf -> output ('your_file_pdf.pdf','D');
      $pdf -> output ('receipts/no'.$receipt.'.pdf','F'); 
				
				
			
		 	$page="Invoiced sales";
						  
		$data = array('title' => $page,"mess" =>"<p class='alert alert-success'> Sale successfully finalised <a class='btn btn-success' href='".base_url().'receipts/no'.$receipt.'.pdf'."' target='_blank' >Download ".$rno."</a> </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/invoicereceipts');	
		  $this->load->view("template/footer");
		  
		  
			}
			else
			{
				
			
		
		$page="Finalise sale";
		
						  
		$data = array('title' => $page,"mess" =>"<p class='alert alert-danger'> Some errors occurred during finalising!! </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/finalisesale');	
		  $this->load->view("template/footer");
		  
			}
		}
	}
	
	
	
	
	
}







?>