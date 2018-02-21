<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>
<script>
	$(document).ready(function() {
		$('.readonly').find('input, textarea, select').attr('readonly', 'readonly');
	});
</script>

<form method="post" class="form-horizontal">

	<div class="breadcrumb">
			<div class="row">
				<div class="col-sm-6">
					<h4><?php echo lang('add_tshwane_tariff_type'); ?></h4>
				</div>
				<div class="col-sm-6">
					<div class="pull-right">
						<?php $this->layout->load_view('layout/header_buttons'); ?>
					</div>
				</div>
			</div>
		</div>

	<div class="container-fluid">

		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="control-group">
				<label class="control-label" style="display:none;"><?php echo lang('council_name'); ?>: </label>

				<div class="controls">
				<div class="readonly">
					<select name="council_id" id="council_id" class="form-control" style="display:none;">
							<option value="0"></option>
							<?php foreach ($council_names as $key => $type) { ?>
										<?php $type->id; ?>
										<option value="<?php echo $type->id; ?>" <?php if ($type->council_name == "Tshwane") { ?>selected="selected"<?php } ?>><?php echo $type->council_name; ?> </option>
							<?php } ?>
					</select>
				</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_name'); ?>: </label>
				<div class="controls">
					<input type="text" name="tariff_name" id="tariff_name" class ="resizedTextbox form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('tariff_name'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_kva_type'); ?>: </label>
				<div class="controls">
				<select name="tariff_kva_type_id" id="tariff_kva_type_id" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_kva_non_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('tariff_kva_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_billing_type'); ?>: </label>
				<div class="controls">
				<select name="billing_type_id" id="billing_type_id" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_billing_format as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('billing_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>
			<!--<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_kva_type'); ?>: </label>
				<div class="controls">
				<select name="tariff_kva_type" id="tariff_kva_type">
					<option value=""></option>
					<?php foreach ($tariff_kva_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('tariff_kva_type') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>-->

			<div class="control-group">
				<label class="control-label"><?php echo lang('tou_type'); ?>: </label>
				<div class="controls">
				<select name="tou_type_id" id="tou_type_id" class="form-control">
					<option value=""></option>
					<?php foreach ($tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('tou_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>


			<!--<div class="control-group">
				<label class="control-label"><?php echo lang('season_type'); ?>: </label>
				<div class="controls">
				<select name="season_type_id" id="season_type_id" class="form-control">
					<option value=""></option>
					<?php foreach ($season_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('season_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>-->
			

			<div class="card-header">
				<div class="row">
					<div class="col-sm-6">
						<strong><?php echo lang('low_season'); ?></strong>
					</div>
				</div>
			</div>

	<div class="span6">

		<fieldset>
<div class="control-group">
				<label class="control-label"><?php echo lang('low_season_start_m'); ?>: </label>
				<div class="controls">
				<select name="low_season_start_m" id="low_season_start_m" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_season as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('low_season_start_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label"><?php echo lang('low_season_end_m'); ?>: </label>
				<div class="controls">
				<select name="low_season_end_m" id="low_season_end_m" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_season as $key => $type) {
							echo $key;
						?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('low_season_end_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>
			
		<div class="control-group">
				<label class="control-label"><?php echo lang('ekuhurleni_value1'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value1" id="value1" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('value1'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('ekuhurleni_value2'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value2" id="value2" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('value2'); ?>">
				</div>
			</div>
		</fieldset>
	</div>

	<div class="span5">
         <fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('ekuhurleni_value3'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value3" id="value3" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('value3'); ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?php echo lang('ekuhurleni_value4'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value4" id="value4" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('value4'); ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_value5'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value5" id="value5" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('value5'); ?>">
				</div>
			</div>
		</fieldset>
	</div>
	<div class="span5">
         <fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_value6'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value6" id="value6" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('value6'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_value7'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value7" id="value7" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('value7'); ?>">
				</div>
			</div>


          </fieldset>

			</div>
			
			
			
	

	<!-- High Season -->
	

			<div class="card-header">
				<div class="row">
					<div class="col-sm-6">
						<strong><?php echo lang('high_season'); ?></strong>
					</div>
				</div>
			</div>

	<div class="span6">

		<fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('high_season_start_m'); ?>: </label>
				<div class="controls">
				<select name="high_season_start_m" id="high_season_start_m" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_season as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('high_season_start_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label"><?php echo lang('high_season_end_m'); ?>: </label>
				<div class="controls">
				<select name="high_season_end_m" id="high_season_end_m" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_season as $key => $type) {
							echo $key;
						?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('high_season_end_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>		
		
		<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_hvalue1'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue1" id="hvalue1" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('hvalue1'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_hvalue2'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue2" id="hvalue2" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('hvalue2'); ?>">
				</div>
			</div>
		</fieldset>
	</div>

	<div class="span5">
         <fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_hvalue3'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue3" id="hvalue3" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('hvalue3'); ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_hvalue4'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue4" id="hvalue4" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('hvalue4'); ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_hvalue5'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue5" id="hvalue5" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('hvalue5'); ?>">
				</div>
			</div>
		</fieldset>
	</div>
	<div class="span5">
         <fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_hvalue6'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue6" id="hvalue6" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('hvalue6'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tshwane_hvalue7'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue7" id="hvalue7" class="form-control" value="<?php echo $this->mdl_tariff_type_tshwane->form_value('hvalue7'); ?>">
				</div>
			</div>


          </fieldset>

			</div>

			<!--<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_kva_type'); ?>: </label>
				<div class="controls">
				<select name="tariff_kva_type_id" id="tariff_kva_type_id">
					<option value=""></option>
					<?php foreach ($tariff_kva_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_tshwane->form_value('tariff_kva_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>-->


	</div>
</form>