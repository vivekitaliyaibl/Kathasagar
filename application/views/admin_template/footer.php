  <footer class="footer text-center"> 2018 &copy; Valam Bhakti </footer>
</div>
<!-- /#page-wrapper -->
</div>
<script src="<?php echo base_url(); ?>plugins/bower_components/jqueryui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/dist/js/tether.min.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>

<!-- Sweet-Alert  -->
<script src="<?php echo base_url(); ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>

<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="<?php echo base_url(); ?>js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url(); ?>js/waves.js"></script>
<script src="<?php echo base_url(); ?>plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="<?php echo base_url(); ?>js/toastr.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>js/custom.min.js"></script>
<script src="<?php echo base_url(); ?>js/validator.js"></script>
<script src="<?php echo base_url(); ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>

<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<?php
// load JS file from the controller
if(!empty($JS)) {
	foreach($JS as $value) {
		?>  
		<script src="<?php echo base_url(); ?><?php echo $value;?>"></script>
		<?php
	}
} ?>

<script src="<?php echo base_url(); ?>plugins/bower_components/lobipanel/dist/js/lobipanel.min.js"></script>
</body>
</html>