<?php
session_start();
include("include/dbcon.php");

							if(empty($_SESSION['urCart'])) {
							}
							else {	
								$urCart = $_SESSION['urCart'];
								$cartQty = $_SESSION['cartQty'];
							}
							
		
	if(isset($_REQUEST['action'])) {
			if($_REQUEST['action']==2) {
				$deleteID = $_REQUEST['item'];
				
				foreach($urCart as $key => $value) {
					if($deleteID==$key) {
						unset($urCart["$key"]);	
						unset($cartQty["$key"]);
						
						$_SESSION['urCart'] = $urCart;
						$_SESSION['cartQty'] = $cartQty;
					}
				}
			}
		}
				if(isset($_SESSION['urCart'])) {foreach($urCart as $key => $value) {
					if(isset($_POST["btnUpdate$key"])) {
						$qty = $_POST['quantity-1'];
						$cartQty["$key"] = $qty;
						$_SESSION['cartQty'] = $cartQty;
					}
				}
				}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title>Nora's Jewelry | Cart</title>

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
										$count = count($urCart);
										$price=0;
										$total=0;
										$qty=0;
										foreach ($urCart as $key => $value) {
											$category = mysql_result(mysql_query("SELECT category FROM tbl_item WHERE item_no='$value'"),0);
											$id = mysql_result(mysql_query("SELECT id FROM tbl_item WHERE item_no='$value'"),0);
											$price = mysql_result(mysql_query("SELECT price FROM tbl_$category WHERE ".$category."_no='$id'"),0);
											$qty = $cartQty[$key];
											$total += intval($price*$qty);
										}
											echo $count.'item(s) - Php '.$total;
									
									?></b></a>
						</a>
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
							
							<?php }?>
							<a href="#" class="btn btn-primary">Checkout</a>
						</div><?php 
						}
									else {
										echo 'No item';
									}?>
					</div>
					
				</div>

				<div class="well">
					<ul class="nav nav-list">
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
							$sql = mysql_query("SELECT DISTINCT(type) FROM tbl_earrings") or die(mysql_error());
							$count = mysql_num_rows($sql);
							
							if($count==0) { ?>
								<a href="earrings.php">
								<!--<i class="icon-shopping-cart"></i>-->
								Earrings
								</a>
							<?php }
							else {
						?>
						<a class="dropdown-toggle" data-toggle="dropdown">
							<!--<i class="icon-shopping-cart"></i>-->
							Earrings
							<b class="caret"></b>
							</a>
							<div class="dropdown-menu well" role="menu" aria-labelledby="dLabel">
							<?php
								while($row = mysql_fetch_array($sql)) {
							?>
								<a href="earrings.php?type=<?php echo $row['type'];?>"><p><?php echo $row['type']?> Earrings <!--<span class="pull-right">PHP</span>--></p></a>
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
				<h2>Shopping Cart</h2>
				<form action="" method="post" id="updateCart">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th colspan="2">Product</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					<?php 
										$subTotal=0;
									if(!empty($urCart)) {
										$urCart = $_SESSION['urCart'];
										$count = count($urCart);
										$price=0;
										$total=0;
										$qty=0;
										foreach ($urCart as $key => $value) {
											$category = mysql_result(mysql_query("SELECT category FROM tbl_item WHERE item_no='$value'"),0);
											$id = mysql_result(mysql_query("SELECT id FROM tbl_item WHERE item_no='$value'"),0);
											$sql = mysql_query("SELECT * FROM tbl_$category WHERE ".$category."_no='$id'") or die(mysql_error());
											while($row = mysql_fetch_array($sql)) {
												$qty = $cartQty[$key];
												$price = $row['price'];
												$total += intval($price*$qty); 
												$subTotal += $total;?>
											
											<tr>
												<td><img src="products/<?php echo $category.'/'.$row['path']; ?>" width="50px" height="50px"></img></td>
												<td><?php echo $row['name']; ?></td>
												<td><input id="quantity-1" name="quantity-1" type="text" class="span1" value="<?php echo $qty;?>" />&nbsp;<button type="submit" name="btnUpdate<?php echo $key;?>"><i class="icon-refresh"></i></button><a href="cart.php?action=2&item=<?php echo $key;?>"><i class="icon-trash"></i></a></td>
												<td><?php echo 'Php '.$row['price'];?></td>
												<td><?php echo 'Php '.$total;?></td>
											</tr>
											
										<?php }
										}
									}
									else { 
										unset($_SESSION['urCart']);
										unset($_SESSION['cartQty']);?>
										<tr>
												<td colspan="4">No item in your Cart</td>
											</tr>
									<?php }
									?>
					</tbody>
				</table>
			</form>

			<dl class="dl-horizontal pull-right">
				<?php 
					if(isset($_SESSION['urCart'])) {
				?>
				<dt>Sub-total:</dt>
				<dd><?php echo 'Php '.$subTotal;?></dd>
				<?php
					if(isset($_SESSION['login'])) {
					$sql = mysql_result(mysql_query("SELECT count(*) FROM tbl_order WHERE member_id='$memberID'"),0);
					if(!$sql) { 
						$subTotal = $subTotal - 500;?>
						<dt>Reg. Discount:</dt>
						<dd>Php 500</dd>
					<?php }
					}
						$dis_no = floor($subTotal/10000);
						$total_dis = $subTotal*(0.05*$dis_no);
						$subTotal = $subTotal-$total_dis;?>
						<dt>Discount:</dt>
						<dd>Php <?php echo $total_dis; ?></dd>

				<dt>Total:</dt>
				<dd><?php echo 'Php '.$subTotal;
						$_SESSION['subTotal'] = $subTotal;?></dd>
				<?php } ?>
			</dl>
			<div class="clearfix"></div>
			<a href="checkout.php" class="btn btn-success pull-right">Check out</a>
			<a href="index.php" class="btn btn-primary">Continue Shopping</a>
		</div>
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