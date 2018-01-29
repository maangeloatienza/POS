<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);                              
?>


<?php 

require 'extensions/db.php';
session_start();


if ( $_SERVER['REQUEST_METHOD'] == 'POST' ): 
    $result = $con->prepare("SELECT * FROM customer WHERE email=:email");
    $result->bindValue(":email",$_POST['email']);
    $result->execute();
    $records = $result->fetch(PDO::FETCH_ASSOC);
    if ( count($result) >0 ) {  
        
        $email = $records['email'];
        $hash = $records['hash'];
        $first_name = $records['first_name'];

      
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
         . " for a confirmation link to complete your password reset!</p>";

       
        $to      = $email;
        $subject = 'Password Reset Link ( maangeloatienza@gmail.com )';
        $message_body = '
         Hello '.$first_name.',

        You have requested password reset!

        Please click this link to reset your password:

        http://localhost/POS-master/reset.php?email='.$email.'&hash='.$hash;

    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'markdontexpect@gmail.com'; 
    $mail->Password = 'Atienza112495'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('markdontexpect@gmail.com', 'ONLINE SHOP');
    $mail->addAddress($to, $first_name); 
    $mail->addReplyTo('markdontexpect@gmail.com', 'ONLINE SHOP');
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message_body;
    $mail->send();
    header("location: success.php");
  }else {
    $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: error.php");
  }
endif;
?>

<?php
    include "extensions/header.php";
    include "extensions/nav.php";
?>    
  <div class="forgot text-center">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label class="col-lg-4">
        Email Address<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email" style="color: black;" class="col-lg-7" />
    </div>
    <button class="btn btn-danger btn-md frgt_btn"/>Reset</button>
    </form>
  </div>

<?php include "extensions/footer.php" ?>
