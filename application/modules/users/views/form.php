<script type="text/javascript">
    $(function()
    {
        show_fields();

        $('#user_type').change(function()
        {
            show_fields();
        });

        function show_fields()
        {
            $('#administrator_fields').hide();
            $('#guest_fields').hide();

            user_type = $('#user_type').val();

            if (user_type == 1)
            {
                $('#administrator_fields').show();
            }
            else if (user_type == 2)
            {
                $('#guest_fields').show();
            }
            else if (user_type == 3)
			{
			  $('#guest_fields').show();
            }
        }
    });
</script>

<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>

<form method="post" class="form-horizontal">

 	<div class="headerbar">
		<div class="breadcrumb">
			<div class="row">
				<div class="col-sm-6">
					<h4><?php echo lang('user_form'); ?></h4>
				</div>
				<div class="col-sm-6">	
					<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
		</div>
	</div>	

    <div class="container-fluid">

        <?php echo $this->layout->load_view('layout/alerts'); ?>

		<div class="row">
		
		  <div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<strong><?php echo lang('account_information'); ?></strong>
				</div>
			
			<div class="card-body">
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('name'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="user_name" class="form-control" id="user_name" value="<?php echo $this->mdl_users->form_value('user_name'); ?>">
				  </div>
				</div>

				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('email_address'); ?>: </label>
				  <div class="col-md-4">
					<input type="text" name="user_email" class="form-control" id="user_email" value="<?php echo $this->mdl_users->form_value('user_email'); ?>">
				  </div>
				</div>

                <?php if (!$id) { ?>

				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('password'); ?>: </label>
				  <div class="col-md-4">
					<input type="password" name="user_password" class="form-control" id="user_password">
				  </div>
				</div>

				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('verify_password'); ?>: </label>
				  <div class="col-md-4">
					<input type="password" name="user_passwordv" class="form-control" id="user_passwordv">
				  </div>
				</div>

                <?php } else { ?>
				
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('change_password'); ?>: </label>
				  <div class="col-md-4">
					 <?php echo anchor('users/change_password/' . $id, lang('change_password')); ?>
				  </div>
				</div>
				<?php } ?>
				
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('user_type'); ?>: </label>
				  <div class="col-md-4">
					 <select name="user_type" id="user_type" class="form-control" >
                            <option value=""></option>
                            <?php foreach ($user_types as $key => $type) { ?>
                           <?php $type; ?>
                            <option value="<?php echo $key; ?>" <?php if ($this->mdl_users->form_value('user_type') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?></option>
                            <?php } ?>
                        </select>
				  </div>
				</div>
			
				</div>
			</div>
			</div>
			

            <!--<div id="administrator_fields">-->
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<strong><?php echo lang('address'); ?></strong>
						</div>
					
			
					<div class="card-body">
						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('street_address'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_address_1" class="form-control" id="user_address_1" value="<?php echo $this->mdl_users->form_value('user_address_1'); ?>">
						  </div>
						</div>
						
						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('street_address_2'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_address_2" class="form-control" id="user_address_2" value="<?php echo $this->mdl_users->form_value('user_address_2'); ?>">
						  </div>
						</div>

						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('city'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_city" class="form-control" id="user_city" value="<?php echo $this->mdl_users->form_value('user_city'); ?>">
						  </div>
						</div>
										
						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('state'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_state" class="form-control" id="user_state" value="<?php echo $this->mdl_users->form_value('user_state'); ?>">
						  </div>
						</div>

						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('zip_code'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_zip" class="form-control" id="user_zip" value="<?php echo $this->mdl_users->form_value('user_zip'); ?>">
						  </div>
						</div>				

						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('country'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_country" class="form-control" id="user_country" value="<?php echo $this->mdl_users->form_value('user_country'); ?>">
						  </div>
						</div>				

					  </div>
				</div>
				</div>
			<!--</div>-->

				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<strong><?php echo lang('contact_information'); ?></strong>
						</div>
					
			
					<div class="card-body">
						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('phone_number'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_phone" class="form-control" id="user_phone" value="<?php echo $this->mdl_users->form_value('user_phone'); ?>">
						  </div>
						</div>
						
						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('fax_number'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_fax" class="form-control" id="user_fax" value="<?php echo $this->mdl_users->form_value('user_fax'); ?>">
						  </div>
						</div>

						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('mobile_number'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_mobile" class="form-control" id="user_mobile" value="<?php echo $this->mdl_users->form_value('user_mobile'); ?>">
						  </div>
						</div>

						<div class="form-group row">
						  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('web_address'); ?>: </label>
						  <div class="col-md-4">
							<input type="text" name="user_web" class="form-control" id="user_web" value="<?php echo $this->mdl_users->form_value('user_web'); ?>">
						  </div>
						</div>
						</div>
					</div>
				</div>
<!--
                <fieldset>

                    <legend><?php echo lang('custom_fields'); ?></legend>

                    <?php foreach ($custom_fields as $custom_field) { ?>
                    <div class="control-group">
                        <label class="control-label"><?php echo $custom_field->custom_field_label; ?>: </label>
                        <div class="controls">
                            <input type="text" name="custom[<?php echo $custom_field->custom_field_column; ?>]" id="<?php echo $custom_field->custom_field_column; ?>" value="<?php echo form_prep($this->mdl_users->form_value('custom[' . $custom_field->custom_field_column . ']')); ?>">
            </div>
                    </div>
                    <?php } ?>
                </fieldset>
				-->

            </div>

           <div id="guest_fields">
			   <div class="col-sm-12">
				   <div class="card">
						<div class="card-header">
							<strong><?php echo lang('client_access'); ?></strong>
						</div>

						<div class="pull-right">
							<a href="#add-user-client" class="btn" style="margin-right: 5px;" data-toggle="modal"><i class="fa fa-user-circle"></i> <?php echo lang('add_client'); ?></a>
						</div>
						
						<div id="div_user_client_table">
							<?php echo $user_client_table; ?>
						</div>	
				   </div>
			   </div>
            <!--</div>-->
		</div>
			
        </div>

    </div>

</form>