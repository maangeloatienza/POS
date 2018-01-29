
<div class="main-container container-fluid">
	<!--Navbar-->
<div class="row">

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                    
				</button>
			<a class="navbar-brand" href="#">
					<img alt="Brand" src="...">
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right dropdown text-center">
				<li><a href="index.php"><i class="fa fa-home" aria-hidden='true'></i>HOME</a></li>
				<li><a href="register.php"><i class="fa fa-user-plus" aria-hidden='true'></i>SIGN UP</a></li>
				<li><a href="login.php"><i  class="fa fa-sign-in" aria-hidden='true'></i>SIGN IN</a></li>
				<li><a data-toggle='modal' data-target='#myModal'><i class='fa fa-shopping-cart' aria-hidden='true'></i>CART</a></li>
						<?php if(!isset($_SESSION['logged_in'])):
						
						else:
							echo "<li><a href='profile.php'><i class='fa fa-user' aria-hidden='true'></i>PROFILE</a></li>
								  <li><a href='logout.php'><i class='fa fa-sign-out' aria-hidden='true'></i>SIGN OUT</a></li>
								";
						endif;
							?>
			</ul>
		</div>
		
	</div>
</nav>
</div>