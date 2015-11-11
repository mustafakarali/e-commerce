<?php
session_start();
include("include/dbcon.php");
							if(empty($_SESSION['urCart'])) {
									
							}
							else {	
								$urCart = $_SESSION['urCart'];
								$cartQty = $_SESSION['cartQty'];
							}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title>Nora's Jewelry | Register</title>

	<!-- Included Bootstrap CSS Files -->
	<link rel="stylesheet" href="./js/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./js/bootstrap/css/bootstrap-responsive.min.css" />
	
	<!-- Includes FontAwesome -->
	<link rel="stylesheet" href="./css/font-awesome/css/font-awesome.min.css" />

	<!-- Css -->	
	<link rel="stylesheet" href="./css/style.css" />

</head>
<body>

    <!-- Start Header -->
    <?php
    include'include/header.php';
	?>
    <!-- End Header -->

	<div class="container" style="margin-top:75px;">
		<div class="row">
			<div class="span3">
				<div class="well">

					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-shopping-cart"></i>
								<?php 
									if(!empty($urCart)) {
										$urCart = $_SESSION['urCart'];
										$cartQty = $_SESSION['cartQty'];
										$count = count($urCart);
										$price=0;
										$total=0;
										$qty=0;
										$count_item=0;
										foreach ($urCart as $key => $value) {
											$category = mysql_result(mysql_query("SELECT category FROM tbl_item WHERE item_no='$value'"),0);
											$id = mysql_result(mysql_query("SELECT id FROM tbl_item WHERE item_no='$value'"),0);
											$price = mysql_result(mysql_query("SELECT price FROM tbl_$category WHERE ".$category."_no='$id'"),0);
											$qty = $cartQty[$key];
											$total += intval($price*$qty);
											$count_item += $qty;
										}
											echo $count_item.'item(s) - Php '.$total;
									
									?></b></a>
									<div class="dropdown-menu well" role="menu" aria-labelledby="dLabel">
										<?php 
											foreach ($urCart as $key => $value) {
													$category = mysql_result(mysql_query("SELECT category FROM tbl_item WHERE item_no='$value'"),0);
													$id = mysql_result(mysql_query("SELECT id FROM tbl_item WHERE item_no='$value'"),0);
													$price = mysql_result(mysql_query("SELECT price FROM tbl_$category WHERE ".$category."_no='$id'"),0);
													$name = mysql_result(mysql_query("SELECT name FROM tbl_$category WHERE ".$category."_no='$id'"),0);
													$qty = $cartQty[$key];
													$total = $price*$qty;
												?>
										<p><?php echo substr($name,0,5).'...';?> x <?php echo $cartQty[$key];?> <span class="pull-right"><?php echo 'Php '.$total;?></span></p>
										<?php }
										?>
											<a href="cart.php" class="btn btn-primary">Checkout</a>
											</div>	<?php }
									else {
										echo 'No item'; ?>
										</b></a>
								<?php 	}?>
					</div>

				</div>

				<div class="well">
                	<ul class	="nav nav-list">
						<li class="nav-header" class="dropdown">Store Category</li>
                        
                	<li class="dropdown">
						<?php 
							$sql = mysql_query("SELECT DISTINCT(type) FROM tbl_bracelets") or die(mysql_error());
							$count = mysql_num_rows($sql);
							
							if($count==0) { ?>
								<a href="bracelet.php">
								<!--<i class="icon-shopping-cart"></i>-->
								Bracelets
								</a>
							<?php }
							else {
						?>
						<a class="dropdown-toggle" data-toggle="dropdown">
							<!--<i class="icon-shopping-cart"></i>-->
							Bracelets
							<b class="caret"></b>
							</a>
							<div class="dropdown-menu well" role="menu" aria-labelledby="dLabel">
							<?php
								while($row = mysql_fetch_array($sql)) {
							?>
								<a href="bracelet.php?type=<?php echo $row['type'];?>"><p><?php echo $row['type'];?> Bracelets <!--<span class="pull-right">PHP</span>--></p></a>
							<?php } ?>
						</div>
						<?php } ?>
					</li>
                    
                	<li class="dropdown">
						<?php 
							$sql = mysql_query("SELECT DISTINCT(type) FROM tbl_necklace") or die(mysql_error());
							$count = mysql_num_rows($sql);
							
							if($count==0) { ?>
								<a href="necklace.php">
								<!--<i class="icon-shopping-cart"></i>-->
								Necklaces
								</a>
							<?php }
							else {
						?>
						<a class="dropdown-toggle" data-toggle="dropdown">
							<!--<i class="icon-shopping-cart"></i>-->
							Necklaces
							<b class="caret"></b>
							</a>
							<div class="dropdown-menu well" role="menu" aria-labelledby="dLabel">
							<?php
								while($row = mysql_fetch_array($sql)) {
							?>
								<a href="necklace.php?type=<?php echo $row['type'];?>"><p><?php echo $row['type']?> Necklaces <!--<span class="pull-right">PHP</span>--></p></a>
							<?php } ?>
						</div>
						<?php } ?>
					</li>  
                    
                	<li class="dropdown">
						<?php 
							$sql = mysql_query("SELECT DISTINCT(type) FROM tbl_pendant") or die(mysql_error());
							$count = mysql_num_rows($sql);
							
							if($count==0) { ?>
								<a href="pendants.php">
								<!--<i class="icon-shopping-cart"></i>-->
								Pendants
								</a>
							<?php }
							else {
						?>
						<a class="dropdown-toggle" data-toggle="dropdown">
							<!--<i class="icon-shopping-cart"></i>-->
							Pendants
							<b class="caret"></b>
							</a>
							<div class="dropdown-menu well" role="menu" aria-labelledby="dLabel">
							<?php
								while($row = mysql_fetch_array($sql)) {
							?>
								<a href="pendants.php?type=<?php echo $row['type'];?>"><p><?php echo $row['type']?> Pendants <!--<span class="pull-right">PHP</span>--></p></a>
							<?php } ?>
						</div>
						<?php } ?>
					</li>
                    
                	<li class="dropdown">
												<?php 
							$sql = mysql_query("SELECT DISTINCT(type) FROM tbl_rings") or die(mysql_error());
							$count = mysql_num_rows($sql);
							
							if($count==0) { ?>
								<a href="rings.php">
								<!--<i class="icon-shopping-cart"></i>-->
								Rings
								</a>
							<?php }
							else {
						?>
						<a class="dropdown-toggle" data-toggle="dropdown">
							<!--<i class="icon-shopping-cart"></i>-->
							Rings
							<b class="caret"></b>
							</a>
							<div class="dropdown-menu well" role="menu" aria-labelledby="dLabel">
							<?php
								while($row = mysql_fetch_array($sql)) {
							?>
								<a href="rings.php?type=<?php echo $row['type'];?>"><p><?php echo $row['type']?> Rings <!--<span class="pull-right">PHP</span>--></p></a>
							<?php } ?>
						</div>
						<?php } ?>
					</li> 
                    
                	<li class="dropdown">
												<?php 
							$sql = mysql_query("SELECT DISTINCT(type) FROM tbl_set") or die(mysql_error());
							$count = mysql_num_rows($sql);
							
							if($count==0) { ?>
								<a href="sets.php">
								<!--<i class="icon-shopping-cart"></i>-->
								Jewelry Sets
								</a>
							<?php }
							else {
						?>
						<a class="dropdown-toggle" data-toggle="dropdown">
							<!--<i class="icon-shopping-cart"></i>-->
							Jewelry Sets
							<b class="caret"></b>
							</a>
							<div class="dropdown-menu well" role="menu" aria-labelledby="dLabel">
							<?php
								while($row = mysql_fetch_array($sql)) {
							?>
								<a href="sets.php?type=<?php echo $row['type'];?>"><p><?php echo $row['type']?> Jewelry Sets <!--<span class="pull-right">PHP</span>--></p></a>
							<?php } ?>
						</div>
						<?php } ?>
					</li>                                                                                                    
                    
					
					</ul>
				</div>


				
			</div>

			<div class="span9">
				<?php include("payment2.php"); ?>
	</div>
	
	<hr />
    <!-- Start Footer -->
    <?php
    include'include/footer.php';
	?>
    <!-- End Footer -->		

	<script src="./js/jquery-1.10.0.min.js"></script>
	<script src="./js/bootstrap/js/bootstrap.min.js"></script>
	<script src="./js/holder.js"></script>
	<script src="./js/script.js"></script>
</body>
</html>