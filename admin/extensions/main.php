<?php 


if($_SESSION['admin_in']!=1):
	header("Location: index.php");
endif;

include "extensions/header.php"; ?>

<?php  ?>

<div class="row">
<div class="main-content col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">

	<div class="sidebar col-lg-2 col-md-2 col-sm-2">

		<div class="admin-acc">
			<a href="admin.php"><img src="images/admin (1).png" class="img-rounded img-responsive text-center" style="margin:auto; width: 150px; height: 150px;"></a>

		</div>


		<h4 class="text-center"><i class="fa fa-tachometer" aria-hidden="true"></i>DASHBOARD</h4>
		<ul class="text-center">
			<li>
				<i class="fa fa-shopping-basket" aria-hidden="true"></i>Products
				<!--Dropdown-->
				<ul class="sub-menu">
					<li><a href="products.php">View Product</a></li>
					<li><a href="add_prod.php">Add product</a></li>
				</ul>

			</li>
			<li><i class="fa fa-user-secret" aria-hidden="true"></i>Employees

				<ul class="sub-menu">
					<li><a href="employee.php">View Employees</a></li>
					<li><a href="add_emp.php">Add Employee</a></li>
				</ul>

			</li>
			<li><i class="fa fa-users" aria-hidden="true"></i>Users
				<ul class="sub-menu">
					<li><a href="users.php">View Users</a></li>
				</ul>
			</li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>