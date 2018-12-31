<?php

include "db.php";
$email = $_POST['email'];
$pass = $_POST['pass'];

$query = "UPDATE users SET password = '$pass' WHERE email = '$email'";
$update_pass = mysqli_query($conn, $query);

if($update_pass) echo 1;
else echo 0;

?>