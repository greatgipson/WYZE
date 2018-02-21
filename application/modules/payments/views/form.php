<script type="text/javascript">
$(function() {
   $('#invoice_id').focus();
   
   amounts = JSON.parse('<?php echo $amounts; ?>');
   
   $('#invoice_id').change(function() {
       $('#payment_amount').val(amounts["invoice" + $('#invoice_id').val()]);
   });
   
});
</script>

<form method="post" class="form-horizontal">

    <?php if ($payment_id) { ?>
    <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
    <?php } ?>

	<div class="headerbar">
		<div class="breadcrumb">
			<div class="col-sm-6">
				<h4><?php echo lang('payment_form'); ?></h4>
			</div>
			<div class="col-sm-6">
				<?php $this->layout->load_view('layout/header_buttons'); ?>
			</div>
		</div>
	</div>

	<div class="container-fluid">

		<?php $this->layout->load_view('layout/alerts'); ?>

			<div class="form-group row">
				<label class="col-md-2 form-control-label"><?php echo lang('invoice'); ?>: </label>
				<div class="col-md-4">
					
					<select name="invoice_id" id="invoice_id" class="form-control">
						<?php if (!$payment_id) { ?>
						<option value=""></option>
						<?php foreach ($open_invoices as $invoice) { ?>
						<option value="<?php echo $invoice->invoice_id; ?>" <?php if ($this->mdl_payments->form_value('invoice_id') == $invoice->invoice_id) { ?>selected="selected"<?php } ?>><?php echo $invoice->invoice_number . ' - ' . $invoice->client_name . ' - ' . format_currency($invoice->invoice_balance); ?></option>
						<?php } ?>
						<?php } else { ?>
						<option value="<?php echo $payment->invoice_id; ?>"><?php echo $payment->invoice_number . ' - ' . $payment->client_name . ' - ' . format_currency($payment->invoice_balance); ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label"><?php echo lang('date'); ?>: </label>
				<div class="col-md-4 input-append date datepicker">
					<input type="text" name="payment_date" id="payment_date" class="form-control" value="<?php echo date_from_mysql($this->mdl_payments->form_value('payment_date')); ?>" readonly>
					<span class="add-on"><i class="icon-th"></i></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-2 form-control-label"><?php echo lang('amount'); ?>: </label>
				<div class="col-md-4">
					<input type="text" name="payment_amount" id="payment_amount" class="form-control" value="<?php echo format_amount($this->mdl_payments->form_value('payment_amount')); ?>">
				</div>
			</div>

			<div class="form-group row">

				<label class="col-md-2 form-control-label"><?php echo lang('payment_method'); ?>: </label>
				<div class="col-md-4">
					<select name="payment_method_id" class="form-control">
						<option value="0"></option>
						<?php foreach ($payment_methods as $payment_method) { ?>
						<option value="<?php echo $payment_method->payment_method_id; ?>" <?php if ($this->mdl_payments->form_value('payment_method_id') == $payment_method->payment_method_id) { ?>selected="selected"<?php } ?>>
							<?php echo $payment_method->payment_method_name; ?>
						</option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group row">

				<label class="col-md-2 form-control-label"><?php echo lang('note'); ?>: </label>
				<div class="col-md-4 ">
					<textarea name="payment_note" class="form-control" rows="9"><?php echo $this->mdl_payments->form_value('payment_note'); ?></textarea>
				</div>

			</div>

            <?php foreach ($custom_fields as $custom_field) { ?>
            <div class="form-group row">
                <label class="col-md-2 form-control-label"><?php echo $custom_field->custom_field_label; ?>: </label>
                <div class="col-md-4">
                    <input type="text" name="custom[<?php echo $custom_field->custom_field_column; ?>]" id="<?php echo $custom_field->custom_field_column; ?>" value="<?php echo form_prep($this->mdl_payments->form_value('custom[' . $custom_field->custom_field_column . ']')); ?>">
                </div>
            </div>
            <?php } ?>

	</div>

</form>