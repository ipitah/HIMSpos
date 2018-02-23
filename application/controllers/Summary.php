<?php
	 define('FPDF_FONTPATH',APPPATH .'plugins/font/');
      require(APPPATH .'plugins/fpdf.php');
    
      ///////////////////////

class PDF extends FPDF
				{
					
			function Header()
				{
   				 // Logo
   			 $this->Image(base_url().'/images/image.jpg',100);
   			 // Arial bold 15
   			// $this->SetFont('Arial','B',14);
   			 // Move to the right
   			//	 $this->Cell(10);
    			// Title
   			//	 $this->Cell(100,5,'Heliums Inventory Management System(HIMS)',0,1,'C');
    			// Line break
				
				 $this->SetFont('Arial','',6);
   			 // Move to the right
   				
				$this->Cell(120,2,'Tel : +254 791 084 712',0,1,'R');
				$this->Cell(120,2,'Tel : +254 737 864 718',0,1,'R');
				
				$this->Cell(120,2,'P.O Box 1688-00200',0,1,'R');
				$this->Cell(120,2,'Email: info@helliumballoonco.com',0,1,'R');
				$this->Cell(120,2,'Web: www.helliumballoonco.com',0,1,'R');
				$this->Cell(120,2,'Fb: hellium balloon co',0,1,'R');
    			// Line break
    			$this->Ln(5);
				}

				// Page footer
				function Footer()
				{
	//    $this->Image(base_url().'/images/footer.png',40);
    
   $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
}


}




class Summary extends CI_Controller {
               
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
	
	
	
