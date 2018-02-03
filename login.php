<?php
session_start();

require "extensions/db.php";

?>

<?php 	include "extensions/header.php";
		include 'extensions/nav.php';	
?>

<?php
$message = '';
if(isset($_POST['password'])):

	

	$result = $con->prepare("SELECT * FROM customer WHERE email=:email");
	
	$result->bindValue(":email",$_POST['email']);
	
	$result->execute();

    $records = $result->fetch(PDO::FETCH_ASSOC);

	if ( count($records) > 0 && password_verify($_POST['password'], $records['password'])){
			$_SESSION['id'] = $records['user_id'];
			$_SESSION['email'] = $records['email'];
			$_SESSION['first_name'] = $records['first_name'];
			$_SESSION['last_name'] = $records['last_name'];
			$_SESSION['active'] = $records['active'];
	        
			$_SESSION['logged_in'] = true;

			$logged_in = $_SESSION['logged_in'];
			header("location: confirm.php");
	    }else {
					$_SESSION['message'] = "You're email address is not registered or you have entered wrong password, try again!";

					$message = $_SESSION['message'];
					header("location: error.php");
		}
endif;

?>


	<div class="col-md-4 col-xs-10  col-md-offset-4 col-xs-offset-1 sign-in">
		
		<form method="POST" action="login.php" class="form-group">
			<h1 class="text-center">SIGN IN</h1>
			<input type="email" name="email" class="form-control" placeholder="Email@email.com" required autocomplete="off">
			<input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
			<p class="text-center"><a href="forgot.php" >Forgot Password?</a></p>
			<input type="submit" name="sign-in" value="Sign In" class="btn form-control">

			<p class="text-center" style="color:red;"><?php echo $message; ?></p>
		</form>
	</div>


<?php include "extensions/footer.php" ?>
