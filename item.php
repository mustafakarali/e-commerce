<?php
session_start();
include("include/dbcon.php");

							if(empty($_SESSION['urCart'])) {
									
							}
							else {	
								$urCart = $_SESSION['urCart'];
								$cartQty = $_SESSION['cartQty'];
							}
							
							if(isset($_POST['addToCart'])) {
									$item_no = $_REQUEST['item_no'];
									$number = $_POST['quantity'];
									
								if($number!='') {
									if($number>$_SESSION['stock']){
										echo 'Not enough stock';
									}
									else if(empty($_SESSION['urCart'])) {
										$urCart = array($item_no);
										$qty = array($number);
										$_SESSION['urCart'] = $urCart;
										$_SESSION['cartQty'] = $qty;
									}
									else {	
										$check=0;
										$urCart = $_SESSION['urCart'];
										$cartQty = $_SESSION['cartQty'];
										
										foreach($urCart as $key => $value) {
											if($value==$item_no) {
												$check=1;
												$cartQty[$key] += $number;
											}
										}
										if($check) {
												$_SESSION['cartQty'] = $cartQty; 
										}
										else {
												array_push($urCart, "$item_no");
												array_push($cartQty, "$number");
												$_SESSION['urCart'] = $urCart;
												$_SESSION['cartQty'] = $cartQty;
										}
									}
								}
							} 
							
			else if(isset($_POST['btnReview'])) {
				$review = $_POST['review'];
				
				if(isset($_SESSION['login'])) {
					$memberID = $_SESSION['login'];
					$itemNo = $_REQUEST['item_no'];
					mysql_query("INSERT INTO tbl_review(member_id, item_no, review) VALUES ('$memberID', '$itemNo', '$review')") or die(mysql_error());
				}
				else {
					echo 'Only registered users can leave a comment. Register or Login First.';
				}
			}
			
			else if(isset($_REQUEST['give'])) {
				$itemNo = $_REQUEST['item_no'];
				$memberID = $_SESSION['login'];
				
				if($_REQUEST['give']=='heart') {
					mysql_query("INSERT INTO tbl_wish(member_id, item_no) VALUES ('$memberID', '$itemNo')") or die(mysql_error());
					header("Location: item.php?item_no=$itemNo");
				}
				else if($_REQUEST['give']=='star') {
					mysql_query("INSERT INTO tbl_star(item_no, member_id) VALUES ('$itemNo', '$memberID')") or die(mysql_error());
					header("Location: item.php?item_no=$itemNo");
				}
			}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title>Nora's Jewelry | Item</title>

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
<?php
    include'include/login.php';
	?>
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
									?>
								<b class="caret"></b></a>
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
							
							<?php } ?>
							<a href="cart.php" class="btn btn-primary">Checkout</a>
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
					</ul>
				</div>				
			</div>
			
			<div class="span9">
				<form action="" method="post">
				<div class="row">
					<div class="span5">
						<div id="items-carousel" class="carousel slide mbottom0">
							<div class="carousel-inner">
								<div class="active item">
								<?php 
									$item_no = $_REQUEST['item_no'];
									$category = mysql_result(mysql_query("SELECT category FROM tbl_item WHERE item_no='$item_no'"),0);
									$id = mysql_result(mysql_query("SELECT id FROM tbl_item WHERE item_no='$item_no'"),0);
									$sql = mysql_query("SELECT * FROM tbl_$category WHERE ".$category."_no='$id'") or die(mysql_error());
									while($row = mysql_fetch_array($sql)) {
										$path = $row['path'];
										$name = $row['name'];
										$desc = $row['description'];
										$price = $row['price'];
										$type = $row['type'];
										$stock = $row['stock'];
										$_SESSION['stock'] = $stock;
									}
									$src = "products/$category/";
								?>
									<img  class="media-object" src="<?php echo $src.''.$path?>" alt="" width="270px" />
								</div>
							</div>
						</div>
					</div>

					<div class="span4">
						<h4><?php echo $name;?></h4>
						<h5><?php echo $type;?></h5>
						<p><?php echo $desc;?></p>
						<h4>PHP <?php echo $price;?></h4>
						<h5><?php if($stock==0) { echo "Not available"; } else { echo "Stock: $stock"; }  ?></h5>
						<h5>Options</h5>
							<label>
								<input type="text" id="quantity" name="quantity" value="1" class="span1" />&nbsp;Qty
							</label>
							<button type="submit" name="addToCart" class="btn btn-primary">Add to Cart</button><br><br><br>
						<?php 
							if(isset($_SESSION['login'])) { $check = mysql_result(mysql_query("SELECT COUNT(*) FROM tbl_wish WHERE member_id='$memberID' AND item_no='$item_no'"),0);
							echo "<i class=\"icon-heart\"></i>";
						if($check) {?> Added to wishlist <br>
						<?php } else {
						?> <a href="item.php?item_no=<?php echo $_REQUEST['item_no']; ?>&give=heart"> Add to wishlist</a><br>
						<?php }
							} else {
						?> <i class="icon-heart"></i> <a href="#myModal" data-toggle="modal"> Add to wishlist</a><br>
						<?php }
						
							if(isset($_SESSION['login'])) { $check = mysql_result(mysql_query("SELECT COUNT(*) FROM tbl_star WHERE member_id='$memberID' AND item_no='$item_no'"),0);
							?> <i class="icon-star"></i> <span class="badge badge-inverse"> <?php
							$stars= mysql_result(mysql_query("SELECT count(*) FROM tbl_star WHERE item_no='$item_no'"),0);
							echo $stars; ?> </span>
						<?php if($check) {?> Liked
						<?php } else { ?>
							<a href="item.php?item_no=<?php echo $_REQUEST['item_no']; ?>&give=star">
						 Like</a> <?php } 
								} else {
						?> <i class="icon-star"></i> <span class="badge badge-inverse"> <?php
							$stars= mysql_result(mysql_query("SELECT count(*) FROM tbl_star WHERE item_no='$item_no'"),0);
							echo $stars; ?> </span><a href="#myModal" data-toggle="modal"> Like</a><br>
						<?php } ?>
					</div>
				</div>

				<div class="row">
					<div class="span9">
						<ul class="nav nav-tabs" id="tabs">
							<li><a href="#reviews"><span class="badge badge-inverse"><?php echo  mysql_result(mysql_query("SELECT count(*) FROM tbl_review WHERE item_no=".$_REQUEST['item_no'].""),0)?></span> Review(s)</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="reviews">
								<?php
									$sql = mysql_query("SELECT m.first_name, m.last_name, r.review FROM tbl_review r, tbl_members m WHERE r.item_no=".$_REQUEST['item_no']." AND r.member_id=m.member_id") or die(mysql_error());
									
									while($row = mysql_fetch_array($sql)) { ?>
										<b><?php echo $row['first_name'].' '.$row['last_name'].':'?></b>
										<?php echo $row['review'];?>
										<hr>
									<?php }
								?>
								
								Comment:
								<textarea name="review"></textarea><br>
								<button type="submit" name="btnReview" class="btn btn-primary">Submit</button>
							</div>
					</div>
				</div>
			</div>
		</form>
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