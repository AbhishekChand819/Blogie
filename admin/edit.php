<?php session_start();
include "../db.php";
if(!isset($_SESSION['id']) && $_SESSION['email'] != 'admin@mail.com'){
    echo "<script>window.location.href='/';</script>";
}
$query = "SELECT * FROM users WHERE id = $session_user_id";
$user_details = mysqli_fetch_assoc(mysqli_query($conn, $query));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <link rel="icon" href="http://pngimg.com/uploads/letter_b/letter_b_PNG13.png" sizes="16x16" type="image/png">
    <title>Dashboard: Edit Post</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Fontfaces CSS-->
    <link href="../dashboard/css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">


    <!-- Vendor CSS-->
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../dashboard/css/theme.css" rel="stylesheet" media="all">

    <style>
        .header-desktop, .account-dropdown{
            z-index: 99;
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
    </style>

</head>

<body>

<div id="overlay">
    <div id="text" class="text-justify">
        <p>Personalized dashboard is not accessible on small scale devices.</p>
        <p>Please login on desktop or laptop to continue.</p>
    </div>
</div>

    <!-- Modal -->
        <div class="modal fade" id="post_update_msg" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Post Updation Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Post has been successfully updated to the system.<br>
                Post changes are applied successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='posts.php';">Okay!</button>
            </div>
            </div>
        </div>
        </div>
    <!-- /Modal -->

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
                            <a class="js-arrow" href="/admin">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="posts.php">
                                <i class="zmdi zmdi-calendar-note"></i>Posts Listing</a>
                        </li>
                        <li>
                            <a href="users.php">
                                <i class="zmdi zmdi-account"></i>Users Listing</a>
                        </li>
                        <li>
                            <a href="categories.php">
                                <i class="zmdi zmdi-view-list-alt"></i>Category Listing</a>
                        </li>
                        <li>
                            <a href="contacts.php">
                                <i class="fas fa-question"></i>Queries Listing</a>
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
                        <li class="has-sub">
                            <a href ="index.php" class="js-arrow">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="posts.php">
                                <i class="zmdi zmdi-calendar-note"></i>Posts Listing</a>
                        </li>
                        <li>
                            <a href="users.php">
                                <i class="zmdi zmdi-account"></i>Users Listing</a>
                        </li>
                        <li>
                            <a href="categories.php">
                                <i class="zmdi zmdi-view-list-alt"></i>Category Listing</a>
                        </li>
                        <li>
                            <a href="contacts.php">
                                <i class="fas fa-question"></i>Queries Listing</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container" style="background-color: #f5f5f5; padding-left: 255px;">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop" style="left: 251px;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button" style="margin-left: auto;">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="https://www.ed.youth4work.com/Images/Users/User-default-image-boy.png">
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn">Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a>
                                                        <img src="https://www.ed.youth4work.com/Images/Users/User-default-image-boy.png">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="https://www.ed.youth4work.com/Images/Users/User-default-image-boy.png">Admin</a>
                                                    </h5>
                                                    <span class="email">blogieverify@gmail.com</span>
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
        <div class="col-lg-12">
            <h1 class="page-header text-center" style="padding-bottom: 30px;">Update Post</h1>
        </div>
    </div>

    <?php
   
    if(isset($_GET['id'])){    
      $post_id = base64_decode($_GET['id']);
    }

    $query = "SELECT * FROM posts WHERE id = $post_id";
    $row = mysqli_fetch_assoc(mysqli_query($conn,$query));
      
    $p_id = $row['id'];
    $p_thumb_url = $row['thumb_url'];
    $p_tags = $row['tags'];
    $p_content = $row['content'];
    $p_category = $row['category'];
    $p_title = addslashes($row['title']);

    ?>

            <div class="row">
                    <div class="col-md-5">
                        <!--/.row-->
                        <div class="row" style="margin-bottom: 30px">
                            <div class="col-lg-12">
                                <input type="text" id="post_id" value="<?php echo $p_id; ?>" hidden>
                                <input type="text" id="post_title" class="form-control" name="title">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 30px">
                            <div class="col-lg-12">
                                <input type="text" id="post_thumb" value="<?php echo $p_thumb_url; ?>" class="form-control" name="thumb_url">
                            </div>
                        </div>
                        
                        <div  class="row" >
                            <div class="col-lg-12">
                            <select class="form-control" id="post_category" name="category">
                                <?php $query = "SELECT * FROM category";
                                    $get_categories = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_assoc($get_categories)){
                                        $category = $row['category'];
                                        $id = $row['id'];
                                ?>
                                <option value="<?php echo $id; ?>" <?php if($id == $p_category) echo "selected"; ?>><?php echo $category; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 30px;" >
                            <div class="col-lg-12">
                            <input type="text" id="post_tags" value="<?php echo $p_tags; ?>" class="form-control" name="tags">
                        </div>
                    </div>

                     
                    <div class="text-right" style="margin-top: 100px;">
                            <button type="button" id="update_post_btn" name="update_post" class="btn btn-lg btn-block btn-primary" style="padding: 10px 50px; float: left;" >Update Post</button>
                        </div>
                    </div>



                    <div class="col-md-7" style="padding-right: 30px;">
                        <div>
                            <textarea id="editor"><?php echo $p_content; ?></textarea>
                        </div>
                    </div>

                </div>                
        </div>
    </div>

    <script> 
    var editor = new Jodit('#editor', {
        height: 500, "buttons": "bold,italic,underline,strikethrough,|,ul,ol,|,outdent,indent,|,font,fontsize,brush,paragraph,|,image,video,table,link,|,align,undo,redo,hr,eraser" 
    });
    
    </script>

      <script>
        $("#post_title").val('<?php echo $p_title; ?>');

        $("#update_post_btn").click(function(){
            var title = $("#post_title").val();
            var id = $("#post_id").val();
            var content = $("#editor").val();
            var category = $("#post_category").val();
            var thumb_url = $("#post_thumb").val();
            var tags = $("#post_tags").val();
            if(title != '' && content != '' && tags !='' && thumb_url != ''){
                $.ajax({
                    type: 'post',
                    url: 'post-actions.php',
                    data: { action: 'update_post', id: id ,title: title, category: category, content: content, tags: tags, thumb_url: thumb_url },
                    success: function(response){
                        if(response == 1){
                            $("#post_update_msg").modal('show');
			                setTimeout(function() {
         			            window.location.href='posts.php';
      			            }, 5000);
                        } else {
                            alert(response);
                        }
                    }
                });
            } else {
                alert('Fields Cannot Be Empty.');
            }
        });
    </script>

        

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
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
    <script src="../dashboard/js/main.js"></script>

</body>

</html>
<!-- end document-->
