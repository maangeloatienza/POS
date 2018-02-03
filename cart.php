<?php 
session_start();
require "extensions/db.php";
?>

<?php

$sample = serialize($_SESSION['shopping_cart']);
$un = unserialize($sample);

foreach ($un as $key => $value) {
	$total = ($value['quantity'] * $value['price']);

	$total =+ $total + ($value['quantity'] * $value['price']);
}

if(isset($_SESSION['logged_in'])){

$result = $con->prepare("INSERT INTO order_info(cust_id,order_details,total) VALUES(:cust_id,:order_details,:total)");

$result->bindValue("cust_id",$_SESSION['id']);
$result->bindValue(":order_details",$sample);
$result->bindValue(":total",$total);


if($result->execute()){
	header("Location: checkout.php");
}




}else{

	 	include "extensions/header.php";
		//include 'extensions/nav.php';
?>

	<div class="col-md-4 col-xs-10  col-md-offset-4 col-xs-offset-1 sign-in">
		
		<form method="POST" action="guess_login.php" class="form-group">
			<h1 class="text-center">CHECKOUT INFORMATION</h1>
			<input type="text" name="first_name" class="form-control" placeholder="First name" required autocomplete="off">
			<input type="text" name="last_name" class="form-control" placeholder="Last name" required autocomplete="off">
			<input type="text" name="address" class="form-control" placeholder="Address" required autocomplete="off">
			<input type="number" name="contact" class="form-control" placeholder="Contact number" min-length="11" required autocomplete="off">
			<input type="submit" name="send" value="Send" class="btn form-control">

		</form>
	</div>

<?php 
}

include "extensions/footer.php" ?>