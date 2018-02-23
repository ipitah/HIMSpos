 
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




<table id="stockrem-table" class="table table-bordered table-striped table-hover">
<thead>
<tr><td>ITEM</td> <!-- <td>BP</td><td>SP</td> --> <td>QTY PURCHASED</td><td>QTY SOLD</td><td>QTY SPOILT</td><td>QTY REMAINING</td></tr>
</thead>
<tbody>
</tbody>
</table>



<button type="button" onclick="printJS('stockrem-table', 'html')" class='btn btn-small btn-success form-control'>
    Print remaining items 
 </button>
 <small> NB. Use google chrome to pre-view it. </small>




</div>











</div>

</div>
<!-- end container -->
</section>

   