
<?php

session_start();

if ( $_SESSION['logged_in'] != true ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}


?>

<?php 	include "extensions/header.php";
		//include 'extensions/nav.php';
?>
<div class="col-md-3 col-sm-2 col-xs-1"></div>

	<div class="confirm text-center col-md-6 col-sm-8 col-xs-10">

	<h1>Welcome</h1>
			<p>
				<?php 
					if ( isset($_SESSION['message']) ):
						echo $_SESSION['message'];
	              		unset( $_SESSION['message'] );
					endif;
				?>
			</p>
          
				<?php
	          		if ( !$active ):
						echo '<div class="info">
							 Account is unverified, please confirm your email by clicking
							 on the email link! </div>';
						echo "
								<a href='logout.php'><button class='btn btn-primary btn-md' />GO</button></a>

							";
					endif;
				?>
			<div class="message">
				<h2><?php echo $first_name.' '.$last_name; ?></h2>
					<p><?= $email ?></p>
			</div>
			<?php
	          		if ( $active ):
						echo "<a href='index.php'><button class='btn btn-primary btn-md' />HOME</button></a>";
					endif;
				?>
</div>

<div class="col-md-3 col-sm-2 col-xs-1"></div>


<?php include "extensions/footer.php" ?>

