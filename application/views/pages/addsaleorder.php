 
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
 $remjs=array();
 $remjs1=array();
 $remjs2=array();
 $vatjs=array();
 
 $Gasrem=0;
 
 
 foreach($boughtGas as $i){ 
  
   if( $i["itemname"]=='Small Cylinder')
   {
	   $Gasrem+=(int)$i["prem"]  *150;
   }
   if( $i["itemname"]=='Big Cylinder')
   {
	   $Gasrem+=(int)$i["prem"]  *300;
   }
   
 }
 
 
 
 //$itemoption[] ='';
   $itemoption['']='Select one';
   
 //  $customeroption[] ='';
   $customeroption['']='Select one';
   
 $c=0;
 $c1=0;
 $c2=0;
 $epmty=0;
 $emptygone=false;
 
 
  foreach($items as $i){ 
  
   $remballoon=(int)$i["rem"];
  
   if( $i["itemname"]=='Empty Balloons' && $emptygone==false)
			  {
			  $emptygone=true;
			  $remballoon=$i["prem"]-$brem;
			  $epmty=$remballoon;
			  }
			  
			  if( $i["itemname"]=='Empty Balloons' && $emptygone==true)
			  {
			 // $emptygone=true;
			  $remballoon=$i["prem"]-$brem;
			  
			  if($remballoon<$epmty)
			  $remjs[$c1]=$remballoon;
			  
			 // $epmty=$remballoon;
			  }
			  
			  
			  if( $i["itemname"]=='Inflated Balloons' && $emptygone==true)
			  {
			  //$emptygone=true;
			  if($Gasrem-(int)$i["srem"]-(int)$i["sprem"]>$epmty)
			  $remballoon=$epmty;
			  else
			  $remballoon=$Gasrem-(int)$i["srem"]-(int)$i["sprem"];
			 
			  }
			  
			  
			   if( $i["itemname"]=='Inflated Balloons' && $emptygone==false)
			  {
				  $remballoon=$Gasrem-(int)$i["srem"]-(int)$i["sprem"];
				  $c1=$c;
			  }
			  
			  
			  
  
  
$vatjs[$c]=(string)$i["vat"];
$itemidjs[$c]=(string)$i["itemid"];
$itemnamejs[$c]=(string)$i["sp"];
$remjs[$c]=$remballoon;
$c++;
 //$itemoption[] =(string)$i["itemid"];
 $itemoption[(string)$i["itemid"]] =(string)$i["itemname"];
// echo $itemoption;
  } 
  
  
  foreach($customer as $c){ 
 $customeroption[(string)$c["cid"]] =(string)$c["cname"]." ".(string)$c["cid"];
  } 
  
  
 
  ?>




<table class="table">

<tr><th> Select Item</th><th> Quantity</th><th> Selling price</th> </tr>


<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '', 'onsubmit'=>'return allowUs();');
echo form_open('saleorder', $attributes); ?>
<input type="hidden" name="countItems" id="countItems" value="<?php echo $countItems; ?>"  />
<?php for($i=1; $i<=$countItems; $i++)
{
 ?>

<tr>
<td>
       
        <?php echo form_error('pitemid'.$i); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = $itemoption
												 
                                                 ?>

        <?php  if(isset($itemids[$i])) { echo form_dropdown('pitemid'.$i, $options, $itemids[$i],'class="form-control" title="ITEM" onchange="getBp('.$i.')" id="pitemid'.$i.'" ');} else echo form_dropdown('pitemid'.$i, $options, set_value('pitemid'.$i),'class="form-control" title="ITEM" onchange="getBp('.$i.')"  id="pitemid'.$i.'" ')?>
</td> 

<td>
        
        <?php echo form_error('pquantity'.$i); ?>
 <input id="pquantity<?php echo $i; ?>" type="text" name="pquantity<?php echo $i; ?>" maxlength="5" value="<?php if(isset($quntitys[$i])) echo $quntitys[$i]; else echo set_value('pquantity'.$i); ?>"  onkeyup="sumSales();"  onkeydown="return restrictCharact(this, event, <?php echo $i; ?>);"  onblur="checkMax(<?php echo $i; ?>);"/>
</td>
                                           
                        
<td>
       
        <?php echo form_error('pbp'.$i); ?>
<input id="pbp<?php echo $i; ?>" type="text" name="pbp<?php echo $i; ?>" maxlength="10" value="<?php if(isset($buyingp[$i])) echo $buyingp[$i]; else echo set_value('pbp'.$i); ?>"  readonly="readonly"  />
</td>

</tr>


 <?php } ?>


<tr>
<td>

      
 <label for="total" style="clear:both; width:30%; float:left;">Total</label>
        <?php echo form_error('total'); ?>
      <input id="total" type="text" name="total"  value="<?php echo set_value('total'); ?>" readonly="readonly" style="width:30%; float:left;" />
      
       <label for="vat" style="clear:both; width:30%; float:left;">VAT</label>
        <?php echo form_error('vat'); ?>
      <input id="vat" type="text" name="vat"  value="<?php echo set_value('vat'); ?>" readonly="readonly" style="width:30%; float:left;" />

        <label for="discount" style="clear:both; width:30%; float:left;">Discount</label>
        <?php echo form_error('discount'); ?>
      <input id="discount" type="text" name="discount" onkeyup="getNetPay();"  value="<?php echo set_value('discount'); ?>"  style="width:30%; float:left;" />
      
       <label for="netTotal" style="clear:both; width:30%; float:left;">Net amount</label>
        <?php echo form_error('netTotal'); ?>
      <input id="netTotal" type="text" name="netTotal"  value="<?php echo set_value('netTotal'); ?>" readonly="readonly"  style="width:30%; float:left;" />
      
      
      
      
