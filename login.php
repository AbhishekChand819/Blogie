<?php session_destroy(); session_start();

include "db.php"; 
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email'";
$select_user_query = mysqli_query($conn, $query);
$rowcount = mysqli_num_rows($select_user_query);

if($rowcount == 0){
  echo 0;
} else {
  $row = mysqli_fetch_assoc($select_user_query);
  if($row['password'] == $password){
    if($row['isBlocked'] == '1'){
      echo 'blocked';
    } else {
      $_SESSION['id'] = $row['id'];
      $_SESSION['email'] = $email;
      $_SESSION['username'] = $row['username'];
      if($email == "admin@mail.com"){
        echo 'admin';
      } else {
        echo 'login';
      }
    }   
  } else {
    echo 'failed';
  }
}

?>