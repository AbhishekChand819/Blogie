<?php
session_start();
include "db.php";
$comment = $_POST['comment'];
$post_id = $_POST['post_id'];
$author = $_SESSION['id'];

$query = "INSERT INTO comments(post_id, author, comment) VALUES('$post_id', '$author', '$comment')";
$add_comment_query = mysqli_query($conn, $query);

if(!$add_comment_query) echo mysqli_error($conn); 
else echo 1;
?>