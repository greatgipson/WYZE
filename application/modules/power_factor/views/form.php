<?php if (isset($modal_user_client)) { echo $modal_user_client; } ?>
	<script>

	var SelectedValue=1;
	function Myfunction(str){
		SelectedValue=str;
	    console.log('pop');
	    alert("Your new selection = "+str);

	  //Overwrite
	    //LastSelected=str;

	    //alert("Your previous selection = "+LastSelected);
	}
	</script>

	<?php
	  $ProductType='';

	  if(isset($_GET['trade'])){
	    //Everything in here will get echoed in the DIV
	    echo "You selected: ".$_GET['trade'];
	    $ProductType = $_POST['trade']; // I'd have thought this might work but when I echo $ProductType, it returns nothing.

	    echo $ProductType.$_POST['trade'];
	    exit;
	  }

	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>

	<form name="x" action="" method="POST">
	  <select name="trade" onchange="$('#extra').load('?trade='+this.value);">
	    <option value="1">item1</option>
	    <option value="2">item2</option>
	    <option value="3">item3</option>
	    <option value="4">item4</option>
	  </select>

	</form>

<div id="extra" style="color:red;"></div>

<form method="post" class="form-horizontal">

	<div class="headerbar">
		<h1><?php echo lang('tariff_type_form'); ?></h1>
		<?php $this->layout->load_view('layout/header_buttons'); ?>
	</div>

	<?php
		$widthChecked = "<script>document.write(SelectedValue);</script>";
		echo "|-------------->".$widthChecked."<------------|";
	?>

	<div class="content">

		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="control-group">
				<label class="control-label"><?php echo lang('council_name'); ?>: </label>
				<div class="controls">


						<?php //print("<pre>".print_r($council_names,true)."</pre>"); ?>
						<?php
						function array_reverse_search($value, $array) {
						             for($i = sizeof($array)-1; $i>=0; $i--) {
						                if ($array[$i]->id == $value) return $array[$i]->council_name;
						             }
						            return "";
        				}

					    //$key = array_search("2", array_column($council_names, 'id'));
					   // echo "KEY---->".array_reverse_search("1",$council_names)."<----|"; ?>

					<select name="council_id" onchange="Myfunction(this.value);">
							<option value="0"></option>
							<?php foreach ($council_names as $key => $type) { ?>
										<?php $type->id; ?>
										<option value="<?php echo $type->id; ?>" <?php if ($this->mdl_tariff_type->form_value('council_id') == $type->id) { ?>selected="selected"<?php } ?>><?php echo $type->council_name; ?> </option>
							<?php } ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_name'); ?>: </label>
				<div class="controls">

					<input type="text" name="tariff_name" id="tariff_name" class ="resizedTextbox" value="<?php echo $this->mdl_tariff_type->form_value('tariff_name'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_kva_type'); ?>: </label>
				<div class="controls">
				<select name="tariff_kva_type_id" id="tariff_kva_type_id">
					<option value=""></option>
					<?php foreach ($tariff_kva_non_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type->form_value('tariff_kva_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>


			<!--<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_kva_type'); ?>: </label>
				<div class="controls">
				<select name="tariff_kva_type" id="tariff_kva_type">
					<option value=""></option>
					<?php foreach ($tariff_kva_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type->form_value('tariff_kva_type') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>-->

			<div class="control-group">
				<label class="control-label"><?php echo lang('tou_type'); ?>: </label>
				<div class="controls">
				<select name="tou_type_id" id="tou_type_id">
					<option value=""></option>
					<?php foreach ($tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type->form_value('tou_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>


			<div class="control-group">
				<label class="control-label"><?php echo lang('season_type'); ?>: </label>
				<div class="controls">
				<select name="season_type_id" id="season_type_id">
					<option value=""></option>
					<?php foreach ($season_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type->form_value('season_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>




			<!--<div class="control-group">
				<label class="control-label"><?php echo lang('tariff_kva_type'); ?>: </label>
				<div class="controls">
				<select name="tariff_kva_type_id" id="tariff_kva_type_id">
					<option value=""></option>
					<?php foreach ($tariff_kva_tou_types as $key => $type) { ?>
						<?php $type; ?>
						<option value="<?php echo $key; ?>" <?php if ($this->mdl_tariff_type->form_value('tariff_kva_type_id') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?> </option>
					<?php } ?>
				</select>
				</div>
			</div>-->


	</div>
</form>