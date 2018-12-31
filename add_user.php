<?php 
  include "db.php";

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/vendor/autoload.php';

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $token='qwertyuiplkgdsdagzcbxmmv1234567890AYHDWKZBNMCONX&*@!';
  $token= str_shuffle($token);
  $token= substr($token,0,5);

  $query = "SELECT * FROM users WHERE email = '$email'";
  $checkUser = mysqli_query($conn, $query);
  if(mysqli_num_rows($checkUser) > 0){
    echo 'user exists';
  } else {
    $query = "INSERT INTO users(email, username, password, isEmailConfirmed, token) VALUES('$email', '$username', '$password', '0', '$token')";
    $add_user_query = mysqli_query($conn, $query);
    $user_id = mysqli_insert_id($conn);  

    if(!$add_user_query){
      echo 0;
    } else {
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
        $mail->addAddress($email,$username);
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Blogie E-mail Address Verification';
            
        $mail_body_message = "
          <html>
          <head>
            <style>
              /* Base ------------------------------ */
              *:not(br):not(tr):not(html) {
                font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
              }
              body {
                width: 100% !important;
                height: 100%;
                margin: 0;
                line-height: 1.4;
                -webkit-text-size-adjust: none;
              }
              a {
                color: #414EF9;
              }
              /* Layout ------------------------------ */
              .email-wrapper {
                width: 100%;
                margin: 0;
                padding: 30px;
                background-color: #FFFFFF;
              }
              .email-content {
                width: 100%;
                margin: 0;
                padding: 0;
              }
              /* Masthead ----------------------- */
              .email-masthead {
                text-align: center;
                padding: 30px 0px;
                background-color: #d93025;
              }
              .email-masthead_name {
                font-size: 20px;
                color: #FFFFFF;
                text-decoration: none;
                text-shadow: 0 1px 0 black;
              }
              /* Body ------------------------------ */
              .email-body {
                width: 100%;
                margin: 0;
                padding: 0;
                background-color: #FFFFFF;
              }
              .email-body_inner {
                width: 570px;
                margin: 0 auto;
                padding: 0; 
                border-left: 10px solid #d93025;
                border-right: 10px solid #d93025;
              }
              .body-action {
                width: 100%;
                margin: 30px auto;
                padding: 0;
                text-align: center;
              }
              .body-sub {
                margin-top: 25px;
                padding-top: 25px;
                border-top: 1px solid #E7EAEC;
              }
              .content-cell {
                padding: 35px;
              }
              .align-right {
                text-align: right;
              }
              /* Type ------------------------------ */
              h1 {
                margin-top: 0;
                color: #292E31;
                font-size: 19px;
                font-weight: bold;
                text-align: left;
              }
              h2 {
                margin-top: 0;
                color: #292E31;
                font-size: 16px;
                font-weight: bold;
                text-align: left;
              }
              h3 {
                margin-top: 0;
                color: #292E31;
                font-size: 14px;
                font-weight: bold;
                text-align: left;
              }
              p {
                margin-top: 0;
                font-size: 16px;
                line-height: 1.5em;
              }
              p.sub {
                font-size: 12px;
                color: #A9A9A9;
                text-align: center;
              }
              /* Buttons ------------------------------ */
              .button {
                display: inline-block;
                width: 200px;
                background-color: #111111;
                border-radius: 3px;
                color: #ffffff;
                font-size: 15px;
                line-height: 45px;
                text-align: center;
                text-decoration: none;
                -webkit-text-size-adjust: none;
                mso-hide: all;
              }
              .button--green {
                background-color: #d93025;
              }
              .greeting-div{
                text-align: center;
                padding-top: 20px;
              }
            </style>
          </head>
          <body>
            <table class='email-wrapper' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td align='center'>
                  <table class='email-content' width='100%' cellpadding='0' cellspacing='0'>
                    <!-- Email Body -->
                    <tr>
                      <td class='email-body' width='100%'>
                        <table class='email-body_inner' align='center' cellpadding='0' cellspacing='0'>
                          <!-- Body content -->
                          <tr>
                          <td class='email-masthead'>
                            <a class='email-masthead_name'>Blogie Account Activation</a>
                          </td>
                        </tr>
                          <tr>
                            <td class='content-cell'>
                              <div class='greeting-div'>
                                <p>Hi $username!</p>
                                <p>You have successfully created a Blogie Account.
                                Please verify your email address and complete your registeration.</p>
                              </div>
                              <!-- Action -->
                              <table class='body-action' align='center' width='100%' cellpadding='0' cellspacing='0'>
                                <tr>
                                  <td align='center'>
                                    <div>
                                      <a class='button button--green'>Verification Code: $token</a>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <!-- Sub copy -->
                              <table class='body-sub'>
                                <tr>
                                  <td>
                                    <p class='sub'>
                                      Didn't create a Blogie account? It's likely someone just typed in your email address by accident. Feel free to ignore this email.
                                    </p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                          <td style='padding: 15px 0px; background-color: #d93025;'></td>
                        </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </body>
          </html>";
          
        $mail->Body = $mail_body_message;
        $mail->send();
        echo 1;
      }
      catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
  }
}

?>