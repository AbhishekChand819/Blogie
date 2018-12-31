<?php 

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer/vendor/autoload.php';

  $email = $_POST['email'];
  $msg = $_POST['msg'];
  $sub = $_POST['sub'];

  $mail = new PHPMailer(true);  

  try {

    //Server settings   

    $mail->SMTPDebug = 0;                                 // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP

    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

    $mail->SMTPAuth = true;                               // Enable SMTP authentication

    $mail->Username = 'blogieverify@gmail.com';                 // SMTP firstname

    $mail->Password = 'blogie2112';                           // SMTP password

    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

    $mail->Port = 587;  

  

    // Passing `true` enables exceptions

    $mail->setFrom('blogieverify@gmail.com');

    $mail->addAddress($email);

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $sub;

    $mail->Body = $msg;

    $mail->send();

    echo 1;
  
  }

catch (Exception $e) {

  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

}

?>