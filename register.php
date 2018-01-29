<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);                              

?>

<?php
		require "extensions/db.php";
	 	include "extensions/header.php";
		include 'extensions/nav.php';	
?>

<?php
session_start();



if(isset($_POST['sign-up'])){
	$first_name		= $_POST['first_name'];
	$last_name		= $_POST['last_name'];
	$email 			= $_POST['email'];
	$password 		= password_hash($_POST['password'],PASSWORD_BCRYPT);
	$hash 			= md5( rand(0,1000) );

	$result = $con->prepare("SELECT * FROM customer WHERE email=:email");
	$result->bindValue(':email',$email);
	$result->execute();
	$record = $result->fetchAll();
	
	if ( count($record) > 0 ) {
	    
		$_SESSION['message'] = 'User with this email already exists!';
		header("Location: error.php");
	    
	} else {

	$stmt = $con->prepare(" INSERT INTO customer(first_name, last_name, email, password, hash) VALUES (:first_name,:last_name,:email,:password, :hash)");
	$stmt->bindValue(':first_name',$first_name);
	$stmt->bindValue(':last_name',$last_name);
	$stmt->bindValue(':email',$email);
	$stmt->bindValue(':password',$password);
	$stmt->bindValue(':hash',$hash);
	    if ( $stmt->execute() ){
	    	$_SESSION['first_name'] = $first_name;
	    	$_SESSION['last_name'] = $last_name;
	    	$_SESSION['email'] = $email;
	    	$_SESSION['active'] = 0;
        	$_SESSION['logged_in'] = true;
        	$_SESSION['message'] =
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        	$to      = 		$email;
        	$subject = 		'Account Verification ( ONLINE SHOP )';
        	$message_body = '
        						Hello '.$first_name.',

        						Thank you for signing up!

						        Please click this link to activate your account:

 						        http://localhost/pos-master/verify.php?email='.$email.'&hash='.$hash;  


                               
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com'; 
			$mail->SMTPAuth = true;
			$mail->Username = 'markdontexpect@gmail.com';
			$mail->Password = 'Atienza112495';
    		$mail->SMTPSecure = 'tls';
    		$mail->Port = 587;

    		$mail->setFrom('maangeloatienza@gmail.com', 'ONLINE SHOP');
    		$mail->addAddress($to, $first_name); 
    		$mail->addReplyTo('maangeloatienza@gmail.com', 'ONLINE SHOP');
    		$mail->isHTML(true);
    		$mail->Subject = $subject;
    		$mail->Body    = $message_body;
    		$mail->send();


    		header("location: confirm.php"); 
	    }

	    else {
	    	header("Location: error.php");
	    }
	}
}

?>




<?php include "extensions/header.php"; ?>

	<div class="col-md-4">
		
	</div>

	<!--Sign up-->
	<div class="col-md-4 sign-up">

		
		<form method="POST" action="register.php" class="form-group">
			<h1 class="text-center">SIGN UP</h1>
			<div class="form-inline">
				<input type="text" name="first_name" class="form-control" placeholder="First name" required autocomplete="off">
				<input type="text" name="last_name" class="form-control" placeholder="Last name" required autocomplete="off">
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="Email@email.com" required autocomplete="off">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
			</div>
			<input type="submit" name="sign-up" value="Sign Up" class="btn btn-md form-control">
		</form>
	</div>

	<div class="col-md-4">
		
	</div>


	</div>

</div>

<?php include "extensions/footer.php" ?>
