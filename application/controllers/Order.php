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
	 //   $this->Image(base_url().'/images/footer.png',40);
    
   $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
}


}




class Order extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Order_model');
	}	
	function index()
	{	
	$tot=0;
	$receipt="PO".rand(100, 1000)."PS".Date("Y").Date("m").Date("d");
	$namec="";
	////////////////////////////////PDF
	 $pagesize = array(150, 150);
				
			$pdf = new PDF( 'P', 'mm', $pagesize );

			//$pdf=new FPDF();
			//var_dump(get_class_methods($pdf));

			$pdf->AddPage();

			$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'SALE',0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'No.  #'.$receipt,0,1,'L');
				 $pdf->SetFont('Times','',8);
			
			if($this->input->post("psupplier")!="")
			{
			$cname['records']= $this->Order_model->get_supplier($this->input->post("psupplier"));
			$pdf->Cell(0,3,"Supplier name :   ".$cname['records'][0]['cname'],1,1,'C');
			$namec=(String)$cname['records'][0]['cname'];
			}
	
	$pdf->Cell(20,5,'',0,1,'C');
	//$pdf->Cell(0,5,'Item   Qty Sp Total',1,1,'C');
	
             $pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'PURCHASE ORDER',0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'No.  #'.$receipt,0,1,'L');
				 $pdf->SetFont('Times','',8);
		
		$pdf->Cell(10,10,'Qty',1,0,'C');
		$pdf->Cell(20,10,'Sp',1,0,'C');
		$pdf->Cell(20,10,'Total',1,1,'C');
	
	$pdf->SetFont('','');
	
	
	$customer= $this->Order_model->get_suppliers();
	$result= $this->Order_model->get_itemspurchased();
		
		
		
		 $page="Purchase order";
						  
		
	
	
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
		
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>$countItems,"itemids"=>$items,"quntitys"=>$quantity,"buyingp"=>$bp);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/purchaseorder');	
		  $this->load->view("template/footer");
		  return;
  }   
	$sc=0;
	$mystarray=array();
	
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
   
    // Data
    $fill = true;
			
			
	for($i=1; $i<= $countItems ; $i++)
		{
			
	$sel=$this->input->post("pitemid".$i);
	if($sel!=0 && $sel!="" && $sel!="0")
	{
		$itemna['records']= $this->Order_model->get_item($this->input->post("pitemid".$i));
		$this->form_validation->set_rules('pitemid'.$i, 'Item', 'required|max_length[10]');			
		$this->form_validation->set_rules('pbp'.$i, 'Buying price', 'required|is_numeric|max_length[10]');					
		$this->form_validation->set_rules('pquantity'.$i, 'Quantity', 'required|is_numeric|max_length[5]');
		
		$pdf->Cell(80,5,$itemna['records'][0]['itemname'],1,0,'C',$fill);
		
		$pdf->Cell(10,5,$this->input->post("pquantity".$i),1,0,'C',$fill);
		$pdf->Cell(20,5,$this->input->post("pbp".$i),1,0,'C',$fill);
		$pdf->Cell(20,5,$this->input->post("pquantity".$i)*$this->input->post("pbp".$i),1,1,'C',$fill);
		
		//$pdf->Cell(0,3,$this->input->post("pitemid".$i).'   '.$this->input->post("pquantity".$i).' '.$this->input->post("pbp".$i).' '.$this->input->post("pquantity".$i)*$this->input->post("pbp".$i),1,1,'C',0);
		
		array_push($mystarray, array(
                'pitemid' => $this->input->post("pitemid".$i),
                'pquantity' => $this->input->post("pquantity".$i),
				 'pbp' => $this->input->post("pbp".$i),
				  'preceipt' => $receipt,
				   'psupplier' => $this->input->post("psupplier"),
				    'psupplierdetails' => $namec,
					'total' => $this->input->post("pquantity".$i)*$this->input->post("pbp".$i),
					'pservedby' => $_SESSION['username']
					));
				$tot+=$this->input->post("pquantity".$i)*$this->input->post("pbp".$i);
		$fill = !$fill;
		$sc++;
		
		
	}
		
		}
		
		
		
		$this->form_validation->set_rules('total', 'Total', 'required|is_numeric');	
		//$this->form_validation->set_rules('preceipt', 'RECEIPT NO.', 'required');	
		$this->form_validation->set_rules('psupplier', 'Supplier ID', 'required');			
		//$this->form_validation->set_rules('psupplierdetails', 'Supplier description', 'max_length[300]');
		
		$pdf->SetFont('','B');
		
		$fill = !$fill;
		$pdf->Cell(80,5,'',1,0,'C',$fill);
		
		$pdf->Cell(10,5,'',1,0,'C',$fill);
		$pdf->Cell(20,5,'TOTAL',1,0,'C',$fill);
		$pdf->Cell(20,5,$tot,1,1,'C',$fill);
		
		
		$pdf->SetFont('','');
		
		
		
		
		
		
		
		
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
	
	
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			 
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>$countItems,"mess" =>"<p class='alert alert-danger'> Attend the following issues before saving </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/purchaseorder');	
		  $this->load->view("template/footer");
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = $mystarray;
					
			// run insert model to write data to db
		
			if ($this->Order_model->SaveForm($form_data) == $sc) // the information has therefore been successfully saved in the db
			{
				
				
			$pdf->SetFont('Arial','','8');
			
		//	$pdf->Cell(200,5,"Served by , ".$_SESSION['membername'],0,1,'C',0);
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
      $pdf -> output ('receipts/'.$receipt.'.pdf','F'); 
				
				
				
				
				
				
				
				
				
				
				
				
		
		
		 
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>2,"mess" =>"<p class='alert alert-success'> Data successfully saved <a class='btn btn-success' href='".base_url().'receipts/'.$receipt.'.pdf'."' target='_blank' >Download Receipt</a> </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/purchaseorder');	
		  $this->load->view("template/footer");
		  
		  
			}
			else
			{
				
			
		
		
		
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>2,"mess" =>"<p class='alert alert-danger'> Some errors occurred during saving!! </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/purchaseorder');	
		  $this->load->view("template/footer");
		  
			}
		}
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
	
	
	public function create_pdf(){
      define('FPDF_FONTPATH',APPPATH .'plugins/font/');
      require(APPPATH .'plugins/fpdf.php');
    
      $pdf = new FPDF('p','mm','A4');
      $pdf -> AddPage();
    
      $pdf -> setDisplayMode ('fullpage');
    
      $pdf -> setFont ('times','B',20);
      $pdf -> cell(200,30,"Title",0,1);
    
      $pdf -> setFont ('times','B','20');
      $pdf -> write (10,"Description");
    
      $pdf -> output ('your_file_pdf.pdf','D');    
  }
	
	
	
	public function load()
	{
		$result= $this->Order_model->get_itemspurchased();
		$customer= $this->Order_model->get_suppliers();
		
		 $page="Purchase order";
						  
		$data = array('title' => $page,"customer" =>$customer, "items"=>$result, 'countItems' =>2);
					 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/purchaseorder');	
		  $this->load->view("template/footer");
		
		 
	}
	
	
}








?>