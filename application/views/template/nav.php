<!-- navbar -->
<div class="navbar-wrapper" >
	<div class="navbar navbar-inverse navbar-fixed-top" >
		<div class="navbar-inner" style="background:#610389;">
			<div class="container" >
				<!-- Responsive navbar -->
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</a>
<h1 class="brand"><a href="<?php echo base_url(); ?>/home"><img src="<?php echo base_url(); ?>images/image.jpg"  />HIMS</a></h1>
				<!-- navigation -->
				<nav class="pull-right nav-collapse collapse">
				<ul id="menu-main" class="nav">
					
                    
                    <?php 
						
					if(!isset($_SESSION['username']))
					{
						?>
                        
                    <li><a href="<?php echo base_url(); ?>/login">Login</a></li>
                    
                     <?php
						
					}

				else
				{
					?>
                    
                    
                    
                    <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
  <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addcategory">Add category</a></li>
  <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/categorylist">Category list</a></li>
                              
                            </ul>
                        </li>   
                        
                        
                         <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">MEMBERS <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
  <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addcustomer">Add customer</a></li>
  <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/customers">Customer list</a></li>
  <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addsupplier">Add supplier</a></li>
  <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/suppliers">Supplier list</a></li>
                              
                            </ul>
                        </li>   
                    
                    
                    
							<li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">ITEMS <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
    <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/additem">Add item</a></li>
     <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/itemslist">Items list</a></li>
                              
                            </ul>
                        </li>   
                        
                       
                        
                        <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">PURCHASE <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addstock">Receive stock</a></li>
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/stocklist">Received stock</a></li>
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/purchaseorder">Purchase order</a></li>

<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/stockremlist">Remaining items in stock</a></li>
                               
                            </ul>
                        </li>
                        
                        
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">SALES <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/home">Make sale</a></li>
  
   <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/sales">Made sales</a></li>
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/salesorder">Sale order</a></li>


                           
                            </ul>
                        </li>
                        
                       
                       
                       <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">SPOILT <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
          <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addspoilt">Add spoilt</a></li>
          <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/spoilt">Spoilt list</a></li>
                               
                            </ul>
                        </li>
                        
                        
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">REPORTS <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/stockreceipts">Stock receipts</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/listreceipts">Sales receipts</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/invoicereceipts">Sales invoices</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/poreceipts">Purchase order receipts</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/soreceipts">Sale order receipts</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  target="_blank" href="<?php echo base_url(); ?>/endofday">End of day sales</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/daychart">Day chart</a></li>

 					<?php 
						
					if($_SESSION['group']=="ADMIN")
					{
						?>
                        
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/summarychart">Custom chart</a></li>
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/reportsummary">Custom report</a></li>
                    
                     <?php
						
					}

					?>


 
                            </ul>
                        </li>
                      
                      
                      
                      <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">STAFF <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/changepassword">Change password</a></li>

<?php 
						
					if($_SESSION['group']=="ADMIN")
					{
						?>
                        
 <li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/addstaff">Add Staff</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/stafflist">Staffs</a></li>
<li><a class="btn btn-info" style="background:#F0F;"  href="<?php echo base_url(); ?>/delete">Batch Delete</a></li>
                     <?php
						
					}

					?>

        
                            </ul>
                        </li>
          
                    
                    
                    
                    <?php 
					
				echo '<li><a href="'.base_url().'/logout">Logout</a></li>';
		  
				}
                       ?> 
                       
                    
				</ul>
				</nav>
			</div>
		</div>
	</div>
</div>



