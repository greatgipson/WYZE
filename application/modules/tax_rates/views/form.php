<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('tax_rate_form'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>

	<div class="container-fluid">

		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tax_rate_name'); ?>: </label>
				<div class="controls">
					<input type="text" name="tax_rate_name" id="tax_rate_name" class="form-control" value="<?php echo $this->mdl_tax_rates->form_value('tax_rate_name'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tax_rate_percent'); ?>: </label>
				<div class="controls">
					<input type="text" name="tax_rate_percent" id="tax_rate_percent" class="form-control" value="<?php echo $this->mdl_tax_rates->form_value('tax_rate_percent'); ?>">
				</div>
			</div>

	</div>

</form>