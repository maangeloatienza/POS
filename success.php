<?php
session_start();

require "extensions/db.php";

include 'extensions/header.php';
include 'extensions/nav.php';
?>

<div class="col-md-3 col-sm-2 col-xs-1"></div>

<div class="success text-center col-md-6 col-sm-8 col-xs-10">
    <h1><?= 'Success'; ?></h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];

    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>
    <a href="index.php"><button class="btn btn-primary btn-md"/>Home</button></a>
</div>

<div class="col-md-3 col-sm-2 col-xs-1"></div>

<?php include "extensions/footer.php" ?>
