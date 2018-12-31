<?php include "db.php"; ?>
<style>
	@media (max-width: 575.98px) { 
		#fbl2p, #fbl4l {
			display: none;
		}
	}
</style>
<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-3">
					<div class="footer-widget">
						<div class="footer-logo">
							<a href="/" class="logo"><img src="./img/logo-alt.PNG"></a>
						</div>
						<p>We're Blogie, a creative studio that loves to learn, collaborate and create.</p>
						<ul class="contact-social">
							<li><a href="https://www.facebook.com/pg/Blogie-908764785998867/posts/" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/Blogie5" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://plus.google.com/u/2/102959616092602745550" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="https://www.instagram.com/blogie_blogs/" class="social-instagram"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-widget">
						<h3 class="footer-title">Categories</h3>
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
				</div>
				<div class="col-md-3">
					<div class="footer-widget">
						<h3 class="footer-title">Popular Tags</h3>
						<div class="tags-widget">
							<ul>
								<li><a>Social</a></li>
								<li><a>Lifestyle</a></li>
								<li><a>Blog</a></li>
								<li><a>Travel</a></li>
								<li><a>Technology</a></li>
								<li><a>Fashion</a></li>
								<li><a>Life</a></li>
								<li><a>News</a></li>
								<li><a>Magazine</a></li>
								<li><a>Food</a></li>
								<li><a>Health</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-widget">
						<h3 class="footer-title">Newsletter</h3>
						<div class="newsletter-widget">
							<form>
								<p>Subscribe to our newsletter for instant updates right in your inbox.</p>
								<input class="input" name="nl_mail" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /row -->

			<!-- row -->
			<div class="footer-bottom row">
				<div class="col-md-7">
					<div class="footer-copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <span id="fbl2p">| This blog is made with <i class="fa fa-heart-o" aria-hidden="true"></i></span>.
					</div>
				</div>
				<div class="col-md-5">
					<ul class="footer-nav">
						<li><a href="/">Home</a></li>
						<li><a href="/about.php">About Us</a></li>
						<li><a href="/contact.php">Contact Us</a></li>
						<span id="fbl4l"><li><a href="/terms.php">Terms & Policy</a></li></span>
					</ul>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->