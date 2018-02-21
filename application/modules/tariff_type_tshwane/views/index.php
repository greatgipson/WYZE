<div class="headerbar">
	<div class="breadcrumb">
		<div class="row">
		<div class="col-sm-6">
			<h4><?php echo lang('tariff_type_tshwane_form'); ?></h4>
		</div>
		<div class="col-sm-6">
			<div class="pull-right">
				<a class="btn btn-primary" href="<?php echo site_url('tariff_type_tshwane/form'); ?>"><i class="fa fa-user-circle"></i><?php echo lang('new'); ?></a>
			</div>
			<div class="pull-right">
				<?php echo pager(site_url('tariff_type_tshwane/index'), 'mdl_tariff_type_tshwane'); ?>
			</div>
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
				<th><?php echo lang('tariff_name'); ?></th>
				<th><?php echo lang('tariff_kva_type'); ?></th>
				<th><?php echo lang('tou_type'); ?></th>
				<!--<th><?php echo lang('season_type'); ?></th>-->
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tariff_type_tshwane as $tariff_type) { ?>
			<tr>
				<td><?php echo $tariff_type->council_name; ?></td>
				<td><?php echo $tariff_type->tariff_name; ?></td>
				<td>
				<?php foreach ($tariff_kva_non_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<?php if ($tariff_type->tariff_kva_type_id == $key) { echo $type; } ?>
			    <?php } ?>
				</td>

				<!--<td><?php echo $tariff_type->tariff_kva_type_id; ?></td>-->

				<td>
				<?php foreach ($tou_types as $key => $type) { ?>
						<?php $type; ?>
						<?php if ($tariff_type->tou_type_id == $key) { echo $type; } ?>
			    <?php } ?>
				</td>

				<!--<td><?php echo $tariff_type->tou_type_id; ?></td>-->

				<!--<td>
				<?php foreach ($season_types as $key => $type) { ?>
						<?php $type; ?>
						<?php if ($tariff_type->season_type_id == $key) { echo $type; } ?>
			    <?php } ?>
				</td>-->
				<!--<td><?php echo $tariff_type->season_type_id ?></td>-->

				<!-- <?php print("<pre>".print_r($season_types,true)."</pre>"); ?>

				<?php foreach ($season_types as $key => $type) { ?>
						<?php $type; ?>
						<?php if ($tariff_type->season_type_id == $key) { echo $type; } ?>
			    <?php } ?>

			    -->
				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
						<ul class="dropdown-menu">
							<li class="dropdown-item">
								<a href="<?php echo site_url('tariff_type_tshwane/form/' . $tariff_type->tariff_id); ?>">
									<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
								</a>
							</li>
							<li class="dropdown-item">
								<a href="<?php echo site_url('tariff_type_tshwane/delete/' . $tariff_type->tariff_id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
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