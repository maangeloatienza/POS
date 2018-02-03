<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";

?>

<?php

if(isset($_POST['yes'])):
	$result = $con->prepare("DELETE FROM employee WHERE emp_id = :emp_id");
	$result->bindValue(":emp_id", $_SESSION['emp_id']);
	if($result->execute()):
		unset($_SESSION['emp_id']);
		header("Location: emp.php");
	endif;
elseif(isset($_POST['no'])):
		unset($_SESSION['emp_id']);
		header("Location: employee.php");
else:
	echo "";
endif;


?>

<div class="col-lg-6 col-md-6 col-lg-6 col-sm-10 col-lg-offset-2 col-md-offset-2">
	<div class="text-center">
		<h4>Do you want to delete this Employee information? </h4>
		<div  class="img-thumbnail" style=" margin:  10px; border:2px solid black; border-radius: 5px; box-shadow: 2px 4px 1px 2px gray;">
			<h4><?php echo $_SESSION['first_name']. " " . $_SESSION['last_name']?></h4>
		</div><br>
		<form action="delete_user.php" method="POST">
			<input type="submit" name="yes" value="Yes" class="btn btn-primary btn-md">
			<input type="submit" name="no" value="No" class="btn btn-danger btn-md">
		</form>
	</div>
</div>

<?php include "extensions/footer.php" ?>