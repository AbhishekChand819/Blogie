<?php session_start(); include "db.php"; ?>
<?php
if(isset($_GET['nl_mail'])){
    $nl_mail = $_GET['nl_mail'];
    if($nl_mail == ''){
        echo "<script>window.location.href='index.php';</script>";
    } else {
        if (filter_var($nl_mail, FILTER_VALIDATE_EMAIL)) {
            $file = 'newsletter_subs.txt';
            $searchfor = $nl_mail;
            // get the file contents, assuming the file to be readable (and exist)
            $contents = file_get_contents($file);
            // escape special characters in the query
            $pattern = preg_quote($searchfor, '/');
            // finalise the regular expression, matching the whole line
            $pattern = "/^.*$pattern.*\$/m";
            // search, and store all matching occurences in $matches
            if(preg_match_all($pattern, $contents, $matches)){
                if(implode("\n", $matches[0]) == $nl_mail){
                    echo "<script>alert('You have successfully subscribed to our newsletter.'); window.location.href='index.php';</script>";
                }
            }
            else{
                $nl_file = fopen("newsletter_subs.txt", "a") or die("Unable to open file!");
                fwrite($nl_file, $nl_mail."\n");
                fclose($nl_file);
                echo "<script>alert('You have successfully subscribed to our newsletter.'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid Email Address'); window.location.href='index.php';</script>";
        }
    }
}
?>
<!-- NAV -->
		<div id="nav">
			<!-- Top Nav -->
			<div id="nav-top">
				<div class="container">
					<!-- social -->
					<ul class="nav-social">
						<li><a href="https://www.facebook.com/pg/Blogie-908764785998867/posts/"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/Blogie5"><i class="fa fa-twitter"></i></a></li>
						<li><a href="https://plus.google.com/u/2/102959616092602745550"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="https://www.instagram.com/blogie_blogs/"><i class="fa fa-instagram"></i></a></li>
					</ul>
					<!-- /social -->

					<!-- logo -->
					<div class="nav-logo">
						<a href="/" class="logo"><img src="./img/logo.PNG"></a>
					</div>
					<!-- /logo -->

					<!-- search & aside toggle -->
					<div class="nav-btns">
					    <?php if(isset($_SESSION['id'])){ ?>
                        <div class="dropdown" style="display:inline;">
                            <button class="btn btn-default" data-toggle="dropdown">Hi, <?php echo $_SESSION['username']; ?></button>
                            <ul class="dropdown-menu" style="top: auto;">
                                <li><a href="<?php if($_SESSION['email'] == 'admin@mail.com') echo 'admin/'; else echo 'dashboard/'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li><a href="/signin.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
						<?php } else { ?>
						<button onclick="location.href='signin.php';"><i class="fa fa-user" aria-hidden="true"></i></button>
						<?php } ?>
                        <button class="search-btn"><i class="fa fa-search"></i></button>
						<button class="aside-btn"><i class="fa fa-bars"></i></button>
						<div id="nav-search" style="padding: 0;">
							<form method="GET" action="search.php">
								<input class="input" style="font-weight: normal; padding: 0 20px;" name="search" placeholder="Enter your search..." autocomplete="off">
							</form>
							<button class="nav-close search-close">
								<span></span>
							</button>
						</div>
					</div>
					<!-- /search & aside toggle -->
				</div>
			</div>
			<!-- /Top Nav -->

			<!-- Main Nav -->
			<div id="nav-bottom">
				<div class="container">
					<!-- nav -->
					<ul class="nav-menu">
						<li>
							<a href="/">Home</a>
						</li>
						<li class="has-dropdown megamenu">
							<a>Trending</a>
							<div class="dropdown tab-dropdown">
								<div class="row">
									<div class="col-md-12">
										<div class="dropdown-body tab-content">
											<!-- tab1 -->
											<div id="tab1" class="tab-pane fade in active">
												<div class="row">
												    
													<?php 
												    $query = "SELECT * FROM posts WHERE status='Approved' ORDER BY views DESC LIMIT 3";
												    $posts = mysqli_query($conn, $query);
												    while($row = mysqli_fetch_assoc($posts)){
												        $title = $row['title'];
												        $id = $row['id'];
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
															<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($id); ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="235px"></a>
															<div class="post-body">
																<div class="post-category">
																	<a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $category; ?></a>
																</div>
																<h3 class="post-title title-sm"><a href="blog-post.php?id=<?php echo base64_encode($id); ?>"><?php echo $title; ?></a></h3>
																<ul class="post-meta">
																	<li><a><?php echo $name; ?></a></li>
																	<li><?php echo $date; ?></li>
																</ul>
															</div>
														</div>
													</div>
													<!-- /post -->

													<?php } ?>

												</div>
											</div>
											<!-- /tab1 -->
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="has-dropdown megamenu">
							<a>Lifestyle</a>
							<div class="dropdown tab-dropdown">
								<div class="row">
									<div class="col-md-12">
										<div class="dropdown-body tab-content">
											<!-- tab1 -->
											<div id="tab1" class="tab-pane fade in active">
												<div class="row">
												    
													<?php 
												    $query = "SELECT * FROM posts WHERE category = 1 AND status='Approved' ORDER BY date LIMIT 3";
												    $life_posts = mysqli_query($conn, $query);
												    while($row = mysqli_fetch_assoc($life_posts)){
												        $title = $row['title'];
												        $id = $row['id'];
												        $date = $row['date'];
												        $thumb_url = $row['thumb_url'];
												        $user_id = $row['posted_by'];
												        $query = "SELECT * FROM users WHERE id = $user_id";
												        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
												    ?>
												    
													<!-- post -->
													<div class="col-md-4">
														<div class="post post-sm">
															<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($id); ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="235px"></a>
															<div class="post-body">
																<div class="post-category">
																	<a href="category.php?category=1">Lifestyle</a>
																</div>
																<h3 class="post-title title-sm"><a href="blog-post.php?id=<?php echo base64_encode($id); ?>"><?php echo $title; ?></a></h3>
																<ul class="post-meta">
																	<li><a><?php echo $name; ?></a></li>
																	<li><?php echo $date; ?></li>
																</ul>
															</div>
														</div>
													</div>
													<!-- /post -->

													<?php } ?>

												</div>
											</div>
											<!-- /tab1 -->
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="has-dropdown megamenu">
							<a>Entertainment</a>
							<div class="dropdown tab-dropdown">
								<div class="row">
									<div class="col-md-12">
										<div class="dropdown-body tab-content">
											<!-- tab1 -->
											<div id="tab1" class="tab-pane fade in active">
												<div class="row">
												    
													<?php 
												    $query = "SELECT * FROM posts WHERE category = 3 AND status='Approved' ORDER BY date LIMIT 3";
												    $ent_posts = mysqli_query($conn, $query);
												    while($row = mysqli_fetch_assoc($ent_posts)){
												        $title = $row['title'];
												        $id = $row['id'];
												        $date = $row['date'];
												        $thumb_url = $row['thumb_url'];
												        $user_id = $row['posted_by'];
												        $query = "SELECT * FROM users WHERE id = $user_id";
												        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
												    ?>
												    
													<!-- post -->
													<div class="col-md-4">
														<div class="post post-sm">
															<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($id); ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="235px"></a>
															<div class="post-body">
																<div class="post-category">
																	<a href="category.php?category=3">Entertainment</a>
																</div>
																<h3 class="post-title title-sm"><a href="blog-post.php?id=<?php echo base64_encode($id); ?>"><?php echo $title; ?></a></h3>
																<ul class="post-meta">
																	<li><a><?php echo $name; ?></a></li>
																	<li><?php echo $date; ?></li>
																</ul>
															</div>
														</div>
													</div>
													<!-- /post -->

													<?php } ?>

												</div>
											</div>
											<!-- /tab1 -->
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="has-dropdown megamenu">
							<a>Technology</a>
							<div class="dropdown tab-dropdown">
								<div class="row">
									<div class="col-md-12">
										<div class="dropdown-body tab-content">
											<!-- tab1 -->
											<div id="tab1" class="tab-pane fade in active">
												<div class="row">
												    
													<?php 
												    $query = "SELECT * FROM posts WHERE category = 5 AND status='Approved' ORDER BY date LIMIT 3";
												    $tech_posts = mysqli_query($conn, $query);
												    while($row = mysqli_fetch_assoc($tech_posts)){
												        $title = $row['title'];
												        $id = $row['id'];
												        $date = $row['date'];
												        $thumb_url = $row['thumb_url'];
												        $user_id = $row['posted_by'];
												        $query = "SELECT * FROM users WHERE id = $user_id";
												        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
												    ?>
												    
													<!-- post -->
													<div class="col-md-4">
														<div class="post post-sm">
															<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($id); ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="235px"></a>
															<div class="post-body">
																<div class="post-category">
																	<a href="category.php?category=5">Technology</a>
																</div>
																<h3 class="post-title title-sm"><a href="blog-post.php?id=<?php echo base64_encode($id); ?>"><?php echo $title; ?></a></h3>
																<ul class="post-meta">
																	<li><a><?php echo $name; ?></a></li>
																	<li><?php echo $date; ?></li>
																</ul>
															</div>
														</div>
													</div>
													<!-- /post -->

													<?php } ?>

												</div>
											</div>
											<!-- /tab1 -->
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="has-dropdown megamenu">
							<a>Sports</a>
							<div class="dropdown tab-dropdown">
								<div class="row">
									<div class="col-md-12">
										<div class="dropdown-body tab-content">
											<!-- tab1 -->
											<div id="tab1" class="tab-pane fade in active">
												<div class="row">
												    
												    <?php 
												    $query = "SELECT * FROM posts WHERE category = 2 AND status='Approved' ORDER BY date LIMIT 3";
												    $sports_posts = mysqli_query($conn, $query);
												    while($row = mysqli_fetch_assoc($sports_posts)){
												        $title = $row['title'];
												        $date = $row['date'];
												        $id = $row['id'];
												        $thumb_url = $row['thumb_url'];
												        $user_id = $row['posted_by'];
												        $query = "SELECT * FROM users WHERE id = $user_id";
												        $name = mysqli_fetch_assoc(mysqli_query($conn, $query))['username'];
												    ?>
												    
													<!-- post -->
													<div class="col-md-4">
														<div class="post post-sm">
															<a class="post-img" href="blog-post.php?id=<?php echo base64_encode($id); ?>"><img class="custom-img" src="<?php echo $thumb_url; ?>" height="235px"></a>
															<div class="post-body">
																<div class="post-category">
																	<a href="category.php?category=2">Sports</a>
																</div>
																<h3 class="post-title title-sm"><a href="blog-post.php?id=<?php echo base64_encode($id); ?>"><?php echo $title; ?></a></h3>
																<ul class="post-meta">
																	<li><a><?php echo $name; ?></a></li>
																	<li><?php echo $date; ?></li>
																</ul>
															</div>
														</div>
													</div>
													<!-- /post -->

													<?php } ?>
													
												</div>
											</div>
											<!-- /tab1 -->
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<!-- /nav -->
				</div>
			</div>
			<!-- /Main Nav -->

			<!-- Aside Nav -->
			<div id="nav-aside">
				<ul class="nav-aside-menu">
					<li><a href="/">Home</a></li>
					<li class="has-dropdown"><a>Categories</a>
						<ul class="dropdown">
						    <?php $query = "SELECT * FROM category";
						    $categories = mysqli_query($conn, $query);
						    while($row = mysqli_fetch_assoc($categories)){
						        $category = $row['category']; 
						        $category_id = $row['id'];
						    ?>
							<li><a href="category.php?category=<?php echo $category_id; ?>"><?php echo $category; ?></a></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="/about.php">About Us</a></li>
					<li><a href="/contact.php">Contact Us</a></li>
					<li><a href="/terms.php">Terms & Privacy Policy</a></li>
				</ul>
				<button class="nav-close nav-aside-close"><span></span></button>
			</div>
			<!-- /Aside Nav -->
		</div>
		<!-- /NAV -->