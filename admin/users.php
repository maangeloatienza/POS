<?php
session_start();
require "extensions/header.php";
require "extensions/main.php";
require "extensions/db.php";

$result = $con->prepare("SELECT * FROM customer");
$result->execute();
$record = $result->fetchAll();

?>


<div class="col-lg-8 col-md-10 col-sm-10 col-lg-offset-1 ">
	
	<div class="prod_tbl">
		<table class="table table-condensed">
			<tr>
				<th width="10%">User ID</th>
				<th width="30%">Name</th>
				<th width="30%">Email</th>
				<th width="30%">Action</th>
			</tr>
			<?php 	if(count($record)>0):

					foreach ($record as $key => $value):
 			?>

			<tr class="text-center">
				<td><?php echo $value['user_id']; ?></td>
				<td><?php echo $value['first_name']." ".$value['last_name'] ?></td>
				<td><?php echo $value['email']; ?></td>
				<td>

					<form action="edit_user_function.php?action=delete&user_id=<?php echo $value['user_id']; ?>" method="POST">
							
						<input type="submit"  name="delete" value="Delete" class="btn btn-danger btn-sm" style="width: 100px;">

					</form>
				</td>
			</tr>
			<?php
					endforeach;
					endif;
			?>
		</table>
	</div>

</div>
