<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">

		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>eWyze. Metering Solution</title>
		<meta name="description" content="">
		<meta name="author" content="EGS Meters">

		<meta name="viewport" content="width=device-width,initial-scale=1">
		
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ewyze_theme/img/favicon.png" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ewyze_theme/css/style_guest.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ewyze_theme/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ewyze_theme/css/simple-line-icons.css">		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/font-awesome/fontawesome-all.js"></script>		

		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/modernizr-2.0.6.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/jquery-1.7.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/bootstrap-datepicker.js"></script>

		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/jquery-ui-1.10.3.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/bootstrap.min.js"></script>

<!-- Graph Start -->
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/graph/egscharts.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/graph/egscharts-3d.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/graph/egscharts-more.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/graph/modules/exporting.js"></script>
		<!--<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/graph/modules/drilldown.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/graph/modules/data.js"></script>-->
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
		<!--<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/graph/modules/jquery.min.js"></script>-->
<!-- Graph End -->

	</head>

<body class="app">
<header class="app-header navbar">
	<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
	  <span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#"></a>
	<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
	  <span class="navbar-toggler-icon"></span>
	</button>
		<!--
		<ul class="nav">
			<li><!--<img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/logo.jpg" />--> <!--<h2><font color="white">JTU Metering Portal</font></h2></li>-->
			<!--<li><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></li>-->
			 <!--<li><?php echo anchor('guest', lang('dashboard')); ?></li>
			 <li><?php echo anchor('guest/quotes/index', lang('quotes')); ?></li>
			<li><?php echo anchor('guest/invoices/index', lang('invoices')); ?></li>-->
			<!--<li><?php echo anchor('guest/payments/index', lang('payments')); ?></li>-->
		<!--</ul>-->

    <ul class="nav navbar-nav ml-auto">  
		<li><a href="#"><?php echo lang('welcome') . ' ' . $this->session->userdata('user_name'); ?></a></li>
		<li>
		<a href="<?php echo site_url('sessions/logout'); ?>" data-original-title="<?php echo lang('logout'); ?>" data-placement="bottom"><i class="fa fa-power-off"></i></a>
		</li>
	</ul>
	
</header>
<div class="app-body">
	<div class="sidebar">
		<nav class="sidebar-nav">
		<ul class="nav">
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('guest'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/dashboard24x24.png" title="<?php echo lang('dashboard'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('dashboard'); ?></span></a></li>
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('guest/reports/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/graph_reports.png" title="<?php echo lang('graph_reports'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('graph_reports'); ?></span></a></li>
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('guest/data_reports/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/data_reports24x24.png" title="<?php echo lang('data_reports'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('data_reports'); ?></span></a></li>

			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('guest/invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/billing24x24.png" title="<?php echo lang('billing'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('billing'); ?></span></a></li>
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('guest/council_invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/council24x24.png" title="<?php echo "Council Billing"; ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo "Council Billing"; ?></span>&nbsp;&nbsp;<img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/compare24x24.png" title="<?php echo lang('billing'); ?>" /></a></li>

			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('guest/phasor/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/phasor24x24.png" title="<?php echo lang('pashor'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('pashor'); ?></span></a></li>

			<!--<li><a href="<?php echo site_url('guest/invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/compare24x24.png" title="<?php echo lang('billing'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo "Compare Meter vs Council"; ?></span></a></li>-->
			<!--<li><a href="<?php echo site_url('guest/phasor/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/reports24x24.png" title="<?php echo lang('reports'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('reports'); ?></span></a></li>
			<li><a href="<?php echo site_url('guest/phasor/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/meter_reading.png" title="<?php echo lang('reading'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('reading'); ?></span></a></li>-->
			<!--<li><a href="<?php echo site_url('guest/status/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/status24x24.png" title="<?php echo lang('status'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('status'); ?></span></a></li>-->

			<!--<li><a href="<?php echo site_url('guest/fault_reports/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/fault_report24x24.png" title="<?php echo lang('fault_report'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('fault_report'); ?></span></a></li>-->

			<!--
			<li><a href="<?php echo site_url('guest/quotes/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/quotes24x24.png" title="<?php echo lang('quotes'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('quotes'); ?></span></li>
			<li><a href="<?php echo site_url('guest/invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/invoices24x24.png" title="<?php echo lang('invoices'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('invoices'); ?></span></a></li>
			<li><a href="<?php echo site_url('guest/payments/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/ewyze_theme/img/icons/payments24x24.png" title="<?php echo lang('payments'); ?>" />&nbsp;&nbsp;&nbsp;<span class="link"><?php echo lang('payments'); ?></span></a></li>
			-->
		</ul>
		</nav>
	</div>

	<main class="main">
		<div id="modal-placeholder"></div>
		<?php echo $content; ?>
	</main><!--end.content-->
</div>
		<script defer src="<?php echo base_url(); ?>assets/ewyze_theme/js/plugins.js"></script>
		<script defer src="<?php echo base_url(); ?>assets/ewyze_theme/js/script.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/bootstrap-datepicker.js"></script>
		<!-- GenesisUI main scripts -->

		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/popper.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/pace.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/app.js"></script>
		<!--[if lt IE 7 ]>
			<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/dd_belatedpng.js"></script>
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