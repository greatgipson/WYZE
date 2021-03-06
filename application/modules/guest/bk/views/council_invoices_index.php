<div class="headerbar">
<h1>
    <?php
			$clientid = $this->session->userdata('client_id');
			$client_names = $this->session->userdata('client_names');
			$client_name_index = $this->session->userdata('client_name_index');
	        if(strlen($clientid)>0){
		        $key = array_search($clientid, $client_name_index); // $key = 2;
				echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">".$client_names[$key]."</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">".$this->session->userdata('meter_number')."</span>)";
		    }else{
				echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">No Client Name Selected</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">No Meter Number Selected</span>)";
		    }

			 $oinvoices = $this->mdl_invoices->where('fi_invoices.client_id', $clientid)->where('fi_invoices.invoice_type_id', 2)->get()->result()
	?>
	</h1>
</div>

<?php //print_r($oinvoices); ?>

<div class="container-fluid">
<div class="row-fluid">
		<div class="widget">

					<div class="widget-title">
						<h5><?php echo lang('open_invoices'); ?></h5>
					</div>

					<table class="table table-striped no-margin">

						<thead>
							<tr>
								<th><?php echo lang('invoice'); ?></th>
										<!--<th><?php echo lang('created'); ?></th>-->
																<td><?php echo "Billing Start date"; ?>: </td>
								<td><?php echo "Billing End  date"; ?>: </td>
								<!--<th><?php echo lang('due_date'); ?></th>-->
								<th><?php echo lang('client_name'); ?></th>
								<th>Meter Number</th>
								<th><?php echo lang('amount'); ?></th>
								<!--<th><?php echo lang('balance'); ?></th>-->
								<th><?php echo lang('options'); ?></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($oinvoices as $invoice) { ?>
							<tr>
								<td><a href="<?php echo site_url('guest/invoices/view/' . $invoice->invoice_id); ?>"><?php echo $invoice->invoice_number; ?></a></td>
								<!--<td><?php echo date_from_mysql($invoice->invoice_date_created); ?></td>-->
								<td><?php echo $invoice->billing_start_date; ?></td>
								<td><?php echo $invoice->billing_end_date; ?></td>
								<!--<td><span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>"><?php echo date_from_mysql($invoice->invoice_date_due); ?></span></td>-->
								<td><?php echo $invoice->client_name; ?></td>
								<td><?php echo $invoice->meter_number; ?></td>
								<td><?php echo format_currency($invoice->invoice_total); ?></td>
								<!--<td><?php echo format_currency($invoice->invoice_balance); ?></td>-->
								<td>
									<a href="<?php echo site_url('guest/invoices/view/' . $invoice->invoice_id); ?>" class="btn btn-small">
										<i class="icon-eye-open"></i> <?php echo lang('view'); ?>
									</a>

									<a href="<?php echo site_url('guest/invoices/generate_pdf/' . $invoice->invoice_id); ?>" class="btn btn-small">
										<i class="icon-print"></i> <?php echo lang('pdf'); ?>
									</a>

									<a href="<?php echo site_url('guest/invoices/edit/' . $invoice->invoice_id); ?>" class="btn btn-small">
										<i class="icon-print"></i> <?php echo lang('edit'); ?>
									</a>
									<a href="<?php echo site_url('guest/council_invoices/compareview/' . $invoice->invoice_id); ?>" class="btn btn-small">
										<i class="icon-random"></i> Compare with EGSMeter
									</a>
									<!--
									<?php if ($this->mdl_settings->setting('merchant_enabled') == 1 and $invoice->invoice_balance > 0) { ?><a href="<?php echo site_url('guest/payment_handler/make_payment/' . $invoice->invoice_url_key); ?>" class="btn btn-small btn-success"><i class="icon-white icon-ok"></i> <?php echo lang('pay_now'); ?></a><?php } ?>
									-->
								</td>
							</tr>
							<?php } ?>



						</tbody>

					</table>

				</div>

		<?php echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><pre>-</pre>"; ?>
	</div>
</div>
