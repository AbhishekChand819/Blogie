<?php
    $conn = mysqli_connect('sql200.epizy.com','epiz_23056287','UbqPhozmZmqqxW','epiz_23056287_id7540799_blog');
    mysqli_set_charset($conn,"utf8");
    if(!$conn){
        echo "Database Connection Failed.";
    }
    date_default_timezone_set("Asia/Kolkata");
?>