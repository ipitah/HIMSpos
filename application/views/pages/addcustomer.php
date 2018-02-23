 
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






<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'additemform', 'id' => 'additemform');
echo form_open('add_customer', $attributes); ?>

<?php 
if(isset($mess)) echo $mess; else echo ""; 
?>

<p>
        <label for="itemname">ID NO./Passport <span class="required">*</span></label>
        <?php echo form_error('cid'); ?>
        <input id="cid" type="text" name="cid"  value="<?php echo set_value('cid'); ?>"  />
</p>

<p>
        <label for="cname">Full name <span class="required">*</span></label>
        <?php echo form_error('cname'); ?>
        <input id="cname" type="text" name="cname"  value="<?php echo set_value('cname'); ?>"  />
</p>


<p>
        <label for="itemdesc">Customer description</label>
	<?php echo form_error('cdesc'); ?>
	
							
	<?php echo form_textarea( array( 'name' => 'cdesc', 'rows' => '5', 'cols' => '80', 'value' => set_value('cdesc') ) )?>
</p>
<p>
        <label for="bp">Address <span class="required"></span></label>
        <?php echo form_error('caddress'); ?>
        <input id="caddress" type="text" name="caddress"  value="<?php echo set_value('caddress'); ?>"  />
</p>

<p>
        <label for="sp">Phone <span class="required">*</span></label>
        <?php echo form_error('cphone'); ?>
        <input id="cphone" type="text" name="cphone"  value="<?php echo set_value('cphone'); ?>"  />
</p>




<p>
        <?php echo form_submit( 'submit', 'Submit'," class='btn btn-large btn-success form-control'"); ?>
</p>

<?php echo form_close(); ?>














</div>











</div>

</div>
<!-- end container -->
</section>

   