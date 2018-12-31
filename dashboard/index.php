<?php session_start();
include "../db.php";
if(!isset($_SESSION['id'])){
    echo "<script>window.location.href='/';</script>";
}
if(isset($_GET['d_id'])){
    $d_p_id = $_GET['d_id'];
    $sql = "DELETE FROM posts WHERE id=$d_p_id";
    $d_post = mysqli_query($conn, $sql);
    echo "<script>window.location.href='index.php';</script>";
} 
$session_user_id = $_SESSION['id'];
$session_username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE id = $session_user_id";
$user_details = mysqli_fetch_assoc(mysqli_query($conn, $query));

$profile_pic = $user_details['profile_img'];
$user_email = $user_details['email'];
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
    <title>Blogie: Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

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
        .pager{
            margin-top: 30px;
            text-align: center;
        }
        .page-number{
            margin: 0px 5px;
            cursor: pointer;
            padding: 10px 16px;
            background-color: lightgrey;
            border-radius: 5px;
        }
        .table-responsive{
            height: 100%;
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

<body class="animsition">

<div id="overlay">
    <div id="text" class="text-justify">
        <p>Personalized dashboard is not accessible on small scale devices.</p>
        <p>Please login on desktop or laptop to continue.</p>
    </div>
</div>

<div id="d_p_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-body">
        Do You Want To Delete This Post ??<br/>
        You will not be able to revert this action!
        </div>
        <input type="text" id="d_p_id" hidden>
        <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Plz Cancel!</button>
        <button class="btn btn-danger" onclick="confirm_post_delete();">Yes, Delete</button> 
        </div>
    </div>
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
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
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
                <nav class="navbar-sidebar" style="height: 100%;">
                    <ul class="list-unstyled navbar__list" style="height: 100%;">
                        <li class="active">
                            <a href="index.php" class="js-arrow">
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
        <div class="page-container">
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
            <div class="main-content">
                <div class="section__content section__content--p30" style="padding-left: 0px;">
                    <div class="container-fluid">
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner" style="height: 100px;">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-thumb-up"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php  
                                                        $likes = 0;
                                                        $query = "SELECT * FROM posts WHERE posted_by = $session_user_id"; 
                                                        $posts = mysqli_query($conn, $query);
                                                        while($row = mysqli_fetch_assoc($posts)){
                                                            $post_likes = $row['likes'];
                                                            $likes += $post_likes;
                                                        }
                                                        echo $likes;
                                                    ?>
                                                </h2>
                                                <span>Likes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner" style="height: 100px;">
                                        <div class="overview-box clearfix" >
                                            <div class="icon">
                                                <i class="zmdi zmdi-comment-text"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php  
                                                        $comment_count = 0;
                                                        $query = "SELECT * FROM posts WHERE posted_by = $session_user_id"; 
                                                        $posts = mysqli_query($conn, $query);
                                                        while($row = mysqli_fetch_assoc($posts)){
                                                            $post_id = $row['id'];
                                                            $query = "SELECT * FROM comments WHERE post_id = $post_id";
                                                            $comments = mysqli_query($conn, $query);
                                                            $comment_count += mysqli_num_rows($comments);
                                                        }
                                                        echo $comment_count;
                                                    ?>
                                                </h2>
                                                <span>Comments</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3" >
                                    <div class="overview__inner" style="height: 100px;">
                                        <div class="overview-box clearfix" >
                                            <div class="icon">
                                                <i class="zmdi zmdi-view-carousel"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php  
                                                        $views = 0;
                                                        $query = "SELECT * FROM posts WHERE posted_by = $session_user_id"; 
                                                        $posts = mysqli_query($conn, $query);
                                                        while($row = mysqli_fetch_assoc($posts)){
                                                            $views += $row['views'];
                                                        }
                                                        echo $views;
                                                    ?>
                                                </h2>
                                                <span>Total Views</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner" style="height: 100px;">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-collection-text"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                        $query = "SELECT * FROM posts WHERE posted_by = $session_user_id"; 
                                                        $posts = mysqli_query($conn, $query);
                                                        $post_count = mysqli_num_rows($posts);
                                                        echo $post_count;
                                                    ?>
                                                </h2>
                                                <span>Total Posts</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row m-t-10" style="width: 100%;">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <?php if($post_count > 0){ ?> 
                                <div class="table-responsive m-b-20" style="background-color: white; border-radius: 8px; width: 100%;">
                                    <table class="table table-data3">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date</th>
                                                <th style="text-align: center;">Title</th>
                                                <th style="text-align: center;">Status</th>
                                                <th>Likes</th>
                                                <th>Comments</th>
                                                <th>Views</th>
                                                <th style="text-align: center;">Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-muted">
                                        <?php
                                            $count = 0;
                                            while($row = mysqli_fetch_assoc($posts)){
                                                $title = $row['title'];
                                                $post_id = $row['id'];
                                                $date = $row['date'];
                                                $likes = $row['likes'];
                                                $views = $row['views'];
                                                $status = $row['status'];
                                                $query = "SELECT * FROM comments WHERE post_id = $post_id";
                                                $post_comments = mysqli_query($conn, $query);
                                                $comment_count = mysqli_num_rows($post_comments);
                                                $count = $count + 1;
                                            
                                        ?>
                                <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $title; ?></td>
                                <td style="text-align: center;"><button class="btn <?php if($status == 'Pending') echo 'btn-warning'; else if($status == 'Approved') echo 'btn-success'; else echo 'btn-danger'; ?>"><?php echo $status; ?></button></td>
                                <td style="text-align: center;"><?php echo $likes; ?></td>
                                <td style="text-align: center;"><?php echo $comment_count; ?></td>
                                <td style="text-align: center;"><?php echo $views; ?></td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-info" onclick="window.location.href='../blog-post.php?id=<?php echo base64_encode($post_id); ?>'" <?php if($status != 'Approved') echo 'disabled'; ?>>View</button>
                                    <button class="btn btn-warning" onclick="window.location.href='update-post.php?id=<?php echo base64_encode($post_id); ?>'">Edit</button>
                                    <button class="btn btn-danger" onclick="delete_post(<?php echo $post_id; ?>);">Delete</button>
                                    </div>
                                </td>
                                </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } else { ?>

                                    <div class="alert alert-warning text-center">
                                        You currently don't have any posts.
                                    </div>

                                <?php } ?>
                                <!-- END DATA TABLE-->
                            </div>

                        <div class="row" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="copyright text-center">
                                    <p>Copyright © <strong>Blogie</strong>. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
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
    <script>
        $('table.table-data3').each(function() {
            var currentPage = 0;
            var numPerPage = 5;
            var $table = $(this);
            $table.bind('repaginate', function() {
                $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
            });
            $table.trigger('repaginate');
            var numRows = $table.find('tbody tr').length;
            var numPages = Math.ceil(numRows / numPerPage);
            var $pager = $('<div class="pager"></div>');
            for (var page = 0; page < numPages; page++) {
                $('<span class="page-number"></span>').text(page + 1).bind('click', {
                    newPage: page
                }, function(event) {
                    currentPage = event.data['newPage'];
                    $table.trigger('repaginate');
                    $(this).addClass('active').siblings().removeClass('active');
                }).appendTo($pager).addClass('clickable');
            }
            $pager.insertAfter($table).find('span.page-number:first').addClass('active');
        });

        function delete_post(id){
            $("#d_p_id").val(id);
            $("#d_p_modal").modal('show');
        }

        function confirm_post_delete(){
            var d_p_id = $("#d_p_id").val();
            window.location.href='index.php?d_id='+d_p_id;
        }
    </script>

</body>

</html>
<!-- end document-->
