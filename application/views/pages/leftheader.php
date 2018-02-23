
 
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
            

<!--

<div class="span1 linksc">

<p class="btn btn-large btn-theme"  style="background:#F0F;" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>

<a class="btn btn-info" style="background:#F0F;" href="<?php echo base_url(); ?>/home">Make sale</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/sales">Made sales</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addstock">Receive stock</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/stocklist">Received stock</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/stockremlist">Remaining items in stock</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/itemslist">Items list</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/additem">Add item</a>
<a class="btn btn-info" style="background:#F0F;"  style="background:#F0F;"  href="<?php echo base_url(); ?>/addspoilt">Add spoilt</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/stockreceipts">Stock receipts</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/listreceipts">Sales receipts</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/purchaseorder">Make order</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/poreceipts">Order receipts</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addcategory">Add category</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/categorylist">Category list</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/reports">Reports</a>
<a class="btn btn-info" style="background:#F0F;"  target="_blank" href="<?php echo base_url(); ?>/endofday">End of day sales</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/reportsummary">Custom report</a>
<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/profile">Profile</a>


<a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/logout">Logout</a>


</div>
-->

<div class="span12"> 








   