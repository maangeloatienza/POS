<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";

?>

<?php

$user_id 	= $_GET['user_id'];

$action 	= $_GET['action'];


if(isset($action)):
	
	$result = $con->prepare("SELECT * FROM customer WHERE user_id = :user_id");
	$result->bindvalue(":user_id", $user_id);
	$result->execute();

	$record = $result->fetchAll();

	if(count($record)>0):
		foreach ($record as $key => $value) {
			//echo $value['item_id']. " " .$value['item_name'];
			$_SESSION['user_id'] 	= $value['user_id'];
			$_SESSION['first_name']	= $value['first_name'];
			$_SESSION['last_name']	= $value['last_name'];
			$_SESSION['email']		= $value['email'];
			if($action == 'edit'):
			//header('Location: edit_user.php');
			else:
			header('Location: delete_user.php');
			endif;
		}
	endif;
endif;
?>