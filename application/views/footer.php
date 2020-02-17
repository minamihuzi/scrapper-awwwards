	<!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark">
        <p class="clearfix mb-0">
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
	<!-- END: Footer-->
	
	<!--Disabled Backdrop Modal -->
    <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Download</h4>
                </div>
                <div class="modal-body" id="modal_content">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>                    
                </div>
            </div>
        </div>
    </div>

	<script src="<?php echo base_url('app-assets')?>/js/core/libraries/jquery.min.js"></script>
	<script>
		var base_url = $('base').attr('href');
		var site_url="<?=site_url();?>";
		var page_code = '<?php echo $page_code; ?>';
	</script>
    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo base_url('app-assets')?>/vendors/js/vendors.min.js"></script>
    <script src="<?php echo base_url('app-assets')?>/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="<?php echo base_url('app-assets')?>/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="<?php echo base_url('app-assets')?>/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

	<!-- BEGIN: Page Vendor JS-->
	<?php if($page_code == 'dashboard') { ?>
    <script src="<?php echo base_url('app-assets')?>/vendors/js/charts/apexcharts.min.js"></script>
	<script src="<?php echo base_url('app-assets')?>/vendors/js/extensions/dragula.min.js"></script>
	<?php } ?>
	<?php if(strpos($page_code, 'add') !== false) { ?>
	<!-- <script src="<?php echo base_url('app-assets')?>/vendors/js/extensions/dropzone.min.js"></script> -->
	<script src="<?php echo base_url('app-assets')?>/vendors/js/ui/prism.min.js"></script>
	<?php } ?>
	<?php if(strpos($page_code, 'list') !== false) { ?>
	<script src="<?php echo base_url('app-assets')?>/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?php echo base_url('app-assets')?>/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('app-assets')?>/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="<?php echo base_url('app-assets')?>/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url('app-assets')?>/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
	<?php } ?>
	<script src="<?php echo base_url('app-assets')?>/vendors/js/extensions/sweetalert2.all.min.js"></script>
	<script src="<?php echo base_url('app-assets')?>/vendors/js/extensions/polyfill.min.js"></script>
    <script src="<?php echo base_url('app-assets')?>/vendors/js/extensions/dropzone.min.js"></script>
	<!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo base_url('app-assets')?>/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="<?php echo base_url('app-assets')?>/js/core/app-menu.js"></script>
    <script src="<?php echo base_url('app-assets')?>/js/core/app.js"></script>
    <script src="<?php echo base_url('app-assets')?>/js/scripts/components.js"></script>
    <script src="<?php echo base_url('app-assets')?>/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

	<!-- BEGIN: Page JS-->
	<?php if($page_code == 'dashboard') { ?>
	<script src="<?php echo base_url('app-assets')?>/js/scripts/pages/dashboard-analytics.js"></script>
	<?php } ?>
	<?php if(strpos($page_code, 'add') !== false) { ?>
	<!-- <script src="<?php echo base_url('app-assets')?>/js/scripts/extensions/dropzone.js"></script> -->
	<?php } ?>
	<?php if(strpos($page_code, 'list') !== false || strpos($page_code, 'add') !== false) { ?>
	<script src="<?php echo base_url('app-assets')?>/js/scripts/pages/app-invoice.js"></script>
	<?php } ?>
	<script src="<?php echo base_url('app-assets')?>/js/<?=$page_code?>.js"></script>	
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>