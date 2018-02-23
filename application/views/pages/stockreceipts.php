
 
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



<table id="stockreceipt-table" class="table table-bordered table-striped table-hover" >
<thead >
<tr><td>Supplier</td><td>Description</td><td>Total charged</td><td>Discount</td><td>Total paid</td><td>Receipts</td><td>Staff</td><td>Delete</td></tr>
</thead >
<tbody >
</tbody>
</table>



<button type="button" onclick="printJS('stockreceipt-table', 'html')" class='btn btn-small btn-success form-control'>
    Print stock receipts 
 </button>
 <small> NB. Use google chrome to pre-view it. </small>




</div>











</div>

</div>
<!-- end container -->
</section>

   