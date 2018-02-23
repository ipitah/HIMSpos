
 
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
if($_SESSION['group']!="ADMIN")
{
	$page="Home";
	$data = array('title' => $page, "mess" =>"<p class='alert alert-warning'> Only ADMIN can perform that action </p>");
		
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view('pages/home');	
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




<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'categoryform', 'id' => 'categoryform');
echo form_open('category', $attributes); ?>


<?php if(isset($mess)) echo $mess; else echo ""; ?>

<p>
<a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/spoilt_items/spoilt items">Delete all spoilt items</a>
</p>



<p>
 <a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/purchase/purchases">Delete all purchases</a>
</p>


<p>
<a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/purchase_order/purchase orders">Delete all purchase_orders</a>
</p>



<p>
 <a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/sale/sales">Delete all sales</a>
</p>

<p>
<a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/sale_order/sale orders">Delete all sale orders</a>
</p>





<p>
<a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/supplier/suppliers">Delete all suppliers</a>
</p>


<p>
 <a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/customer/customers">Delete all customers</a>
</p>


<p>
<a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/items/items">Delete all items</a>
</p>

<p>
<a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/category/categories">Delete all categories</a>
</p>





<p>
<a class='btn btn-large btn-danger' href="<?php echo base_url(); ?>/batch_delete/delete/staff/staffs">Delete all staffs</a>
</p>



<?php echo form_close(); ?>












</div>











</div>

</div>
<!-- end container -->
</section>

   