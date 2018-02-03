<?php
session_start();

include "extensions/db.php";
include "extensions/main.php";

$result = $con->prepare("SELECT * FROM employee");

$result->execute();
$record = $result->fetchAll();


?>

<div class="col-lg-8 col-md-8 col-lg-offset-1 col-md-offset-1">
	<table class="table table-condensed">
		<tr>
			<th>Employee ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>User Name</th>
			<th>Action</th>
		</tr>
		<?php foreach($record as $key => $value): ?>
		<tr>
			<td><?php echo $value['emp_id']; ?></td>	
			<td><?php echo $value['first_name']; ?></td>	
			<td><?php echo $value['last_name']; ?></td>	
			<td><?php echo $value['username']; ?></td>
			<td>
				<form action="edit_emp_function.php?action=edit&emp_id=<?php echo $value['emp_id']; ?>" method="POST">
					<input type="submit" name="edit" value="Edit" class="btn btn-primary btn-sm" style="width: 100px;" >
				</form>
				<form action="edit_emp_function.php?action=delete&emp_id=<?php echo $value['emp_id']; ?>" method="POST">
					<input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm" style="width: 100px;" >
				</form>
			</td>	
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php include "extensions/footer.php"; ?>