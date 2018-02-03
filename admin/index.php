<?php
session_start();
require 'extensions/db.php';
include "extensions/header.php"; ?>

<?php
$message = '';
if(isset($_POST['login'])):

	$result = $con->prepare("SELECT * FROM admin WHERE username = :username and password = :password");
	$result->bindValue(":email", $_POST['username']);
	$result->bindValue(":password", $_POST['password']);
	$result->execute();

	$records = $result->fetch(PDO::FETCH_ASSOC);
	if(count($records)>0):
		$_SESSION['admin_in'] = 1;
		header("Location: admin.php");
	else:
		$message = "ERROR LOGGIN IN ADMIN ACCOUNT!";
	endif;
endif;
?>

<nav class="navbar">
	<div class="container-fluid">	
		<div class="text-center">
			<h3 style="color: white;">ADMIN LOGIN</h3>
		</div>
	</div>
</nav>


<div class="login-form">
	
	<form id="signin" class="text-center" role="form" action="" method="POST">
			
				<span class="input-group-addon"><i class="fa fa-user"></i>Username</span>
				<input id="email" type="text" class="form-control" name="username" value="" placeholder="Username" required autocomplete="off">                        
			<br>
			
				<span class="input-group-addon"><i class="fa fa-lock"></i>Password</span>
				<input id="password" type="password" class="form-control" name="password" value="" placeholder="Password" required autocomplete="off">                                        
			<br>
			
				<input type="submit" name="login" value="Login" class="btn btn-danger btn-md">
				<br>
				<h6 ><?=$message;  ?></h6>

	</form>

</div>







<?php  include "extensions/footer.php"; ?>
