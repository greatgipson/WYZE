<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EGS Metering Solution</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
		<link href="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/ewyze_theme/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/ewyze_theme/css/form-elements.css" rel="stylesheet">		
		<link href="<?php echo base_url(); ?>assets/ewyze_theme/css/login_style.css" rel="stylesheet">		
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/ewyze_theme/js/libs/jquery-1.7.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/ewyze_theme/js/bootstrap-datepicker.js"></script>


		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

        <script type="text/javascript">
            $(function() { $('#email').focus(); });
        </script>

	</head>

	<body>

       <!-- Top content -->
        <div class="top-content">        
			<div class="container">
				<div class="row">
					<div class="col-sm-4 form-box">
						<div class="form-top">
							<div class="logo">
							   <?php if ($login_logo) { ?>
										<img class="login-logo" src="<?php echo base_url(); ?>uploads/<?php echo $login_logo; ?>"  alt="">
								<?php } else { ?>
										<center><h1><?php echo lang('login'); ?></h1></center>
								<?php } ?> 								
							</div>
							<div class="form-top-left">
								<h3>Login to eWyze. Portal</h3>
							</div>
							<div class="form-top-right">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<div class="form-bottom">
							<form role="form" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" class="login-form">
								<div class="form-group">
									<label class="sr-only" for="form-username">Username</label>
									<input type="text" name="email" id="email" placeholder="<?php echo lang('email'); ?>" class="form-username form-control" required autofocus>
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" name="password" id="password" placeholder="<?php echo lang('password'); ?>" class="form-password form-control" required>
								</div>
								<input type="submit" name="btn_login" value="<?php echo lang('login'); ?>" class="btn">
							</form>
						</div>
					</div>
				</div>
			</div>            
        </div>

	</body>
</html>