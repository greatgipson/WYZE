	<table class="table table-striped">
		<thead>
			<tr>
				<th><?php echo lang('description'); ?></th>
				<th><?php echo lang('meter_type'); ?></th>
				<th><?php echo lang('client_name'); ?></th>
				<!--<th><?php echo lang('connections'); ?></th>-->
				<th><?php echo lang('date_of_installation'); ?></th>
				<th><?php echo lang('meter_number'); ?></th>
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>
		<!--<?php print("<pre>".print_r($client_meters,true)."</pre>"); ?>-->
		<tbody>
			<?php foreach ($client_meters as $client_meters) { ?>
			<tr>
				<td><?php echo $client_meters->description; ?></td>
	

				<td><?php foreach ($meter_type as $key => $type) { ?>
						<?php $type; ?>
						<?php if ($client_meters->meter_type_id == $key) { echo $type; } ?>
			    <?php } ?></td>
				<td><?php echo $client_meters->client_name; ?></td>
			<!--	<td><?php foreach ($connections as $key => $type) { ?>
						<?php $type; ?>
						<?php if ($client_meters->connection_id == $key) { echo $type; } ?>
			    <?php } ?></td>-->

				<td><?php echo date("Y-m-d",strtotime($client_meters->date_of_installation)); ?></td>
				<td><?php echo $client_meters->meter_number; ?></td>

				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
						<ul class="dropdown-menu">
							<li class="dropdown-item">
								<a href="<?php echo site_url('client_meters/form/' . $client_meters->id); ?>">
									<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
								</a>
							</li>
							<li class="dropdown-item">
								<a href="<?php echo site_url('client_meters/delete/' . $client_meters->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
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
