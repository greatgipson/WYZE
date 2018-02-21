<script type="text/javascript">

    $(function() {

        $('#btn_save_invoice').click(function() {
            var items = [];
			var item_order = 1;
            $('table tr.item').each(function() {
			    var row = {};
                $(this).find('input,select,textarea').each(function() {
                    if ($(this).is(':checkbox')) {
                        row[$(this).attr('name')] = $(this).is(':checked');
                    } else {
                        row[$(this).attr('name')] = $(this).val();
                    }
                });
				row['item_order'] = item_order;
				item_order++;
                items.push(row);
            }

            );

            $.post("<?php echo site_url('guest/invoices/save'); ?>", {
                invoice_id: <?php echo $invoice_id; ?>,
                invoice_number: $('#invoice_number').val(),
                invoice_date_created: $('#invoice_date_created').val(),
                invoice_date_due: $('#invoice_date_due').val(),
                invoice_status_id: $('#invoice_status_id').val(),
                items: JSON.stringify(items),
                invoice_terms: $('#invoice_terms').val(),
                custom: $('input[name^=custom]').serializeArray()
            },
            function(data) {
                var response = JSON.parse(data);
                if (response.success == '1') {
                    window.location = "<?php echo site_url('guest/invoices/view'); ?>/" + <?php echo $invoice_id; ?>;
                }
                else {
                    $('.control-group').removeClass('error');
                    for (var key in response.validation_errors) {
                        $('#' + key).parent().parent().addClass('error');
                    }
                }
            });
        });

        $('#btn_generate_pdf').click(function() {
            window.location = '<?php echo site_url('invoices/generate_pdf/' . $invoice_id); ?>';
        });

        $('#btn_add_item').click(function() {
            $('#new_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
        });

        <?php if (!$items) { ?>
            $('#new_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
        <?php } ?>

    });

</script>



	<?php
			 function formatcurrency($floatcurr){
					$curr = "ZAR";
					$currencies['ZAR'] = array(2,'.',' ');          //  South Africa, Rand
					return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);
			 }
		?>

<div class="headerbar">
	<h1>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang('invoice'); ?> #<?php echo $invoice->invoice_number; ?></h1>

	<div class="pull-right">
		<!--<a href="#" class="btn" id="btn_add_item" style="margin-right: 5px;"><i class="icon-plus-sign"></i> <?php echo lang('add_item'); ?></a>-->
        <a href="<?php echo site_url('guest/invoices/generate_pdf/' . $invoice->invoice_id); ?>" class="btn" id="btn_generate_pdf" data-invoice-id="<?php echo $invoice_id; ?>" data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"><i class="icon-print"></i> <?php echo lang('download_pdf'); ?></a>
        <a href="#" class="btn btn-primary" id="btn_save_invoice"><i class="icon-ok icon-white"></i> <?php echo lang('save'); ?></a>
	</div>

</div>

<div class="content">

<?php echo $this->layout->load_view('layout/alerts'); ?>

	<form id="invoice_form" class="form-horizontal">

		<div class="invoice">

			<div class="cf">

				<div class="pull-left">
					 <h2><a href="<?php echo site_url('clients/view/' . $invoice->client_id); ?>"><?php echo $invoice->client_name; ?></a></h2><br>
										<span>
											<?php echo ($invoice->client_address_1) ? $invoice->client_address_1 . '<br>' : ''; ?>
											<?php echo ($invoice->client_address_2) ? $invoice->client_address_2 . '<br>' : ''; ?>
											<?php echo ($invoice->client_city) ? $invoice->client_city : ''; ?>
											<?php echo ($invoice->client_state) ? $invoice->client_state : ''; ?>
											<?php echo ($invoice->client_zip) ? $invoice->client_zip : ''; ?>
											<?php echo ($invoice->client_country) ? '<br>' . $invoice->client_country : ''; ?>
										</span>
										<br><br>
										<?php if ($invoice->client_phone) { ?>
										<span><strong><?php echo lang('phone'); ?>:</strong> <?php echo $invoice->client_phone; ?></span><br>
										<?php } ?>
										<?php if ($invoice->client_email) { ?>
										<span><strong><?php echo lang('email'); ?>:</strong> <?php echo $invoice->client_email; ?></span>
					<?php } ?>
				</div>


				<table style="width: auto" class="pull-right table table-striped table-bordered">

				                    <tbody>
				                        <tr>
				                            <td>
				                                <div class="control-group invoice-properties">
				                                    <label class="control-label"><?php echo lang('invoice'); ?> #</label>
				                                    <div class="controls">
				                                        <input type="text" id="invoice_number" class="input-small" value="<?php echo $invoice->invoice_number; ?>" style="margin: 0px;" DISABLED>
				                                    </div>
				                                </div>
				                                <div class="control-group invoice-properties">
				                                    <label class="control-label"><?php echo lang('date'); ?></label>
				                                    <div class="controls">
				                                        <input type="text" id="invoice_date_created" class="input-small" value="<?php echo date_from_mysql($invoice->invoice_date_created); ?>" style="margin: 0px;" DISABLED>
				                                    </div>
				                                </div>
				                                <div class="control-group invoice-properties">
				                                    <label class="control-label"><?php echo lang('due_date'); ?></label>
				                                    <div class="controls">
				                                        <input type="text" id="invoice_date_due" class="input-small" value="<?php echo date_from_mysql($invoice->invoice_date_due); ?>" style="margin: 0px;" DISABLED>
				                                    </div>
				                                </div>
				                                <div class="control-group invoice-properties">
				                                    <label class="control-label"><?php echo lang('status'); ?></label>
				                                    <div class="controls">
				                                        <select name="invoice_status_id" id="invoice_status_id" DISABLED>
				                                            <?php foreach ($invoice_statuses as $key=>$status) { ?>
				                                            <option value="<?php echo $key; ?>" <?php if ($key == $invoice->invoice_status_id) { ?>selected="selected"<?php } ?>><?php echo $status['label']; ?></option>
				                                            <?php } ?>
				                                        </select>
				                                    </div>
				                                </div>
				                            </td>
				                        </tr>
				                    </tbody>

				</table>

			</div>




<table id="item_table" class="items table table-striped table-bordered">
	<thead>
		<tr>
			<th><?php echo lang('item'); ?></th>
			<th style="min-width: 300px;"><?php echo lang('description'); ?></th>
			<th style="width: 100px;">Units/<?php echo lang('quantity'); ?></th>
			<th style="width: 100px;">Charges/Price</th>
			<th><?php echo lang('tax_rate'); ?></th>
			<th><?php echo lang('subtotal'); ?></th>
			<th><?php echo lang('tax'); ?></th>
			<th><?php echo lang('total'); ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		<tr id="new_item" style="display: none;">
			<td style="vertical-align: top;">
				<input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
				<input type="hidden" name="item_id" value="">
				<input type="text" name="item_name" class="lookup-item-name" style="width: 90%;" data-typeahead=""><br>
                <label><input type="checkbox" name="save_item_as_lookup" tabindex="999"> <?php echo lang('save_item_as_lookup'); ?></label>
			</td>
            <td><textarea name="item_description" style="width: 90%;"></textarea></td>
			<td style="vertical-align: top;"><input type="text" class="input-mini" name="item_quantity" style="width: 90%;" value=""></td>
			<td style="vertical-align: top;"><input type="text" class="input-mini" name="item_price" style="width: 90%;" value=""></td>
			<td style="vertical-align: top;">
			    <?php print_r($tax_rates); ?>
				<select name="item_tax_rate_id" class="input-small">
					<option value="0"><?php echo lang('none'); ?></option>
					<?php foreach ($tax_rates as $tax_rate) { ?>
					<option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if ($tax_rate->tax_rate_id == $this->mdl_settings->setting('default_item_tax_rate')) { ?>selected="selected"<?php } ?>><?php echo $tax_rate->tax_rate_percent . '% - ' . $tax_rate->tax_rate_name; ?></option>
					<?php } ?>
				</select>
			</td>
			<td style="vertical-align: top;"><span name="subtotal"></span></td>
			<td style="vertical-align: top;"><span name="item_tax_total"></span></td>
			<td style="vertical-align: top;"><span name="item_total"></span></td>
			<td></td>
		</tr>

		<?php foreach ($items as $item) { ?>
		<tr class="item">
			<td style="vertical-align: top;">
				<input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
				<input type="hidden" name="item_id" value="<?php echo $item->item_id; ?>">
				<input type="text" name="item_name" style="width: 90%;" value="<?php echo $item->item_name; ?>" DISABLED>
			</td>
            <td><textarea name="item_description" style="width: 90%;" DISABLED><?php echo $item->item_description; ?></textarea></td>
			<td style="vertical-align: top;"><input type="text" name="item_quantity" style="width: 90%;" value="<?php echo ($item->item_quantity); ?>"></td>
			<td style="vertical-align: top;"><input type="text" name="item_price" style="width: 90%;" value="<?php echo ($item->item_price); ?>" DISABLED></td>
			<td style="vertical-align: top;">
				<select name="item_tax_rate_id" name="item_tax_rate_id" style="width: 90%;" DISABLED>
					<option value="0"><?php echo lang('none'); ?></option>
					<?php foreach ($tax_rates as $tax_rate) { ?>
					<option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if ($item->item_tax_rate_id == $tax_rate->tax_rate_id) { ?>selected="selected"<?php } ?>><?php echo $tax_rate->tax_rate_percent . '% - ' . $tax_rate->tax_rate_name; ?></option>
					<?php } ?>
				</select>
			</td>
			<td style="vertical-align: top;"><span name="subtotal"><?php echo formatcurrency($item->item_subtotal); ?></span></td>
			<td style="vertical-align: top;"><span name="item_tax_total"><?php echo formatcurrency($item->item_tax_total); ?></span></td>
			<td style="vertical-align: top;"><span name="item_total"><?php echo formatcurrency($item->item_total); ?></span></td>
			<td style="vertical-align: top;">
				<a class="" href="<?php echo site_url('invoices/delete_item/' . $invoice->invoice_id . '/' . $item->item_id); ?>" title="<?php echo lang('delete'); ?>">
					<i class="icon-remove"></i>
				</a>
			</td>
		</tr>
		<?php } ?>

	</tbody>

</table>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><?php echo lang('subtotal'); ?></th>
			<th><?php echo lang('item_tax'); ?></th>
			<th><?php echo lang('invoice_tax'); ?></th>
			<th><?php echo lang('total'); ?></th>
			<th><?php echo lang('paid'); ?></th>
			<th><?php echo lang('balance'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo formatcurrency($invoice->invoice_item_subtotal); ?></td>
			<td><?php echo formatcurrency($invoice->invoice_item_tax_total); ?></td>
			<td>
				<?php if ($invoice_tax_rates) { foreach ($invoice_tax_rates as $invoice_tax_rate) { ?>
					<strong><?php echo anchor('invoices/delete_invoice_tax/' . $invoice->invoice_id . '/' . $invoice_tax_rate->invoice_tax_rate_id, lang('remove')) . ' ' . $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%:</strong>
					<?php echo formatcurrency($invoice_tax_rate->invoice_tax_rate_amount); ?><br>
				<?php } } else { echo formatcurrency('0'); }?>
			</td>
			<td><?php echo formatcurrency($invoice->invoice_total); ?></td>
			<td><?php echo formatcurrency($invoice->invoice_paid); ?></td>
			<td><?php echo formatcurrency($invoice->invoice_balance); ?></td>
		</tr>
	</tbody>
</table>



	<p><strong><?php echo lang('invoice_terms'); ?></strong></p>
				<textarea id="invoice_terms" name="invoice_terms" style="width: 100%;" rows="5"><?php echo $invoice->invoice_terms; ?></textarea>
            <br><br>


		</div>
	</form>

</div>

