<?php

include "db.php";
$error = 1;
if(isset($_POST['contact_btn'])){
    $email = $_POST['email'];
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    if($email != '' && $subject != '' && $msg != ''){
        $query = "INSERT INTO contact_us(email, subject, message) VALUES('$email', '$subject', '$msg')";
        $insert_contact_query = mysqli_query($conn, $query);

        if(!$insert_contact_query){
            echo "<script>alert('Sorry, there was a problem. Please try again.'); window.location.href='contact.php';</script>";
        } else {
            $error = 0;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" href="http://pngimg.com/uploads/letter_b/letter_b_PNG13.png" sizes="16x16" type="image/png">
	<title>Blogie: Contact Us</title>

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

</head>

<body>
	<!-- HEADER -->
	<header id="header">
		<?php include "header.php"; ?>

		<!-- PAGE HEADER -->
		<div class="page-header">
			<div class="container">
				<div class="row">
					<div class="col-md-offset-1 col-md-10 text-center">
						<h1 class="text-uppercase">Contact Us</h1>
						<p class="lead">We like to create things with fun, open-minded people. Feel free to say Hello!</p>
					</div>
				</div>
			</div>
		</div>
		<!-- /PAGE HEADER -->
	</header>
	<!-- /HEADER -->

    <!-- Modal -->
    <div id="contact_success_modal" class="modal fade" role="dialog" style="top: 30%">
        <div class="modal-dialog">

            <div class="modal-content">
            <div class="modal-body">
                <p style="margin: 0; font-size: 20px;">Thankyou for contacting us.<br/>Your response has been recorded by the system.<br/>We will get in touch with your shortly.<br/>Meanwhile ... keep reading :p</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="window.location.href='contact.php';" data-dismiss="modal">Okay!</button>
            </div>
            </div>

        </div>
    </div>
    <!-- /Modal -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<div class="section-row">
						<div class="section-title">
							<h2 class="title">Contact Information</h2>
						</div>
						<ul class="contact">
							<li><i class="fa fa-phone"></i> +91-**********</li>
							<li><i class="fa fa-envelope"></i> <a>blogieverify@gmail.com</a></li>
						</ul>
					</div>

					<div class="section-row">
						<div class="section-title">
							<h2 class="title">Mail us</h2>
						</div>
						<form method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="text" name="subject" placeholder="Subject">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="input" name="message" placeholder="Message"></textarea>
									</div>
									<button type="submit" name="contact_btn" class="primary-button">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-4">
					<!-- social widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Social Media</h2>
						</div>
						<div class="social-widget">
							<ul>
								<li>
									<a href="https://www.facebook.com/pg/Blogie-908764785998867/posts/" class="social-facebook">
										<i class="fa fa-facebook"></i>
										<span>Facebook</span>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/Blogie5" class="social-twitter">
										<i class="fa fa-twitter"></i>
										<span>Twitter</span>
									</a>
								</li>
								<li>
									<a href="https://plus.google.com/u/2/102959616092602745550" class="social-google-plus">
										<i class="fa fa-google-plus"></i>
										<span>G-Plus</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /social widget -->

					<!-- newsletter widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Newsletter</h2>
						</div>
						<div class="newsletter-widget">
							<form>
								<p>Subscribe to our newsletter for instant updates right in your inbox.</p>
								<input class="input" name="nl_mail" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
					<!-- /newsletter widget -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
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
        document.onkeydown = function() {    
            switch (event.keyCode) { 
                case 116 : //F5 button
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false; 
                case 82 : //R button
                    if (event.ctrlKey) { 
                        event.returnValue = false; 
                        event.keyCode = 0;  
                        return false; 
                    } 
            }
        }
    </script>

<?php 
if($error == 0) {
    echo '<script>$("#contact_success_modal").modal("show");</script>';
} 
?>

</body>

</html>
