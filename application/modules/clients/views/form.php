<script type="text/javascript">
$(function() {
   $('#client_name').focus();
});
</script>

<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="row">
				<div class="col-sm-6">
					<h4><?php echo lang('client_form'); ?></h4>
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
			  <strong><?php echo lang('personal_information'); ?></strong>
			</div>
			<div class="card-body">
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_active"><?php echo lang('active_client'); ?>: </label>
				  <div class="col-md-4">
					<input type="checkbox" name="client_active" id="client_active" value="1" <?php if ($this->mdl_clients->form_value('client_active') == 1 or !is_numeric($this->mdl_clients->form_value('client_active'))) { ?>checked="checked"<?php } ?> >					
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_name">* <?php echo lang('client_name'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" id="client_name" name="client_name" class="form-control" value="<?php echo $this->mdl_clients->form_value('client_name'); ?>">				
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_billing_date"><?php echo lang('client_billing_date'); ?>: </label>
					<?php
					if ($this->mdl_clients->form_value('client_billing_date')){
						$billingdate=$this->mdl_clients->form_value('client_billing_date');
					}else{
						$billingdate= date("Y-m-d");
						//$billingdate="";
					}
					?>				  
				  <div class="col-md-4">
					<input type="date" id="client_billing_date" name="client_billing_date" class="form-control" value="<?php echo date("Y-m-d",strtotime($billingdate));?>">
				  </div>
				</div>				
			</div>

		  </div>
		  </div>

		  <div class="col-sm-12">
			<div class="card">
			<div class="card-header">
			  <strong><?php echo lang('tariff_information'); ?></strong>
			</div>
			<div class="card-body">
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="tariff_id"><?php echo lang('tariff_type_desc'); ?>: </label>
				  <div class="col-sm-4">
						<select name="tariff_id" class="form-control">
							<option value="0"></option>
							<?php foreach ($tariff_names as $key => $type) { ?>
										<?php $type->tariff_id; ?>
										<option value="<?php echo $type->tariff_id; ?>" <?php if ($this->mdl_clients->form_value('tariff_id') == $type->tariff_id) { ?>selected="selected"<?php } ?>><?php echo $type->tariff_name; ?> </option>
							<?php } ?>
						</select>					
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="alternative_tariff_id"><?php echo lang('tariff_type_alternative_desc'); ?>: </label>
				  <div class="col-md-4">
						<select name="alternative_tariff_id" class="form-control">
							<option value="0"></option>
							<?php foreach ($tariff_names as $key => $type) { ?>
										<?php $type->tariff_id; ?>
										<option value="<?php echo $type->tariff_id; ?>" <?php if ($this->mdl_clients->form_value('alternative_tariff_id') == $type->tariff_id) { ?>selected="selected"<?php } ?>><?php echo $type->tariff_name; ?> </option>
							<?php } ?>
						</select>				
				  </div>
				</div>				
			</div>

		  </div>
		  </div>

		  <div class="col-sm-12">
			<div class="card">
			<div class="card-header">
			  <strong><?php echo lang('address'); ?></strong>
			</div>
			<div class="card-body">
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('street_address'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_address_1" class="form-control" id="client_address_1" value="<?php echo $this->mdl_clients->form_value('client_address_1'); ?>">
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_2"><?php echo lang('street_address_2'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_address_2" class="form-control" id="client_address_2" value="<?php echo $this->mdl_clients->form_value('client_address_2'); ?>">			
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_city"><?php echo lang('city'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_city" class="form-control" id="client_city" value="<?php echo $this->mdl_clients->form_value('client_city'); ?>">			
				  </div>
				</div>	
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_state"><?php echo lang('state'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_state" class="form-control" id="client_state" value="<?php echo $this->mdl_clients->form_value('client_state'); ?>">			
				  </div>
				</div>	
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_zip"><?php echo lang('zip_code'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_zip" class="form-control" id="client_zip" value="<?php echo $this->mdl_clients->form_value('client_zip'); ?>">			
				  </div>
				</div>	
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_country"><?php echo lang('country'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_country" class="form-control" id="client_country" value="<?php echo $this->mdl_clients->form_value('client_country'); ?>">			
				  </div>
				</div>					
			</div>

		  </div>
		  </div>		  		  

					<?php //---it---inizio ?>
					<!--<fieldset>
						<legend>Ditta</legend>

						<div class="control-group">
							<label class="control-label"><?php echo lang('it_codice_fiscale'); ?>: </label>
							<div class="controls">
								<input type="text" name="client_it_codfisc" id="client_it_codfisc" value="<?php echo $this->mdl_clients->form_value('client_it_codfisc'); ?>">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo lang('it_partita_iva'); ?>: </label>
							<div class="controls">
								<input type="text" name="client_it_piva" id="client_it_piva" value="<?php echo $this->mdl_clients->form_value('client_it_piva'); ?>">
							</div>
						</div>
					</fieldset> -->
					<?php //---it---fine ?>

		  <div class="col-sm-12">
			<div class="card">
			<div class="card-header">
			  <strong><?php echo lang('contact_information'); ?></strong>
			</div>
			<div class="card-body">
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_phone"><?php echo lang('phone_number'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_phone" class="form-control" id="client_phone" value="<?php echo $this->mdl_clients->form_value('client_phone'); ?>">
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_fax"><?php echo lang('fax_number'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_fax" class="form-control" id="client_fax" value="<?php echo $this->mdl_clients->form_value('client_fax'); ?>">			
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_mobile"><?php echo lang('mobile_number'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_mobile" class="form-control" id="client_mobile" value="<?php echo $this->mdl_clients->form_value('client_mobile'); ?>">			
				  </div>
				</div>	
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_email"><?php echo lang('email_address'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_email" class="form-control" id="client_email" value="<?php echo $this->mdl_clients->form_value('client_email'); ?>">			
				  </div>
				</div>	
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_web"><?php echo lang('web_address'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="client_web" class="form-control" id="client_web" value="<?php echo $this->mdl_clients->form_value('client_web'); ?>">			
				  </div>
				</div>						
			</div>

		  </div>
		  </div>					
					

		</div>
	</div>


        <!--<div class="row-fluid">

            <div class="span12">
        <fieldset>
            <legend><?php echo lang('custom_fields'); ?></legend>

            <?php foreach ($custom_fields as $custom_field) { ?>
            <div class="control-group">
                <label class="control-label"><?php echo $custom_field->custom_field_label; ?>: </label>
                <div class="controls">
                                <input type="text" name="custom[<?php echo $custom_field->custom_field_column; ?>]" id="<?php echo $custom_field->custom_field_column; ?>" value="<?php echo form_prep($this->mdl_clients->form_value('custom[' . $custom_field->custom_field_column . ']')); ?>">
	</div>
            </div>
            <?php } ?>
        </fieldset>
            </div>

        </div>-->

	</div>

</form>