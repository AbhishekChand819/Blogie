<?php session_start();
include "../db.php";
if(!isset($_SESSION['id']) && $_SESSION['email'] != 'admin@mail.com'){
    echo "<script>window.location.href='/';</script>";
} 
if(isset($_GET['remove'])){
    $query_id = $_GET['remove'];
    $query = "DELETE FROM contact_us WHERE id = $query_id";
    $delete_query = mysqli_query($conn, $query);
    echo "<script>window.location.href='contacts.php';</script>";
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
    <title>Dashboard: Queries Listing</title>

    <!-- Fontfaces CSS-->
    <link href="../dashboard/css/font-face.css" rel="stylesheet" media="all">
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
    <link href="../dashboard/css/theme.css" rel="stylesheet" media="all">
    <style>
        .pagination{
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
        }
        .paglink{
            margin: 0px 5px;
            cursor: pointer;
            padding: 10px 16px;
            background-color: lightgrey;
            border-radius: 5px;
            color: black;
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
<div id="ans_query_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reply To Query</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" rows="5" placeholder="Answer the query here ..." id="mail_body"></textarea>
        <input type="text" id="receiver_mail" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="send_mail();">Submit Reply</button>
        <button type="button" class="btn btn-default" onclick="location.reload();">Close</button>
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
                        <li class="active">
                            <a href="contacts.php">
                                <i class="fas fa-question"></i>Queries Listing</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container" style="background-color: #f5f5f5;">
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
            <div class="main-content">
                <div class="section__content section__content--p30" style="padding-left: 0px;">
                    <div class="container-fluid">
                        <div class="row" style="margin-bottom: 40px;">
                            <div class="col-md-12">
                                <h2 class="text-center">Administration Dashboard : Queries Listing</h2>
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 40px;">
                            <div class="table-responsive" style="background-color: #fff;">
                              <table class="table table-hover">
                                <thead class="thead-dark">
                                  <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM contact_us";
                                        $queries = mysqli_query($conn, $query);
                                        while($row = mysqli_fetch_assoc($queries)){
                                            $count = $count + 1;
                                            $email = $row['email'];
                                            $sub = $row['subject'];
                                            $msg = $row['message'];
                                            $id = $row['id'];
                                    ?>
                                  <tr>
                                    <td class="text-center"><?php echo $count; ?></td>
                                    <td class="text-center"><?php echo $email; ?></td>
                                    <td class="text-center"><?php echo $sub; ?></td>
                                    <td class="text-center"><?php echo $msg; ?></td>
                                    <td class="text-center">
                                        <button onclick="answer_query('<?php echo $email; ?>');" class="btn btn-primary">Answer Query</button>
                                        <button onclick="remove_query('<?php echo $id; ?>');" class="btn btn-danger">Remove Query</button>
                                    </td>
                                  </tr>
                                    <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="vendor/animsition/animsition.min.js"></script>
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
    <script>
        function remove_query(id){
            window.location.href='contacts.php?remove='+id;
        }
        function answer_query(email){
            $("#receiver_mail").val(email);
            $("#ans_query_modal").modal('show');
        }
        function send_mail(){
            $("#ans_query_modal").modal('hide');
            var email = $("#receiver_mail").val();
            var msg = $("#mail_body").val();
            var subject = "Reply to your query on Blogie";
            if(email != '' && msg != ''){
                $.ajax({
                    url: "../send_mail.php",
                    type: "POST",
                    data: { email: email, msg: msg, sub: subject },
                    success: function(res){
                        if(res == 1){
                            alert('Mail Sent');
                        } else {
                            alert('Oops! please try again!');
                        }
                    }
                });
            } else {
                alert('Invalid Submit.');
            }
        }
    </script>

</body>

</html>
<!-- end document-->
