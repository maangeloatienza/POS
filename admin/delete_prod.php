<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";

?>

<?php

if(isset($_POST['yes'])):
	$result = $con->prepare("DELETE FROM uploads WHERE item_id = :item_id");
	$result->bindValue(":item_id", $_SESSION['item_id']);
	if($result->execute()):
		unset($_SESSION['item_id']);
		header("Location: products.php");
	endif;
elseif(isset($_POST['no'])):
		unset($_SESSION['item_id']);
		header("Location: products.php");
else:
	echo "";
endif;


?>

<div class="col-lg-6 col-md-6 col-lg-6 col-sm-10 col-lg-offset-2 col-md-offset-2">
	<div class="text-center">
		<h4>Do you want to delete this product? </h4>
		<div  class="img-thumbnail" style=" margin:  10px; border-radius: 5px; box-shadow: 2px 4px 1px 2px gray;">
			<h5 style="background-color: black; color: white;"><?php echo $_SESSION['item_name']; ?></h5>
			<img src=<?php echo "../uploads/".$_SESSION['file_name']; ?> style="width: 100px; height: 100px; margin:  10px; ">
			<h5 style="background-color: black; color: white;"> &#8369; <?php echo $_SESSION['price'] ?></h5>
		</div><br>
		<form action="delete.php" method="POST">
			<input type="submit" name="yes" value="Yes" class="btn btn-primary btn-md">
			<input type="submit" name="no" value="No" class="btn btn-danger btn-md">
		</form>
	</div>
</div>

<?php include "extensions/footer.php" ?>