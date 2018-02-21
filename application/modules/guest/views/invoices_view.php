<script type="text/javascript">

    $(function() {

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



<div class="headerbar">
		<div class="breadcrumb">
			<div class="row">
				<div class="col-sm-6">
					<h4>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang('invoice'); ?> #<?php echo $invoice->invoice_number; ?> 
					<?php if($invoice->invoice_type_id == 1){ 
						echo "<b>(Meter Invoice)</b>"; 
					}else { 
						echo "<b> (Council Invoice) </b>"; } 
					?>
					</h4>
				</div>
				<div class="col-sm-6">
					<div class="pull-right">
						<a href="<?php echo site_url('guest/invoices/generate_pdf/' . $invoice->invoice_id); ?>" class="btn" id="btn_generate_pdf" data-invoice-id="<?php echo $invoice_id; ?>" data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"><i class="icon-print"></i> <?php echo lang('download_pdf'); ?></a>					
					</div>
				</div>
		</div>
	</div>
</div>
<!--<div class="headerbar">
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang('invoice'); ?> #<?php echo $invoice->invoice_number; ?></h4> <?php if($invoice->invoice_type_id == 1){ echo "<h1>&nbsp;&nbsp;&nbsp;(EGSMeter Invoice)</h1>"; } else {echo "<h1>&nbsp;&nbsp;&nbsp;
	(Council Invoice)</h1>"; } ?>

	<div class="pull-right">
		<!--<a href="#" class="btn" id="btn_add_item" style="margin-right: 5px;"><i class="icon-plus-sign"></i> <?php echo lang('add_item'); ?></a>-->
  <!--      <a href="<?php echo site_url('guest/invoices/generate_pdf/' . $invoice->invoice_id); ?>" class="btn" id="btn_generate_pdf" data-invoice-id="<?php echo $invoice_id; ?>" data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"><i class="icon-print"></i> <?php echo lang('download_pdf'); ?></a>
	</div>

</div>-->
<?php
	 function formatcurrency($floatcurr){
			$curr = "ZAR";
			$currencies['ZAR'] = array(2,'.','');          //  South Africa, Rand
			return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);
	 }
?>
<?php echo $this->layout->load_view('layout/alerts'); ?>

<div class="content">

	<form id="invoice_form" class="form-horizontal">

		<div class="invoice">

			<div class="cf">
				<div class="pull-left">

						<h1><?php echo $invoice->client_name; ?></h1><h3><?php echo htmlspecialchars($invoice->tariff_name); ?></h3><br>
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


				<table border="0" cellpadding="10" cellspacing="10" style="border-collapse:collapse; border:0px solid #000;" align="right">
				<tr>

				<td>
					<table class="pull-right table table-striped table-bordered"  border=0>
						<tbody>
							<tr>
								<td><b><?php echo "Meter Number"; ?>:</b></td>
								<td><?php echo $invoice->meter_number; ?></td>
							</tr>
							<tr>
								<td><b><?php echo "Council Acc No"; ?>:</b></td>
								<td><?php echo $invoice->council_acc_no; ?></td>
							</tr>

							<tr>
								<td><b><?php echo "kWh Prev Reading"; ?>:</b></td>
								<td><?php echo $invoice->kwh_previous_reading; ?></td>
							</tr>
							<tr>
								<td><b><?php echo "kWh Current Reading"; ?>:</b></td>
								<td><?php echo $invoice->kwh_current_reading; ?></td>
							</tr>
							<tr>
								<td><b><?php echo "kVArh Prev Reading"; ?>:</b></td>
								<td><?php echo $invoice->kvarh_previous_reading; ?></td>
							</tr>
							<tr>
								<td><b><?php echo "kVArh Current Reading"; ?>:</b></td>
								<td><?php echo $invoice->kvarh_current_reading; ?></td>
							</tr>
						</tbody>
					</table>
				</td>

				<td style="text-align: right;">
					<table class="pull-right table table-striped table-bordered"  border=0>
						<tbody>
							<tr>
								<td><b>Council: </b></td>
								<td><?php echo $invoice->council_name; ?></td>
							</tr>
							<tr>
								<td><b><?php echo "Billing Start date"; ?>: </b></td>
								<td><?php echo $invoice->billing_start_date; ?></td>
							</tr>
							<tr>
								<td><b><?php echo "Billing End  date"; ?>: </b></td>
								<td><?php echo $invoice->billing_end_date; ?></td>
							</tr>
							<tr>
								<td><b><?php echo "Breaker Size"; ?>: </b></td>
								<td><?php echo $invoice->breaker_size; ?></td>
							</tr>
							<tr>
								<td><b><?php echo lang('amount_due'); ?>: </b></td>
								<td><?php echo formatcurrency($invoice->invoice_balance); ?></td>
							</tr>
							<tr>
								<td><b>&nbsp;</b></td>
								<td>&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</td>


			<!--<td>

				<table style="width: auto" class="pull-right table table-striped table-bordered">

                    <tbody>
                        <tr>
                            <td><?php echo lang('invoice'); ?> #</td>
                            <td><?php echo $invoice->invoice_number; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('date'); ?></td>
                            <td><?php echo date_from_mysql($invoice->invoice_date_created); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('due_date'); ?></td>
                            <td><?php echo date_from_mysql($invoice->invoice_date_due); ?></td>
                        </tr>

                    </tbody>

				</table>

				</td>-->


				</tr>
				</table>



			</div>

            <table id="item_table" class="items table table-striped table-bordered">
                <thead>
                    <tr>
                        <th><?php echo lang('item'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                        <!--<th><?php echo lang('quantity'); ?></th>-->
                        <th>Charges/Price</th>
                        <th><?php echo lang('subtotal'); ?></th>
                        <th>VAT 14.00%</th>
                        <th><?php echo lang('total'); ?></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($items as $item) { ?>
                    <tr class="item">
                        <td><?php echo $item->item_name; ?></td>
 							<td><?php echo nl2br($item->item_description); ?></td>
                        <!--<td><?php echo $item->item_quantity; ?></td>-->
                        <?php if($item->item_price>0) { ?>
							<td><?php echo ($item->item_price); ?></td>
							<td><?php echo formatcurrency($item->item_subtotal); ?></td>
							<td><?php echo formatcurrency($item->item_tax_total); ?></td>
							<td><?php echo formatcurrency($item->item_total); ?></td>
						<?php }else{ ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>

						<?php } ?>
                    </tr>
                    <?php } ?>

                </tbody>

            </table>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th><?php echo lang('subtotal'); ?></th>
                        <th><?php echo lang('item_tax'); ?></th>
                       <!-- <th><?php echo lang('invoice_tax'); ?></th> -->
                        <th><?php echo lang('total'); ?></th>
                       <!-- <th><?php echo lang('paid'); ?></th>
                        <th><?php echo lang('balance'); ?></th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo formatcurrency($invoice->invoice_item_subtotal); ?></td>
                        <td><?php echo formatcurrency($invoice->invoice_item_tax_total); ?></td>
                       <!-- <td>
                            <?php if ($invoice_tax_rates) { foreach ($invoice_tax_rates as $invoice_tax_rate) { ?>
                                <strong><?php echo anchor('invoices/delete_invoice_tax/' . $invoice->invoice_id . '/' . $invoice_tax_rate->invoice_tax_rate_id, lang('remove')) . ' ' . $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%:</strong>
                                <?php echo formatcurrency($invoice_tax_rate->invoice_tax_rate_amount); ?><br>
                            <?php } } else { echo formatcurrency('0'); }?>
                        </td>-->
                        <td><?php echo formatcurrency($invoice->invoice_total); ?></td>
                       <!-- <td><?php echo formatcurrency($invoice->invoice_paid); ?></td>
                        <td><?php echo formatcurrency($invoice->invoice_balance); ?></td>-->
                    </tr>
                </tbody>
            </table>

			<p><strong><?php echo lang('invoice_terms'); ?></strong></p>
			<p><?php echo nl2br($invoice->invoice_terms); ?></p>

		</div>

	</form>

</div>