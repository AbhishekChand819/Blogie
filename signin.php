<?php session_start(); session_destroy(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" href="http://pngimg.com/uploads/letter_b/letter_b_PNG13.png" sizes="16x16" type="image/png">
	<title>Blogie: Sign In/Sign Up</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	<style type="text/css">
		.form-input-wrapper{
			margin: 20px 0px;
		}
		.form-control{
			height: 40px;
		}
		#loader {
		    background: url("https://gifimage.net/wp-content/uploads/2017/10/colorful-loader-gif-transparent-11.gif") no-repeat scroll center center rgba(250,250,250,0.9);
		    position: fixed;
		    height: 100%;
		    width: 100%;
		    z-index: 9999;
		}
		.reg_wrapper {
			padding-top: 40px;
			padding-bottom: 40px;
		}
		.login_wrapper{
			padding-top: 80px;
			padding-bottom: 80px;
		}

		/* Responsive styles Start */
		@media (max-width: 575.98px) { 

		}

		@media (min-width: 576px) and (max-width: 767.98px) { 

		}

		@media (min-width: 768px) and (max-width: 991.98px) { 

		}

		@media (min-width: 992px) and (max-width: 1199.98px) { 
			.reg_wrapper {

			}
		}
		/* Responsive styles End */

	</style>

</head>

