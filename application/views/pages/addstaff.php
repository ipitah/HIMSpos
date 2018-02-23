
 
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
echo form_open('Staffs', $attributes); ?>

<?php if(isset($mess)) echo $mess; else echo ""; ?>

<p>
        <label for="fullname">Full name <span class="required">*</span></label>
        <?php echo form_error('fullname'); ?>
        <input id="fullname" type="text" name="fullname"  value="<?php echo set_value('fullname'); ?>"  />
</p>

<p>
        <label for="email">Email</label>
        <?php echo form_error('email'); ?>
        <input id="email" type="text" name="email"  value="<?php echo set_value('email'); ?>"  />
</p>

<p>
        <label for="contact">Contact <span class="required">*</span></label>
        <?php echo form_error('contact'); ?>
        <input id="contact" type="text" name="contact"  value="<?php echo set_value('contact'); ?>"  />
</p>

<p>
        <label for="gender">Gender <span class="required">*</span></label>
        <?php echo form_error('gender'); ?>
        
                <?php // Change or Add the radio values/labels/css classes to suit your needs ?>
                <input id="gender" name="gender" type="radio" class="" value="M" <?php echo $this->form_validation->set_radio('gender', 'M'); ?> />
        		<label for="gender" class="">M</label>

        		<input id="gender" name="gender" type="radio" class="" value="F" <?php echo $this->form_validation->set_radio('gender', 'F'); ?> />
        		<label for="gender" class="">F</label>
</p>


<p>
        <label for="mygroup">Level <span class="required">*</span></label>
        <?php echo form_error('mygroup'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array(
                                                  ''  => 'Please Select',
                                                  'RECEPTIONIST'    => 'RECEPTIONIST',
												  'MODERATOR'    => 'MODERATOR',
												  'ADMIN'    => 'ADMIN'
                                                ); ?>

        <?php echo form_dropdown('mygroup', $options, set_value('mygroup'))?>
</p>     


<p>
        <label for="username">Username <span class="required">*</span></label>
        <?php echo form_error('username'); ?>
        <input id="username" type="text" name="username"  value="<?php echo set_value('username'); ?>"  />
</p>


<p>
        <label for="password">Password <span class="required">*</span></label>
        <?php echo form_error('password'); ?>
        <input id="password" type="password" name="password"  value="<?php echo set_value('password'); ?>"  />
</p>
                                        
        
 <p>
        <label for="cpassword">Confirm Password <span class="required">*</span></label>
        <?php echo form_error('cpassword'); ?>
        <input id="cpassword" type="password" name="cpassword"  value="<?php echo set_value('cpassword'); ?>"  />
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

   