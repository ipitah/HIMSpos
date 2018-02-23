
<!-- spacer section -->
<section class="spacer green">
<div class="container">
	<div class="row">
		<div class="span12 aligncenter flyUp" style="border:groove;">
        
			<h2 style="border-bottom:groove; color:black; height:100%; width:50%; margin:5px auto; text-align:center; opacity:0.7;" class="pagetitle">Login Section</h2>
			<div class="row">
		
        
       <div class="span12">
							<div class="cform" id="contact-form">
        <?php // Change the css classes to suit your needs    

$attributes = array('class' => 'loginform', 'id' => 'loginform');
echo form_open('loginform', $attributes); ?>


<div class="form-group">
        <label for="username" class="lable">Username <span class="required">*</span></label>
        <?php echo form_error('username'); ?>
       <input id="username" type="text" name="username" placeholder="Enter Username" class="form-control" value="<?php echo set_value('username'); ?>"  />
</div>

<div class="form-group">
        <label for="password"  class="lable">Password <span class="required">*</span></label>
        <?php echo form_error('password'); ?>
        
   <input id="password" type="password" name="password" placeholder="Enter password" class="form-control"  value="<?php echo set_value('password'); ?>"  />
</div>

        <?php // echo form_submit( 'submit', 'Submit'); ?>

<input type="submit" class='btn btn-large btn-success form-control' name="submit" value="Submit"  />

<?php echo form_close(); ?>

        </div>
        </div>
        
        
        
        
					</div>
		</div>
	</div>
</div>
</section>
<!-- end spacer section -->
<!-- section: team -->
<section id="maincontent" class="inner">
<div class="container">


</div>
<!-- end container -->
</section>

