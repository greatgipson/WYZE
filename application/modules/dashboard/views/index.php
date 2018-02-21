<div class="headerbar">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><h5><?php echo lang('dashboard'); ?></h5></li>
	</ol>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>

<div class="container-fluid">

    <div class="row">

        <div class="col-sm-12">
		
			<h4 class="card-header ">
				<?php echo lang('quick_actions'); ?>
			</h4>		
			<div class="card-group quick_actions">
				<div class="card">
				  <div class="card-body text-center">
				  <a class="action-icons" href="<?php echo site_url('clients/form'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small class="text-center"><?php echo lang('add_client'); ?></small>					
					</div>
				  </a>
				  </div>
				</div>

				<div class="card">
				  <div class="card-body text-center">
				  <a class="action-icons" href="<?php echo site_url('client_meters/form'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-steam fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small class="text-center"><?php echo lang('add_meter'); ?></small>					
					</div>
				  </a>
				  </div>
				</div>	

				<div class="card">
				  <div class="card-body text-center">
				  <a class="action-icons" href="<?php echo site_url('users/form'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small class="text-center"><?php echo lang('add_user'); ?></small>					
					</div>
				  </a>
				  </div>
				</div>	

				<div class="card">
				  <div class="card-body text-center">
				  <a class="action-icons" href="<?php echo site_url('users/index'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-users fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small class="text-center"><?php echo lang('view_users'); ?></small>					
					</div>
				  </a>
				  </div>
				</div>					
			</div>	
			<!--<div class="card-group quick_actions">
				<div class="card">
				  <div class="card-body text-center">
				  <a href="<?php echo site_url('tariff_type_city_power/index'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-credit-card fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('add_city_power_tariff_type'); ?></small>
					</div>
				  </a>
				  </div>
				</div>
				
				<div class="card">
				  <div class="card-body text-center">
				  <a href="<?php echo site_url('tariff_type_ekuhurleni/index'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-credit-card fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('add_ekuhurleni_tariff_type'); ?></small>
					</div>
				  </a>
				  </div>
				</div>
				
				<div class="card">
				  <div class="card-body text-center">
				  <a href="<?php echo site_url('tariff_type_tshwane/index'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-credit-card fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('add_tshwane_tariff_type'); ?></small>
					</div>
				  </a>
				  </div>
				</div>-->
				<!--
				<div class="card">
				  <div class="card-body text-center">
					<a href="javascript:void(0)" class="create-quote">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-file fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('create_quote'); ?></small>
					</div>
				  </a>
				  </div>
				</div>
				<div class="card">
				  <div class="card-body text-center">
					<a href="javascript:void(0)" class="create-invoice">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-money fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('create_invoice'); ?></small>
					</div>
				  </a>
				  </div>
				</div>
				<div class="card">
				  <div class="card-body text-center">
				  <a href="<?php echo site_url('payments/form'); ?>">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-credit-card fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('enter_payment'); ?></small>
					</div>
				  </a>
				  </div>
				</div>-->				
			</div>
			<!--<div class="card ">
				<div class="card-header">
					<i class="icon-doc"></i>
					<?php echo lang('quote_overview'); ?>
				</div>	
				<table class="table">
					<thead>
					<tr>
						<?php foreach ($quote_status_totals as $total) { ?>
							<th><a href="<?php echo site_url($total['href']); ?>"><?php echo $total['label']; ?></a></th>
						<?php } ?>
					</tr>
					</thead>
					<tbody>
					<tr>
						<?php foreach ($quote_status_totals as $total) { ?>
						   <td class="<?php echo $total['class']; ?>"><?php echo format_currency($total['sum_total']); ?></td>
						<?php } ?>
					</tr>
					</tbody>
				</table>
			</div>
			
			<div class="card ">
				<div class="card-header">
					<i class="fa fa-money fa-lg"></i>
					<?php echo lang('invoice_overview'); ?>
				</div>	
				<table class="table">
					<thead>
					<tr>
						<?php foreach ($invoice_status_totals as $total) { ?>
							<th><a href="<?php echo site_url($total['href']); ?>"><?php echo $total['label']; ?></a></th>
						<?php } ?>
					</tr>
					</thead>
					<tbody>
					<tr>
						<?php foreach ($invoice_status_totals as $total) { ?>
						   <td class="<?php echo $total['class']; ?>"><?php echo format_currency($total['sum_total']); ?></td>
						<?php } ?>
					</tr>
					</tbody>
				</table>			  
			</div> -->
			
			        <div class="col-sm-12">
		
			<h4 class="card-header ">
				<?php echo lang('import_data'); ?>
			</h4>		
			<div class="card-group quick_actions">
				<div class="card">
				  <div class="card-body text-center">
					<a class="action-icons" href="<?php echo base_url(); ?>uploads/meter_data/index.php" target="_blank">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-upload fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('import_meter_data'); ?></small>
					</div>
				  </a>
				  </div>
				</div>
				
				<div class="card">
				  <div class="card-body text-center">
					<!--<a href="<?php echo site_url('tariff_type_tshwane/index'); ?>">-->
					<a class="action-icons" href="<?php echo base_url(); ?>uploads/meter_phasor/index.php" target="_blank">
					<div class="fa-stack fa-3x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-upload fa-stack-1x fa-inverse"></i>
					</div>
					<div class="text-center">
						<small><?php echo lang('import_meter_phasor'); ?></small>
					</div>
				  </a>
				  </div>
				</div>
			</div>
			
        </div>
