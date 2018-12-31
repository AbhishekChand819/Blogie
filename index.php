<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" href="http://pngimg.com/uploads/letter_b/letter_b_PNG13.png" sizes="16x16" type="image/png">
	<title>Blogie: Home</title>

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
			<div id="hot-post" class="row hot-post">
				<div class="col-md-8 hot-post-left">
				    <?php 
				    $query = "SELECT * FROM posts WHERE status='Approved' ORDER BY RAND()";
				    $post = mysqli_fetch_assoc(mysqli_query($conn, $query));
				    $post_id = $post['id'];
			        $title = $post['title'];
			        $date = $post['date'];
			        $thumb_url = $post['thumb_url'];
			        $user_id = $post['posted_by'];
			        $cat_id = $post['category'];
			        $query = "SELECT * FROM users WHERE id = $user_id";
			        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
			        $query = "SELECT * FROM category WHERE id = $cat_id";
			        $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
				    ?>
					<!-- post -->
					<div class="post post-thumb">
						<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($post_id); ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="508px"></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
							</div>
							<h3 class="post-title title-lg"><a href="blog-post.php?id=<?php echo base64_encode($post_id); ?>"><?php echo $title; ?></a></h3>
							<ul class="post-meta">
								<li><a><?php echo $name; ?></a></li>
								<li><?php echo $date; ?></li>
							</ul>
						</div>
					</div>
					<!-- /post -->
				</div>
				<div class="col-md-4 hot-post-right">
				    <?php 
				    $query = "SELECT * FROM posts WHERE id <> $post_id AND status='Approved' ORDER BY RAND() LIMIT 2";
				    $posts = mysqli_query($conn, $query);
				    while($row = mysqli_fetch_assoc($posts)){
				        $title = $row['title'];
				        $post_id = base64_encode($row['id']);
    			        $date = $row['date'];
    			        $thumb_url = $row['thumb_url'];
    			        $user_id = $row['posted_by'];
    			        $cat_id = $row['category'];
    			        $query = "SELECT * FROM users WHERE id = $user_id";
    			        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
    			        $query = "SELECT * FROM category WHERE id = $cat_id";
    			        $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
				    ?>
					<!-- post -->
					<div class="post post-thumb">
						<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="250px"></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
							</div>
							<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
							<ul class="post-meta">
								<li><a><?php echo $name; ?></a></li>
								<li><?php echo $date; ?></li>
							</ul>
						</div>
					</div>
					<!-- /post -->
                    <?php } ?>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<!-- row -->
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<h2 class="title">Recent posts</h2>
							</div>
						</div>
						<?php 
						$query = "SELECT * FROM posts WHERE status='Approved' ORDER BY date LIMIT 4";
						$selected_posts = mysqli_query($conn, $query);
						while($row = mysqli_fetch_assoc($selected_posts)){
						    $thumb_url = $row['thumb_url'];
						    $post_id = base64_encode($row['id']);
						    $cat_id = $row['category'];
						    $title = $row['title'];
						    if(strlen($title) > 50){
						        $title = substr($title, 0, 50)." ...";
						    }
						    $date = $row['date'];
						    $user_id = $row['posted_by'];
						    $query = "SELECT * FROM category WHERE id = $cat_id";
						    $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
						    $query = "SELECT * FROM users WHERE id = $user_id";
						    $author = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
						?>
						<!-- post -->
						<div class="col-md-6">
							<div class="post">
								<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="240px"></a>
								<div class="post-body">
									<div class="post-category">
										<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
									</div>
									<h3 class="post-title" style="height: 42px;"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
									<ul class="post-meta">
										<li><a><?php echo $author; ?></a></li>
										<li><?php echo $date; ?></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /post -->
                        <?php } ?>
					</div>
					<!-- /row -->

					<!-- row -->
					<div class="row" style="margin-bottom: 30px;">
						<div class="col-md-12">
							<div class="section-title">
								<h2 class="title">Lifestyle</h2>
							</div>
						</div>
						
						<?php 
					    $query = "SELECT * FROM posts WHERE category = 1 AND status='Approved' ORDER BY date LIMIT 3";
					    $life_posts = mysqli_query($conn, $query);
					    while($row = mysqli_fetch_assoc($life_posts)){
					        $title = $row['title'];
					        $post_id = base64_encode($row['id']);
					        $date = $row['date'];
					        $thumb_url = $row['thumb_url'];
					        $user_id = $row['posted_by'];
					        $query = "SELECT * FROM users WHERE id = $user_id";
					        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
					    ?>
					    
						<!-- post -->
						<div class="col-md-4">
							<div class="post post-sm">
								<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="155px"></a>
								<div class="post-body">
									<div class="post-category">
										<a href="category.php?category=1">Lifestyle</a>
									</div>
									<h3 class="post-title title-sm" style="height: 37px;"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
									<ul class="post-meta">
										<li><a><?php echo explode(" ", $name)[0]; ?></a></li>
										<li><?php echo $date; ?></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /post -->
						
						<?php } ?>

					</div>
					<!-- /row -->

					<!-- row -->
					<div class="row" style="margin-bottom: 30px;">
						<div class="col-md-12">
							<div class="section-title">
								<h2 class="title">Fashion & Travel</h2>
							</div>
						</div>
						<?php 
					    $query = "SELECT * FROM posts WHERE (category = 4 OR category = 6) AND (status='Approved') ORDER BY date LIMIT 3";
					    $selected_posts = mysqli_query($conn, $query);
					    while($row = mysqli_fetch_assoc($selected_posts)){
					        $title = $row['title'];
					        if(strlen($title) > 40){
					            $title = substr($title, 0, 40)." ...";
					        }
					        $date = $row['date'];
					        $post_id = base64_encode($row['id']);
					        $thumb_url = $row['thumb_url'];
					        $user_id = $row['posted_by'];
					        $cat_id = $row['category'];
					        $query = "SELECT * FROM users WHERE id = $user_id";
					        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
					        $query = "SELECT * FROM category WHERE id = $cat_id";
					        $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
					    ?>
						<!-- post -->
						<div class="col-md-4">
							<div class="post post-sm">
								<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="155px"></a>
								<div class="post-body">
									<div class="post-category">
										<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
									</div>
									<h3 class="post-title title-sm" style="height: 37px;"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
									<ul class="post-meta">
										<li><a><?php echo explode(" ", $name)[0]; ?></a></li>
										<li><?php echo $date; ?></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /post -->
						<?php } ?>
					</div>
					<!-- /row -->

					<!-- row -->
					<div class="row" style="margin-bottom: 30px;">
						<div class="col-md-12">
							<div class="section-title">
								<h2 class="title">Technology & Health</h2>
							</div>
						</div>
						<?php 
					    $query = "SELECT * FROM posts WHERE (category = 5 OR category = 7) AND (status = 'Approved') ORDER BY date LIMIT 3";
					    $selected_posts = mysqli_query($conn, $query);
					    while($row = mysqli_fetch_assoc($selected_posts)){
					        $title = $row['title'];
					        $post_id = base64_encode($row['id']);
					        if(strlen($title) > 40){
					            $title = substr($title, 0, 40)." ...";
					        }
					        $date = $row['date'];
					        $thumb_url = $row['thumb_url'];
					        $user_id = $row['posted_by'];
					        $cat_id = $row['category'];
					        $query = "SELECT * FROM users WHERE id = $user_id";
					        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
					        $query = "SELECT * FROM category WHERE id = $cat_id";
					        $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
					    ?>
						<!-- post -->
						<div class="col-md-4">
							<div class="post post-sm">
								<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="155px"></a>
								<div class="post-body">
									<div class="post-category">
										<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
									</div>
									<h3 class="post-title title-sm" style="height: 37px;"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
									<ul class="post-meta">
										<li><a><?php echo explode(" ", $name)[0]; ?></a></li>
										<li><?php echo $date; ?></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /post -->
						<?php } ?>
					</div>
					<!-- /row -->
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

					<!-- category widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Categories</h2>
						</div>
						<div class="category-widget">
							<ul>
								<?php
							    $query = "SELECT * FROM category ORDER BY RAND() LIMIT 5";
							    $categories = mysqli_query($conn, $query);
							    while($row = mysqli_fetch_assoc($categories)){
							        $cat_id = $row['id'];
							        $category = $row['category'];
							        $query = "SELECT * FROM posts WHERE category = $cat_id AND status='Approved'";
							        $selected_posts = mysqli_query($conn, $query);
							        $count = mysqli_num_rows($selected_posts);
							    ?>
								<li><a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?> <span><?php echo $count; ?></span></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<!-- /category widget -->

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

					<!-- post widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Popular Posts</h2>
						</div>
						
						<?php  
    				    $query = "SELECT * FROM posts WHERE status='Approved' ORDER BY likes LIMIT 10";
    				    $liked_posts = mysqli_query($conn, $query);
    				    while($row = mysqli_fetch_assoc($liked_posts)){
    				        $thumb_url = $row['thumb_url'];
    				        $post_id = base64_encode($row['id']);
    				        $cat_id = $row['category'];
    				        $date = $row['date'];
    				        $title = $row['title'];
    				        $user_id = $row['posted_by'];
    				        $query = "SELECT * FROM users WHERE id = $user_id";
    				        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
    				        if(strlen($title) > 35){
    				            $title = substr($title, 0, 35)." ...";
    				        }
    				        $query = "SELECT * FROM category WHERE id = $cat_id";
    				        $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
    				    ?>
						<!-- post -->
						<div class="post post-widget">
							<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="86px"></a>
							<div class="post-body">
								<div class="post-category">
									<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
								</div>
								<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
							</div>
						</div>
						<!-- /post -->
						<?php } ?>
						
					</div>
					<!-- /post widget -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
		    <div class="section-title">
    			<h2 class="title">Must Read</h2>
    		</div>
			<!-- row -->
			<div class="row" style="margin-bottom: 30px;">
				    
				    <?php  
				    $query = "SELECT * FROM posts WHERE status='Approved' ORDER BY views DESC LIMIT 9";
				    $must_posts = mysqli_query($conn, $query);
				    while($row = mysqli_fetch_assoc($must_posts)){
				        $thumb_url = $row['thumb_url'];
				        $post_id = base64_encode($row['id']);
				        $cat_id = $row['category'];
				        $title = $row['title'];
				        if(strlen($title) > 35){
				            $title = substr($title, 0, 35)." ...";
				        }
				        $query = "SELECT * FROM category WHERE id = $cat_id";
				        $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
				    ?>
				    
					<!-- post -->
					<div class="col-md-4">
    					<div class="post post-widget">
    						<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="86px"></a>
    						<div class="post-body">
    							<div class="post-category">
    								<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
    							</div>
    							<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
    						</div>
    					</div>
					</div>
					<!-- /post -->
                    
                    <?php } ?>
                    
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
				    <?php  
				    $query = "SELECT * FROM posts WHERE status='Approved' ORDER BY likes DESC LIMIT 5";
				    $liked_posts = mysqli_query($conn, $query);
				    while($row = mysqli_fetch_assoc($liked_posts)){
				        $thumb_url = $row['thumb_url'];
				        $cat_id = $row['category'];
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
				        $query = "SELECT * FROM category WHERE id = $cat_id";
				        $category = mysqli_fetch_assoc(mysqli_query($conn, $query))['category'];
				    ?>
					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="200px"></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
							</div>
							<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
							<ul class="post-meta">
								<li><a><?php echo $name; ?></a></li>
								<li><?php echo $date; ?></li>
							</ul>
							<p><?php echo substr($content, 0, 220)." ..."; ?></p>
						</div>
					</div>
					<!-- /post -->
					<?php } ?>
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
