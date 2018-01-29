<?php

require 'extensions/db.php';
session_start();

if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $_GET['email']; 
    $hash = $_GET['hash']; 


    $result = $con->prepare("SELECT * FROM customer WHERE email=:email AND hash=:hash");

    $result->bindValue(':email',$email);
    $result->bindValue(':hash',$hash);

    $result->execute();
    $record = $result->fetch(PDO::FETCH_ASSOC);
    if ( count($record)<0 ){ 
      $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: error.php");
    }
}
else {
  $_SESSION['message'] = "Sorry, verification failed, try again!";
  header("location: error.php");  
}
?>

<?php
    include "extensions/header.php";
    include "extensions/nav.php";
?> 

<div class="col-md-3 col-sm-2 col-xs-1"></div>

    <div class="reset text-center col-md-6 col-sm-8 col-xs-10">

      <h1>Choose Your New Password</h1>
          
        <form action="reset_password.php" method="post" class="form-group">

                
                <div class="form-inline">
                <label class="col-lg-5">
                    New Password<span class="req">*</span>
                </label>
                <input type="password"required name="newpassword" autocomplete="off" style="color: black;" class="form-control" />
                </div>
                
                <div class="form-inline">
                <label class="col-lg-5">
                    Confirm New Password<span class="req">*</span>
                </label>
                <input type="password"required name="confirmpassword" autocomplete="off" style="color: black;" class="form-control" />
                </div>

            <input type="hidden" name="email" value="<?= $email ?>" >    
            <input type="hidden" name="hash" value="<?= $hash ?>">
            <br>
            <input type="submit" name="" class="btn btn-primary btn-md rst_btn" value="Apply">
          
        </form>

    </div>

<div class="col-md-3 col-sm-2 col-xs-1"></div>

<?php include "extensions/footer.php" ?>
