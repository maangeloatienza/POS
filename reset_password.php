<?php

require 'extensions/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 


    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 

        $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        

        $email = $_POST['email'];
        $hash = $_POST['hash'];
        
        $sql = "UPDATE customer SET password='$new_password', hash='$hash' WHERE email='$email'";

        if ( $con->prepare($sql) ) {

            $_SESSION['message'] = "Your password has been reset successfully!";
            header("location: success.php");    

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: error.php");    
    }

}
?>