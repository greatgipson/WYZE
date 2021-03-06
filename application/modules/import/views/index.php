<div class="headerbar">
	<div class="breadcrumb">
		<div class="col-sm-6">
			<h4><?php echo lang('import_data'); ?></h4>
		</div>
		<div class="col-sm-6">
			<div class="pull-right">
				<a class="btn btn-primary" href="<?php echo site_url('import/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
			</div>
			
			<div class="pull-right">
				<?php echo pager(site_url('import/index'), 'mdl_import'); ?>
			</div>
		</div>
	</div>
</div>

<div class="table-content">

	<?php echo $this->layout->load_view('layout/alerts'); ?>

	<table class="table table-striped">

		<thead>
			<tr>
	            <th><?php echo lang('id'); ?></th>
				<th><?php echo lang('date'); ?></th>
				<th><?php echo lang('clients'); ?></th>
	            <th><?php echo lang('invoices'); ?></th>
	            <th><?php echo lang('invoice_items'); ?></th>
	            <th><?php echo lang('payments'); ?></th>
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($imports as $import) { ?>
			<tr>
				<td><?php echo $import->import_id; ?></td>
				<td><?php echo $import->import_date; ?></td>
	            <td><?php echo $import->num_clients; ?></td>
	            <td><?php echo $import->num_invoices; ?></td>
	            <td><?php echo $import->num_invoice_items; ?></td>
	            <td><?php echo $import->num_payments; ?></td>
				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo site_url('import/delete/' . $import->import_id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
									<i class="icon-trash"></i> <?php echo lang('delete'); ?>
								</a>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>

	</table>

</div>