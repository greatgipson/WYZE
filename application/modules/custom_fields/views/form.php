<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('custom_field_form'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="control-group">
				<label class="control-label"><?php echo lang('table'); ?>: </label>
				<div class="controls">
                    <select name="custom_field_table" id="custom_field_table" class="form-control">
                        <option value=""></option>
                        <?php foreach ($custom_field_tables as $table => $label) { ?>
                        <option value="<?php echo $table; ?>" <?php if ($this->mdl_custom_fields->form_value('custom_field_table') == $table) { ?>selected="selected"<?php } ?>><?php echo $label; ?></option>
                        <?php } ?>
                    </select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('label'); ?>: </label>
				<div class="controls">
					<input type="text" name="custom_field_label" id="custom_field_label" class="form-control" value="<?php echo $this->mdl_custom_fields->form_value('custom_field_label'); ?>">
				</div>
			</div>

	</div>

</form>