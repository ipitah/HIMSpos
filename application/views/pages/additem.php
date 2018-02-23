 
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
echo form_open('add_item', $attributes); ?>

<?php if(isset($mess)) echo $mess; else echo ""; 


$itemoption['']='Select one';

 
  foreach($items as $i){ 
 
 $itemoption[(string)$i["category"]] =(string)$i["category"];
 
  } 


?>

<p>
        <label for="itemname">Item name <span class="required">*</span></label>
        <?php echo form_error('itemname'); ?>
        <input id="itemname" type="text" name="itemname"  value="<?php echo set_value('itemname'); ?>"  />
</p>

<p>
        <label for="itemdesc">Item description</label>
	<?php echo form_error('itemdesc'); ?>
	
							
	<?php echo form_textarea( array( 'name' => 'itemdesc', 'rows' => '5', 'cols' => '80', 'value' => set_value('itemdesc') ) )?>
</p>
<p>
        <label for="bp">Buying price <span class="required">*</span></label>
        <?php echo form_error('bp'); ?>
        <input id="bp" type="text" name="bp"  value="<?php echo set_value('bp'); ?>"  />
</p>

<p>
        <label for="sp">Selling price <span class="required">*</span></label>
        <?php echo form_error('sp'); ?>
        <input id="sp" type="text" name="sp"  value="<?php echo set_value('sp'); ?>"  />
</p>

<p>
<label for="category">Item category</label>
 <?php echo form_error('category'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = $itemoption;
												 
                                                 ?>
                                 </br>                
<?php   echo form_dropdown('category', $options, set_value('category'),'class="form-control" title="Item category" ')?>
                                
                 </p>
                 
                 <p>
                 
                 <label for="process">Taxed</label>
 <?php echo form_error('vat'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array( ''  => 'Select one',
		'Yes'  => 'Yes',
		'No'  => 'No'
		
		);
												 
                               ?>
          </br>                                         
<?php   echo form_dropdown('vat', $options, set_value('vat'),'class="form-control" title="VAT" ')?>
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

   