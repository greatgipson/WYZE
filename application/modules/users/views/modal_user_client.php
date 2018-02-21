<?php $this->layout->load_view('users/jquery_user_lookup'); ?>
<script type="text/javascript">

$(function() {

	// Performs the lookup against current clients in the database
	$('#client_name').keypress(function()
	{
		var self = $(this);

		$.post("<?php echo site_url('clients/ajax/name_query'); ?>", {
			query: self.val()
		}, function(data)
		{
			var json_response = eval('(' + data + ')');
			self.data('typeahead').source = json_response;
		});
	});
});


</script>
<script type="text/javascript">
    $(function()
    {
        $('#btn_user_client').click(function() {
            
            $.post("<?php echo site_url('users/ajax/save_user_client'); ?>", {
                user_id: '<?php echo $id; ?>',
                client_name: $('#client_name').val()
            }, function(data) {
               
               $('#div_user_client_table').load('<?php echo site_url('users/ajax/load_user_client_table'); ?>', { user_id: '<?php echo $id; ?>' } );
            });

        });
    });

</script>

	<div id="add-user-client" class="modal hide">
	<form class="form-horizontal">
		<div class="modal-header">
			<div>
				<h5><?php echo lang('add_client'); ?></h5>
			</div>

			<div class="pull-right">
				<a data-dismiss="modal" class="close">x</a>
			</div>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label"><?php echo lang('client'); ?>: </label>
				<div class="controls">
					<input type="text" name="client_name" id="client_name" style="margin: 0 auto;" data-provide="typeahead" data-items="8" data-source='' autocomplete="off">
				</div>
			</div>

		</div>

		<div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="icon-white icon-remove"></i> <?php echo lang('close'); ?></button>
			<button class="btn btn-primary" id="btn_user_client" type="button"><i class="icon-white icon-ok"></i> <?php echo lang('submit'); ?></button>
		</div>

	</form>

</div>