<?php
session_start(); 
require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';
include "db_conn.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Password Recovery using PHP and MySQL</title>
        <!-- css -->
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    </head>
    <body style="background-image:url('https://wimg.ruan8.com/uploadimg/image/20190402/20190402163328_31815.jpg')">
        <div class="body">
                <?php
                    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
                        $email = $_POST["email"];
                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                        if (!$email) {
                            $error .="Invalid email address";
                        } else {
                            $sel_query = "SELECT * FROM `users` WHERE email='" . $email . "'";
                            $results = mysqli_query($conn, $sel_query);
                            $row = mysqli_num_rows($results);
                            $data = mysqli_fetch_assoc($results);
                            $id = $data['id'];
                            if ($row == "") {
                                $error .= "User Not Found";
                            }
                        }
                        if ($error != "") {
                            echo $error;
                        } else {

                            $output = '';

                            $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                            $expDate = date("Y-m-d H:i:s", $expFormat);
                            $key = md5(time());
                            $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                            $key = $key . $addKey;
                            
                            
                            $sql = "UPDATE users SET forgetKey='".$key."' WHERE id=$id";
                            mysqli_query($conn,$sql);


                            $output.='<p>Please click on the following link to reset your password.</p>';
                            //replace the site url
                            $output.='<p><a href="http://134.208.3.125/purePHP/Login/reset-password.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">http://134.208.3.125/purePHP/Login/reset-password.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
                            $body = $output;
                            $subject = "Password Recovery";

                            $email_to = $email;


                            //autoload the PHPMailer
                            //require("vendor/autoload.php");
                            $mail = new PHPMailer();
                            $mail->SMTPDebug = 0;
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com'; // Enter your host here
                            $mail->SMTPAuth = true;
                            $mail->Username = '410621212@gms.ndhu.edu.tw'; // Enter your email here
                            $mail->Password = "A230425876"; //Enter your passwrod here
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;
                            $mail->IsHTML(true);
                            // $mail->From = 'smtp.gmail.com';
                            // $mail->FromName = "WALL's BLOG";
                            $mail->setFrom('410621212@gms.ndhu.edu.tw', 'WALL\'sBLOG');
                            $mail->Subject = $subject;
                            $mail->Body = $body;
                            $mail->AddAddress($email_to);
                            if (!$mail->Send()) {
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            } else {
                                echo "An email has been sent";
                            }
                        }
                    }
                ?>
                <form method="post" action="" name="reset">
                    <i class="fas fa-key"></i>
                    <h2>Forgot Password</h2>   
                    <p><strong style="color: red;"> Please check your email letter.</strong></p>
                    <label>Enter Email Address:</label>
                    <input type="email" name="email" placeholder="username@email.com" class="form-control"/>
                    <input type="submit" id="reset" value="Reset Password"  class="btn btn-submit"/>
                    <p>If you have done the verification before, please entry our email address. </p>
                    <p>We will help you find back your account.</p>
                    <p>But if you never verify yout email, I'm so sorry to tell you that please create a new account. </p>
                </form>
        </div>
    </body>
</html>