 
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





<table>
 <?php  /* foreach($items as $i){ ?>
                    <tr>
                    <td><?php echo $i["itemid"]; ?></td>
                    <td><?php echo $i["itemname"]; ?></td>
                  
                    <td><?php echo $i["itemdesc"]; ?></td>
                    <td><?php echo $i["bp"]; ?></td>
                    <td><?php echo $i["sp"]; ?></td>
                    <td><?php echo $i["user"]; ?></td>
                    <td><?php echo $i["dateadded"]; ?></td>
                </tr>
            <?php } */ ?>

</table>


<table id="staff-table" class="table table-bordered table-striped table-hover display nowrap" cellspacing="0" width="100%">
<thead>
<tr><td>Full name</td><td>Email</td><td>Contact</td><td>Gender</td><td>Username</td><td>Rank</td><td>Status</td><td>Date added</td><td>Update</td><td>Delete</td></tr>
</thead>
<tbody>
</tbody>
</table>


<button type="button" onclick="printJS('staff-table', 'html')" class='btn btn-small btn-success form-control'>
    Print staffs 
 </button>
 <small> NB. Use google chrome to pre-view it. </small>
 
 


</div>











</div>

</div>
<!-- end container -->
</section>

   