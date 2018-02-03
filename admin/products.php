<?php
session_start();
require "extensions/db.php";
//include "extensions/header.php";

$records	= $con->prepare(" SELECT * FROM uploads ");

$records->execute();

$results = $records->fetchAll();

?>


<?php include "extensions/main.php"; ?>


<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="prod_tbl">		
		<div class="table-responsive">	
			<table class="table-condensed table-hover" >
				<tr>
					<th width="10%">Product ID</th>
					<th width="15%">Image</th>
					<th width="20%">Product Name</th>
					<th width="30%">Description</th>
					<th width="8%">Price</th>
					<th width="17%">Action</th>
				</tr>
				<?php if(count($results)>0): //php condition statement ito
						foreach ($results as $key => $value): 
				?>
				<tr class="text-center">
					<td><?php echo $value['item_id']; ?></td>
					<td><img src=<?php echo "../uploads/".$value['file_name']; ?> style="width: 50px; height: 50px;"></td>
					<td><?php echo $value['item_name']; ?></td>
					<td><?php echo $value['item_desc']; ?></td>
					<td><?php echo $value['price']; ?></td>
					<td class="text-center">
						<form action="edit_function.php?action=edit&item_id=<?php echo $value['item_id']; ?>" method="POST">
							<input type="submit"  name="edit" value="Edit" class="btn btn-primary btn-sm" style="width: 100px;">
							
						</form>

						<form action="edit_function.php?action=delete&item_id=<?php echo $value['item_id']; ?>" method="POST">
							
							<input type="submit"  name="delete" value="Delete" class="btn btn-danger btn-sm" style="width: 100px;">

						</form>
					</td>
				</tr>
				<?php endforeach;
					  endif;
				?>
			</table>
		</div>

	</div>
</div>





<?php include "extensions/footer.php"; ?>
