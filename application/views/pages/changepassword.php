
 
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




<?php $attributes = array('class' => 'categoryform', 'id' => 'categoryform');
echo form_open('changepass', $attributes);  if(isset($mess)) echo $mess; else echo ""; ?>


<p>
        <label for="oldpass">Old Password <span class="required">*</span></label>
        <?php echo form_error('oldpass'); ?>
        <input id="oldpass" type="password" name="oldpass"  value="<?php echo set_value('oldpass'); ?>"  />
</p>

<p>
        <label for="newpass">New password <span class="required">*</span></label>
        <?php echo form_error('newpass'); ?>
        <input id="newpass" type="password" name="newpass"  value="<?php echo set_value('newpass'); ?>"  />
</p>

<p>
        <label for="confirm">Confirm new password <span class="required">*</span></label>
        <?php echo form_error('confirm'); ?>
        <input id="confirm" type="password" name="confirm"  value="<?php echo set_value('confirm'); ?>"  />
</p>

<input type="submit" class="btn btn-large btn-success form-control" name="submit" id="submit" value="Change password" />

</form>








</div>











</div>

</div>
<!-- end container -->
</section>

   