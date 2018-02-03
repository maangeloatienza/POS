<?php
session_start();
include "extensions/db.php";


$sample = serialize($_SESSION['shopping_cart']);
$un = unserialize($sample);

foreach ($un as $key => $value) {
	$total = ($value['quantity'] * $value['price']);

	$total =+ $total + ($value['quantity'] * $value['price']);
}


$result = $con->prepare("INSERT INTO guess_order_info(order_details,first_name,last_name,address,contact,total)
						VALUES 				   (:order_details,:first_name,:last_name,:address,:contact,:total)");

$result->bindValue(":order_details",$sample);
$result->bindValue(":first_name",$_POST['first_name']);
$result->bindValue(":last_name",$_POST['last_name']);
$result->bindValue(":address",$_POST['address']);
$result->bindValue(":contact",$_POST['contact']);
$result->bindValue(":total",$total);


if($result->execute()){
	header("Location: checkout.php");
}



?>