</td>



<td>

<label for="discreason"> <small>If discount, give reason. </small> </label>
        <?php echo form_error('discreason'); ?>
      <input id="discreason" type="text" name="discreason"  value="<?php echo set_value('discreason'); ?>"  /> 
      
      <label for="color"> Balloon color </label>
        <?php echo form_error('color'); ?>
      <input id="color" type="text" name="color"  value="<?php echo set_value('color'); ?>"  /> 
      
      <label for="arrangement"> Ballon Arrangement </label>
        <?php echo form_error('arrangement'); ?>
      <input id="arrangement" type="text" name="arrangement"  value="<?php echo set_value('arrangement'); ?>"  />        

      
                             
       
</td>



<td>


<label for="category">Customer ID NO./Passport</label>
 <?php echo form_error('psupplier'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = $customeroption;
												 
                                                 ?>
                                           
<?php   echo form_dropdown('psupplier', $options, set_value('psupplier'),'class="form-control" title="Customer ID NO./Passport" ')?>



<label for="deliverydate"> Delivery date </label>
        <?php echo form_error('deliverydate'); ?>
      <input id="deliverydate" type="text" name="deliverydate"  value="<?php echo set_value('deliverydate'); ?>"  /> 
      
      
      <label for="deliverytime"> Delivery time </label>
        <?php echo form_error('deliverytime'); ?>
      <input id="deliverytime" type="text" name="deliverytime"  value="<?php echo set_value('deliverytime'); ?>"  /> 



</td>
</tr>

<tr>


<td>
       <input type="submit" value="Add 5 more Items" class='btn btn-large btn-info form-control' name="addmore" id="addmore"  />
</td>

<td>


       
</td>




<td>
        <input type="submit" value="Submit" class='btn btn-large btn-success form-control' name="submit" id="submit"  />
</td>
</tr>

<?php echo form_close(); ?>


</table>





</div>




<script language="javascript" type="text/javascript" >

<?php   

echo 'var itemids = '.json_encode($itemidjs).';';

echo 'var itemnames = '.json_encode($itemnamejs).';';

echo 'var remains = '.json_encode($remjs).';';

echo 'var vatjs = '.json_encode($vatjs).';';

echo 'var countItems = '.$countItems.';';

?>




function getVAT()
{
	var vat=0;
	for (i=1; i<=countItems; i++)
	{
		//alert ("Item "+i);
		var str="";
		var sel=document.getElementById("pitemid"+i).value;
	if(sel!="" && sel!=0)
	{
	var id=itemids.indexOf(sel);
	str=vatjs[id];
	
	if(str=="Yes")
	{
		vat+=Number(document.getElementById("pquantity"+i).value)*Number(document.getElementById("pbp"+i).value)*0.16;
	}
	
	
	}
		
		
	}
	
	document.getElementById("vat").value=(vat);
	getNetPay();
}






function getBp(no)
{
	// alert (no);
	var str=0;
	var sel=document.getElementById("pitemid"+no).value;
	//alert (sel);
	
	if(sel!="" && sel!=0)
	{
	
	var id=itemids.indexOf(sel);
	// alert (id);
	str=itemnames[id];
	}
	else
	{
		str=0;
	}

document.getElementById("pbp"+no).value=(str);
checkMax(no);
sumSales();
getVAT();
}




function getMyBalance()
{
//	var amt=Number(document.getElementById("amountgiven").value);
	var tot=Number(document.getElementById("total").value);
	
//	document.getElementById("balance").value=(amt-tot);
	
}




function getNetPay()
{
	// var amt=Number(document.getElementById("amountgiven").value);
	var tot=Number(document.getElementById("total").value);
	var vat=Number(document.getElementById("vat").value);
	var discount=Number(document.getElementById("discount").value);
	document.getElementById("netTotal").value=(tot-discount+vat);
//	document.getElementById("balance").value=(amt-tot+discount-vat);
	
}





function checkMax(no)
{
	// alert (no);
	var str=0;
	var sel=document.getElementById("pitemid"+no).value;
	var comp=Number(document.getElementById("pquantity"+no).value);
	//alert (sel);
	
	if(sel!="" && sel!=0)
	{
	
	var id=itemids.indexOf(sel);
	// alert (id);
	str=Number(remains[id]);
	
	
	
	if(comp>str)
	{
document.getElementById("pquantity"+no).value=("");
document.getElementById("pbp"+no).value="";
document.getElementById("pitemid"+no).value="";
alert ("The remaining items in the store are fewer than that, actually they are only "+str);
return;
	}
	else
	{
		getVAT();
	}
	
	
	}
	else
	{
		str=0;
	}
	
	
	
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



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





function sumSales()
{
	var c=document.getElementById("countItems").value;
	//alert(c);
	c=Number(c);
	var sum=0;
	for (var i=1; i<=c;i++)
	{
		var q=Number(document.getElementById("pquantity"+i).value);
		var s=Number(document.getElementById("pbp"+i).value);
		if(s>0 && q>0)
		sum+=s*q;
	}
	
	document.getElementById("total").value=sum;
	
}







</script>









</div>

</div>
<!-- end container -->
</section>

   