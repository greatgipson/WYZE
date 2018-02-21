<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>eWyze. Meters Online System</title>
		<meta name="description" content="">
		<meta name="author" content="EGS Meters">
		


		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ewyze_theme/css/style.css">
		<script src="https://use.fontawesome.com/1a9da7fa54.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ewyze_theme/css/simple-line-icons.css">		

		
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ewyze_theme/img/favicon.png" />

		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/jquery-3.2.1.min.js"></script>		
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/modernizr-2.0.6.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/jquery-1.7.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/bootstrap-datepicker.js"></script>

        <script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/jquery-ui-1.10.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/ewyze_theme/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/bootstrap.min.js"></script>

        <script type="text/javascript">

            $(function()
            {
                $('.nav-tabs').tab();
                $('.tip').tooltip();

                $('.datepicker').datepicker({ format: '<?php echo date_format_datepicker(); ?>'});

                $('.create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>");
                });

                $('.create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>");
                });

                $('#btn_quote_to_invoice').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_quote_to_invoice'); ?>/" + quote_id);
                });

                $('#btn_copy_invoice').click(function() {
                    invoice_id = $(this).data('invoice-id');
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_copy_invoice'); ?>", {invoice_id: invoice_id});
                });

                $('#btn_copy_quote').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_copy_quote'); ?>", {quote_id: quote_id});
                });

                $('.client-create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>", {
                        client_name: $(this).data('client-name')
                    });
                });

                $('.client-create-test').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_test'); ?>", {
                        client_name: $(this).data('client-name')
                    });
                });


                $('.client-create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>", {
                        client_name: $(this).data('client-name')
                    });
                });
				$(document).on('click', '.invoice-add-payment', function() {
                    invoice_id = $(this).data('invoice-id');
                    invoice_balance = $(this).data('invoice-balance');
                    $('#modal-placeholder').load("<?php echo site_url('payments/ajax/modal_add_payment'); ?>", {invoice_id: invoice_id, invoice_balance: invoice_balance });
                });

            });

        </script>

	</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden   pace-done pace-done" cz-shortcut-listen="true"><div class="pace  pace-inactive pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

