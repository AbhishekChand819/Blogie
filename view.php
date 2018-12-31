<?php session_start();
include "db.php";
if(isset($_GET['id'])){
    $post_id = base64_decode($_GET['id']);
    $query = "SELECT * FROM posts WHERE id = $post_id";
    $post = mysqli_fetch_assoc(mysqli_query($conn, $query));
}
else echo "<script>window.location.href='/';</script>";
if((!isset($_SESSION)) && $_SESSION['email'] != 'admin@mail.com'){
	echo "<script>window.location.href='/';</script>";
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
	<title><?php echo $post['title']; ?> - Blogie</title>

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
		<div id="post-header" class="page-header">
			<div class="page-header-bg" style="background: url('<?php echo $post['thumb_url']; ?>') no-repeat; background-size: cover;" data-stellar-background-ratio="0.5"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-10">
						<div class="post-category">
						    <?php $cat_id = $post['category'];
						    $query = "SELECT * FROM category WHERE id = $cat_id";
						    $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
						    ?>
							<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
						</div>
						<h1><?php echo $post['title']; ?></h1>
						<ul class="post-meta">
						    <?php $user_id = $post['posted_by'];
						    $query = "SELECT * FROM users WHERE id = $user_id";
						    $author = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
						    ?>
							<li><strong>Posted By: </strong><?php echo $author; ?></a></li>
							<li><?php echo $post['date']; ?></li>
							<?php
							$query = "SELECT * FROM comments WHERE post_id = $post_id";
							$comments_query = mysqli_query($conn, $query);
							$comment_count = mysqli_num_rows($comments_query);
							?>
							<li><i class="fa fa-comments"></i> <?php echo $comment_count; ?></li>
							<li><i class="fa fa-eye"></i> <?php echo $post['views']; ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /PAGE HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<!-- post share -->
					<div class="section-row">
						<div class="post-share">
                            <?php $coded_p_id = $_GET['id']; ?>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://blogie.epizy.com/blog-post.php?id='.$coded_p_id; ?>" target="_blank" class="social-facebook"><i class="fa fa-facebook"></i><span>Share</span></a>
							<a href="https://twitter.com/share?url=<?php echo 'http://blogie.epizy.com/blog-post.php?id='.$coded_p_id; ?>&amp;text=Check%20out%20this%20blog%20post%20on%20Blogie" target="_blank" class="social-twitter"><i class="fa fa-twitter"></i><span>Tweet</span></a>
							<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="social-pinterest"><i class="fa fa-pinterest"></i><span>Pin</span></a>
							<a href="mailto:?Subject=Check out this post on Blogie&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo 'http://blogie.epizy.com/blog-post.php?id='.$coded_p_id; ?>"><i class="fa fa-envelope"></i><span>Email</span></a>
						</div>
					</div>
					<!-- /post share -->

					<!-- post content -->
					<div class="section-row" id="post-content-div">
						<?php echo $post['content']; ?>
					</div>
					<!-- /post content -->

					<!-- post tags -->
					<div class="section-row">
						<div class="post-tags">
							<ul>
								<li>TAGS:</li>
								<?php $tags = explode(",", $post['tags']); foreach($tags as $tag){ ?>
									<li><a><?php echo $tag; ?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<!-- /post tags -->

                    <!-- post like -->
					<div class="section-row alert alert-info" style="margin-bottom: 40px;">
                    <div class="row" style="padding: 10px 20px;">
						<div class="col-xs-9" style="padding: 0;">
                            <p style="margin: 0; margin-top: 6px;">Liked the post? Make sure to give it a thumbs up.</p>
                        </div>
						<div class="col-xs-3" style="padding: 0;">
                            <button class="btn btn-primary" id="like_btn" onclick="like_post();" disabled>Give A Thumbs Up <i class="fa fa-thumbs-up"></i></button>
                        </div>
					</div>
					</div>
					<!-- /post like -->
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
		$("iframe").css({ "display": "block", "width": "100%" });
		$('#post-content-div').find('img').css({ "padding": "20px", "display": "block", "width": "100%", "height": "100%" });
		$('#post-content-div').find('p').css({ "font-family": "Muli" });
	</script>

</body>
</html>