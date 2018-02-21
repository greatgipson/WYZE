<div class="headerbar">
	<div class="breadcrumb">
		<div class="col-sm-6">
			<h4><?php echo lang('consumption_time_form'); ?></h4>
		</div>
		<div class="col-sm-6">
			<div class="pull-right">
				<a class="btn btn-primary" href="<?php echo site_url('consumption_time/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
			</div>
			<div class="pull-right">
				<?php echo pager(site_url('consumption_time/index'), 'mdl_consumption_time'); ?>
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
				<th><?php echo lang('tou_type'); ?></th>
				<th><?php echo lang('season_type'); ?></th>
				<th><?php echo lang('consumption_time'); ?></th>
				<th><?php echo lang('start_time'); ?></th>
				<th><?php echo lang('end_time'); ?></th>
				<th><?php echo lang('day_type'); ?></th>
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($consumption_time as $Valuetype) { ?>
			<tr>
				<td><?php echo $Valuetype->council_name; ?></td>

				<td>
					<?php foreach ($tou_types as $key => $type) { ?>
							<?php $type; ?>
							<?php if ($Valuetype->tou_type_id == $key) { echo $type; } ?>
					<?php } ?>
				</td>

				<td>
					<?php foreach ($season_types as $key => $type) { ?>
							<?php $type; ?>
							<?php if ($Valuetype->season_type_id == $key) { echo $type; } ?>
					<?php } ?>
				</td>

				<td>
					<?php foreach ($consumption_types as $key => $type) { ?>
							<?php $type; ?>
							<?php if ($Valuetype->consumption_type_id == $key) { echo $type; } ?>
					<?php } ?>
				</td>

			   <td><?php echo $Valuetype->start_time; ?></td>
			   <td><?php echo $Valuetype->end_time; ?></td>

			   <td>
					<?php foreach ($day_types as $key => $type) { ?>
							<?php $type; ?>
							<?php if ($Valuetype->day_type_id == $key) { echo $type; } ?>
					<?php } ?>
			   </td>
















				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo site_url('consumption_time/form/' . $Valuetype->id); ?>">
									<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('consumption_time/delete/' . $Valuetype->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
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