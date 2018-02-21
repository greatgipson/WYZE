<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">


		<?php
			 function formatcurrency($floatcurr){
					$curr = "ZAR";
					$currencies['ZAR'] = array(2,'.',' ');          //  South Africa, Rand
					return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);
			 }
		?>
        <style>
         	<?php //---it---inizio ?>
         	<?php if (!empty($preview_pdf)): ?>
         		html, body {
				  overflow-y: visible;
				}
         	<?php endif; ?>
        	<?php //---it---fine ?>

            * {
                margin:0px;
                padding:2px;
            }
            body {
                color: #000 !important;
            }
            table {
                width:100%;
            }
            #header table {
                width:100%;
                padding: 0px;
            }
            #header table td, .amount-summary td {
                vertical-align: text-top;
                padding: 2px;
            }
            #company-name{
                color:#000;
                font-size: 15px;
            }
            #invoice-to td {
                text-align: left
            }
            #invoice-to {
                margin-bottom: 2px;
            }
            #invoice-to-right-table td {
                padding-right: 2px;
                padding-left: 2px;
                text-align: right;
            }

            .seperator {
                height: 2px
            }
            .top-border {
                border-top: none;
            }
            .no-bottom-border {
                border:none !important;
                background-color: white !important;
            }
        </style>

	</head>
	<body>
       <table border="0" cellpadding="50" cellspacing="50" style="border-collapse:collapse; border:0px solid #000;">
        <tr>
                    <td>



        <div id="header">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:0px solid #000;">
                <tr>
                    <td id="company-name">
                        <?php echo invoice_logo_pdf(); ?>
                        <h2><?php echo $invoice->client_name; ?></h2>
						<b><?php echo htmlspecialchars($invoice->tariff_name); ?></b>
                        <!--<p>
                            <?php if ($invoice->user_address_1) { echo $invoice->user_address_1 . '<br>'; } ?>
                            <?php if ($invoice->user_address_2) { echo $invoice->user_address_2 . '<br>'; } ?>
                            <?php if ($invoice->user_city) { echo $invoice->user_city . ' '; } ?>
                            <?php if ($invoice->user_state) { echo $invoice->user_state . ' '; } ?>
                            <?php if ($invoice->user_zip) { echo $invoice->user_zip . '<br>'; } ?>
                            <?php if ($invoice->user_phone) { ?>Tel. <?php echo $invoice->user_phone; ?><br><?php } ?>
                            <?php if ($invoice->user_fax) { ?>Fax <?php echo $invoice->user_fax; ?><?php } ?>
                        </p> -->
                    </td>
                    <td style="text-align: right;"><h2><?php echo lang('invoice'); ?> <?php echo $invoice->invoice_number; ?></h2></td>
                </tr>
            </table>
        </div>


        <div id="invoice-to">
            <table style="width: 100%;" border=0>
                <tr>
                    <td style="padding-left: 5px;">
                        <p><b><?php echo lang('bill_to'); ?>:</b></p>
                        <p><?php echo $invoice->client_name; ?><br>
                            <?php if ($invoice->client_address_1) { echo $invoice->client_address_1 . '<br>'; } ?>
                            <?php if ($invoice->client_address_2) { echo $invoice->client_address_2 . '<br>'; } ?>
                            <?php if ($invoice->client_city) { echo $invoice->client_city . ' '; } ?>
                            <?php if ($invoice->client_state) { echo $invoice->client_state . ' '; } ?>
                            <?php if ($invoice->client_zip) { echo $invoice->client_zip . '<br>'; } ?>
                            <?php if ($invoice->client_phone) { ?>Tel. <?php echo $invoice->client_phone; ?><br><?php } ?>
                        </p>
                    </td>
                    <td>

                    <table id="invoice-to-right-table"  border=1>
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
                        <table id="invoice-to-right-table"  border=1>
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
                               <!-- <tr>
                                    <td><b><?php echo lang('invoice_date'); ?>: </b></td>
                                    <td><?php echo $invoice->invoice_date_created; ?></td>
                                </tr>-->

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
                </tr>
            </table>
        </div>

        <div id="invoice-items">
            <table class="table table-striped" style="width: 100%;" border=1>
                <thead>
                    <tr>
                        <th><?php echo lang('item'); ?></th>
                        <!--<th><?php echo lang('description'); ?></th>-->
                        <th style="text-align: center;">Units</th>
                        <!--<th style="text-align: right;"><?php echo lang('qty'); ?></th>-->
                        <th style="text-align: center;">Charges/<?php echo lang('price'); ?></th>
                        <th style="text-align: center;"><?php echo lang('subtotal'); ?></th>

                        <!--<?php foreach ($invoice_tax_rates as $invoice_tax_rate) : ?>
							<th style="text-align: center;"><?php echo $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%</th>
                        <?php endforeach ?>-->
                        <th style="text-align: center;">VAT 14.00%</th>
                        <th style="text-align: center;"><?php echo lang('total'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <?php if($item->is_bold==1){ ?>
                            	<td><b><?php echo $item->item_name; ?><b></td>
                            <?php }else{ ?>
								<td><?php echo $item->item_name; ?></td>
                          	<?php } ?>
                          	<td style="text-align: left;"><?php echo nl2br($item->item_description); ?></td>

                            <!--<td style="text-align: right;"><?php echo $item->item_units; ?></td>-->
                            <!--<td style="text-align: right;"><?php echo $item->item_units_desc; ?></td>-->
                              <?php if($item->item_price>0) { ?>
                            <td style="text-align: right;"><?php echo ($item->item_price); ?></td>
                            <td style="text-align: right;"><?php echo formatcurrency($item->item_subtotal); ?></td>
                            <td style="text-align: right;"><?php echo formatcurrency($item->item_tax_total); ?></td>
                            <td style="text-align: right;"><?php echo formatcurrency($item->item_total); ?></td>
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
        	<table id="invoice-to-right-table"  border=1>
                    <tbody>
							<tr>
								<td style="width: 80%;text-align: right;"><?php echo lang('subtotal'); ?>:</td>
								<td style="width: 20%;text-align: right;"><?php echo formatcurrency($invoice->invoice_item_subtotal); ?></td>
							</tr>
							<!--<?php if ($invoice->invoice_item_tax_total > 0) { ?>
							<tr>
								<td style="text-align: right;"><?php echo lang('item_tax'); ?></td>
								<td style="text-align: right;"><?php echo formatcurrency($invoice->invoice_item_tax_total); ?></td>
							</tr>
							<?php } ?>-->
							<?php foreach ($invoice_tax_rates as $invoice_tax_rate) : ?>
							<tr>
									<td style="text-align: right;"><?php echo $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%</td>
									<td style="text-align: right;"><?php echo formatcurrency($invoice_tax_rate->invoice_tax_rate_amount); ?></td>
							</tr>
							<?php endforeach ?>
							<tr>
									<td style="text-align: right;"><?php echo lang('total'); ?>:</td>
									<td style="text-align: right;"><?php echo formatcurrency($invoice->invoice_total); ?></td>
							</tr>
							<!--<tr>
							<td style="text-align: right;"></td>
								<td style="text-align: right;"></td>
									<td style="text-align: right;"><?php echo lang('paid'); ?>:</td>
									<td style="text-align: right;"><?php echo formatcurrency($invoice->invoice_paid) ?></td>
							</tr>
							<tr>
							<td style="text-align: right;"></td>
								<td style="text-align: right;"></td>
									<td style="text-align: right;"><?php echo lang('balance'); ?>:</td>
									<td style="text-align: right;"><strong><?php echo formatcurrency($invoice->invoice_balance) ?></strong></td>
							</tr>-->
		          </tbody>
            </table>
		</div>
		<div class="seperator"></div>
			<?php if ($invoice->invoice_terms) { ?>
				<h4><?php echo lang('terms'); ?></h4>
				<p><?php echo nl2br($invoice->invoice_terms); ?></p>
			<?php } ?>
		</div>

    <!-- END of table -->
       </td></tr>
        </table>


	</body>
</html>