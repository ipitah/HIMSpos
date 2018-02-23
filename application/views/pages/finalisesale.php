 
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

$attributes = array('class' => 'additemform', 'id' => 'additemform', 'onsubmit'=>'return allowUs();');
echo form_open('finalise_sale', $attributes); ?>

<?php if(isset($mess)) echo $mess; else echo ""; 


?>
 <input id="id" type="hidden" name="id" class="form-control" maxlength="50" value="<?php  if(isset($id)) echo $id; else echo set_value('id'); ?>" />
 
 <input id="psupplier" type="hidden" name="psupplier" class="form-control" maxlength="50" value="<?php  
 if(isset($id)) 
 { 
 if($psupplier=="No%20Customer")
  echo ""; 
  else 
  echo $psupplier;
  }
  else echo set_value('psupplier'); ?>" />
 
 
 <p>
 <label for="process">Process</label>
 <?php echo form_error('process'); ?>
       
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array( ''  => 'Select one',
		'CANCELED'  => 'CANCEL',
		'RECEIPTED'  => 'RECEIPT'
		);
												 
                                                 ?>
                                                 
<?php   echo form_dropdown('process', $options, set_value('process'),' id= "process" class="form-control" title="Process" ')?>

 
 
 </p>
 
 <p>
 
 
 
 <label for="paymentmethod">Payment Method</label>
 <?php echo form_error('paymentmethod'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array( ''  => 'Select one',
		'CASH'  => 'CASH',
		'M-PESA'  => 'M-PESA',
		'BANK'  => 'BANK'
		
		);
												 
                                                 ?>
                                                 
<?php   echo form_dropdown('paymentmethod', $options, set_value('paymentmethod'),'class="form-control" title="Payment method" ')?>
                                
                                </p>
 
 <p>
                                <label for="transcno"> <small>If Bank, Receipt No. if MPESA, transacrion No. </small> </label>
        <?php echo form_error('transcno'); ?>
      <input id="transcno" type="text" name="transcno"  value="<?php echo set_value('transcno'); ?>"  />                 
                                                 
 
 </p>
 
 <p>
 
 <label for="amountgiven" style="width:30%; float:left;">Amount given</label>
        <?php echo form_error('amountgiven'); ?>
      <input id="amountgiven" type="text" name="amountgiven"  value="<?php echo set_value('amountgiven'); ?>" onkeyup="getNetPay();" onkeydown="return restrictCharact(this, event,0);" style="width:30%; float:left;" />
      
      </p>
 
 <p>
      
 <label for="total" style="clear:both; width:30%; float:left;">Total</label>
        <?php echo form_error('total'); ?>
      <input id="total" type="text" name="total"  value="<?php if(isset($id)) echo $total; else echo set_value('total'); ?>" readonly="readonly" style="width:30%; float:left;" />
      
      </p>
 
 <p>
      
       <label for="vat" style="clear:both; width:30%; float:left;">VAT</label>
        <?php echo form_error('vat'); ?>
      <input id="vat" type="text" name="vat"  value="<?php if(isset($id)) echo $vat; else echo set_value('vat'); ?>" readonly="readonly" style="width:30%; float:left;" />
 
  </p>
 
 <p>
 
 <label for="discount" style="clear:both; width:30%; float:left;">Discount</label>
        <?php echo form_error('discount'); ?>
      <input id="discount" type="text" name="discount" onkeyup="getNetPay();"  value="<?php  if(isset($id)) echo $discount; else echo set_value('discount'); ?>"  style="width:30%; float:left;" />
      
       </p>
 
 <p>
      
       <label for="netTotal" style="clear:both; width:30%; float:left;">Net amount</label>
        <?php echo form_error('netTotal'); ?>
      <input id="netTotal" type="text" name="netTotal"  value="<?php echo set_value('netTotal'); ?>" readonly="readonly"  style="width:30%; float:left;" />
      
       </p>
 
 <p>
      
      <label for="balance" style="clear:both; width:30%; float:left;">Balance</label>
        <?php echo form_error('balance'); ?>
      <input id="balance" type="text" name="balance"  value="<?php echo set_value('balance'); ?>" readonly="readonly"  style="width:30%; float:left;" />
 
  </p>
 

<p style="clear:both;">
<label for="transcno"> <small>If discount, give reason. </small> </label>
        <?php echo form_error('discreason'); ?>
      <input id="discreason" type="text" name="discreason"  value="<?php if(isset($id)) { if($discreason=="No%20Discount") echo ""; else echo $discreason;} else echo set_value('discreason'); ?>"  />      
</p>
 
 
 
 
 
<p style="clear:both;">
        <?php echo form_submit( 'submit', 'Finalise'," class='btn btn-large btn-success form-control'"); ?>
</p>

<?php echo form_close(); ?>














</div>






<script language="javascript" type="text/javascript" >

function allowUs()
{
	
	if((Number(document.getElementById("netTotal").value)<0 || Number(document.getElementById("balance").value)<0) && document.getElementById("process").value!="CANCELED")
	{
		alert("Check the computation, correct the discount given and submit");
	return false;
	}
}




function getMyBalance()
{
	var amt=Number(document.getElementById("amountgiven").value);
	var tot=Number(document.getElementById("total").value);
	
	document.getElementById("balance").value=(amt-tot);
	
}



function getNetPay()
{
	var amt=Number(document.getElementById("amountgiven").value);
	var tot=Number(document.getElementById("total").value);
	var vat=Number(document.getElementById("vat").value);
	var discount=Number(document.getElementById("discount").value);
	document.getElementById("netTotal").value=(tot-discount+vat);
	document.getElementById("balance").value=(amt-tot+discount-vat);
	
}






function restrictCharact(myfield, e, no) {
	
	// create as many regular expressions here as you need:
var digitsOnly = /[1234567890]/g;
var integerOnlyC = /[0-9]/g;
var alphaOnly = /[A-Za-z]/g;
	
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);

	// if they pressed esc... remove focus from field...
	if (code==27) { this.blur(); return false; }
	
	// ignore if they are press other keys
	// strange because code: 39 is the down key AND ' key...
	// and DEL also equals .
	if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(digitsOnly)) {
			
			return true;
			
		} else {
			
			return false;
		}
		
	}
	
}










</script>






</div>

</div>
<!-- end container -->
</section>

   