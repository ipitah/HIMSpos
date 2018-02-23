 
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
// $itemoption[] ='';
   $itemoption['']='Select one';
 $c=0;
 
  foreach($items as $i){ 
if((string)$i["itemname"]!="Inflated Balloons")
  {
$itemidjs[$c]=(string)$i["itemid"];
$itemnamejs[$c]=(string)$i["bp"];
$c++;
// $itemoption[] =(string)$i["itemid"];
 
 $itemoption[(string)$i["itemid"]] =(string)$i["itemname"];
// echo $itemoption;
}
  } 
  
  //  $customeroption[] ='';
   $customeroption['']='Select one';
  foreach($customer as $c){ 
 
 $customeroption[(string)$c["cid"]] =(string)$c["cname"]." ".(string)$c["cid"];
  } 
 
  ?>






<table class="table">

<tr><th> Select Item</th><th> Quantity</th><th> Buying price</th> </tr>


<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('Purchase', $attributes); ?>
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

        <?php  if(isset($itemids[$i])) { echo form_dropdown('pitemid'.$i, $options, $itemids[$i],'class="form-control" title="ITEM" onchange="getSp('.$i.')" id="pitemid'.$i.'" ');} else echo form_dropdown('pitemid'.$i, $options, set_value('pitemid'.$i),'class="form-control" title="ITEM" onchange="getSp('.$i.')"  id="pitemid'.$i.'" ')?>
</td> 

<td>
        
        <?php echo form_error('pquantity'.$i); ?>
 <input id="pquantity<?php echo $i; ?>" type="text" name="pquantity<?php echo $i; ?>" maxlength="5" value="<?php if(isset($quntitys[$i])) echo $quntitys[$i]; else echo set_value('pquantity'.$i); ?>"  onkeyup="getSum();"  onkeypress="return restrictCharacters(this, event, 'integerOnly');" />
</td>
                                           
                        
<td>
       
        <?php echo form_error('pbp'.$i); ?>
<input id="pbp<?php echo $i; ?>" type="text" name="pbp<?php echo $i; ?>" maxlength="10" value="<?php if(isset($buyingp[$i])) echo $buyingp[$i]; else echo set_value('pbp'.$i); ?>"  readonly="readonly"  />
</td>

</tr>


 <?php } ?>


<tr>
<td>
 <label for="total">Total</label>
        <?php echo form_error('total'); ?>
      <input id="total" type="text" name="total"  value="<?php echo set_value('total'); ?>" readonly="readonly" />

        <label for="discount">Discount</label>
        <?php echo form_error('discount'); ?>
      <input id="discount" type="text" name="discount"  value="<?php echo set_value('discount'); ?>"  onkeydown="return restrictCharacters(this, event, 'integerOnly');" />
</td>



<td>
<label for="preceipt">RECEIPT NO.</label>
        <?php echo form_error('preceipt'); ?>
      <input id="preceipt" type="text" name="preceipt"  value="<?php echo set_value('preceipt'); ?>"  />
</td>



<td>
        <label for="psupplier">Supplier ID NO./Passport</label>
 <?php echo form_error('psupplier'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = $customeroption;
												 
                                                 ?>
                                 </br>                
<?php   echo form_dropdown('psupplier', $options, set_value('psupplier'),'class="form-control" title="Customer ID NO./Passport" ')?>

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

function getSp(no)
{
	// alert (no);
	var str=0;
	var sel=document.getElementById("pitemid"+no).value;
	//alert (sel);
	
	if(sel!="" && sel!=0)
	{
	
<?php   

echo 'var itemids = '.json_encode($itemidjs).';';

echo 'var itemnames = '.json_encode($itemnamejs).';';
?>


	var id=itemids.indexOf(sel);
	// alert (id);
	str=itemnames[id];
	}
	else
	{
		str=0;
	}

document.getElementById("pbp"+no).value=(str);
getSum();
}










function restrictCharacters(myfield, e, restrictionType) {
	
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





function getSum()
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

   