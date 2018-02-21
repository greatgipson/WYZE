<form method="post" class="form-horizontal">

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('item_lookup_form'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>

	<div class="container-fluid">

		<?php $this->layout->load_view('layout/alerts'); ?>

        <div class="control-group">
            <label class="control-label"><?php echo lang('item_name'); ?>: </label>
            <div class="controls">
                <input type="text" name="item_name" id="item_name" class="form-control" value="<?php echo $this->mdl_item_lookups->form_value('item_name'); ?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label"><?php echo lang('description'); ?>: </label>
            <div class="controls">
                <input type="text" name="item_description" id="item_description" class="form-control" value="<?php echo $this->mdl_item_lookups->form_value('item_description'); ?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label"><?php echo lang('price'); ?>: </label>
            <div class="controls">
                <input type="text" name="item_price" id="item_price" class="form-control" value="<?php echo $this->mdl_item_lookups->form_value('item_price'); ?>">
            </div>
        </div>

	</div>

</form>