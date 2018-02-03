<?php
session_start();
require "extensions/db.php";
require "extensions/header.php";
require "extensions/main.php";

?>


<?php



if(isset($_POST['add'])):

	$err = $_FILES['prod_img']['error'];
	if($err>0):
		echo "Error Uploading file";
	else:
		$file 		= $_FILES['prod_img']['name'];
		$tmp_file	= $_FILES['prod_img']['tmp_name'];
	
		move_uploaded_file($tmp_file, "../uploads/".$file);

	endif;

	$result = $con->prepare("INSERT INTO	uploads(file_name,item_name,item_desc,price)
							 VALUES 			   (:file_name,:item_name,:item_desc,:price)");
	$result->bindValue(":file_name", $file);
	$result->bindValue(":item_name", $_POST['item_name']);
	$result->bindValue(":item_desc", $_POST['item_desc']);
	$result->bindValue("price",		 $_POST['price']);

	if($result->execute()):

		header("Location: products.php");

	endif;
endif;
?>
 

<div class="col-lg-6 col-md-10 col-sm-10 col-lg-offset-2" style="margin-top: 10px;">
	<form action="add_prod.php" method="POST" enctype="multipart/form-data" class="form-group">
		<h3 class="text-center">ADD PRODUCT</h3>
		<span class="input-group-addon"><i></i>Update Photo</span>
			<div style="text-align: center;">
				<input type="file" name="prod_img" id="prod_img" class="btn btn-primary" style="display: inline-block;" required>
			</div>
		<span class="input-group-addon"><i></i>Product name</span>
		<input type="text" name="item_name" class="form-control" required>
		<span class="input-group-addon"><i></i>Description</span>
		<input type="text" name="item_desc" class="form-control" required>
		<span class="input-group-addon"><i></i>Price</span>
		<input type="number" name="price" class="form-control" required>
		<div class="text-center">
			<input type="submit" name="add" value="Update" class="btn btn-primary btn-md">
		</div>
	</form>
</div>



<?php



?>