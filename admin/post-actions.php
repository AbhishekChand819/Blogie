<?php session_start();
    include "../db.php";

    if($_POST['action'] == 'update_post'){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $id = $_POST['id'];
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $tags = $_POST['tags'];
        $category = $_POST['category'];
        $thumb_url = $_POST['thumb_url'];

        $query = "UPDATE posts SET title = '{$title}', content = '{$content}', tags = '{$tags}', category = '{$category}', thumb_url = '{$thumb_url}' WHERE id  = {$id}";
        $edit_post = mysqli_query($conn, $query);
        if(!$edit_post) echo mysqli_error($conn);
        else echo 1;
    }
?>