<!--
        <div class="col-sm-6">
			<!--
			<div class="card ">
				<div class="card-header">
					<i class="fa fa-exclamation-triangle fa-lg"></i>
					</i><?php echo lang('overdue_invoices'); ?>
				</div>	
				<table class="table">
					<thead>
					<tr>
						<th style="width: 15%;"><?php echo lang('status'); ?></th>
						<th style="width: 20%;"><?php echo lang('due_date'); ?></th>
						<th style="width: 10%;"><?php echo lang('invoice'); ?></th>
						<th style="width: 35%;"><?php echo lang('client'); ?></th>
						<th style="text-align: right; width: 15%;"><?php echo lang('balance'); ?></th>
						<th style="text-align: center; width: 5%;"><?php echo lang('pdf'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($overdue_invoices as $invoice) { ?>
						<tr>
							<td><span class="label <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>"><?php echo $invoice_statuses[$invoice->invoice_status_id]['label']; ?></span></td>
							<td><span class="font-overdue"><?php echo date_from_mysql($invoice->invoice_date_due); ?></span></td>
							<td><?php echo anchor('invoices/view/' . $invoice->invoice_id, $invoice->invoice_number); ?></td>
							<td><?php echo anchor('clients/view/' . $invoice->client_id, $invoice->client_name); ?></td>
							<td style="text-align: right;"><?php echo format_currency($invoice->invoice_balance); ?></td>
							<td style="text-align: center;"><a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>" title="<?php echo lang('download_pdf'); ?>"><i class="icon-print"></i></a></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="6" style="text-align: center;"><?php echo anchor('invoices/status/overdue', lang('view_all')); ?></td>
					</tr>
					</tbody>
				</table>			
			</div>
			-->
			<!--
			<div class="card ">
				<div class="card-header">
					<i class="fa fa-clock-o fa-lg"></i><?php echo lang('recent_quotes'); ?>
				</div>	
				<table class="table">
					<thead>
						<tr>
							<th style="width: 15%;"><?php echo lang('status'); ?></th>
							<th style="width: 15%;"><?php echo lang('date'); ?></th>
							<th style="width: 10%;"><?php echo lang('quote'); ?></th>
							<th style="width: 40%;"><?php echo lang('client'); ?></th>
							<th style="text-align: right; width: 15%;"><?php echo lang('balance'); ?></th>
							<th style="text-align: center; width: 5%;"><?php echo lang('pdf'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($quotes as $quote) { ?>
							<tr>
								<td><span class="label <?php echo $quote_statuses[$quote->quote_status_id]['class']; ?>"><?php echo $quote_statuses[$quote->quote_status_id]['label']; ?></span></td>
								<td><?php echo date_from_mysql($quote->quote_date_created); ?></td>
								<td><?php echo anchor('quotes/view/' . $quote->quote_id, $quote->quote_number); ?></td>
								<td><?php echo anchor('clients/view/' . $quote->client_id, $quote->client_name); ?></td>
								<td style="text-align: right;"><?php echo format_currency($quote->quote_total); ?></td>
								<td style="text-align: center;"><a href="<?php echo site_url('quotes/generate_pdf/' . $quote->quote_id); ?>" title="<?php echo lang('download_pdf'); ?>"><i class="icon-print"></i></a></td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="6" style="text-align: center;"><?php echo anchor('quotes/status/all', lang('view_all')); ?></td>
						</tr>
					</tbody>
				</table>				
			</div>
			
			-->
			
           <!-- <div class="widget">

                <div class="widget-title">
                    <h5><i class="icon-time"></i><?php echo lang('recent_invoices'); ?></h5>
                </div>

                <table class="table table-striped no-margin">
                    <thead>
                        <tr>
                            <th style="width: 15%;"><?php echo lang('status'); ?></th>
                            <th style="width: 15%;"><?php echo lang('due_date'); ?></th>
                            <th style="width: 10%;"><?php echo lang('invoice'); ?></th>
                            <th style="width: 40%;"><?php echo lang('client'); ?></th>
                            <th style="text-align: right; width: 15%;"><?php echo lang('balance'); ?></th>
                            <th style="text-align: center; width: 5%;"><?php echo lang('pdf'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoices as $invoice) { ?>
                            <tr>
                                <td><span class="label <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>"><?php echo $invoice_statuses[$invoice->invoice_status_id]['label']; ?></span></td>
                                <td><span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>"><?php echo date_from_mysql($invoice->invoice_date_due); ?></span></td>
                                <td><?php echo anchor('invoices/view/' . $invoice->invoice_id, $invoice->invoice_number); ?></td>
                                <td><?php echo anchor('clients/view/' . $invoice->client_id, $invoice->client_name); ?></td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_balance); ?></td>
                                <td style="text-align: center;"><a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>" title="<?php echo lang('download_pdf'); ?>"><i class="icon-print"></i></a></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" style="text-align: center;"><?php echo anchor('invoices/status/all', lang('view_all')); ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>-->

    </div>

</div>