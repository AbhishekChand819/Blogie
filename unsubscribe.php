<?php

$DELETE = $_GET['email'];
$data = file("./newsletter_subs.txt");
$out = array();

foreach($data as $line) {
 if(trim($line) != $DELETE) {
    $out[] = $line;
 }
}

$fp = fopen("./newsletter_subs.txt", "w+");
flock($fp, LOCK_EX);
foreach($out as $line) {
 fwrite($fp, $line);
}
flock($fp, LOCK_UN);
fclose($fp); 

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="http://pngimg.com/uploads/letter_b/letter_b_PNG13.png" sizes="16x16" type="image/png">
    <title>Blogie: Unsubscribe Newsletter</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <style>
        /* Links */
        a, a:focus, a:hover {
        color: #fff;
        }

        /* Custom default button */
        .btn-secondary, .btn-secondary:hover, .btn-secondary:focus {
        color: #333;
        text-shadow: none; /* Prevent inheritance from `body` */
        background-color: #fff;
        border: .05rem solid #fff;
        }

        html, body {
        height: 100%;
        background: url(https://images.pexels.com/photos/355770/pexels-photo-355770.jpeg?cs=srgb&dl=adventure-alpine-background-355770.jpg&fm=jpg) no-repeat center center;
        }

        body {
        display: -ms-flexbox;
        display: flex;
        color: #fff;
        text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .cover-container {
        max-width: 50em;
        background-color: rgba(0,0,0,.8);
        }

        .masthead {
        margin-bottom: 2rem;
        }

        .masthead-brand {
        margin-bottom: 0;
        }

        .nav-masthead .nav-link {
        padding: .25rem 0;
        font-weight: 700;
        color: rgba(255, 255, 255, .5);
        background-color: transparent;
        border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover, .nav-masthead .nav-link:focus {
        border-bottom-color: rgba(255, 255, 255, .25);
        }

        .nav-masthead .nav-link + .nav-link {
        margin-left: 1rem;
        }

        .nav-masthead .active {
        color: #fff;
        border-bottom-color: #fff;
        }

        @media (min-width: 48em) {
        .masthead-brand {
            float: left;
        }
        .nav-masthead {
            float: right;
        }
        }

        .cover {
        padding: 0 1.5rem;
        }
        .cover .btn-lg {
        padding: .75rem 1.25rem;
        font-weight: 700;
        }

        .mastfoot {
        color: rgba(255, 255, 255, .5);
        }
    </style>
  </head>

  <body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Blogie</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="/">Home</a>
            <a class="nav-link" href="/about.php">About</a>
            <a class="nav-link" href="/contact.php">Contact</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Are You Leaving Us?</h1>
        <p class="lead">We are sorry to hear that you no longer wish to receive emails from Blogie. Please note that you may receive some mails for a short time till our system updates your request.</p>
        <p class="lead">You have successfully unsubscribed from our daily newsletter.</p>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Copyright ©2018 All rights reserved, by <a href='/'>Blogie</a>.</p>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
