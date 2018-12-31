<?php session_start();
include "../db.php"; 
if(!isset($_SESSION['id'])){
    echo "<script>window.location.href='/';</script>";
}
$session_user_id = $_SESSION['id'];
$session_username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE id = $session_user_id";
$user_details = mysqli_fetch_assoc(mysqli_query($conn, $query));

$profile_pic = $user_details['profile_img'];
$user_email = $user_details['email'];

if(isset($_GET['id'])){
    $comment_id = $_GET['id'];
    $query = "DELETE FROM comments WHERE id = $comment_id";
    $delete_comment = mysqli_query($conn, $query);

    echo "<script>window.location.href='comments.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <link rel="icon" href="http://pngimg.com/uploads/letter_b/letter_b_PNG13.png" sizes="16x16" type="image/png">
    <title>Blogie: Post Comments</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">


    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <style>
        .header-desktop, .account-dropdown{
            z-index: 99;
        }
        .card {
            margin-bottom: 5px;
        }
        .card-body {
            padding-left: 32px;
        }
        #overlay {
          position: fixed; /* Sit on top of the page content */
          display: none;
          width: 100%; /* Full width (cover the whole page) */
          height: 100%; /* Full height (cover the whole page) */
          top: 0; 
          left: 0;
          right: 0;
          bottom: 0;
          background-color: rgba(0,0,0,0.95); /* Black background with opacity */
          z-index: 999999; /* Specify a stack order in case you're using a different order for other elements */
        }
        #text{
          position: absolute;
          top: 50%;
          left: 50%;
          font-size: 20px;
          color: white;
          transform: translate(-50%,-50%);
          -ms-transform: translate(-50%,-50%);
        }

        @media (max-width: 1199.98px) { 
            #overlay {
                display: block;
            }
        }

        @media (min-width: 1200px) { 

        }
    </style>

</head>

<body>

<div id="overlay">
    <div id="text" class="text-justify">
        <p>Personalized dashboard is not accessible on small scale devices.</p>
        <p>Please login on desktop or laptop to continue.</p>
    </div>
</div>

    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="/">
                            <img src="images/icon/logo.png">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                     	<li>
                            <a href="create-post.php">
                                <i class="fas fa-chart-bar"></i>New Post</a>
                        </li>
                        <li>
                            <a href="comments.php">
                                <i class="fas fa-map-marker-alt"></i>Comments</a>
                        </li>
                  
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block" style="width: 250px";>
            <div class="logo">
                <a href="/">
                    <img src="images/icon/logo.png">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="create-post.php">
                                <i class="fas fa-chart-bar"></i>New Post</a>
                        </li>
                        <li class="active">
                            <a href="comments.php">
                                <i class="fas fa-map-marker-alt"></i>Comments</a>
                        </li>
                        <li style="position: absolute; bottom: 10px;">
                            <a href="/signin.php">
                                <i class="zmdi zmdi-power"></i>Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container" style="padding-left: 252px;">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop" style="left: 251px;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                        	<h3>Personalized Dashboard</h3>
                            <div class="header-button" style="margin-left: auto;">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?php echo $profile_pic; ?>">
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn"><?php echo $session_username; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a>
                                                        <img src="<?php echo $profile_pic; ?>">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="<?php echo $profile_pic; ?>"><?php echo $session_username; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $user_email; ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="/signin.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
        <!-- MAIN CONTENT-->
        <div class="main-content" style="background-color: white; padding-left: 20px">
            <div class="row">
                <div class="col-lg-12 text-center" style="padding-bottom: 30px;">
                    <h1 class="page-header">Comments</h1>
                    <p class="lead">Click on post title to view people's reviews</p>
                </div>
            </div>

            <div class="col-lg-12">
                <div id="accordion">

                <?php 
                $query = "SELECT * FROM posts WHERE posted_by = $session_user_id"; 
                $posts = mysqli_query($conn, $query);
                if(mysqli_num_rows($posts) > 0){
                while($row = mysqli_fetch_assoc($posts)){
                    $title = $row['title'];
                    $post_id = $row['id'];
                ?>

		        <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <div class="btn" data-toggle="collapse" data-target="#collapse<?php echo $post_id ?>" aria-expanded="true" aria-controls="collapseOne">
                          <?php echo $title ?>
                        </div>
                      </h5>
                    </div>
		    <div id="collapse<?php echo $post_id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <?php $query = "SELECT * FROM comments WHERE post_id = $post_id";
                            $comments = mysqli_query($conn, $query);
                            if(mysqli_num_rows($comments)>0){
                            while($comment = mysqli_fetch_assoc($comments)){
                                $comment_msg = $comment['comment'];
                                $comment_id = $comment['id'];
                        ?>
                        <div class="row" style="padding: 0 20px;">
                            <div>
                                <p style="margin-top: 10px;"><?php echo $comment_msg; ?></p>
                            </div>
                            <div style="margin-left: auto;">
                                <button class="btn btn-danger" onclick="window.location.href='comments.php?id=<?php echo $comment_id; ?>'">Delete Comment</button>
                            </div>
                        </div>
                        <hr>
                        <?php }} else { ?>
                        
                        <div class="alert alert-warning text-center" style="margin: 0;">
                            No Comments Yet.
                        </div>
                        
                        <?php } ?>
                      </div>
                    </div>
                </div>
		        
                <?php }} else { ?>

                <div class="alert alert-warning text-center">
                    <p class="lead">You have no posts yet.</p>
                </div>

                <?php } ?>

                </div>
	     </div>
        </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
