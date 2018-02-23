 
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







<?php if(isset($mess)) echo $mess; else echo ""; ?>




<p> You must be in connected to the internet to view the graphs.</p>





<div id="piechartsale" style="width: 900px; height: 500px;"></div>


<button type="button" onclick="printJS('piechartsale', 'html')" class='btn btn-small btn-success form-control'>
    Print graph 
 </button>
 <small> NB. Use google chrome to pre-view it. </small>



<div id="piechartstock" style="width: 900px; height: 500px;"></div>


<button type="button" onclick="printJS('piechartstock', 'html')" class='btn btn-small btn-success form-control'>
    Print graph 
 </button>
 <small> NB. Use google chrome to pre-view it. </small>








</div>











</div>

</div>
<!-- end container -->
</section>

   
   
   
   
   
   <script type="text/javascript">

         // Load the Visualization API and the line package.
         google.charts.load('current', {'packages':['corechart']});
         // Set a callback to run when the Google Visualization API is loaded.
         google.charts.setOnLoadCallback(drawChart);
        
         function drawChart() {
              $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/Charts/getdata',
                success: function (data1) {
					//alert(data1);
                  var data = new google.visualization.DataTable();
                  // Add legends with data type
                  data.addColumn('string', 'itemname');
                 data.addColumn('number', 'stotal');
                 //Parse data into Json
                 var jsonData = $.parseJSON(data1);
                 for (var i = 0; i < jsonData.length; i++) {
                   data.addRow([jsonData[i].itemname, parseInt(jsonData[i].stotal)]);
                 }
                  
				  
				  var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!

			var yyyy = today.getFullYear();
		if(dd<10){
   		 dd='0'+dd;
		} 
		if(mm<10){
    mm='0'+mm;
		} 
		var today = dd+'/'+mm+'/'+yyyy;
				  
				  
                 var options = {
                  legend: '',
                  pieSliceText: 'label',
                  title: today+' Sales Performance',
                };
				
				var options = {
     pieSliceText: 'label',
     title: today+' Sales Performance',
     is3D: true,
};
  
                var chart = new google.visualization.PieChart(document.getElementById('piechartsale'));
                chart.draw(data, options);
               }
            });
          }
		  
		
      </script>
      
      
      
      
      
      <script type="text/javascript">

         // Load the Visualization API and the line package.
         google.charts.load('current', {'packages':['corechart']});
         // Set a callback to run when the Google Visualization API is loaded.
         google.charts.setOnLoadCallback(drawStockChart);
        
         function drawStockChart() {
              $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/Charts/getstockdata',
                success: function (data1) {
					//alert(data1);
                  var data = new google.visualization.DataTable();
                  // Add legends with data type
                  data.addColumn('string', 'itemname');
                 data.addColumn('number', 'ptotal');
                 //Parse data into Json
                 var jsonData = $.parseJSON(data1);
                 for (var i = 0; i < jsonData.length; i++) {
                   data.addRow([jsonData[i].itemname, parseInt(jsonData[i].ptotal)]);
                 }
                  
				  
				  var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!

			var yyyy = today.getFullYear();
		if(dd<10){
   		 dd='0'+dd;
		} 
		if(mm<10){
    mm='0'+mm;
		} 
		var today = dd+'/'+mm+'/'+yyyy;
				  
				  
                 var options = {
                  legend: '',
                  pieSliceText: 'label',
                  title: today+' Stock Performance',
                };
				
				var options = {
     pieSliceText: 'label',
     title: today+' Stock Performance',
     is3D: true,
};
  
                var chart = new google.visualization.PieChart(document.getElementById('piechartstock'));
                chart.draw(data, options);
               }
            });
          }
		  
		
      </script>