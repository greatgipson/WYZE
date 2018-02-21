<div class="headerbar">
	<div class="breadcrumb">
		<div class="col-sm-4">
			<h4><?php echo lang('invoices'); ?></h4>
		</div>
		<div class="col-sm-8">
			<div class="pull-right">
				<a class="create-invoice btn btn-primary" href="#"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
			</div>

			<div class="pull-right">
				<?php echo pager(site_url('invoices/status/' . $this->uri->segment(3)), 'mdl_invoices'); ?>
			</div>
			
			<div class="pull-right">
				<ul class="nav nav-pills index-options">
					<li <?php if ($status == 'all') { ?>class="active"<?php } ?>><a href="<?php echo site_url('invoices/status/all'); ?>"><?php echo lang('all'); ?></a></li>
					<li <?php if ($status == 'draft') { ?>class="active"<?php } ?>><a href="<?php echo site_url('invoices/status/draft'); ?>"><?php echo lang('draft'); ?></a></li>
					<li <?php if ($status == 'sent') { ?>class="active"<?php } ?>><a href="<?php echo site_url('invoices/status/sent'); ?>"><?php echo lang('sent'); ?></a></li>
					<li <?php if ($status == 'viewed') { ?>class="active"<?php } ?>><a href="<?php echo site_url('invoices/status/viewed'); ?>"><?php echo lang('viewed'); ?></a></li>
					<li <?php if ($status == 'paid') { ?>class="active"<?php } ?>><a href="<?php echo site_url('invoices/status/paid'); ?>"><?php echo lang('paid'); ?></a></li>
					<li <?php if ($status == 'overdue') { ?>class="active"<?php } ?>><a href="<?php echo site_url('invoices/status/overdue'); ?>"><?php echo lang('overdue'); ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="table-content">

	<div id="filter_results">
	<?php $this->layout->load_view('invoices/partial_invoice_table', array('invoices' => $invoices)); ?>
	</div>

</div>