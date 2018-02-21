<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('payment_method_form'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>

	<div class="container-fluid">

		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="control-group">
				<label class="control-label"><?php echo lang('payment_method'); ?>: </label>
				<div class="controls">
					<input type="text" name="payment_method_name" id="payment_method_name" class="form-control" value="<?php echo $this->mdl_payment_methods->form_value('payment_method_name'); ?>">
				</div>
			</div>

	</div>
	
</form>