<body>
	<div id="loader" style="display: none;"></div>

	<!-- HEADER -->
	<header id="header">
		<?php include "header.php"; ?>	
	</header>
	<!-- /HEADER -->

	<div class="alert alert-danger text-center" id="rf" style="display:none; margin-bottom: 0px;"> Registeration Failed : ( </div>

  	<!-- Modal For Email Verification -->
	<div id="rs" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Verification Required</h4>
	      </div>
	      <div class="modal-body">
	        <p>Hi there! We have sent a verification code to your email address. Please enter the verification code given in the mail below to complete your registeration.</p>
	        <input type="text" class="form-control" placeholder="Verification Code" id="v-code">
	        <input type="text" id="v-email" hidden>
	        <div id="reg_msg" class="alert" style="display: none;">
	        	
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" onclick="verifyUser();">Submit</button>
	        <button type="button" class="btn btn-default" onclick="location.reload();">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal For Password Change -->
	<div id="pass_change" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog">

	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Reset Password</h4>
	      </div>
	      <div class="modal-body">
	        <input type="password" class="form-control" placeholder="New Password" id="n_pass"><br/>
	        <input type="password" class="form-control" placeholder="Confirm Password" id="c_n_pass">
			<input type="text" id="f-email" hidden><br>
			<div id="pass_msg" class="alert" style="display: none;">
	        	
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" onclick="change_password();">Submit</button>
	        <button type="button" class="btn btn-default" onclick="location.reload();">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal For Forgot Password -->
	<div id="forgot_pass_modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Forgot Password</h4>
	      </div>
	      <div class="modal-body">
	        <p>Enter your email address to reset your password.</p>
	        <input type="text" class="form-control" placeholder="Registered Email" id="f_email"><br/>
	        <div id="reset_pass_msg" class="alert alert-success" style="display: none;">
	        	An email has been sent to you containing the password.
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" onclick="forgot_pass();" id="reset_pass_btn">Submit</button>
	        <button type="button" class="btn btn-default" onclick="location.reload();">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- SECTION -->
	<div class="section" style="background-image: url(https://impressprinters.com/wp-content/uploads/2017/10/blurred-background-1.jpg);">
		<div class="container">
		<!-- row -->
		<div class="row" style="padding: 40px 0px 60px 0px;">

			<div class="col-xs-12 col-sm-6">
				<div class="reg_wrapper">
					<h2 class="text-center">Be A Part Of Us - Sign Up</h2>

					<div class="form-input-wrapper">
						<div class="input-group">
						    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input class="form-control" type="text" placeholder="Your Username" id="su_username" required>
						</div>
					</div>

					<div class="form-input-wrapper">
						<div class="input-group">
						    <span class="input-group-addon">@</span>
							<input class="form-control" type="email" placeholder="Your Email" id="su_email" required>
						</div>
					</div>

					<div class="form-input-wrapper">
						<div class="input-group">
						    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" type="password" placeholder="Password" id="su_pass" required>
						</div>
					</div>

					<div class="form-input-wrapper">
						<div class="input-group">
						    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" type="password" placeholder="Confirm Password" id="su_c_pass" required >
						</div>
					</div>

					<div class="form-input-wrapper" style="margin: 0px; padding: 0px;">
						<div class="col-xs-1" style="font-size: 18px; padding: 10px 0px;">
							<input type="checkbox" style="width: 20px; height: 20px;" checked>
						</div>
						<div class="col-xs-5" style="font-size: 18px; padding: 10px 0px;">
							 &nbsp; I agree to the terms
						</div>
						<div class="col-xs-6" style="padding: 0px;">
							<input type="button" class="btn btn-danger btn-lg btn-block" value="Sign Up" onclick="signup_submit();">	
						</div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6">
				<div class="login_wrapper">
					<h2 class="text-center" style="">Existing Member - Login</h2>

					<div class="form-input-wrapper">
						<div class="input-group">
						    <span class="input-group-addon">@</span>
							<input class="form-control" type="email" placeholder="Email"  id="si_email" required>
						</div>
					</div>

					<div class="form-input-wrapper">
						<div class="input-group">
						    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" type="password" placeholder="Password" id="si_pass" required>
						</div>
					</div><br/>

					<div class="form-input-wrapper" style="margin: 0px; padding: 0px;">
						<div class="col-xs-5" style="font-size: 17px; padding: 11px 0px;">
							<p onclick="$('#forgot_pass_modal').modal('show');">Forgot Password ?</p>
						</div>
						<div class="col-xs-6 col-xs-offset-1" style="padding: 0px;">
							<input type="button" class="btn btn-success btn-lg btn-block" value="Login" onclick="signin_submit();">	
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /.row -->
		</div>
	</div>
	<!-- /SECTION -->

	<!-- FOOTER -->
	<footer id="footer">
		<?php include "footer.php"; ?>
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/main.js"></script>

	<script>
	function getUrlParameter(name) {
	    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
	    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
	    var results = regex.exec(location.search);
	    return results === null ? false : decodeURIComponent(results[1].replace(/\+/g, ' '));
	}

	function signin_submit(){
		var email = $("#si_email").val();
		var password = $("#si_pass").val();
		if(email != '' && password != ''){
			$.ajax({
					type: "POST",
					url: "login.php",
					data: { email: email, password: password },
					success: function(response){
						if(response == 0){
							alert('You Are Not Registered Yet.');
						} else if(response == 'failed'){
							alert('Incorrect Credentials.');
						} else if(response == 'login'){
							var returnUrl = getUrlParameter('return');
							if(returnUrl){
								window.location.href = 'blog-post.php?id='+returnUrl;
							} else {
								window.location.href = 'index.php';
							}
						} else if(response == 'admin'){
							window.location.href = 'admin/';
						} else if(response == 'blocked'){
							alert('Your account has been blocked by admin. Contact us for further details.');
						}
					}
			});
		}
	}

	function verifyUser(){
			var v_code = $("#v-code").val();
			var v_email = $("#v-email").val();
			if(v_code != ''){
				$.ajax({
						type: "POST",
						url: "confirm.php",
						data: { email: v_email, token: v_code },
						success: function(res){
							if(res == 0){
								alert('Sorry something went wrong. Please try again after some time.');
							}
							else if(res == 1){
								$("#reg_msg").addClass("alert-danger");
								$("#reg_msg").html('Invalid Code Provided.');
								$("#reg_msg").show();
							}
							else if(res == 2){
								$("#v-code").attr("disabled", true);
								$("#reg_msg").removeClass("alert-danger");
								$("#reg_msg").addClass("alert-success");
								$("#reg_msg").html('Registeration Successful. You can login now.');
								$("#reg_msg").show();
							} else {
								alert('Error: Something broke up. Contact Us if the issue persists.');
							}
						}
				});
			}
		}	

		function signup_submit(){
			var email = $("#su_email").val();
			var username = $("#su_username").val();
			var password = $("#su_pass").val();
			var c_password = $("#su_c_pass").val();
			var re = /\S+@\S+\.\S+/;
			if(email != '' && username != '' && (password == c_password) && re.test(email)){
				$("#loader").show();
				$.ajax({
						type: "POST",
						url: "add_user.php",
						data: { email: email, username: username, password: password },
						success: function(response){
							$("#loader").hide();
							if(response == 1){
								$("#v-email").val(email);
								$("#rs").modal('show');
							} else if(response == "user exists"){ 
								setTimeout(function(){
									alert('You are already a registered user.');
									location.reload();
								}, 1000);
							} else {
								$("#rf").show();
							}
						}
				});
			}
		}

		function forgot_pass(){
			var email = $("#f_email").val();
			var re = /\S+@\S+\.\S+/;
			if(email != '' && re.test(email)){
				$("#reset_pass_btn").html('Please Wait ...');
				$("#reset_pass_btn").attr("onclick","");
				$.ajax({
					type: "POST",
					url: "forgot_pass.php",
					data: { email: email },
					success: function(res){
						$("#reset_pass_btn").html('Submit');
						$("#reset_pass_btn").attr("onclick","forgot_pass();");
						if(res == 0){
							alert('Email doesn\'t exist.');
						} else if(res == 1){
							$("#reset_pass_msg").show();
						} else {
							alert('Error: Uncaught error occured. Contact if the problem persists.');
						}
					}
				});
			} else {
				alert('Invalid details provided.')
			}
		}

		function change_password(){
			var pass = $("#n_pass").val();
			var c_pass = $("#c_n_pass").val();
			var email = $("#f-email").val();
			if(pass == c_pass && pass != ''){
				$.ajax({
					type: "POST",
					url: "change_pass.php",
					data: { email: email, pass: pass },
					success: function(res){
						if(res == 1){
							$("#pass_msg").addClass("alert-success");
							$("#pass_msg").html('Password changed successfully.');
							$("#pass_msg").show();
						} else {
							alert('Sorry! Something broke up. Please try again.')
						}
					}
				});
			} else {
				alert('Wrong or incorrect form status.');
			}
		}
  </script>

</body>
</html>