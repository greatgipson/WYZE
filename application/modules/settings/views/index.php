<script type="text/javascript">
$().ready(function() {
    $('#btn-submit').click(function() {
        $('#form-settings').submit();
    });
});  
</script>

<div class="headerbar">
	<div class="breadcrumb">
		<div class="row">
			<div class="col-sm-6">
				<h4><?php echo lang('settings'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<form method="post" class="form-horizontal" id="form-settings" enctype="multipart/form-data">
		<ul class="nav nav-tabs" role="tablist">		
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#settings-general" role="tab"><?php echo lang('general'); ?></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#settings-invoices" role="tab"><?php echo lang('invoices'); ?></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#settings-quotes" role="tab"><?php echo lang('quotes'); ?></a>
			</li>
			
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#settings-taxes" role="tab"><?php echo lang('taxes'); ?></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#settings-email" role="tab"><?php echo lang('email'); ?></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#settings-merchant" role="tab"><?php echo lang('merchant_account'); ?></a>
			</li>			
		</ul>
	
			<div class="tab-content">

				<div id="settings-general" class="tab-pane active">
					
					<?php $this->layout->load_view('layout/alerts'); ?>
					
					<?php $this->layout->load_view('settings/partial_settings_general'); ?>
				</div>

				<div id="settings-invoices" class="tab-pane">
					<?php $this->layout->load_view('settings/partial_settings_invoices'); ?>
				</div>
				
				<div id="settings-quotes" class="tab-pane">
					<?php $this->layout->load_view('settings/partial_settings_quotes'); ?>
				</div>
				
				<div id="settings-taxes" class="tab-pane">
					<?php $this->layout->load_view('settings/partial_settings_taxes'); ?>
				</div>

				<div id="settings-email" class="tab-pane">
					<?php $this->layout->load_view('settings/partial_settings_email'); ?>
				</div>
				
				<div id="settings-merchant" class="tab-pane">
					<?php $this->layout->load_view('settings/partial_settings_merchant'); ?>
				</div>

			</div>
		
	</form>
</div>
