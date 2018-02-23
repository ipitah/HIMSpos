
 
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

$attributes = array('class' => 'categoryform', 'id' => 'categoryform');
echo form_open('category', $attributes); ?>

<?php if(isset($mess)) echo $mess; else echo ""; ?>

<p>
        <label for="category">Category <span class="required">*</span></label>
        <?php echo form_error('category'); ?>
        <br /><input id="category" type="text" name="category" class="form-control" maxlength="50" value="<?php echo set_value('category'); ?>"  />
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

   