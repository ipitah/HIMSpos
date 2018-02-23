
 
  
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

$attributes = array('class' => 'summaryform', 'id' => 'summaryform');
echo form_open('summary', $attributes); ?>

<?php if(isset($mess)) echo $mess; else echo ""; ?>

<p>
        <label for="bigdate">FROM DATE <span class="required">*</span></label>
        <?php echo form_error('bigdate'); ?>
        
       <input type="date" name="bigdate" id="bigdate" maxlength="50" value="<?php echo set_value('bigdate'); ?>"  />
</p>


<p>
        <label for="enddate">END DATE <span class="required">*</span></label>
        <?php echo form_error('enddate'); ?>
        <input type="date" name="enddate" id="enddate" maxlength="50" value="<?php echo set_value('enddate'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit'," class='btn btn-large btn-success form-control' onclick='drawChart();' "); ?>
</p>

<?php echo form_close(); ?>








<div id="piechartsale" style="width: 900px; height: 500px;"></div>
<button type="button" onclick="drawChart();" >Show sales</button>

<div id="piechartstock" style="width: 900px; height: 500px;"></div>







</div>











</div>

</div>
<!-- end container -->
</section>

   
   
   
   
   
   