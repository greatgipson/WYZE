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
					<h4><?php echo lang('add_city_power_tariff_type'); ?></h4>
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
											<option value="<?php echo $type->id; ?>" <?php if ($type->council_name == "City Power") { ?>selected="selected"<?php } ?>><?php echo $type->council_name; ?> </option>
								<?php } ?>
						</select>
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_name'); ?>: </label>
				<div class="controls">
					<input type="text" name="tariff_name" id="tariff_name" class ="resizedTextbox form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('tariff_name'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_kva_type'); ?>: </label>
				<div class="controls">
				<select name="tariff_kva_type_id" id="tariff_kva_type_id" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_kva_non_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('tariff_kva_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
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
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('billing_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
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
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('tariff_kva_type') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
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
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('tou_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>


		<!--	<div class="control-group">
				<label class="control-label"><?php echo lang('season_type'); ?>: </label>
				<div class="controls">
				<select name="season_type_id" id="season_type_id" class="form-control">
					<option value=""></option>
					<?php foreach ($season_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('season_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>-->
			
			<br>
			<div class="card-header">
				<div class="row">
					<div class="col-sm-6">
						<strong><?php echo lang('low_season'); ?></strong>
					</div>
				</div>
			</div>

			<!--- Low Season -->
	<div class="span6">

		<fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('low_season_start_m'); ?>: </label>
				<div class="controls">
				<select name="low_season_start_m" id="low_season_start_m" class="form-control">
					<option value=""></option>
					<?php foreach ($tariff_season as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('low_season_start_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
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
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('low_season_end_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>
		
		<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value1'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value1" id="value1" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value1'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value2'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value2" id="value2" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value2'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value3'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value3" id="value3" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value3'); ?>">
				</div>
			</div>

				</fieldset>

	</div>

	<div class="span5">

		<fieldset>
	    <div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value9'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value9" id="value9" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value9'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value10'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value10" id="value10" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value10'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value11'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value11" id="value11" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value11'); ?>">
				</div>
			</div>
		</fieldset>
         <fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value4'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value4" id="value4" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value4'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value5'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value5" id="value5" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value5'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value6'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value6" id="value6" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value6'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value7'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value7" id="value7" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value7'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value8'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value8" id="value8" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value8'); ?>">
				</div>
			</div>

          </fieldset>

			</div>
		<div class="span6">

		<fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value12'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value12" id="value12" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value12'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value13'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value13" id="value13" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value13'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_value14'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="value14" id="value14" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('value14'); ?>">
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
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('tariff_kva_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>-->

			
			
	<!-- High Season -->
	
				<br>
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
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('high_season_start_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
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
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type_city_power->form_value('high_season_end_m') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>		

		<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue1'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue1" id="hvalue1" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue1'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue2'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue2" id="hvalue2" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue2'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue3'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue3" id="hvalue3" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue3'); ?>">
				</div>
			</div>

				</fieldset>

	</div>

	<div class="span5">

		<fieldset>
	    <div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue9'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue9" id="hvalue9" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue9'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue10'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue10" id="hvalue10" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue10'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue11'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue11" id="hvalue11" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue11'); ?>">
				</div>
			</div>
		</fieldset>
         <fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue4'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue4" id="hvalue4" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue4'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue5'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue5" id="hvalue5" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue5'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue6'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue6" id="hvalue6" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue6'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue7'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue7" id="hvalue7" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue7'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue8'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue8" id="hvalue8" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue8'); ?>">
				</div>
			</div>

          </fieldset>

			</div>
		<div class="span6">

		<fieldset>
			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue12'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue12" id="hvalue12" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue12'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue13'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue13" id="hvalue13" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue13'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('city_power_hvalue14'); ?>: </label>
				<div class="controls">
		 			<input type="number" step="any" name="hvalue14" id="hvalue14" class="form-control" value="<?php echo $this->mdl_tariff_type_city_power->form_value('hvalue14'); ?>">
				</div>
			</div>
			</fieldset>
	</div>

	

	</div>
</form>