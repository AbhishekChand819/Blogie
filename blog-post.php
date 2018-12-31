<?php include "db.php";
if(isset($_GET['id'])){
    $post_id = base64_decode($_GET['id']);
    $query = "SELECT * FROM posts WHERE id = $post_id";
    $post = mysqli_fetch_assoc(mysqli_query($conn, $query));

    $status = $post['status'];
    if($status != 'Approved'){
    	echo "<script>window.location.href='/';</script>";
    }

    $views = $post['views'];
    $new_views = $views + 1;

    $query = "UPDATE posts SET views = '$new_views' WHERE id = $post_id";
    $add_view_query = mysqli_query($conn, $query);
}
else echo "<script>window.location.href='index.php';</script>";
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
                            <button class="btn btn-primary" id="like_btn" onclick="like_post();">Give A Thumbs Up <i class="fa fa-thumbs-up"></i></button>
                        </div>
					</div>
					</div>
					<!-- /post like -->

					<!-- post nav -->
					<div class="section-row">
						<div class="post-nav">
						    
						    <?php 
						    $query = "SELECT * FROM posts WHERE id < $post_id AND status = 'Approved'";
						    $prev_post_query = mysqli_query($conn, $query);
						    if(mysqli_num_rows($prev_post_query) != 0){
						        $prev_post = mysqli_fetch_assoc($prev_post_query);
						    ?>
							<div class="prev-post">
								<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($prev_post['id']); ?>"><img src="<?php echo $prev_post['thumb_url']; ?>" height="66px"></a>
								<h3 class="post-title"><a href="blog-post.php?id=<?php echo base64_encode($prev_post['id']); ?>"><?php echo $prev_post['title']; ?></a></h3>
								<span>Previous post</span>
							</div>
							<?php } ?>

                            <?php 
						    $query = "SELECT * FROM posts WHERE id > $post_id AND status = 'Approved'";
						    $next_post_query = mysqli_query($conn, $query);
						    if(mysqli_num_rows($next_post_query) != 0){
						        $next_post = mysqli_fetch_assoc($next_post_query);
						    ?>
							<div class="next-post">
								<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($next_post['id']); ?>"><img src="<?php echo $next_post['thumb_url']; ?>" height="66px"></a>
								<h3 class="post-title"><a href="blog-post.php?id=<?php echo base64_encode($next_post['id']); ?>"><?php echo $next_post['title']; ?></a></h3>
								<span>Next post</span>
							</div>
							<?php } ?>
							
						</div>
					</div>
					<!-- /post nav  -->

					<!-- /related post -->
					<div style="margin-bottom: 20px;">
						<div class="section-title">
							<h3 class="title">Related Posts</h3>
						</div>
						<div class="row">
						    <?php 
    					    $query = "SELECT * FROM posts WHERE (category = $cat_id AND id <> $post_id) AND (status = 'Approved') ORDER BY RAND() LIMIT 3";
    					    $related_posts = mysqli_query($conn, $query);
    					    while($row = mysqli_fetch_assoc($related_posts)){
    					        $title = $row['title'];
    					        $post_id = base64_encode($row['id']);
    					        if(strlen($title) > 45){
    					            $title = substr($title, 0, 45)." ...";
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
									<a class="post-img" href="blog-post.php?id=<?php echo $post_id; ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="153px"></a>
									<div class="post-body">
										<div class="post-category">
											<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
										</div>
										<h3 class="post-title title-sm" style="height: 37px;"><a href="blog-post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h3>
										<ul class="post-meta">
											<li><strong><?php echo explode(" ", $name)[0]; ?></strong></li>
											<li><?php echo $date; ?></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /post -->
                            <?php } ?>
						</div>
					</div>
					<!-- /related post -->

					<!-- post comments -->
					<div id="post-comments-wrapper">
						<div class="section-row" id="post-comments-div">
							<div class="section-title">
								<h3 class="title"><?php echo $comment_count; ?> Comments</h3>
							</div>
							<?php if($comment_count > 0){ ?>
							<div class="post-comments">
							    <?php while($row = mysqli_fetch_assoc($comments_query)){
							        $date = $row['date'];
							        $comment = $row['comment'];
							        $user_id = $row['author'];
							        $query = "SELECT * FROM users WHERE id = $user_id";
							        $user = mysqli_fetch_assoc(mysqli_query($conn, $query));
							    ?>
								<!-- comment -->
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="<?php echo $user['profile_img']; ?>" height="50px" width="50px">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?php echo $user['username']; ?></h4>
											<span class="time"><?php echo $date; ?></span>
										</div>
										<p><?php echo $comment; ?></p>
									</div>
								</div>
								<!-- /comment -->
								<?php } ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /post comments -->

					<?php if(isset($_SESSION['id'])){ ?>

					<!-- post reply -->
					<div class="section-row">
						<div class="section-title">
							<h3 class="title">Leave a reply</h3>
						</div>
						<div class="post-reply">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="input" id="comment" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="col-md-3">
									<button class="primary-button" onclick="add_comment();">Submit</button>
								</div>
								<div class="col-md-9" id="comment_msg" style="display: none;">
									<div class="alert alert-success">
										Comment Added Successfully.
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /post reply -->

					<?php } else { ?>

					<div class="section-row">
						<div class="alert alert-info text-center">You need to be logged in to post a comment. <a href="signin.php?return=<?php echo $_GET['id']; ?>">Login Now</a></div>
					</div>

					<?php } ?>

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
							        $query = "SELECT * FROM posts WHERE category = $cat_id AND status = 'Approved'";
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
    				    $query = "SELECT * FROM posts WHERE status = 'Approved' ORDER BY likes LIMIT 9";
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
    				        if(strlen($title) > 40){
    				            $title = substr($title, 0, 40)." ...";
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

		function add_comment(){
			var comment = $("#comment").val();
			var post_id = '<?php echo $post['id']; ?>';
			if(comment != ''){
				$.ajax({
					type: "POST",
					url: "add_comment.php",
					data: { comment: comment, post_id: post_id },
					success: function(res){
						if(res == 1){
							$("#comment_msg").show();
							$("#post-comments-wrapper").load(" #post-comments-div");
							$("#comment").val('');
							setTimeout(function(){
								$("#comment_msg").hide();
							}, 5000);
						} else {
							alert('Something Wrong Happened. Contact us if the issue persists.');
						}
					}
				});
			}
		}

        function like_post(){
            $("#like_btn").attr("disabled", true);
            $("#like_btn").html("Post Liked, Thankyou :)");
            var p_id = "<?php echo $_GET['id']; ?>";
            $.ajax({
                type: "POST",
                url: "like_post.php",
                data: { id: p_id },
                success: function(res){

                }
            });
        }
	</script>

</body>
</html>