<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">

		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>EGS Metering Solution</title>
		<meta name="description" content="">
		<meta name="author" content="EGS Meters">

		<meta name="viewport" content="width=device-width,initial-scale=1">

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">

		<script src="<?php echo base_url(); ?>assets/default/js/libs/modernizr-2.0.6.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datepicker.js"></script>

		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-ui-1.10.3.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap.min.js"></script>

<!-- Graph Start -->
		<script src="<?php echo base_url(); ?>assets/default/js/libs/graph/egscharts.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/graph/egscharts-3d.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/graph/egscharts-more.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/graph/modules/exporting.js"></script>
		<!--<script src="<?php echo base_url(); ?>assets/default/js/libs/graph/modules/drilldown.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/graph/modules/data.js"></script>-->
<!--
<script type="text/javascript">
            $(function()
            {
                $('.client-create-invoice').click(function() {
				                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>", {
				                        client_name: $(this).data('client-name')
				                    });
                });

              }
</script>-->
		<!--<script src="<?php echo base_url(); ?>assets/default/js/libs/graph/modules/jquery.min.js"></script>-->
<!-- Graph End -->

	</head>

	<body>

		<nav class="navbar navbar-inverse">

			<div class="navbar-inner">
				<div class="container-fluid">
					<div style="float:left" >
					<h2><font color="white">JTU Metering Solution</font></h2>
					</div>
					<!--
					<ul class="nav">
						<li><!--<img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/logo.jpg" />--> <!--<h2><font color="white">JTU Metering Portal</font></h2></li>-->
						<!--<li><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></li>-->
						 <!--<li><?php echo anchor('guest', lang('dashboard')); ?></li>
                         <li><?php echo anchor('guest/quotes/index', lang('quotes')); ?></li>
                        <li><?php echo anchor('guest/invoices/index', lang('invoices')); ?></li>-->
                        <!--<li><?php echo anchor('guest/payments/index', lang('payments')); ?></li>-->
					<!--</ul>-->

					<ul class="nav pull-right settings">
                        <li><a href="#"><?php echo lang('welcome') . ' ' . $this->session->userdata('user_name'); ?></a></li>
						<li><a href="<?php echo site_url('sessions/logout'); ?>" class="tip icon logout" data-original-title="<?php echo lang('logout'); ?>" data-placement="bottom"><i class="icon-off"></i></a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="sidebar">

			<ul class="sidebar_items">
				<li><a href="<?php echo site_url('guest'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/dashboard24x24.png" title="<?php echo lang('dashboard'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('dashboard'); ?></span></a></li>
				<li><a href="<?php echo site_url('guest/reports/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/graph_reports.png" title="<?php echo lang('graph_reports'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('graph_reports'); ?></span></a></li>
				<li><a href="<?php echo site_url('guest/data_reports/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/data_reports24x24.png" title="<?php echo lang('data_reports'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('data_reports'); ?></span></a></li>

				<li><a href="<?php echo site_url('guest/invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/billing24x24.png" title="<?php echo lang('billing'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('billing'); ?></span></a></li>
				<li><a href="<?php echo site_url('guest/council_invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/council24x24.png" title="<?php echo "Council Billing"; ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo "Council Billing"; ?></span>&nbsp;&nbsp;<img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/compare24x24.png" title="<?php echo lang('billing'); ?>" /></a></li>

				<li><a href="<?php echo site_url('guest/phasor/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/phasor24x24.png" title="<?php echo lang('pashor'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('pashor'); ?></span></a></li>

				<!--<li><a href="<?php echo site_url('guest/invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/compare24x24.png" title="<?php echo lang('billing'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo "Compare Meter vs Council"; ?></span></a></li>-->
				<!--<li><a href="<?php echo site_url('guest/phasor/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/reports24x24.png" title="<?php echo lang('reports'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('reports'); ?></span></a></li>
				<li><a href="<?php echo site_url('guest/phasor/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/meter_reading.png" title="<?php echo lang('reading'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('reading'); ?></span></a></li>-->
				<!--<li><a href="<?php echo site_url('guest/status/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/status24x24.png" title="<?php echo lang('status'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('status'); ?></span></a></li>-->

				<!--<li><a href="<?php echo site_url('guest/fault_reports/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/fault_report24x24.png" title="<?php echo lang('fault_report'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('fault_report'); ?></span></a></li>-->

				<!--
				<li><a href="<?php echo site_url('guest/quotes/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/quotes24x24.png" title="<?php echo lang('quotes'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('quotes'); ?></span></li>
				<li><a href="<?php echo site_url('guest/invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/invoices24x24.png" title="<?php echo lang('invoices'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('invoices'); ?></span></a></li>
				<li><a href="<?php echo site_url('guest/payments/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/payments24x24.png" title="<?php echo lang('payments'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('payments'); ?></span></a></li>
				-->
			</ul>
		</div>

		<div class="main-area">

			<div id="modal-placeholder"></div>

			<?php echo $content; ?>

		</div><!--end.content-->

		<script defer src="<?php echo base_url(); ?>assets/default/js/plugins.js"></script>
		<script defer src="<?php echo base_url(); ?>assets/default/js/script.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datepicker.js"></script>

		<!--[if lt IE 7 ]>
			<script src="<?php echo base_url(); ?>assets/default/js/dd_belatedpng.js"></script>
			<script type="text/javascript"> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
		<![endif]-->

		<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
			 chromium.org/developers/how-tos/chrome-frame-getting-started -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script type="text/javascript">window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

	</body>
</html>