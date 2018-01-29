<?php 
session_start();
require 'extensions/db.php';
include "extensions/header.php";



if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $_GET['email']; 
    $hash = $_GET['hash']; 
    
    $result = $con->prepare("SELECT * FROM customer WHERE email=:email AND hash='$hash' AND active='0'");
    $result->bindValue(":email",$email);
    $result->execute();
    $records = $result->fetch(PDO::FETCH_OBJ);
    if( count($result) == 0 ){ 
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Your account has been activated!";
        
        $update = $con->prepare("UPDATE customer SET active='1' WHERE email=:email");
        $update->bindValue(":email",$email);
        $update->execute();
        $_SESSION['active'] = 1;
        
        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: error.php");
}     
?>