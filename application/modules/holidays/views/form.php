<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>
<script>
	$(document).ready(function() {
		$('.readonly').find('input, textarea, select').attr('readonly', 'readonly');
	});
</script>

<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('holidays_form'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<?php $this->layout->load_view('layout/alerts'); ?>
			<div class="control-group">
				<label class="control-label"><?php echo lang('council_name'); ?>: </label>
				<div class="controls">
						<select name="council_id" id="council_id" class="form-control">
								<option value="0"></option>
								<?php foreach ($council_names as $key => $type) { ?>
											<?php $type->id; ?>
											<option value="<?php echo $type->id; ?>" <?php if ($this->mdl_holidays->form_value('council_id') == $type->id) { ?>selected="selected"<?php } ?>><?php echo $type->council_name; ?> </option>
								<?php } ?>
						</select>
					</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('holiday_date'); ?>: </label>
				<div class="controls">
					<input type="date" name="holiday_date" id="holiday_date" class ="resizedTextbox form-control" value="<?php echo $this->mdl_holidays->form_value('holiday_date'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('holiday_desc'); ?>: </label>
				<div class="controls">
					<input type="text" name="holiday_desc" id="holiday_desc" class ="resizedTextbox form-control" value="<?php echo $this->mdl_holidays->form_value('holiday_desc'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('day_type'); ?>: </label>
				<div class="controls">
				<select name="day_type_id" id="day_type_id" class="form-control">
					<option value=""></option>
					<?php foreach ($day_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_holidays->form_value('day_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>


	</div>
</form>