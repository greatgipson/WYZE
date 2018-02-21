<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>
<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('council_form'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="control-group">
				<label class="control-label"><?php echo lang('council_name'); ?>: </label>
				<div class="controls">
					<input type="text" name="council_name" id="council_name" value="<?php echo $this->mdl_council->form_value('council_name'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('surcharge'); ?>: </label>
				<div class="controls">
					<select name="surcharge" id="surcharge"  class="form-control">
							<option value=""></option>
							<?php foreach ($surcharges as $key => $type) { ?>
								<?php $type; ?>
								<option value="<?php echo $key; ?>" <?php if ($this->mdl_council->form_value('surcharge') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
							<?php } ?>
					</select>
				</div>
			</div>
	</div>
</form>