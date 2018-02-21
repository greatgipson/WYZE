<form method="post" class="form-horizontal">

 	<div class="headerbar">
		<div class="breadcrumb">
			<div class="row">
				<div class="col-sm-6">
					<h4><?php echo lang('change_password'); ?></h4>
				</div>
				<div class="col-sm-6">	
					<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
		</div>
	</div>	

	
	    <div class="container-fluid">

		<?php $this->layout->load_view('layout/alerts'); ?>

		<div class="row">
		
		  <div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<strong><?php echo lang('change_password'); ?></strong>
				</div>
			
			<div class="card-body">
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('password'); ?>: </label>
				  <div class="col-md-4">
					<input type="password" name="user_password" class="form-control" id="user_password">
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-md-3 form-control-label" for="client_address_1"><?php echo lang('verify_password'); ?>: </label>
				  <div class="col-md-4">
					<input type="password" name="user_passwordv" class="form-control" id="user_passwordv">
				  </div>
				</div>

			</div>
			</div>
			</div>
	</div>
	</div>
	
</form>