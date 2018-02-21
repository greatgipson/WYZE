<div class="headerbar">
	<h1><?php echo lang('tariff_type'); ?></h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="<?php echo site_url('tariff_type/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
	</div>

	<div class="pull-right">
		<?php echo pager(site_url('tariff_type/index'), 'mdl_tariff_type'); ?>
	</div>

</div>
<div class="table-content">

	<?php echo $this->layout->load_view('layout/alerts'); ?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th><?php echo lang('council_name'); ?></th>
				<th><?php echo lang('tariff_type_desc'); ?></th>
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tariff_type as $tariff_type) { ?>
			<tr>
				<td><?php echo $tariff_type->council_name; ?></td>
				<td><?php echo $tariff_type->tariff_name; ?></td>

								<td>
									<div class="options btn-group">
										<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
										<ul class="dropdown-menu">
											<li>
												<a href="<?php echo site_url('tariff_type/form/' . $tariff_type->id); ?>">
													<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
												</a>
											</li>
											<li>
												<a href="<?php echo site_url('tariff_type/delete/' . $tariff_type->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
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