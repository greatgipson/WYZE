<div class="headerbar">
	<div class="breadcrumb">
		<div class="col-sm-6">
			<h4><?php echo lang('council'); ?></h4>
		</div>
		<div class="col-sm-6">
			<div class="pull-right">
				<a class="btn btn-primary" href="<?php echo site_url('council/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
			</div>

			<div class="pull-right">
				<?php echo pager(site_url('council/index'), 'mdl_council'); ?>
			</div>
		</div>
	</div>
</div>

<div class="table-content">

	<?php echo $this->layout->load_view('layout/alerts'); ?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th><?php echo lang('council_name'); ?></th>
				<!--<th><?php echo lang('tariff_type'); ?></th>-->
				<th><?php echo lang('surcharge'); ?></th>
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($council as $council) { ?>
			<tr>
				<td><?php echo $council->council_name; ?></td>
				<td><?php echo $surcharges[$council->surcharge]; ?></td>
				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo site_url('council/form/' . $council->id); ?>">
									<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('council/delete/' . $council->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
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