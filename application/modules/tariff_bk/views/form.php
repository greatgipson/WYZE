<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>
<form method="post" class="form-horizontal">

	<div class="headerbar">
		<h1><?php echo lang('tariff_type_form'); ?></h1>
		<?php $this->layout->load_view('layout/header_buttons'); ?>
	</div>

	<div class="content">

		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="control-group">
				<label class="control-label"><?php echo lang('council_name'); ?>: </label>
				<div class="controls">


						<?php //print("<pre>".print_r($council_names,true)."</pre>"); ?>
						<?php
						function array_reverse_search($value, $array) {
						             for($i = sizeof($array)-1; $i>=0; $i--) {
						                if ($array[$i]->id == $value) return $array[$i]->council_name;
						             }
						            return "";
        				}

					    //$key = array_search("2", array_column($council_names, 'id'));
					   // echo "KEY---->".array_reverse_search("1",$council_names)."<----|"; ?>

					<select name="council_id">
							<option value="0"></option>
							<?php foreach ($council_names as $key => $type) { ?>
										<?php $type->id; ?>
										<option value="<?php echo $type->id; ?>" <?php if ($this->mdl_tariff_type->form_value('council_id') == $type->id) { ?>selected="selected"<?php } ?>><?php echo $type->council_name; ?> </option>
							<?php } ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_type_desc'); ?>: </label>
				<div class="controls">

					<input type="text" name="tariff_type_desc" id="tariff_type_desc" value="<?php echo $this->mdl_tariff_type->form_value('tariff_type_desc'); ?>">
				</div>
			</div>

	</div>
</form>