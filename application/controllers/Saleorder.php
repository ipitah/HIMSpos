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
   			 $this->SetFont('Arial','',6);
   			 // Move to the right
   				
				$this->Cell(80,2,'Tel : +254 791 084 712',0,1,'R');
				$this->Cell(80,2,'Tel : +254 737 864 718',0,1,'R');
				
				$this->Cell(80,2,'P.O Box 1688-00200',0,1,'R');
				$this->Cell(80,2,'Email: info@helliumballoonco.com',0,1,'R');
				$this->Cell(80,2,'Web: www.helliumballoonco.com',0,1,'R');
				$this->Cell(80,2,'Fb: hellium balloon co',0,1,'R');
				
   				// $this->Cell(100,5,'Heliums Inventory Management System(HIMS)',0,1,'C');
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




class Saleorder extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Sale_model');
	}	
	
	
	
	function index($delivery)
	{	
	

	$delivery=rand(100, 1000)."PS".Date("Y").Date("m").Date("d");
	$namec="";
	$tot=0;
	$receipt="SO".$delivery;
	$delivery='SD'.$delivery;
	////////////////////////////////PDF
	 $pagesize = array(100, 150);
				
			$pdf = new PDF( 'P', 'mm', $pagesize );

			//$pdf=new FPDF();
			//var_dump(get_class_methods($pdf));

			$pdf->AddPage();
			
			
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'DELIVERY NOTE',0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'No.  #'.$delivery,0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
			$pdf->Cell(0,5,'Date .............................',0,1,'L');
			$pdf->Cell(0,5,'Balloons and other materials received by ...........................................................................',0,1,'L');
			$pdf->Cell(0,5,'Time of delivery .........................................................',0,1,'L');

		//	$pdf->SetFont('Arial','','8');  // SetFont('family','Type','Size');

		//	$pdf->Cell(0,3,'P.O Box 15280-00100 Nairobi-Kenya',0,1,'C');
			
			$pdf->SetFont('Times','','11');
			
			if($this->input->post("psupplier")!="")
			{
			$cname['records']= $this->Sale_model->get_customer($this->input->post("psupplier"));
			$pdf->Cell(0,3,"Customer Name :   ".$cname['records'][0]['cname'],0,1,'L');
			$namec=(String)$cname['records'][0]['cname'];
			}
			
			
			
			
			//$pdf->Cell(20,5,'',0,1,'C');
	
	//$pdf->Cell(0,5,'Item   Qty Sp Total',1,1,'C');
	
	$pdf->Cell(100,5,'Particulars table',0,1,'L');
	$pdf->SetFont('','U');
	//$pdf->Cell(0,5,'#'.$receipt,0,1,'C');
	$pdf->SetFont('','');
	$pdf->Cell(20,3,'',0,1,'C');
	$pdf->SetFont('','B');
	     $pdf->Cell(60,8,'Particular',1,0,'C');
		
		$pdf->Cell(20,8,'Qty',1,1,'C');
		//$pdf->Cell(20,15,'Sp',1,0,'C');
		//$pdf->Cell(20,15,'Total',1,1,'C');
	
	$pdf->SetFont('','');
	
	
	$customer= $this->Sale_model->get_customers();
	$result= $this->Sale_model->get_remainingitems();
	$Eballons=$this->Sale_model->get_usedballoons();
	$remballoon=(int)$Eballons[0]['brem'];
	$boughtGas=$this->Sale_model->get_boughtGas();
		
		
		 $page="Add Sale";
						  
		
	
	
	
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
		
						  
		$data = array('title' => $page, 'boughtGas'=>$boughtGas, 'brem'=>$remballoon, "items"=>$result,"customer" =>$customer, 'countItems' =>$countItems,"itemids"=>$items,"quntitys"=>$quantity,"buyingp"=>$bp);
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addsaleorder');	
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
		$itemna['records']= $this->Sale_model->get_item($this->input->post("pitemid".$i));
		$this->form_validation->set_rules('pitemid'.$i, 'Item', 'required|max_length[10]');			
		$this->form_validation->set_rules('pbp'.$i, 'Buying price', 'required|is_numeric|max_length[10]');					
		$this->form_validation->set_rules('pquantity'.$i, 'Quantity', 'required|is_numeric|max_length[5]');
		
		$pdf->Cell(60,5,$itemna['records'][0]['itemname'],1,0,'C',$fill);
		
		$pdf->Cell(20,5,$this->input->post("pquantity".$i),1,1,'C',$fill);
	//	$pdf->Cell(20,5,$this->input->post("pbp".$i),1,0,'C',$fill);
	//	$pdf->Cell(20,5,$this->input->post("pquantity".$i)*$this->input->post("pbp".$i),1,1,'C',$fill);
		
		//$pdf->Cell(0,3,$this->input->post("pitemid".$i).'   '.$this->input->post("pquantity".$i).' '.$this->input->post("pbp".$i).' '.$this->input->post("pquantity".$i)*$this->input->post("pbp".$i),1,1,'C',0);
		
		array_push($mystarray, array(
                'sitemid' => $this->input->post("pitemid".$i),
                'squantity' => $this->input->post("pquantity".$i),
				 'sbp' => $this->input->post("pbp".$i),
				  'sreceipt' => $receipt,
				   'scustomer' => $this->input->post("psupplier"),
				    'scustomerdetails' => $namec,
					'stotal' => $this->input->post("pquantity".$i)*$this->input->post("pbp".$i),
					'sservedby' => $_SESSION['username'],
					'color' => $this->input->post("color"),
					'arrangement' => $this->input->post("arrangement"),
					'deliverydate' => $this->input->post("deliverydate"),
					'deliverytime' => $this->input->post("deliverytime"),
					'deliveryreceipt' => $delivery,
					'vat' => $this->input->post("vat"),
					'discreason' => $this->input->post("discreason"),
                'discount' => $this->input->post("discount")));
				$tot+=$this->input->post("pquantity".$i)*$this->input->post("pbp".$i);
		$fill = !$fill;
		$sc++;
		
	
	}
		
		}
		
		$this->form_validation->set_rules('arrangement', 'Balloon arrangement', '');
		$this->form_validation->set_rules('color', 'Ballon color', '');
		$this->form_validation->set_rules('deliverydate', 'Delivery date', '');
		$this->form_validation->set_rules('deliverytime', 'Delivery time', '');
		
		$this->form_validation->set_rules('discount', 'Discount', '');	
		$this->form_validation->set_rules('total', 'Total', 'required|is_numeric');	
		$this->form_validation->set_rules('vat', 'VAT.', 'required');	
		$this->form_validation->set_rules('psupplier', 'Customer ID', 'required');			
	//	$this->form_validation->set_rules('psupplierdetails', 'Customer description', 'max_length[300]');
		//$this->form_validation->set_rules('amountgiven', 'Amount given', 'required|is_numeric');	
		//$this->form_validation->set_rules('balance', 'Balance', 'required|is_numeric');	
		//$this->form_validation->set_rules('paymentmethod', 'Payment Method', 'required');
		//$this->form_validation->set_rules('process', 'Process', 'required');
		//if($this->input->post("paymentmethod")!="CASH")
	//	$this->form_validation->set_rules('transcno', '<small>If Bank, Receipt No. if MPESA, transacrion No. </small>', 'required');
		
		if($this->input->post("discount")!="")
		$this->form_validation->set_rules('discreason', '<small>If discount, state reason. </small>', 'required');
		
		/*
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
		*/
		
		$pdf->Cell(10,3,'',0,1,'L');
		
		$pdf->SetFont('Arial','',6);
	
		$pdf->Cell(30,3,'Payment settled',0,0,'L');
		$pdf->Cell(3,3,'',1,0,'L');
		$pdf->Cell(10,3,'Yes',0,0,'L');
		
		$pdf->Cell(3,3,'',1,0,'L');
		$pdf->Cell(10,3,'No',0,1,'L');
		
		$pdf->Cell(10,5,'Signature of the receiving person .......................................',0,1,'L');
		$pdf->Cell(20,3,'Delivered by ...........................................................................................',0,1,'L');
		$pdf->Cell(20,3,'Signature ..................................',0,1,'L');
		
		
	
		$pdf->SetFont('','');
		
		
		
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
	
	
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			 
						  
		$data = array('title' => $page, 'boughtGas'=>$boughtGas, 'brem'=>$remballoon, "items"=>$result,"customer" =>$customer, 'countItems' =>$countItems,"mess" =>"<p class='alert alert-danger'> Attend the following issues before saving </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addsaleorder');	
		  $this->load->view("template/footer");
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
				
			
			
			$form_data = $mystarray;
					
			// run insert model to write data to db
		
			if ($this->Sale_model->SaveOrder($form_data) == $sc) // the information has therefore been successfully saved in the db
			{
	//
				
			$pdf->SetFont('Arial','','6');
			
		//	$pdf->Cell(200,5,"Served by , ".$_SESSION['membername'],0,1,'C',0);
		
		
		
		//	$pdf->Cell(100,3,'Payment is done through Lipa na M-PESA, ',0,0,'R');
	$pdf->SetFont('','U');
	//$pdf->Cell(0,3,"No. 3G4523",0,1,'C');
	$pdf->SetFont('','');
		
		
		
			$pdf->Cell(30,3,'Served by, ',0,0,'L');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,$_SESSION['membername'],0,1,'L');
	$pdf->SetFont('','');
	
			
			
			// $pdf->Cell(200,5,"Printed on, ".date("F j, Y, H:i:s"),0,1,'C',0);
			 
			 $pdf->Cell(30,3,'Printed on, ',0,0,'L');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,date("F j, Y, H:i:s"),0,1,'L');
	$pdf->SetFont('','');
	
			 
   
  			 // $pdf -> output ('your_file_pdf.pdf','D');
      $pdf -> output ('receipts/no'.$delivery.'.pdf','F'); 
	  
	  
	  
	  function generateSaleorder($receipt,$cname,$cphone,$caddress,$color,$arrangement,$deliverydate,$deliverytime)
	{
		
		$pagesize = array(100, 150);
				
			$pdf = new PDF( 'P', 'mm', $pagesize );

			//$pdf=new FPDF();
			//var_dump(get_class_methods($pdf));

			$pdf->AddPage();
			
			$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'SALE ORDER',0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(0,5,'No. #'.$receipt,0,1,'L');
				 $pdf->SetFont('Arial','',6);
			
			$pdf->SetFont('Times','','11');
			
			$pdf->Cell(20,5,'',0,1,'C');
			
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(100,5,'Name of the person placing order '.$cname,0,1,'L');
			$pdf->Cell(100,5,'Contact Number                   '.$cphone,0,1,'L');
			$pdf->Cell(100,5,'Balloon Color                    '.$color,0,1,'L');
			$pdf->Cell(100,5,'Balloon arrangement              '.$arrangement,0,1,'L');
			$pdf->Cell(100,5,'Delivery date                    '.$deliverydate,0,1,'L');
			$pdf->Cell(100,5,'Delivery time                    '.$deliverytime,0,1,'L');
			$pdf->Cell(100,5,'Delivery location & description  '.$caddress,0,1,'L');
			
			
			
			$pdf->SetFont('Arial','',6);
			
			$pdf->Cell(20,3,'',0,1,'C');
			
			$pdf->Cell(30,3,'Served by, ',0,0,'L');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,$_SESSION['membername'],0,1,'L');
	$pdf->SetFont('','');
	
			
			
			// $pdf->Cell(200,5,"Printed on, ".date("F j, Y, H:i:s"),0,1,'C',0);
			 
			 $pdf->Cell(30,3,'Printed on, ',0,0,'L');
	$pdf->SetFont('','U');
	$pdf->Cell(0,3,date("F j, Y, H:i:s"),0,1,'L');
	$pdf->SetFont('','');
	
			 
   
  			 // $pdf -> output ('your_file_pdf.pdf','D');
      $pdf -> output ('receipts/no'.$receipt.'.pdf','F'); 
		
		
		
		
	}
	
				
				
			generateSaleorder($receipt,$cname['records'][0]['cname'],$cname['records'][0]['cphone'],$cname['records'][0]['caddress'],$this->input->post("color"),$this->input->post("arrangement"),$this->input->post("deliverydate"),$this->input->post("deliverytime"));
		 
						  
		$data = array('title' => $page, 'boughtGas'=>$boughtGas, 'brem'=>$remballoon, "items"=>$result,"customer" =>$customer, 'countItems' =>2,"mess" =>"<p class='alert alert-success'> Data successfully saved <a class='btn btn-success' href='".base_url().'receipts/no'.$receipt.'.pdf'."' target='_blank' >Download sale order</a>  <a class='btn btn-success' href='".base_url().'receipts/no'.$delivery.'.pdf'."' target='_blank' >Download delivery note</a> </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addsaleorder');	
		  $this->load->view("template/footer");
		  
		  
			}
			else
			{
				
			
		
		
		
						  
		$data = array('title' => $page, 'boughtGas'=>$boughtGas, 'brem'=>$remballoon, "items"=>$result,"customer" =>$customer, 'countItems' =>2,"mess" =>"<p class='alert alert-danger'> Some errors occurred during saving!! </p>");
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addsaleorder');	
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
		$result= $this->Sale_model->get_remainingitems();
		$customer= $this->Sale_model->get_customers();
		$Eballons=$this->Sale_model->get_usedballoons();
	$remballoon=(int)$Eballons[0]['brem'];
	$boughtGas=$this->Sale_model->get_boughtGas();
		
	$page="Add Sale";
						  
		$data = array('title' => $page, 'boughtGas'=>$boughtGas, 'brem'=>$remballoon, "items"=>$result,"customer" =>$customer,'countItems' =>2);
					
	  $pagesize = array(150, 150);



				


 			$pdf = new PDF( 'P', 'mm', $pagesize );

			//$pdf=new FPDF();
			//var_dump(get_class_methods($pdf));

			$pdf->AddPage();

			$pdf->SetFont('Arial','','8');  // SetFont('family','Type','Size');

			$pdf->Cell(0,3,'P.O Box 24814-00502 Karen-Nairobi',0,1,'C');
			
			 $pdf->Cell(80,5,"Printed on, ".date("F j, Y, H:i:s"),0,1,'C',0);
   
  			 // $pdf -> output ('your_file_pdf.pdf','D');
      $pdf -> output ('receipts/your_file_pdf.pdf','F'); 
						 
						 
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/addsaleorder');	
		  $this->load->view("template/footer");
		
		 
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}








?>