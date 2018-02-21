<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>
<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="row">
				<div class="col-sm-6">
					<h4><?php echo lang('client_meters'); ?></h4>
				</div>
				<div class="col-sm-6">
					<?php $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<?php $this->layout->load_view('layout/alerts'); ?>
				<div class="row">
		  <div class="col-sm-12">
			<div class="card">
				<div class="card-header">
				  <strong><?php echo lang('meter_information'); ?></strong>
				</div>
			<div class="card-body">
			
			<div class="form-group row">
				<label class="col-md-2 form-col-md-2 form-control-label"><?php echo lang('client_name'); ?>: </label>
				<div class="col-md-4">
					<select name="client_id" class="form-control">
							<option value="0"></option>
							<?php foreach ($client_names as $key => $type) { ?>
										<?php $type->client_id; ?>
										<option value="<?php echo $type->client_id; ?>" <?php if ($this->mdl_client_meters->form_value('client_id') == $type->client_id) { ?>selected="selected"<?php } ?>><?php echo $type->client_name; ?> </option>
							<?php } ?>
					</select>
				</div>
			</div>

            <div class="form-group row">
                <label class="col-md-2 form-col-md-2 form-control-label"><?php echo lang('active_client'); ?>: </label>
                <div class="col-md-4">
                    <input type="checkbox" name="is_active" id="is_active" class="checkbox" value="1" <?php if ($this->mdl_client_meters->form_value('is_active') == 1 or !is_numeric($this->mdl_client_meters->form_value('is_active'))) { ?>checked="checked"<?php } ?>>
                </div>
            </div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label"><?php echo lang('meter_type'); ?>: </label>
				<div class="col-md-4">
					<select name="meter_type_id" id="meter_type_id" class="form-control">
						<option value=""></option>
							<?php foreach ($meter_type as $key => $type) { ?>
							<?php $type; ?>
							<option value="<?php echo $key; ?>" <?php if ($this->mdl_client_meters->form_value('meter_type_id') == $key) { ?> selected="selected"<?php } ?>><?php echo $type; ?></option>
						  <?php } ?>
					</select>
				</div>
			</div>
			
			
				<div class="form-group row">
                        <label class="col-md-2 form-control-label"><?php echo lang('description'); ?>: </label>
                        <div class="col-md-4">
                            <input type="text" name="description" id="description" class="form-control" value="<?php echo $this->mdl_client_meters->form_value('description'); ?>">
                        </div>
                </div>
			

				<div class="form-group row">
                        <label class="col-md-2 form-control-label"><?php echo lang('breaker_size'); ?>: </label>
                        <div class="col-md-4">
                            <input type="text" name="breaker_size" id="breaker_size" class="form-control" value="<?php echo $this->mdl_client_meters->form_value('breaker_size'); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label"><?php echo lang('connections'); ?>: </label>
                        <div class="col-md-4">
                           <!-- <input type="text" name="connections" id="connections" value="<?php echo $this->mdl_client_meters->form_value('connections'); ?>"> -->

                           	<select name="connection_id" id="connection_id" class="form-control">
									<option value=""></option>
									<?php foreach ($connections as $key => $type) { ?>
										<?php $type; ?>
										<option value="<?php echo $key; ?>" <?php if ($this->mdl_client_meters->form_value('connection_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
									<?php } ?>
								</select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label"><?php echo lang('date_of_installation'); ?>: </label>

                        <?php
                        if ($this->mdl_client_meters->form_value('date_of_installation')){
							$dateofinstallation=$this->mdl_client_meters->form_value('date_of_installation');
						}else{
							$dateofinstallation= date("Y-m-d");
						}
						?>


                        <div class="col-md-4">
                            <input type="date" name="date_of_installation" id="date_of_installation" class="form-control" value="<?php echo date("Y-m-d",strtotime($dateofinstallation));?>">
                        </div>
                    </div>


   					<div class="form-group row">
                        <label class="col-md-2 form-control-label"><?php echo lang('meter_number'); ?>: </label>
                        <div class="col-md-4">
                            <input type="text" name="meter_number" id="meter_number" class="form-control" value="<?php echo $this->mdl_client_meters->form_value('meter_number'); ?>">
                        </div>
                    </div>


   					<div class="form-group row">
                        <label class="col-md-2 form-control-label"><?php echo lang('modem_number'); ?>: </label>
                        <div class="col-md-4">
                            <input type="text" name="modem_number" id="modem_number" class="form-control" value="<?php echo $this->mdl_client_meters->form_value('modem_number'); ?>">
                        </div>
                    </div>


				<div class="form-group row">
				<label class="col-md-2 form-control-label"><?php echo lang('sim_number'); ?>: </label>
				<div class="col-md-4">
					<input type="text" name="sim_number" id="sim_number" class="form-control" value="<?php echo $this->mdl_client_meters->form_value('sim_number'); ?>">
				</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 form-control-label"><?php echo lang('sim_cell_number'); ?>: </label>
					<div class="col-md-4">
						<input type="number" name="sim_cell_number" id="sim_cell_number" class="form-control" value="<?php echo $this->mdl_client_meters->form_value('sim_cell_number'); ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 form-control-label"><?php echo lang('ip_address'); ?>: </label>
					<div class="col-md-4">
						<input type="text" name="ip_address" id="ip_address" class="form-control" value="<?php echo $this->mdl_client_meters->form_value('ip_address'); ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 form-control-label"><?php echo lang('ct_ratio'); ?>: </label>
					<div class="col-md-4">
						<?php
							$ctratio = $this->mdl_client_meters->form_value('ct_ratio');
							if (!is_numeric($ctratio)) {
								$ctratio = 0;
							}
						?>

						<input type="text" name="ct_ratio" id="ct_ratio" class="form-control" value="<?php echo $ctratio; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 form-control-label"><?php echo lang('vt_ratio'); ?>: </label>


					<div class="col-md-4">
					<?php
												$vt_ratio = $this->mdl_client_meters->form_value('vt_ratio');
												if (!is_numeric($vt_ratio)) {
													$vt_ratio = 0;
												}
						?>
						<input type="text" name="vt_ratio" id="vt_ratio" class="form-control" value="<?php echo $vt_ratio; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 form-control-label"><?php echo lang('meter_kwh_total'); ?>: </label>

						<?php
								$meter_kwh_total = $this->mdl_client_meters->form_value('meter_kwh_total');
								if (!is_float($meter_kwh_total)) {
									$meter_kwh_total = 0.00;
								}
						?>

					<div class="col-md-4">
						<input type="number" step="any" name="meter_kwh_total" class="form-control" id="meter_kwh_total" value="<?php echo $meter_kwh_total; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 form-control-label"><?php echo lang('meter_kvarh_total'); ?>: </label>
						<?php
								$meter_kvarh_total = $this->mdl_client_meters->form_value('meter_kvarh_total');
								if (!is_float($meter_kvarh_total)) {
									$meter_kvarh_total = 0.00;
								}
						?>
					<div class="col-md-4">
						<input type="number" step="any" name="meter_kvarh_total" class="form-control" id="meter_kvarh_total" value="<?php echo $meter_kvarh_total; ?>">
					</div>
				</div>


	</div>
	</div>
	</div>
	</div>
	</div>
</form>