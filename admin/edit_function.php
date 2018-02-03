<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";

?>

<?php

$item_id 	= $_GET['item_id'];

$action 	= $_GET['action'];


if(isset($action)):
	
	$result = $con->prepare("SELECT * FROM uploads WHERE item_id = :item_id");
	$result->bindvalue(":item_id", $item_id);
	$result->execute();

	$record = $result->fetchAll();

	if(count($record)>0):
		foreach ($record as $key => $value) {
			//echo $value['item_id']. " " .$value['item_name'];
			$_SESSION['item_id'] 	= $value['item_id'];
			$_SESSION['file_name']	= $value['file_name'];
			$_SESSION['item_name']	= $value['item_name'];
			$_SESSION['price']	= $value['price'];
			if($action == 'edit'):
			header('Location: edit_prod.php');
			else:
			header('Location: delete_prod.php');
			endif;
		}
	endif;
endif;
?>