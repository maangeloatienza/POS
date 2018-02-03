<?php
session_start();
include "extensions/db.php";
include "extensions/main.php";

if(isset($_POST['register'])):

$user = ($_POST['first_name']." ".$_POST['last_name']);

$username = str_replace(" ", "_", $user);


$result = $con->prepare("INSERT INTO 	employee
						 		  		(first_name,last_name,username,password) 
						 VALUES	 		(:first_name,:last_name,:username,:password)");
$result->bindValue(":first_name",$_POST['first_name']);
$result->bindValue(":last_name",$_POST['last_name']);
$result->bindValue(":username",strtolower($username));
$result->bindValue(":password",password_hash($_POST['last_name'],PASSWORD_BCRYPT));

	if($result->execute()):
		header('Location: employee.php');
	
	else:
		echo strtolower($username);
	endif;
endif;
?>

<div class="col-md-4 col-xs-10  col-md-offset-3 col-xs-offset-1 sign-in" style="margin-top: 20px;">
	
	<form class="text-center" role="form" action="add_emp.php" method="POST">
				<span class="input-group-addon"> <i class="fa fa-user"></i>First Name</span>
				<input type="text" class="form-control" name="first_name" value="" placeholder="First Name" required autocomplete="off">
			
			<br>

				<span class="input-group-addon"><i class="fa fa-user"></i>Last Name</span>
				<input type="text" class="form-control" name="last_name" value="" placeholder="Last Name" required autocomplete="off">
			
			<br>
			
				<span class="input-group-addon"><i class="fa fa-user"></i>Username</span>
				<input type="text" class="form-control" name="username" value="" placeholder="Username" disabled="on">                        
			<br>
			
				<span class="input-group-addon"><i class="fa fa-lock"></i>Password</span>
				<input type="password" class="form-control" name="password" value="" placeholder="Password" disabled="on">                                        
			<br>
			
				<input type="submit" name="register" value="Register" class="btn btn-danger btn-md">
				<br>

	</form>	
	
</div>

<?php include "extensions/footer.php"; ?>