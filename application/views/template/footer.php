<footer>
<div class="container">
	<div class="row">
		<div class="span6 offset3">
			<ul class="social-networks">
				<li><a href="#"><i class="icon-circled icon-bgdark icon-instagram icon-2x"></i></a></li>
				<li><a href="#"><i class="icon-circled icon-bgdark icon-twitter icon-2x"></i></a></li>
				<li><a href="#"><i class="icon-circled icon-bgdark icon-dribbble icon-2x"></i></a></li>
				<li><a href="#"><i class="icon-circled icon-bgdark icon-pinterest icon-2x"></i></a></li>
			</ul>
			<p class="copyright">
				&copy; HIMS. All rights reserved.
                <div class="credits">
                    <!-- 
                        All the links in the footer should remain intact. 
                        You can delete the links only if you purchased the pro version.
                        Licensing information: https://bootstrapmade.com/license/
                        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Maxim
                    -->
                    <a href="<?php echo base_url(); ?>/home" style="color:black">Heliums Inventory Management System(HIMS)</a> <!-- &copy;ipitah -->
                </div>
			</p>
		</div>
	</div>
</div>
<!-- ./container -->
</footer>
<a href="#" class="scrollup"><i class="icon-angle-up icon-square icon-bgdark icon-2x"></i></a>
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.scrollTo.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.nav.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.localscroll-1.2.7-min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>js/isotope.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.flexslider.js"></script>


<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>

<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>


<script src="<?php echo base_url(); ?>js/inview.js"></script>
<script src="<?php echo base_url(); ?>js/animate.js"></script>
<script src="<?php echo base_url(); ?>js/validate.js"></script>
<script src="<?php echo base_url(); ?>js/custom.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>contactform/contactform.js"></script>





<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispitem/books_page") ?>",
            type : 'GET'
        },
    });
});




$(document).ready(function() {
    $('#stock-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispstock/stock_page") ?>",
            type : 'GET'
        },
    });
});




$(document).ready(function() {
    $('#sale-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispsale/sales_page") ?>",
            type : 'GET'
        },
    });
});


$(document).ready(function() {
    $('#stockrem-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispremstock/stock_page") ?>",
            type : 'GET'
        },
    });
});


$(document).ready(function() {
    $('#salereceipt-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispsale/sales_receipts") ?>",
            type : 'GET'
        },
    });
});




$(document).ready(function() {
    $('#invoicereceipt-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispsale/sales_invoices") ?>",
            type : 'GET'
        },
    });
});




$(document).ready(function() {
    $('#dispsaleorder-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispsaleorder/sales_receipts") ?>",
            type : 'GET'
        },
    });
});





$(document).ready(function() {
    $('#stockreceipt-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispstock/stock_receipts") ?>",
            type : 'GET'
        },
    });
});



$(document).ready(function() {
    $('#poreceipt-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("disppurchaseorder/stock_receipts") ?>",
            type : 'GET'
        },
    });
});


$(document).ready(function() {
    $('#category-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispcategory/books_page") ?>",
            type : 'GET'
        },
    });
});





$(document).ready(function() {
    $('#supplier-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispsupplier/books_page") ?>",
            type : 'GET'
        },
    });
});



$(document).ready(function() {
    $('#customer-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispcustomer/books_page") ?>",
            type : 'GET'
        },
    });
});


$(document).ready(function() {
    $('#spoilt-table').DataTable({
		 dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": {
            url : "<?php echo site_url("dispspoilt/books_page") ?>",
            type : 'GET'
        },
    });
});



$(document).ready(function() {
    $('#staff-table').DataTable({
		
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		
        "ajax": {
            url : "<?php echo site_url("dispstaffs/books_page") ?>",
            type : 'GET'
        },
		
  
    });
	
});







$("#enddate").datepicker(
    {
        dateFormat: 'yy-mm-dd'
    }
);


$("#bigdate").datepicker(
    {
        dateFormat: 'yy-mm-dd'
    }
);









</script>

<script src="https://printjs-4de6.kxcdn.com/print.min.js" type="text/javascript" language="javascript" > </script>

</body>
</html>

