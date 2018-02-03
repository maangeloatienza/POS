<?php
session_start();
include "extensions/db.php";
include "extensions/main.php";
?>


<div class="col-lg-10">
	<div class="col-lg-10 col-lg-offset-1">
		<!--With Login sales-->
	
<?php
$registered = $con->prepare("SELECT * FROM order_info");
$registered->execute();
$sales_r = $registered->fetchAll();
if(count($sales_r)>0):
?>

		<table class="text-center table table-condensed">
			<tr >
				<th width="10%" style="text-align: center;">Order ID</th>
				<th width="35%" style="text-align: center;">Items</th>
				<th width="20%" style="text-align: center;">Total</th>
				<th width="10%" style="text-align: center;">Status</th>
				<th width=""></th>
			</tr>
<?php foreach ($sales_r as $key => $reg){ 

	$ser = unserialize($reg['order_details']);

					
?>

			<tr>
				<td><?php echo $reg['order_id']; ?>	</td>				

				<td>
					<?php
					for($i=0; $i<count($ser);$i++){
						echo $ser[$i]['name']. " - ".$ser[$i]['quantity']."<br>";
					}
					?>


				</td>
				<td><?php echo $reg['total'];?></td>
				<td>
					
					<?php

					if($reg['status'] == 1):
						echo "Approved";
					elseif($reg['status'] == 0):
						echo "Pending";
					endif;

					?>

				</td>				
			</tr>



		</table>
	
<?php 
}
endif;


?>
</div>
	<div class="col-lg-5 col-lg-offset-1">
		<!--Guess sales-->
		<table>
			
		</table>
	</div>
</div>


<?php  include "extensions/footer.php"; ?>