	$this->form_validation->set_rules('bigdate', 'FROM DATE', 'required|max_length[50]');
			$this->form_validation->set_rules('enddate', 'END DATE', 'required|max_length[50]');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$data=array("title" => "Custom summary", "mess" => "<p class='alert alert-danger'> Kindly fix the following errors and submit again</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/reportsummary");	
		  $this->load->view("template/footer");	
		}
		else // passed validation proceed to post success logic
		{
	
	$start=$this->input->post("bigdate");
	$stop=$this->input->post("enddate");
	
	
	
	
	$tot=0;
	$receipt="DS".rand(100, 1000)."PS".Date("Y").Date("m").Date("d");
	
	////////////////////////////////PDF
	 $pagesize = array(297, 210);
				
			$pdf = new PDF( 'P', 'mm', $pagesize );

			//$pdf=new FPDF();
			//var_dump(get_class_methods($pdf));

			$pdf->AddPage();

			$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'SALES ON '.date("F j, Y, H:i:s"),0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'No.  #'.$receipt,0,1,'L');
				
	   
		$pdf->SetFont('Times','','6');
		
		$pdf->Cell(7,5,'SNO.',1,0,'C');
				  
		 $pdf->Cell(8,5,'REF NO.',1,0,'C');
		
		$pdf->Cell(30,5,'ITEM',1,0,'C');
		$pdf->Cell(8,5,'SP',1,0,'C');
		$pdf->Cell(8,5,'QTY',1,0,'C');
		$pdf->Cell(8,5,'PAID',1,0,'C');
		$pdf->Cell(8,5,'TOTAL',1,0,'C');
	//	$pdf->Cell(8,5,'DISC',1,0,'C');
	//	$pdf->Cell(8,5,'BAL',1,0,'C');
		$pdf->Cell(20,5,'PAY MODE',1,0,'C');
		$pdf->Cell(20,5,'TRANS. NO',1,0,'C');
		$pdf->Cell(15,5,'STATUS',1,0,'C');
		$pdf->Cell(20,5,'RECEIPT',1,0,'C');
		$pdf->Cell(20,5,'CUSTOMER',1,0,'C');
		$pdf->Cell(25,5,'STAFF',1,1,'C');
		
		
		
		
		
		
	
	$pdf->SetFont('','');
	
	$result= $this->Sale_model->customdaysales($start,$stop);
		
	
	
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
   
    // Data
	$c=0;
	$tot=0;
    $fill = true;
			
			
			  foreach($result->result() as $r) {
				  $c++;
				  $pdf->Cell(7,5,$c,1,0,'C',$fill);
				  
		 $pdf->Cell(8,5,$r->saleid,1,0,'C',$fill);
		
		$pdf->Cell(30,5,$r->itemname,1,0,'C',$fill);
		$pdf->Cell(8,5,$r->sbp,1,0,'C',$fill);
		$pdf->Cell(8,5,$r->squantity,1,0,'C',$fill);
		$pdf->Cell(8,5,$r->samountgiven,1,0,'C',$fill);
		$pdf->Cell(8,5,$r->stotal,1,0,'C',$fill);
	//	$pdf->Cell(8,5,$r->discount,1,0,'C',$fill);
		//$pdf->Cell(8,5,$r->sbalance,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->spaymentmethod,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->stranscno,1,0,'C',$fill);
		$pdf->Cell(15,5,$r->status,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->sreceipt,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->scustomer,1,0,'C',$fill);
		$pdf->Cell(25,5,$r->fullname,1,1,'C',$fill);
		
		
		
				$tot+=$r->stotal;
		$fill = !$fill;
		
		
             
          }
			
		$pdf->SetFont('','B');
		
		
		
		$pdf->Cell(20,5,'',0,1,'C');
		$fill = true;
		$pdf->Cell(80,5,'TOTAL',0,0,'C',$fill);
		
		$pdf->Cell(10,5,$tot,0,0,'C',$fill);
		
		if( $result= $this->Sale_model->endofdayCustomComputation($start,$stop))
		{
			
			$dicount=0;
			$vat=0;
			 foreach($result->result() as $r) {
				$dicount+=$r->discount; 
				$vat+=$r->vat; 
			 }
			
		$pdf->Cell(20,5,'Discount',0,0,'C',$fill);
		$pdf->Cell(20,5,$dicount,0,1,'C',$fill);
		
		
		$pdf->Cell(80,5,'VAT',0,0,'C',$fill);
		
		$pdf->Cell(10,5,$vat,0,0,'C',$fill);
		
		$pdf->Cell(20,5,'NET TOTAL',1,0,'C',$fill);
		$pdf->Cell(20,5,$tot-$dicount-$vat,1,1,'C',$fill);
		}
		
		
		
		
		
		$pdf->SetFont('','');
		
		
			$pdf->SetFont('Arial','','8');
			
		//	$pdf->Cell(200,5,"Served by , ".$_SESSION['membername'],0,1,'C',0);
		$pdf->Cell(20,3,'',0,1,'C');
			
			$pdf->Cell(100,3,'Generated by, ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,$_SESSION['membername'],0,1,'C');
	$pdf->SetFont('','');
	
			
			
			// $pdf->Cell(200,5,"Printed on, ".date("F j, Y, H:i:s"),0,1,'C',0);
			 
			 $pdf->Cell(100,3,'Printed on, ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,date("F j, Y, H:i:s"),0,1,'C');
	$pdf->SetFont('','');
		
		
		
//////////////////////End Sales begin stock		
		
		
		
		
		
		
		$pdf->AddPage();

			
	$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'STOCK ON '.date("F j, Y, H:i:s"),0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'No.  #'.$receipt,0,1,'L');
	   
		$pdf->SetFont('Times','','6');
		
		$pdf->Cell(7,5,'SNO.',1,0,'C');
				  
		 $pdf->Cell(8,5,'REF NO.',1,0,'C');
		
		$pdf->Cell(30,5,'ITEM',1,0,'C');
		$pdf->Cell(8,5,'BP',1,0,'C');
		$pdf->Cell(8,5,'QTY',1,0,'C');
		//$pdf->Cell(8,5,'PAID',1,0,'C');
		$pdf->Cell(8,5,'TOTAL',1,0,'C');
		//$pdf->Cell(8,5,'DISC',1,0,'C');
		//$pdf->Cell(8,5,'BAL',1,0,'C');
		//$pdf->Cell(20,5,'PAY MODE',1,0,'C');
		//$pdf->Cell(20,5,'TRANS. NO',1,0,'C');
		$pdf->Cell(20,5,'RECEIPT',1,0,'C');
		$pdf->Cell(20,5,'CUSTOMER',1,0,'C');
		$pdf->Cell(25,5,'STAFF',1,1,'C');
		
		
		
		
		
		
	
	$pdf->SetFont('','');
	
	$result= $this->Sale_model->customdaystock($start,$stop);
		
	
	
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
   
    // Data
	$c=0;
	$tot=0;
    $fill = true;
			
			
			  foreach($result->result() as $r) {
				  $c++;
				  $pdf->Cell(7,5,$c,1,0,'C',$fill);
				  
		 $pdf->Cell(8,5,$r->purchaseid,1,0,'C',$fill);
		
		$pdf->Cell(30,5,$r->itemname,1,0,'C',$fill);
		$pdf->Cell(8,5,$r->pbp,1,0,'C',$fill);
		$pdf->Cell(8,5,$r->pquantity,1,0,'C',$fill);
	//	$pdf->Cell(8,5,$r->samountgiven,1,0,'C',$fill);
		$pdf->Cell(8,5,$r->total,1,0,'C',$fill);
		//$pdf->Cell(8,5,$r->discount,1,0,'C',$fill);
		//$pdf->Cell(8,5,$r->sbalance,1,0,'C',$fill);
	//	$pdf->Cell(20,5,$r->spaymentmethod,1,0,'C',$fill);
	//	$pdf->Cell(20,5,$r->stranscno,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->preceipt,1,0,'C',$fill);
		$pdf->Cell(20,5,$r->psupplier,1,0,'C',$fill);
		$pdf->Cell(25,5,$r->fullname,1,1,'C',$fill);
		
		
		
				$tot+=$r->total;
		$fill = !$fill;
		
		
             
          }
			
		$pdf->SetFont('','B');
		
		
		$pdf->Cell(20,5,'',0,1,'C');
		$fill = true;
		$pdf->Cell(80,5,'TOTAL',0,0,'C',$fill);
		
		$pdf->Cell(10,5,$tot,0,0,'C',$fill);
		
		if( $result= $this->Sale_model->endofdayCustomComputation2($start,$stop))
		{
			$dicount=0;
			 foreach($result->result() as $r) {
				$dicount+=$r->discount; 
			 }
			
			
		$pdf->Cell(20,5,'Discount',0,0,'C',$fill);
		$pdf->Cell(20,5,$dicount,0,1,'C',$fill);
		
		
		$pdf->Cell(80,5,'',0,0,'C',$fill);
		
		$pdf->Cell(10,5,'',0,0,'C',$fill);
		
		$pdf->Cell(20,5,'NET TOTAL',1,0,'C',$fill);
		$pdf->Cell(20,5,$tot-$dicount,1,1,'C',$fill);
		}
		
		
		
		
		$pdf->SetFont('','');
		
		
		
		
		
////////////////////////////////////End stock		
		
		
		
		
		
				
			$pdf->SetFont('Arial','','8');
			
		//	$pdf->Cell(200,5,"Served by , ".$_SESSION['membername'],0,1,'C',0);
		$pdf->Cell(20,3,'',0,1,'C');
			
			$pdf->Cell(100,3,'Generated by, ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,$_SESSION['membername'],0,1,'C');
	$pdf->SetFont('','');
	
			
			
			// $pdf->Cell(200,5,"Printed on, ".date("F j, Y, H:i:s"),0,1,'C',0);
			 
			 $pdf->Cell(100,3,'Printed on, ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,date("F j, Y, H:i:s"),0,1,'C');
	$pdf->SetFont('','');
	
			 
   
  			 // $pdf -> output ('your_file_pdf.pdf','D');
      $pdf -> output ('receipts/'.$receipt.'.pdf','D'); 
				
				
				
		}
				
				
		
		
	}
	
	
	
	
	
	
}

?>