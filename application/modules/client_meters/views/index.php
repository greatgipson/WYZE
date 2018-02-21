<div class="headerbar">
	<div class="breadcrumb">
		<div class="row">
			<div class="col-sm-6">
				<h4><?php echo lang('client_meters'); ?></h4>
			</div>
			<div class="col-sm-6">
				<div class="pull-right">
					<a class="btn btn-primary" href="<?php echo site_url('client_meters/form'); ?>"><i class="fa fa-user-circle"></i> <?php echo lang('new'); ?></a>
				</div>

				<div class="pull-right">
					<?php echo pager(site_url('client_meters/index'), 'mdl_client_meters'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="table-content">

	<?php echo $this->layout->load_view('layout/alerts'); ?>

	
	<div id="filter_results">
		<?php $this->layout->load_view('client_meters/partial_client_meters_table'); ?>
	</div>

</div>