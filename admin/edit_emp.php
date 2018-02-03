<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";


if(isset($_POST['update'])):

	$result = $con->prepare("UPDATE employee 
							 SET 	first_name		= :first_name,
							 		last_name		= :last_name,
							 		username 		= :username,
							 		password 		= :password");

	$result->bindValue(":first_name",$_POST['first_name']);
	$result->bindValue(":last_name",$_POST['last_name']);
	$result->bindValue(":username",$_POST['username']);
	$result->bindValue(":password",password_hash($_POST['first_name']), PASSWORD_BCRYPT);

	if($result->execute()):
		unset($_SESSION['emp_id']);
		header("Location:employee.php");
	endif;
endif;




?>

<div class="col-lg-6 col-md-10 col-sm-10 col-lg-offset-2" style="margin-top: 10px;">
	<form action="edit_emp.php" method="POST" enctype="multipart/form-data" class="form-group">
		<h3 class="text-center">EDIT EMPLOYEE INFORMATION</h3>
		<span class="input-group-addon"><i></i>First Name</span>
		<input type="text" name="first_name" class="form-control" required>
		<span class="input-group-addon"><i></i>Last Name</span>
		<input type="text" name="last_name" class="form-control" required>
		<span class="input-group-addon"><i></i>Username</span>
		<input type="text" name="username" class="form-control" required>
		<span class="input-group-addon"><i></i>Password</span>
		<input type="text" name="password" class="form-control" required>
		<div class="text-center">
			<input type="submit" name="update" value="Update" class="btn btn-primary btn-md">
		</div>
	</form>
</div>

<?php include "extensions/footer.php"; ?>