<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";

?>


<?php

$emp_id 	= $_GET['emp_id'];

$action 	= $_GET['action'];


if(isset($action)):
	
	$result = $con->prepare("SELECT * FROM employee WHERE emp_id = :emp_id");
	$result->bindvalue(":emp_id", $emp_id);
	$result->execute();

	$record = $result->fetchAll();

	if(count($record)>0):
		foreach ($record as $key => $value) {
			
			$_SESSION['emp_id'] 	= $value['emp_id'];
			$_SESSION['first_name']	= $value['first_name'];
			$_SESSION['last_name']	= $value['last_name'];
			$_SESSION['username']	= $value['username'];
			if($action == 'edit'):
			  header('Location: edit_emp.php');
			endif;
		}
	endif;
endif;
?>