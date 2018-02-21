<script type="text/javascript">

    $(function() {

        $('#btn_generate_pdf').click(function() {
            window.location = '<?php echo site_url('invoices/generate_pdf/' . $invoice_id); ?>';
        });

    });

</script>

<div class="headerbar">
	<h1>&nbsp;&nbsp;&nbsp;&nbsp;EGSMeters <?php echo lang('invoice'); ?> #<?php echo $invoice->invoice_number; ?> vs Council <?php echo lang('invoice'); ?> #<?php echo $linked_invoice->invoice_number; ?></h1>

<!--
	<div class="pull-right">
        <a href="<?php echo site_url('guest/invoices/generate_pdf/' . $invoice->invoice_id); ?>" class="btn" id="btn_generate_pdf" data-invoice-id="<?php echo $invoice_id; ?>" data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"><i class="icon-print"></i> <?php echo lang('download_pdf'); ?></a>
	</div>
-->
</div>
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

					<h2><?php echo $invoice->client_name; ?></h2><br>
					<span>
						<?php echo ($invoice->client_address_1) ? $invoice->client_address_1 . '<br>' : ''; ?>
						<?php echo ($invoice->client_address_2) ? $invoice->client_address_2 . '<br>' : ''; ?>
						<?php echo ($invoice->client_city) ? $invoice->client_city : ''; ?>
						<?php echo ($invoice->client_state) ? $invoice->client_state : ''; ?>
						<?php echo ($invoice->client_zip) ? $invoice->client_zip : ''; ?>
						<?php echo ($invoice->client_country) ? '<br>' . $invoice->client_country : ''; ?>
					</span>

				</div>

			<!--	<table style="width: auto" class="pull-right table table-striped table-bordered">

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

				</table>-->




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
								<td><b><?php echo lang('invoice_date'); ?>: </b></td>
								<td><?php echo $invoice->invoice_date_created; ?></td>
							</tr>

							<tr>
								<td><b><?php echo "Breaker Size"; ?>: </b></td>
								<td><?php echo $invoice->breaker_size; ?></td>
							</tr>
							<tr>
								<td><b><?php echo lang('amount_due'); ?>: </b></td>
								<td><?php echo formatcurrency($invoice->invoice_balance); ?></td>
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

			<table class="items table table-striped table-bordered">
			<tr>
			<td>
					<center><u><h4>Council Billing (<?php echo $invoice->invoice_number; ?>)</h4></u></center>
					<table id="item_table1" class="items table table-striped table-bordered">
						<thead>
							<tr>
								<th><?php echo lang('item'); ?></th>
								<th><?php echo lang('description'); ?></th>
								<th><?php echo lang('quantity'); ?></th>

								<th><?php echo lang('price'); ?></th>
								<!--<th><?php echo lang('subtotal'); ?></th>-->
								<!--<th><?php echo lang('tax'); ?></th>-->
								<th><?php echo lang('total'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $items as $index => $item) { ?>
							<tr class="item">
								<td><?php echo $item->item_name; ?></td>
								<td><?php echo nl2br($item->item_description); ?></td>
								<td><?php echo $item->item_quantity; ?></td>
								<td><?php echo ($item->item_price); ?></td>
								<!--<td><?php echo formatcurrency($item->item_subtotal); ?></td>-->
								<!--<td><?php echo formatcurrency($item->item_tax_total); ?></td>-->

								<!--<td><?php echo ($item->item_total."---".$linked_items[$index]->item_total."---"); ?></td>-->

								<?php
								if($linked_items[$index]->item_total < $item->item_total OR $linked_items[$index]->item_total > $item->item_total){
									 echo "<td><font color=#DC143C size=4>".($item->item_total)."</font></td>";
								}else if($item->item_total == $linked_items[$index]->item_total){
									echo "<td><font color=#00b300 size=4>".($item->item_total)."</font></td>";
								}
								?>


							</tr>
							<?php } ?>

						</tbody>

					</table>
	<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><?php echo lang('subtotal'); ?></th>
								<th><?php echo lang('item_tax'); ?></th>
								<!--<th><?php echo lang('invoice_tax'); ?></th>-->
								<th><?php echo lang('total'); ?></th>
								<!--<th><?php echo lang('paid'); ?></th>-->
								<!--<th><?php echo lang('balance'); ?></th>-->
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php
									if(formatcurrency($invoice->invoice_item_subtotal) < formatcurrency($linked_invoice->invoice_item_subtotal) OR formatcurrency($invoice->invoice_item_subtotal) > formatcurrency($linked_invoice->invoice_item_subtotal)){
										 echo "<td><font color=#DC143C size=4>".formatcurrency($invoice->invoice_item_subtotal)."</font></td>";
									}else if(formatcurrency($invoice->invoice_item_subtotal) == formatcurrency($linked_invoice->invoice_item_subtotal)){
										echo "<td><font color=#00b300 size=4>".formatcurrency($invoice->invoice_item_subtotal)."</font></td>";
									}
								?>



								<?php
									if(formatcurrency($invoice->invoice_item_tax_total) < formatcurrency($linked_invoice->invoice_item_tax_total) OR formatcurrency($invoice->invoice_item_tax_total) > formatcurrency($linked_invoice->invoice_item_tax_total)){
										 echo "<td><font color=#DC143C size=4>".formatcurrency($invoice->invoice_item_tax_total)."</font></td>";
									}else if(formatcurrency($invoice->invoice_item_tax_total) == formatcurrency($linked_invoice->invoice_item_tax_total)){
										echo "<td><font color=#00b300 size=4>".formatcurrency($invoice->invoice_item_tax_total)."</font></td>";
									}
								?>

								<?php
									if(formatcurrency($invoice->invoice_total) < formatcurrency($linked_invoice->invoice_total) OR formatcurrency($invoice->invoice_total) > formatcurrency($linked_invoice->invoice_total)){
										 echo "<td><font color=#DC143C size=4>".formatcurrency($invoice->invoice_total)."</font></td>";
									}else if(formatcurrency($invoice->invoice_total) == formatcurrency($linked_invoice->invoice_total)){
										echo "<td><font color=#00b300 size=4>".formatcurrency($invoice->invoice_total)."</font></td>";
									}
								?>

								<!--<td><?php echo formatcurrency($invoice->invoice_item_subtotal); ?></td>-->

								<!--<td><?php echo formatcurrency($invoice->invoice_item_tax_total); ?></td>-->
								<!--<td>
									<?php if ($invoice_tax_rates) { foreach ($invoice_tax_rates as $invoice_tax_rate) { ?>
										<strong><?php echo anchor('invoices/delete_invoice_tax/' . $invoice->invoice_id . '/' . $invoice_tax_rate->invoice_tax_rate_id, lang('remove')) . ' ' . $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%:</strong>
										<?php echo formatcurrency($invoice_tax_rate->invoice_tax_rate_amount); ?><br>
									<?php } } else { echo formatcurrency('0'); }?>
								</td>-->



								<!--<td><?php echo formatcurrency($invoice->invoice_total); ?></td>-->
								<!--<td><?php echo formatcurrency($invoice->invoice_paid); ?></td>-->
								<!--<td><?php echo formatcurrency($invoice->invoice_balance); ?></td>-->
							</tr>
						</tbody>
					</table>

            </td>

            <td>
			<center><u><h4>EGSMeter Billing (<?php echo $linked_invoice->invoice_number; ?>)</h4></u></center>
            <table id="item_table" class="items table table-striped table-bordered">
                <thead>
                    <tr>
                        <th><?php echo lang('item'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                        <th><?php echo lang('quantity'); ?></th>
                        <th><?php echo lang('price'); ?></th>
                        <!--<th><?php echo lang('subtotal'); ?></th>-->
                        <!--<th><?php echo lang('tax'); ?></th>-->
                        <th><?php echo lang('total'); ?></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ( $linked_items as $index => $item) { ?>
                    <tr class="item">
                        <td><?php echo $item->item_name; ?></td>
                        <td><?php echo nl2br($item->item_description); ?></td>
                        <td><?php echo $item->item_quantity; ?></td>
                        <td><?php echo ($item->item_price); ?></td>
                        <!--<td><?php echo formatcurrency($item->item_subtotal); ?></td>-->
                        <!--<td><?php echo formatcurrency($item->item_tax_total); ?></td>-->
						<?php
							if($items[$index]->item_total < $item->item_total OR $items[$index]->item_total > $item->item_total){
								 echo "<td><font color=#DC143C size=4>".($item->item_total)."</font></td>";
							}else if($item->item_total == $items[$index]->item_total){
								echo "<td><font color=#00b300 size=4>".($item->item_total)."</font></td>";
							}
						?>

                    </tr>
                    <?php } ?>

                </tbody>

            </table>

					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><?php echo lang('subtotal'); ?></th>
								<th><?php echo lang('item_tax'); ?></th>
								<!--<th><?php echo lang('invoice_tax'); ?></th>-->
								<th><?php echo lang('total'); ?></th>
								<!--<th><?php echo lang('paid'); ?></th>-->
								<!--<th><?php echo lang('balance'); ?></th>-->
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php
									if(formatcurrency($invoice->invoice_item_subtotal) < formatcurrency($linked_invoice->invoice_item_subtotal) OR formatcurrency($invoice->invoice_item_subtotal) > formatcurrency($linked_invoice->invoice_item_subtotal)){
										 echo "<td><font color=#DC143C size=4>".formatcurrency($linked_invoice->invoice_item_subtotal)."</font></td>";
									}else if(formatcurrency($invoice->invoice_item_subtotal) == formatcurrency($linked_invoice->invoice_item_subtotal)){
										echo "<td><font color=#00b300 size=4>".formatcurrency($linked_invoice->invoice_item_subtotal)."</font></td>";
									}
								?>

								<?php
									if(formatcurrency($invoice->invoice_item_tax_total) < formatcurrency($linked_invoice->invoice_item_tax_total) OR formatcurrency($invoice->invoice_item_tax_total) > formatcurrency($linked_invoice->invoice_item_tax_total)){
										 echo "<td><font color=#DC143C size=4>".formatcurrency($linked_invoice->invoice_item_tax_total)."</font></td>";
									}else if(formatcurrency($invoice->invoice_item_tax_total) == formatcurrency($linked_invoice->invoice_item_tax_total)){
										echo "<td><font color=#00b300 size=4>".formatcurrency($linked_invoice->invoice_item_tax_total)."</font></td>";
									}
								?>

								<?php
									if(formatcurrency($invoice->invoice_total) < formatcurrency($linked_invoice->invoice_total) OR formatcurrency($invoice->invoice_total) > formatcurrency($linked_invoice->invoice_total)){
										 echo "<td><font color=#DC143C size=4>".formatcurrency($linked_invoice->invoice_total)."</font></td>";
									}else if(formatcurrency($invoice->invoice_total) == formatcurrency($linked_invoice->invoice_total)){
										echo "<td><font color=#00b300 size=4>".formatcurrency($linked_invoice->invoice_total)."</font></td>";
									}
								?>

								<!--<td><?php echo formatcurrency($linked_invoice->invoice_item_subtotal); ?></td>
								<td><?php echo formatcurrency($linked_invoice->invoice_item_tax_total); ?></td>-->
								<!--<td>
									<?php if ($invoice_tax_rates) { foreach ($linked_invoice_tax_rates as $invoice_tax_rate) { ?>
										<strong><?php echo anchor('invoices/delete_invoice_tax/' . $invoice->invoice_id . '/' . $invoice_tax_rate->invoice_tax_rate_id, lang('remove')) . ' ' . $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%:</strong>
										<?php echo formatcurrency($invoice_tax_rate->invoice_tax_rate_amount); ?><br>
									<?php } } else { echo formatcurrency('0'); }?>
								</td>-->
								<!--<td><?php echo formatcurrency($linked_invoice->invoice_total); ?></td>-->
								<!--<td><?php echo formatcurrency($linked_invoice->invoice_paid); ?></td>-->
								<!--<td><?php echo formatcurrency($linked_invoice->invoice_balance); ?></td>-->
							</tr>
						</tbody>
					</table>

            </td>
            </tr>
            </table>




			<table class="items table table-striped table-bordered">
			<tr>
			<td>
				<center><u><h4>Bill Differences</h4></u></center>
					<table id="item_table1" class="items table table-striped table-bordered">
						<thead>
							<tr>
								<th><?php echo lang('subtotal'); ?></th>
								<th><?php echo lang('item_tax'); ?></th>
								<th><?php echo lang('total'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							 <td><?php echo formatcurrency(max(($invoice->invoice_item_subtotal), ($linked_invoice->invoice_item_subtotal)) - min(($invoice->invoice_item_subtotal), ($linked_invoice->invoice_item_subtotal))); ?></td>
							 <td><?php echo formatcurrency(max(($invoice->invoice_item_tax_total), ($linked_invoice->invoice_item_tax_total)) - min(($invoice->invoice_item_tax_total), ($linked_invoice->invoice_item_tax_total))); ?></td>
							 <td><?php echo formatcurrency(max(($invoice->invoice_total), ($linked_invoice->invoice_total)) - min(($invoice->invoice_total), ($linked_invoice->invoice_total))); ?></td>
							 </tr>
							 </tbody>
					</table>



			</td>
			</tr>
			</table>


<!--
			<p><strong><?php echo lang('invoice_terms'); ?></strong></p>
			<p><?php echo nl2br($invoice->invoice_terms); ?></p>
-->
		</div>

	</form>

</div>