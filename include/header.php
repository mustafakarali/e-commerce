	<?php 
		include("login.php");
	?>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
								<a class="brand" href="index.php" style="height:90px;"><img src="products/logo.png" alt="NORA'S JEWELRY" height="90px" style="height:90px;"/></a>
				
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Store Category <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="bracelet.php">Bracelets</a></li>
								<li><a href="necklace.php">Necklace</a></li>
								<li><a href="earrings.php">Earrings</a></li>
								<li><a href="pendants.php">Pendants</a></li>
								<li><a href="rings.php">Rings</a></li>                                
								<li><a href="sets.php">Jewelry Sets</a></li>                                
							</ul>
						</li>
					</ul>
					<div class="navbar-form form-search pull-right">
						<ul class="nav">
						
										<li><a href="contact.php">Contact</a></li>
						<?php
							if(isset($_SESSION['login'])) {
								$memberID = $_SESSION['login'];
								$sql = mysql_query("SELECT first_name, last_name FROM tbl_members WHERE member_id='$memberID'") or die(mysql_error());
								while($row = mysql_fetch_array($sql)) {
									$fname = $row['first_name'];
									$lname = $row['last_name'];
								}
							?>
								<li class="dropdown">
								<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $fname.' '.$lname.' ';?><b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="profile.php">Profile</a></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
							<?php
							}
							else {
						?>
                        <li><a href="#myModal" data-toggle="modal">Sign In</a></li>
                        <li><a href="register.php">Create an Account</a></li>
						<li><a href="contact.php">Contact</a></li>
						<?php } ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">E-Commerce <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="cart.php">Cart</a></li>
								<li><a href="checkout.php">Checkout</a></li>
							</ul>
						</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
	</div>