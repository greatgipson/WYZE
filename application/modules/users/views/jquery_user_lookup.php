<script type="text/javascript">

$(function() {

	// Performs the lookup against current clients in the database
	$('#user_name').keypress(function()
	{
		var self = $(this);

		$.post("<?php echo site_url('users/ajax/name_query'); ?>", {
			query: self.val()
		}, function(data)
		{
			var json_response = eval('(' + data + ')');
			//window.alert(json_response);
			self.data('typeahead').source = json_response;
		});
	});
});


</script>