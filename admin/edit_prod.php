<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";

?>


<?php

//if($_GET['action']=='edit'):
//$action = $_GET['edit'];


//$_SESSION['item_id'] = $_GET['item_id'];
//if($_GET['action']=='edit'):
	if(isset($_POST['update'])):

		$err = $_FILES['file_name']['error'];
		if($err>0):
			echo "Error Uploading file";
		else:
			$file 		= $_FILES['file_name']['name'];
			$tmp_file	= $_FILES['file_name']['tmp_name'];

			move_uploaded_file($tmp_file, "../uploads/".$file);

		endif;

	$result = $con->prepare("UPDATE uploads SET
							file_name 	=:file_name,
							item_name	=:item_name,
							item_desc	=:item_desc,
							price 		=:price
							WHERE item_id= ".$_SESSION['item_id']."");
	$result->bindValue(":file_name",$file);
	$result->bindValue(":item_name",$_POST['item_name']);
	$result->bindValue(":item_desc",$_POST['item_desc']);
	$result->bindValue(":price",$_POST['price']);
	//$result->bindValue(":price",);

		if($result->execute()):
			unset($_SESSION['item_id']);
			header("Location:products.php");
		endif;
	endif;
?>
 

<div class="col-lg-6 col-md-10 col-sm-10 col-lg-offset-2" style="margin-top: 10px;">
	<form action="edit.php" method="POST" enctype="multipart/form-data" class="form-group">
		<h3 class="text-center">EDIT PRODUCT</h3>
		<span class="input-group-addon"><i></i>Update Photo</span>
			<div style="text-align: center;">
				<input type="file" name="file_name" id="prod_img" class="btn btn-primary" style="display: inline-block;" required>
			</div>
		<span class="input-group-addon"><i></i>Product name</span>
		<input type="text" name="item_name" class="form-control" required>
		<span class="input-group-addon"><i></i>Description</span>
		<input type="text" name="item_desc" class="form-control" required>
		<span class="input-group-addon"><i></i>Price</span>
		<input type="number" name="price" class="form-control" required>
		<div class="text-center">
			<input type="submit" name="update" value="Update" class="btn btn-primary btn-md">
		</div>
	</form>
</div>

<?php //endif; ?>