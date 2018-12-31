<?php

include "db.php";
$post_id = base64_decode($_POST['id']);
$query = "SELECT * FROM posts WHERE id = $post_id";
$post_details = mysqli_fetch_assoc(mysqli_query($conn, $query));

$likes = $post_details['likes'];
$new_likes = $likes + 1;

$query = "UPDATE posts SET likes = '$new_likes' WHERE id = $post_id";
$update_likes = mysqli_query($conn, $query);

?>