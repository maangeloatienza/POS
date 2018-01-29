<?php
session_start();
//unset($_SESSION['shopping_cart']);
require "extensions/db.php";


$records	= $con->prepare(" SELECT * FROM uploads ");

$records->execute();

$results = $records->fetchAll();


?>
<?php 	include "extensions/header.php";
		include 'extensions/nav.php';	
?>

<?php

	$product_id = array();


if(filter_input(INPUT_POST, 'add_to_cart')):
		if(isset($_SESSION['shopping_cart'])){
			$count = count($_SESSION['shopping_cart']);

			//sequential array
			$product_id = array_column($_SESSION['shopping_cart'], 'id');
			
				if(!in_array(filter_input(INPUT_GET, 'item_id'),$product_id)){
					$_SESSION['shopping_cart'][$count] = array(

					'id'		=> filter_input(INPUT_GET, 'item_id'),
					'name'		=> filter_input(INPUT_POST, 'item_name'),
					'price'		=> filter_input(INPUT_POST, 'item_price'),
					'quantity'	=> filter_input(INPUT_POST, 'quantity')
					);

				}else {
					for($i=0; $i < count($product_id); $i++) { 
						if($product_id[$i] == filter_input(INPUT_GET, 'item_id')){
							$_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
						}
					}
				}
		}else{
			$_SESSION['shopping_cart'][0] = array(

				'id'		=> filter_input(INPUT_GET, 'item_id'),
				'name'		=> filter_input(INPUT_POST, 'item_name'),
				'price'		=> filter_input(INPUT_POST, 'item_price'),
				'quantity'	=> filter_input(INPUT_POST, 'quantity')

			);
		}
		

endif;
if(filter_input(INPUT_GET, 'action') == 'delete'){
	foreach($_SESSION['shopping_cart'] as $key => $product){
		if ($product['id'] == filter_input(INPUT_GET, 'item_id')){
			unset($_SESSION['shopping_cart'][$key]);
		}
	}
		$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}


//pre_r($_SESSION);

function pre_r($array){
		echo '<pre>';
		print_r($array);	
		echo '</pre>';
	}


?>

	
	
		<!--Carousel of some products-->
<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-1"></div>
	<div class="col-lg-10 col-md-10 col-sm-10">
		<div id="myCarousel" class="carousel slide row" data-ride="carousel">
  				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>

	  			<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="assests/images/sample1.jpg" alt="Los Angeles" class="img-responsive">
					</div>

					<div class="item">
						<img src="assests/images/sample2.jpg" alt="Chicago" class="img-responsive">
					</div>

					<div class="item">
						<img src="assests/images/sample3.jpg" alt="New York" class="img-responsive">
					</div>
				</div>

		</div>
	</div>
	<div class="col-lg-1 col-md-1 col-sm-1"></div>
</div>
		<!--Carousel of some products-->

<div class="row">

	<div class="col-lg-3 col-md-3">
		
		<h2>CATEGORIES</h2>


	</div>

		<!--Show Items-->

		<div class="container-fluid">
			
			<?php
				if(count($results)>0):
					foreach($results as $key => $result){
			?>
				<form method="POST" action="index.php?action=add&item_id=<?php echo $result['item_id']; ?>">

					<div class="col-xm-5 col-sm-4 col-md-3 col-lg-2 products ">
						<h6>Click image for details</h6>
						<a href=<?php echo "uploads/".$result['file_name'];?> data-lightbox="gallery" title="<?php echo $result['item_desc']; ?>">
							<img src=<?php echo "uploads/".$result['file_name']; ?> class="img-responsive" >
						</a>
						<h4 class="text-info text-center"><?php echo $result['item_name']; ?></h4>
						<h5 class="text-info text-center"><?php echo " &#8369;".$result['price'] ?></h5>
						<input type="number" name="quantity" value="Quantity" class="form-control text-center" value="1" placeholder="Quantity" min="0" required>
						<input type="hidden" name="item_name" value="<?php echo $result['item_name']?>">
						<input type="hidden" name="item_price" value="<?php echo $result['price']?>">
						<input type="submit" name="add_to_cart" value="Add to cart" class="btn btn-primary btn-sm form-control" >
					</div>
				</form>
			<?php }

				endif;
			 ?>

		</div>

	
</div> <!--ENDING FOR ITEM LIST-->
<div style="clear:both"></div>  
	<br />




<?php include "cart.php" ?>

<?php include "extensions/footer.php" ?>
