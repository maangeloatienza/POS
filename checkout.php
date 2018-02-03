<?php
session_start();

require "extensions/db.php";
include "extensions/header.php";
$sample = "";

if(isset($_SESSION['logged_in'])):
	if(isset($_SESSION['shopping_cart'])){

		$result = $con->prepare("SELECT * FROM order_info ORDER BY order_id DESC LIMIT 1");
		$result->execute();
		$record = $result->fetch(PDO::FETCH_ASSOC);

		if(count($record)>0){
			$sample = unserialize($record['order_details']);
			
			//pre_r($sample);
		}else {
			echo " ERROR";
		}

	} else {
		header("Location: index.php");
	}
else:

	if(isset($_SESSION['shopping_cart'])){

		$result = $con->prepare("SELECT * FROM guess_order_info ORDER BY order_id DESC LIMIT 1");
		$result->execute();
		$record = $result->fetch(PDO::FETCH_ASSOC);

		if(count($record)>0){
			$sample = unserialize($record['order_details']);
			
			//pre_r($sample);
		}else {
			echo " ERROR";
		}

	} else {
		header("Location: index.php");
	}


endif;
include "extensions/header.php";

?>
<div class="row">
<div class="col-lg-4 col-sm-1"></div>
	<div class=" col-lg-4 col-sm-10 table-responsive" id="receipt" style="border: 2px solid gray;">

	<table class="table" style="margin: auto">
		
		<div class="text-center">
			<?php if(isset($_SESSION['logged_in'])):  ?>
				<h4>Transaction ID : OLSHP-R - <?php echo $record["order_id"]; ?></h4>
				<h6>Transaction made by <?php echo $_SESSION['first_name']. " " . $_SESSION['last_name'] ?></h6>
			<?php else: ?>
				<h4>Transaction ID : OLSHP-G - <?php echo $record["order_id"]; ?></h4>
				<h6>Transaction made by <?php echo $record['first_name']. " " . $record['last_name'] ?></h6>
			<?php endif; ?>
			<h5>Send Payment thru:</h5>
			<a href="">
					<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVdu57vSzEzzkDOT19actEUbRgbfhxAX435mJn8lDoG69m3Sn_OQ" style="height: 50px; width: 150px; margin: auto;" class="img-responsive">
			</a>
		</div>

		<tr>
			<th width="40%">Item Ordered</th>
			<th width="20%">Quantity</th>
			<th width="20%">Price</th>
			<th width="20%">Cost</th>
		</tr>
		<tr>
			<?php
			foreach ($sample as $key => $value):
			?>
				<td><?php echo $value['name']    ?></td>
				<td><?php echo $value['quantity']?></td>
				<td>&#8369; <?php echo $value['price']   ?></td>
				<td>&#8369; <?php echo $value['price']*$value['quantity']?></td>
		</tr>
		<tr >
			
			<?php endforeach;?>	
			
			<td></td>
			<td></td>
			<td>TOTAL :</td>
			<td>&#8369; <?php echo $record['total']; ?></td>
		</tr>

	</table>
	
</div>

<div class="col-lg-4 col-sm-1"></div>
</div>


<div class="text-center" style="margin: 20px 10px;">
	<button id="print" class="btn btn-primary btn-lg" onclick="printDiv('receipt');">PRINT
		<script type="text/javascript">
		function printDiv(divName) {
		    var printContents = document.getElementById('receipt').innerHTML;
		    var originalContents = document.body.innerHTML;

		    document.body.innerHTML = printContents;

		    window.print();

		    document.body.innerHTML = originalContents;
		}
		

		</script>
	</button>

	<button class="btn btn-danger btn-lg"><a href="clear_cart.php">Done</a></button>

</div>



<?php
include "extensions/footer.php";
?>