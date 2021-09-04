<?php 
session_start(); 
require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';
include "db_conn.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {

    $email = $_POST['email'];
    if (empty($email)) {
		header("Location: home.php?error=Email is required");
	    exit();
	}
    else{
       
            $mail = new PHPMailer();
             //Enable verbose debug output
             $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
             //Send using SMTP
             $mail->isSMTP();
  
             //Set the SMTP server to send through
             $mail->Host = 'smtp.gmail.com';
  
             //Enable SMTP authentication
             $mail->SMTPAuth = true;
  
             //SMTP username
             $mail->Username = '410621212@gms.ndhu.edu.tw';
  
             //SMTP password
             $mail->Password = 'A230425876';
  
             //Enable TLS encryption;
             $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  
             //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
             $mail->Port = 587;
  
             //Recipients
             $mail->setFrom('410621212@gms.ndhu.edu.tw', 'WALL\'sBLOG');
  
             //Add a recipient
             $mail->addAddress($email, $name);
  
             //Set email format to HTML
             $mail->isHTML(true);
  
             $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
  
             $mail->Subject = 'Email verification';
             $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
  
             $mail->send();

  
            // //  $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
  
            //  // connect with database
    
            
            // //  // insert in users table

            $name = $_SESSION['user_name'];
            $id = $_SESSION['id'];
            $boolean = 1;
            // 
            $_SESSION['email'] = $email;
            $_SESSION['code'] = $verification_code;
            $_SESSION['id'] = $id;
            $sql ="UPDATE users SET code='".$verification_code."' ,email='" .$email."'  WHERE id=$id";
            mysqli_query($conn, $sql);
            header("Location: email-verification.php");

            exit();
        
  



    }

}