<div class="nav navbar-nav d-md-down-none">
		<li class="nav-item px-3">
			<div class="btn">
				<?php echo anchor('dashboard', lang('dashboard')); ?>
			</div>
		</li>

		<li class="nav-item px-3">
			<div class="dropdown">
			  <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo lang('users'); ?>
			  </a>

			  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<li class="dropdown-item"><?php echo anchor('users/form', lang('add_user')); ?></li>
				<li class="dropdown-item"><?php echo anchor('users/index', lang('view_users')); ?></li>
			  </ul>
			</div>
		</li>
		
		<li class="nav-item px-3">	  
			<div class="dropdown">
			  <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo lang('clients'); ?>
			  </a>

			  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<li class="dropdown-item"><?php echo anchor('clients/form', lang('add_client')); ?></li>
				<li class="dropdown-item"><?php echo anchor('clients/index', lang('view_clients')); ?></li>
			  </ul>
			</div>
		</li>
		
		<li class="nav-item px-3">
			<div class="dropdown">
			  <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo lang('meters'); ?>
			  </a>

			  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<li class="dropdown-item"><?php echo anchor('client_meters/form', lang('add_meter')); ?></li>
				<li class="dropdown-item"><?php echo anchor('client_meters/index', lang('view_meters')); ?></li>
			  </ul>
			</div>	
		</li>
		

		
		<li class="nav-item px-3">
			<div class="dropdown">
			  <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo lang('tariff_name'); ?>
			  </a>

			  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<li class="dropdown-item"><?php echo anchor('tariff_type_city_power/index', lang('add_city_power_tariff_type')); ?></li>
				<li class="dropdown-item"><?php echo anchor('tariff_type_ekuhurleni/index', lang('add_ekuhurleni_tariff_type')); ?></li> 
				<li class="dropdown-item"><?php echo anchor('tariff_type_tshwane/index', lang('add_tshwane_tariff_type')); ?></li>
			  </ul>
			</div>		  
		</li>
	  
	</div>	

	<?php if (isset($filter_display) and $filter_display == TRUE) { ?>
	<?php $this->layout->load_view('filter/jquery_filter'); ?>
	<form class="navbar-search pull-left">
		<input type="text" class="search-query form-control" id="filter" placeholder="<?php echo $filter_placeholder; ?>">
	</form>
	<?php } ?>	
	
    <ul class="nav navbar-nav ml-auto">   
      <li class="nav-item d-md-down-none">
        <a href="#"><?php echo lang('welcome') . ' ' . $this->session->userdata('user_name'); ?></a>
      </li>
      <!--<li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-original-title="<?php echo lang('settings'); ?>" data-placement="bottom"><i class="fa fa-briefcase"></i></a>
        <ul class="dropdown-menu dropdown-menu-right options-menu">
			<li class="dropdown-item"><?php echo anchor('custom_fields/index', lang('custom_fields')); ?></li>
			<li class="dropdown-item"><?php echo anchor('email_templates/index', lang('email_templates')); ?></li>
			<li class="dropdown-item"><?php echo anchor('import', lang('import_data')); ?></li>
			<li class="dropdown-item"><?php echo anchor('invoice_groups/index', lang('invoice_groups')); ?></li>
			<li class="dropdown-item"><?php echo anchor('item_lookups/index', lang('item_lookups')); ?></li>
			<li class="dropdown-item"><?php echo anchor('payment_methods/index', lang('payment_methods')); ?></li>
			<li class="dropdown-item"><?php echo anchor('tax_rates/index', lang('tax_rates')); ?></li>
			<li class="dropdown-item"><?php echo anchor('council/index', lang('council_form')); ?></li>
			
			<li class="dropdown-item"><?php echo anchor('tariff_type_city_power/index', lang('add_city_power_tariff_type')); ?></li>
			<li class="dropdown-item"><?php echo anchor('tariff_type_ekuhurleni/index', lang('add_ekuhurleni_tariff_type')); ?></li>
			<li class="dropdown-item"><?php echo anchor('tariff_type_tshwane/index', lang('add_tshwane_tariff_type')); ?></li>

			<li class="dropdown-item"><?php echo anchor('consumption_time/index', lang('add_consumption_time')); ?></li>
			<li class="dropdown-item"><?php echo anchor('holidays/index', lang('add_holidays')); ?></li>

			<li class="dropdown-item"><?php echo anchor('seasons/index', lang('seasons')); ?></li>
			<li class="dropdown-item"><?php echo anchor('users/index', lang('user_accounts')); ?></li>
			<li class="divider"></li>
			<li class="dropdown-item"><?php echo anchor('settings', lang('system_settings')); ?></li>
        </ul></li>-->
		<!--<li><?php echo anchor('tariff_type/index', lang('tariff_type')); ?></li>-->
      
	  <li class="nav-item d-md-down-none">
        <a href="<?php echo site_url('sessions/logout'); ?>" data-original-title="<?php echo lang('logout'); ?>" data-placement="bottom"><i class="fa fa-power-off"></i></a>
      </li>	  
    </ul>

  </header>

  <div class="app-body">
    <div class="sidebar">
	  <nav class="sidebar-nav">
		<ul class="nav">
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('dashboard'); ?>"> <i class="fa fa-speedometer"></i> <?php echo lang('dashboard'); ?></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('users/index'); ?>"><i class="fa fa-people"></i> <?php echo lang('users'); ?></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('clients/index'); ?>"> <i class="fa fa-people"></i> <?php echo lang('clients'); ?></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('client_meters/index'); ?>"><i class="fa fa-people"></i> <?php echo lang('meters'); ?></a>
		  </li>	  
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('tariff_type_city_power/index'); ?>"><i class="fa fa-people"></i> <?php echo lang('add_city_power_tariff_type'); ?></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('tariff_type_ekuhurleni/index'); ?>"><i class="fa fa-people"></i> <?php echo lang('add_ekuhurleni_tariff_type'); ?></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('tariff_type_tshwane/index'); ?>"><i class="fa fa-people"></i> <?php echo lang('add_tshwane_tariff_type'); ?></a>
		  </li>	  
		  
		 <!-- <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('invoices/index'); ?>"><i class="fa fa-money fa-lg"></i> <?php echo lang('quotes'); ?> <?php echo lang('invoices'); ?></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('quotes/index'); ?>"><i class="fa fa-doc"></i> <?php echo lang('quotes'); ?></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('payments/index'); ?>"><i class="fa fa-wallet"></i> <?php echo lang('payments'); ?></a>
		  </li>	-->			  
		</ul>
	  </nav>
	</div>

