


<div class=" col-md-3 col-sm-6 text-center" id="item">
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-lg">
	    
		<div class="modal-content">
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

		<!--CONTENT OF THE CART-->

<div class="modal-body">
	<div class="row">
			<?php //if(isset($_SESSION['active'])): ?>
			<div class="table-responsive col-lg-12 ">  
				<table class="table text-left" id="cart">  
					<tr><th colspan="5"><h3>Order Details</h3></th></tr>   
				<tr > 
					
						<th width="40%">Product Name</th>  
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>  
				</tr>  
		        
				<?php   
					if(!empty($_SESSION['shopping_cart'])):
		             $total = 0;
						foreach($_SESSION['shopping_cart'] as $key => $product): 
		        ?>  
				<tr>  
					<td><?php echo $product['name']; ?></td>  
					<td><?php echo $product['quantity']; ?></td>  
					<td>&#8369; <?php echo $product['price']; ?></td>  
					<td>&#8369; <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
					<td>
						<a href="index.php?action=delete&item_id=<?php echo $product['id']; ?>">
							<i class="fa fa-trash"></i>
						</a>
					</td>  
				</tr>
				<?php  
					$total = $total + ($product['quantity'] * $product['price']);  
					endforeach;  
				?>  
				<tr>  
					<td colspan="3" align="right">Total</td>  
					<td align="right">PHP <?php echo number_format($total, 2); ?></td>  
					<td></td>  
		        </tr>

		        <tr>
		            <!-- Show checkout button only if the shopping cart is not empty -->
		            <td colspan="3">
						<?php 
							if (isset($_SESSION['shopping_cart'])):
								if (count($_SESSION['shopping_cart']) > 0):
							?>
								<a href="clear_cart.php" class="button"><i class="fa fa-times" aria-hidden="true"></i>CLEAR CART</a>
								
							<?php 	
								endif;
							endif;
						?>
					</td>
					<td colspan="2">
						<?php 
							if (isset($_SESSION['shopping_cart'])):
								if (count($_SESSION['shopping_cart']) > 0):
							?>
								<a href="#" class="button">Checkout</a>
							<?php 	
								endif;
							endif;
						?>
					</td>
				</tr>
			<?php  	//endif;
					endif;
				?>  
			</table> 
		</div>
	</div>				
</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	      
		</div>
	</div>
  
</div>

<?php include "extensions/footer.php" ?>