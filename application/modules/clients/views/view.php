<script type="text/javascript">
	$(function() {
		$('#save_client_note').click(function()
		{
			$.post("<?php echo site_url('clients/ajax/save_client_note'); ?>",
			{
				client_id: $('#client_id').val(),
				client_note: $('#client_note').val()
			}, function(data) {
				var response = JSON.parse(data);
				if (response.success == '1')
				{
					// The validation was successful
					$('.control-group').removeClass('error');
					$('#client_note').val('');

					$('#notes_list').load("<?php echo site_url('clients/ajax/load_client_notes'); ?>",
					{
						client_id: <?php echo $client->client_id; ?>
					});
				}
				else
				{
					// The validation was not successful
					$('.control-group').removeClass('error');
					for (var key in response.validation_errors) {
						$('#' + key).parent().parent().addClass('error');
					}
				}
			});
		});

	});
</script>

<div class="headerbar">
		<div class="breadcrumb">
			<div class="row">
				<div class="col-sm-6">
					<h4><?php echo $client->client_name; ?></h4>
				</div>
				<div class="col-sm-6">
					<div class="pull-right">
						<!--<a href="#" class="btn client-create-quote" data-client-name="<?php echo $client->client_name; ?>"><i class="icon-plus-sign"></i> <?php echo lang('create_quote'); ?></a>
						<a href="#" class="btn client-create-invoice" data-client-name="<?php echo $client->client_name; ?>"><i class="icon-plus"></i> <?php echo lang('create_invoice'); ?></a>-->
						<a href="<?php echo site_url('clients/form/' . $client->client_id); ?>" class="btn"><i class="fa fa-pencil"></i> <?php echo lang('edit'); ?></a>
						<a class="btn btn-danger" href="<?php echo site_url('clients/delete/' . $client->client_id); ?>" onclick="return confirm('<?php echo lang('delete_client_warning'); ?>');"><i class="fa fa-remove"></i> <?php echo lang('delete'); ?></a>
					</div>
				</div>
		</div>
	</div>
</div>

<div class="tabbable tabs-below">

	<div class="tab-content">

		<div id="clientDetails" class="tab-pane tab-info active">

            <?php $this->layout->load_view('layout/alerts'); ?>

			<div class="profile">

				<div class="primaryInfo row">

					<div class="pull-left">
						<h2><?php echo $client->client_name; echo "(".$client->egs_number.")"; ?></h2>
						<br>
						<span>
							<?php echo ($client->client_address_1) ? $client->client_address_1 . '<br>' : ''; ?>
							<?php echo ($client->client_address_2) ? $client->client_address_2 . '<br>' : ''; ?>
							<?php echo ($client->client_city) ? $client->client_city : ''; ?>
							<?php echo ($client->client_state) ? $client->client_state : ''; ?>
							<?php echo ($client->client_zip) ? $client->client_zip : ''; ?>
							<?php echo ($client->client_country) ? '<br>' . $client->client_country : ''; ?>
							<?php //---it---inizio ?>
							<!--<?php echo ($client->client_it_codfisc) ? '<br><strong>'.lang('it_codice_fiscale').':</strong> ' . $client->client_it_codfisc : ''; ?>
							<?php echo ($client->client_it_piva) ? '<br><strong>'.lang('it_partita_iva').':</strong> ' . $client->client_it_piva : ''; ?>-->
							<?php //---it---fine ?>
						</span>
					</div>
<!--
					<div class="pull-right" style="text-align: right;">
						<span><strong><?php echo lang('total_billed'); ?>:</strong> <?php echo format_currency($client->client_invoice_total); ?></span><br>
						<span><strong><?php echo lang('total_paid'); ?>:</strong> <?php echo format_currency($client->client_invoice_paid); ?></span><br>
						<span><strong><?php echo lang('total_balance'); ?>:</strong> <?php echo format_currency($client->client_invoice_balance); ?></span>
					</div>
-->
				</div>

				<dl>
					<dt><span><?php echo lang('contact_information'); ?></span></dt>
					<div class="left_algin">

					<?php if ($client->client_email) { ?>
					<dd><span><?php echo lang('email'); ?>:</span> <?php echo auto_link($client->client_email, 'email'); ?></dd>
					<?php } ?>
					<?php if ($client->client_phone) { ?>
					<dd><span><?php echo lang('phone'); ?>:</span> <?php echo $client->client_phone; ?></dd>
					<?php } ?>
					<?php if ($client->client_mobile) { ?>
					<dd><span><?php echo lang('mobile'); ?>:</span> <?php echo $client->client_mobile; ?></dd>
					<?php } ?>
					<?php if ($client->client_fax) { ?>
					<dd><span><?php echo lang('fax'); ?>:</span> <?php echo $client->client_fax; ?></dd>
					<?php } ?>
					<?php if ($client->client_web) { ?>
					<dd><span><?php echo lang('web'); ?>:</span> <?php echo auto_link($client->client_web,'url', TRUE); ?></dd>
					<?php } ?>
					</div>
				</dl>

				<dl>
					<dt><span><?php echo lang('tariff_information'); ?></span></dt>
					<div class="left_algin">
						<?php if ($client->tariff_name) { ?>
							<dd><b><?php echo lang('tariff_type_desc'); ?>:</b> <?php echo $client->tariff_name; ?></dd>
						<?php } ?>


						<?php if ($client->alternative_tariff_id) { ?>

							<?php foreach ($tariff_names as $key => $type) { ?>
										<?php $type->tariff_id; ?>
										 <?php if ($client->alternative_tariff_id == $type->tariff_id) { ?>   <dd><b><?php echo lang('tariff_type_alternative_desc'); ?>:</b>    <?php echo $type->tariff_name;}?></dd>
							<?php } ?>

						<?php } ?>



					</div>

					</div>
				</dl>
<!--
                <dl class="profile-custom">
                    <dt><span><?php echo lang('custom_fields'); ?></span></dt>
                    <?php foreach ($custom_fields as $custom_field) { ?>
                    <dd><span><?php echo $custom_field->custom_field_label; ?>: </span> <?php echo $client->{$custom_field->custom_field_column}; ?></dd>
                    <?php } ?>
                </dl>
-->
                <br>

			</div>
<!--
			<div class="notes">

				<div id="notes_list">
					<?php echo $partial_notes; ?>
				</div>

				<form>
					<input type="hidden" name="client_id" id="client_id" value="<?php echo $client->client_id; ?>">
					<fieldset>

						<legend><?php echo lang('notes'); ?></legend>
						<div class="control-group">
							<div class="controls">
								<textarea id="client_note"></textarea>
							</div>
						</div>

						<input type="button" id="save_client_note" class="btn btn-primary" value="<?php echo lang('add_notes'); ?>">
					</fieldset>
				</form>

			  </div> -->
			  
			  
			</div>

		<!--<div id="clientQuotes" class="tab-pane">
			<?php echo $quote_table; ?>
		</div>-->

		<div id="clientInvoices" class="tab-pane">
			<?php echo $invoice_table; ?>
		</div>

	</div>

	<!--<ul class="nav-tabs">
		<li class="active"><a data-toggle="tab" href="#clientDetails"><?php echo lang('details'); ?></a></li>
		<li><a data-toggle="tab" href="#clientQuotes"><?php echo lang('quotes'); ?></a></li>
		<li><a data-toggle="tab" href="#clientInvoices"><?php echo lang('invoices'); ?></a></li>
	</ul>-->


</div>