<!-- Main content -->
<main class="main">
  <!-- Breadcrumb -->
	<div id="modal-placeholder"></div>
	<?php echo $content; ?>
</main>	 

    <aside class="aside-menu">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
        </li>
      </ul>

      <!-- Tab panes -->
      
	  
	  <!--<div class="tab-content">
	  
        <div class="tab-pane active" id="timeline" role="tabpanel">
          <div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">
            <small><b>Today</b></small>
          </div>
          <hr class="transparent mx-3 my-0">
          <div class="callout callout-warning m-0 py-3">
            <div class="avatar float-right">
              <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
            </div>
            <div>Meeting with
              <strong>Lucas</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
            <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
          </div>
          <hr class="mx-3 my-0">
          <div class="callout callout-info m-0 py-3">
            <div class="avatar float-right">
              <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
            </div>
            <div>Skype with
              <strong>Megan</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
            <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line </small>
          </div>
          <hr class="transparent mx-3 my-0">
          <div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">
            <small><b>Tomorrow</b></small>
          </div>
          <hr class="transparent mx-3 my-0">
          <div class="callout callout-danger m-0 py-3">
            <div>New UI Project -
              <strong>deadline</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
            <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
            <div class="avatars-stack mt-2">
              <div class="avatar avatar-xs">
                <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
            </div>
          </div>
          <hr class="mx-3 my-0">
          <div class="callout callout-success m-0 py-3">
            <div>
              <strong>#10 Startups.Garden</strong> Meetup</div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
            <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
          </div>
          <hr class="mx-3 my-0">
          <div class="callout callout-primary m-0 py-3">
            <div>
              <strong>Team meeting</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
            <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
            <div class="avatars-stack mt-2">
              <div class="avatar avatar-xs">
                <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
            </div>
          </div>
          <hr class="mx-3 my-0">
        </div>
        <div class="tab-pane p-3" id="messages" role="tabpanel">
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
        </div>
        <div class="tab-pane p-3" id="settings" role="tabpanel">
          <h6>Settings</h6>

          <div class="aside-options">
            <div class="clearfix mt-4">
              <small><b>Option 1</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input" checked="">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
            <div>
              <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
            </div>
          </div>

          <div class="aside-options">
            <div class="clearfix mt-3">
              <small><b>Option 2</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
            <div>
              <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
            </div>
          </div>

          <div class="aside-options">
            <div class="clearfix mt-3">
              <small><b>Option 3</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
          </div>

          <div class="aside-options">
            <div class="clearfix mt-3">
              <small><b>Option 4</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input" checked="">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
          </div>

          <hr>
          <h6>System Utilization</h6>

          <div class="text-uppercase mb-1 mt-4">
            <small><b>CPU Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">348 Processes. 1/4 Cores.</small>

          <div class="text-uppercase mb-1 mt-2">
            <small><b>Memory Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">11444GB/16384MB</small>

          <div class="text-uppercase mb-1 mt-2">
            <small><b>SSD 1 Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">243GB/256GB</small>

          <div class="text-uppercase mb-1 mt-2">
            <small><b>SSD 2 Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">25GB/256GB</small>
        </div>
      </div>
    </aside>

  </div> -->

<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/plugins.js"></script>
<script src="<?php echo base_url(); ?>assets/ewyze_theme/js/script.js"></script>
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
</html>