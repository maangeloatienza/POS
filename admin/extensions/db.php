<?php

	$server		= "localhost";
	$user		= "root";
	$password	= "";
	$dbname		= "pos_db";

try {
	$con 		= new PDO("mysql:host=$server;dbname=$dbname",$user,$password);
} catch(PDOException $e){
	die("Connection Failed: ". $e->getMessage());
}


?>