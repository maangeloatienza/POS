<?php

session_start();
?>

<?php   include "extensions/header.php";
        include 'extensions/nav.php';
?>

<div class="col-md-3 col-sm-2 col-xs-1"></div>


<div class="error text-center col-md-6 col-sm-8 col-xs-10">
    <h1>ERROR!</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    else:
        header( "Location: index.php" );
    endif;
    ?>
    </p>
        <a href="login.php"><button class="btn btn-danger btn-lg err_btn"/>Login</button></a>
        <a href="register.php"><button class="btn btn-danger btn-lg err_btn"/>Register</button></a>
</div>

<div class="col-md-3 col-sm-2 col-xs-1"></div>


<?php include "extensions/footer.php" ?>
