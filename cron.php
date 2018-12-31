<?php
include "db.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/vendor/autoload.php';

$handle = fopen("newsletter_subs.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $email = $line;
        $query = "SELECT * FROM posts WHERE status = 'Approved' ORDER BY date LIMIT 5";
        $latest_posts = mysqli_query($conn, $query);

        $mail = new PHPMailer(true);  
        try {
            //Server settings   
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'blogieverify@gmail.com';           // SMTP firstname
            $mail->Password = 'blogie2112';                       // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;  
            
            // Passing `true` enables exceptions
            $mail->setFrom('blogieverify@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Blogie Newsletter';
                
            $mail_body_message = '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>

    <style type="text/css">

        * { font-family: "Avenir Next", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; overflow-x: hidden; }

        body, .body-wrap { width: 100% !important; background: #f8f8f8; }

        .container { margin: 0 auto; display: block !important; clear: both !important; max-width: 650px !important; }

        .container table { width: 100% !important; }

        .container .masthead { padding: 50px 0; background: #71bc37; color: white; }

        .container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }
        
        .container .masthead h3 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }

        .container .content { background: white; padding: 30px 35px; }

        .container .content.footer { background: none; }

        .container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }

        .container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }

        .container .content.footer a:hover { text-decoration: underline; }

        .col-4{
        	width: 30%;
        	float: left;
        }

        p{
            font-size: 16px;
        }

        .col-8{
        	width: 65%;
        	float: right;
        }

        .col-8 h3{
        	margin: 0px;
        }

        .col-8 button{
            width: 100px;
            background-color: #428bca;
            border-radius: 5px;
            font-size: 15px;
            line-height: 35px;
            text-align: center;
            border: 0px;
            margin-top: 20px;
        }

        .col-8 button a, .button a{
            color: #fff;
            text-decoration: none;
        }

        .clear{
        	clear: both;
        }

        .row{
        	margin: 15px 0px;
        }

        .button {
            width: 200px;
            background-color: #5cb85c;
            border-radius: 5px;
            color: #ffffff;
            font-size: 15px;
            line-height: 40px;
            text-align: center;
            border: 0px;
        }

    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">
            <table>
                <tr>
                    <td align="center" class="masthead">
                        <h1>Blogie</h1>
                        <h3>Directory of Wonderful Things</h3>
                    </td>
                </tr>
                <tr>
                    <td class="content">
                        <h2>Hi there,</h2>
                        <p>Here is your daily dose of latest blog posts, a list of trending posts on the website today.</p>

                        <div class="col-12">
';

while($post = mysqli_fetch_assoc($latest_posts)){
    $thumb_url = $post['thumb_url'];
    $title = $post['title'];
    if(strlen($title) > 60){
        $title = substr($title, 0, 60)." ...";
    }
    $p_id = $post['id'];
    $mail_body_message .= '
        <div class="row">
            <div class="col-4">
                <img src="'.$thumb_url.'" width="100%" height="100px">
            </div>
            <div class="col-8">
                <h3>'.$title.'</h3>
                <button><a href="http://blogie.epizy.com/blog-post.php?id='.base64_encode($p_id).'">Read Now</a></button>
            </div>
        </div>
    ';
}

$mail_body_message .= '
                    </div>
                        <div style="text-align: center; margin: 30px 0px;">
                            <p>We have much more for you. Visit our website for daily updated posts.</p>
                            <button class="button"><a href="http://blogie.epizy.com/">Visit Blogie</a></button>
                        </div>
                    
                        <p><em>– Blogie Team</em></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="container">
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Sent by <a href="http://blogie.epizy.com/">Blogie</a></p>
                        <p>Want to opt out for newsletter? <a href="http://blogie.epizy.com/unsubscribe.php?email='.$email.'">Unsubscribe</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
';
            $mail->Body = $mail_body_message;
            $mail->send();
        }
        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    fclose($handle);
} else {
    // error opening the file.
} 

?>