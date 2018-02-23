
 
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
 
 $itemoption=array();
 $itemidjs=array();
 $itemnamejs=array();
 $itemoption[] ='';
   $itemoption['']='Select one';
 $c=0;
 
  foreach($items as $i){ 

$itemidjs[$c]=(string)$i["itemid"];
$itemnamejs[$c]=(string)$i["sp"];
$c++;
 $itemoption[] =(string)$i["itemid"];
 $itemoption[(string)$i["itemid"]] =(string)$i["itemname"];
// echo $itemoption;
  } 
  
 
  ?>







<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'addspoiltform', 'id' => 'addspoiltform');
echo form_open('update_spoilt', $attributes); ?>

<input id="id" type="hidden" name="id" class="form-control" maxlength="50" value="<?php  if(isset($id)) echo $id; else echo set_value('id'); ?>" />

<p>
        <label for="itemno">Item name <span class="required">*</span></label>
        <?php echo form_error('itemno'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = $itemoption; ?>

       <?php if(isset($id)) echo form_dropdown('itemno', $options, $customer[0]['itemno']);
	    else  echo form_dropdown('itemno', $options, set_value('itemno'))?>
</p>                                             
                        
<p>
        <label for="quantity">Quantity <span class="required">*</span></label>
        <?php echo form_error('quantity'); ?>
        <input id="quantity" type="text" name="quantity"  value="<?php if(isset($id)) echo $customer[0]['quantity']; else echo set_value('quantity'); ?>"  />
</p>

<p>
        <label for="describe">Description of damage</label>
	<?php echo form_error('describe'); ?>
	
							
	<?php if(isset($id)) 
	echo form_textarea( array( 'name' => 'describe', 'rows' => '5', 'cols' => '80', 'value' => $customer[0]['describe'] ) ); 
	else echo form_textarea( array( 'name' => 'describe', 'rows' => '5', 'cols' => '80', 'value' => set_value('describe') ) )?>
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

   