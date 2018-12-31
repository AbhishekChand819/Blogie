<?php 
include "db.php";
	if(isset($_GET['category'])){
		$get_cat_id = $_GET['category'];
		$query = "SELECT * FROM category WHERE id = $get_cat_id";
		$get_category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
	} else {
		echo "<script>window.location.href='index.php';</script>";
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
	<title>Blogie: <?php echo $get_category; ?> Posts</title>

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
	</header>
	<!-- /HEADER -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row" style="margin-top: 10px; margin-bottom: 50px;">
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title"><?php echo $get_category; ?> Posts</h2>
					</div>

					<?php  
				    $query = "SELECT * FROM posts WHERE category = $get_cat_id AND status = 'Approved' ORDER BY date DESC";
				    $get_category_posts = mysqli_query($conn, $query);
				    while($row = mysqli_fetch_assoc($get_category_posts)){
				        $thumb_url = $row['thumb_url'];
				        $date = $row['date'];
				        $title = $row['title'];
				        $user_id = $row['posted_by'];
				        $post_id = base64_encode($row['id']);
				        $content = strip_tags($row['content']);
				        $query = "SELECT * FROM users WHERE id = $user_id";
				        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
				        if(strlen($title) > 65){
				            $title = substr($title, 0, 65)." ...";
				        }
				    ?>

					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="200px"></a>
						<div class="post-body">
							<div class="post-category">
								<a><?php echo $get_category; ?></a>
							</div>
							<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
							<ul class="post-meta">
								<li><strong><?php echo $name; ?></strong></li>
								<li><?php echo $date; ?></li>
							</ul>
							<p><?php echo substr($content, 0, 220)." ....."; ?></p>
						</div>
					</div>
					<!-- /post -->

					<?php } ?>
				</div>

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

</body>

</html>
