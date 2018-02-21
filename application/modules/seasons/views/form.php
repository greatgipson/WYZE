<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>
<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('seasons'); ?></h4>
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

					<select name="council_id" class="form-control">
							<option value="0"></option>
							<?php foreach ($council_names as $key => $type) { ?>
										<?php $type->id; ?>
										<option value="<?php echo $type->id; ?>" <?php if ($this->mdl_seasons->form_value('council_id') == $type->id) { ?>selected="selected"<?php } ?>><?php echo $type->council_name; ?> </option>
							<?php } ?>
					</select>
				</div>
			</div>


			<div class="control-group">
							<label class="control-label"><?php echo lang('month'); ?>: </label>
							<div class="controls">

								<!--<input type="text" name="month" id="month" value="<?php echo $this->mdl_seasons->form_value('month'); ?>">-->


								<select name="month" id="month" class="form-control">
									<option value=""></option>
									<?php foreach ($months as $key => $type) { ?>
										<?php $type; ?>
										<option value="<?php echo $key; ?>" <?php if ($this->mdl_seasons->form_value('month') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
									<?php } ?>
								</select>
							</div>
			</div>


			<div class="control-group">
				<label class="control-label"><?php echo lang('season_type'); ?>: </label>
				<div class="controls">
					<!--<input type="text" name="season_type" id="season_type" value="<?php echo $this->mdl_seasons->form_value('season_type'); ?>">-->

					<select name="season_type" id="season_type" class="form-control">
							<option value=""></option>
							<?php foreach ($season_types as $key => $type) { ?>
								<?php $type; ?>
								<option value="<?php echo $key; ?>" <?php if ($this->mdl_seasons->form_value('season_type') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
							<?php } ?>
					</select>

				</div>
			</div>

			<div class="control-group">
							<label class="control-label"><?php echo lang('season_year'); ?>: </label>
							<div class="controls">
						<select name="year" id="year" class="form-control">
							<option value=""></option>
							<?php foreach ($season_years as $key => $type) { ?>
								<?php $type; ?>
								<option value="<?php echo $key; ?>" <?php if ($this->mdl_seasons->form_value('year') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
							<?php } ?>
					</select>
							</div>
			</div>


	</div>
</form>