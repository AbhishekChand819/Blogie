<?php
	include "db.php";
	$email = $_POST['email'];
	$token = $_POST['token'];

	$query = "SELECT * FROM users WHERE email='$email'";
    $select_user_query = mysqli_query($conn,$query);
    
	if (mysqli_num_rows($select_user_query) > 0) {
		$prev_token = mysqli_fetch_assoc($select_user_query)['token'];
		if($prev_token == $token){
			$query = "UPDATE users SET isEmailConfirmed='1', token='***' WHERE email = '$email'";
		    $update_user_query = mysqli_query($conn,$query);
		    echo 2;
		} else {
			echo 1;
		}
	} else {
		echo 0;
    }
?>