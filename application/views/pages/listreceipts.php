 
  
<?php

 if(!isset($_SESSION['username']))
{
	
		$data["title"]="Login";
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/login');	
		  $this->load->view("template/footer");
		  die();	
		 
		  
}
else
?>
 
 
 
 
 
 
 
<!-- spacer section -->
<section class="spacer green">
<div class="container">
	<div class="row">
		<div class="span12  flyUp">
        
			<h2 class="alignright"><small>User: <?php echo '<a href="#">'.$_SESSION['membername'].'</a>'; ?></small></h2>
			<h2 class="alignleft"><u>HIMS|<?php echo $title; ?> </u></h2>
            
		</div>
	</div>
</div>
</section>
<!-- end spacer section -->
<!-- section: team -->
<section id="maincontent" class="inner">
<div class="container">
	<div class="row">
            



<div class="span12"> 



 
 
 
 
 <?php


if(isset($mess)) 
 echo $mess;

?>



<table id="salereceipt-table" class="table table-bordered table-striped table-hover" >
<thead >
<tr><td>CUSTOMER</td><td>DESCRIPTION</td><td>Amount given</td><td>TOT</td><td>Discount</td><td>Discount reason</td><td>VAT</td><td>TOT received</td><td>Balance</td><td>Payment Method</td><td>Transaction No.</td><td>RECEIPT</td><td>STAFF</td></tr>
</thead >
<tbody >
</tbody>
</table>



<button type="button" onclick="printJS('salereceipt-table', 'html')" class='btn btn-small btn-success form-control'>
    Print sales receipts 
 </button>
 <small> NB. Use google chrome to pre-view it. </small>




</div>











</div>

</div>
<!-- end container -->
</section>

   