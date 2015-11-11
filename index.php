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
	<title>Nora's Jewelry</title>

	<!-- Included Bootstrap CSS Files -->
	<link rel="stylesheet" href="./js/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./js/bootstrap/css/bootstrap-responsive.min.css" />
	
	<!-- Includes FontAwesome -->
	<link rel="stylesheet" href="./css/font-awesome/css/font-awesome.min.css" />

	<!-- Css -->	
	<link rel="stylesheet" href="./css/style.css" />
	
    <!-- Bootstrap -->
    <link href="slider/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="slider/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Bootslider -->
    <link href="slider/css/bootslider.css" rel="stylesheet">
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
											<a href="cart.php" class="btn btn-primary">Checkout
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


				<!---<div class="well">
					<form class="form login-form">
						<h2>Sign in</h2>
						<div>
							<label>Username</label>
							<input id="Username" name="Username" type="text" />

							<label>Password</label>
							<input id="Password" name="Password" type="password" />

							<label class="checkbox inline">
								<input type="checkbox" id="RememberMe" value="option1"> Remember me
							</label>

							<br /><br />

							<button type="submit" class="btn btn-success">Login</button>
						</div>
						<br />
						<a href="#">register</a>&nbsp;&#124;&nbsp;<a href="#">forgot password?</a>
					</form>
				</div>-->
			</div>

			<div class="span9">
				<div class="">
      <div id="slider-fluid-banner" class="carousel slide">
        <div class="carousel-inner">
          <div class="active item">
            <img src="slider/img/banner.png" alt="Mountain view">
			</div>
          <div class="item">
            <img src="slider/img/banner1.png" alt="Mountain view">
          </div>
          <div class="item">
            <img src="slider/img/banner2.png" alt="Mountain view">
          </div>
          <div class="item">
            <img src="slider/img/banner3.png" alt="Mountain view">
          </div>		  
        </div>
        <a class="left carousel-control" href="#slider-fluid-banner" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#slider-fluid-banner" data-slide="next">&rsaquo;</a>
      </div>
			</div>


				<ul class="thumbnails">
								<?php 
									$sql = mysql_query("SELECT * FROM tbl_bracelets ORDER BY bracelets_no DESC LIMIT 1") or die(mysql_error());
									while($row = mysql_fetch_array($sql)) {
										$path = "products/bracelets/";
										$file = $row['path'];
										$name = $row['name'];
										$id = $row['bracelets_no'];
										$item_no = mysql_result(mysql_query("SELECT item_no FROM tbl_item WHERE category='bracelets' AND id='$id'"),0);
									
								?>
					<li class="span3">
						<div class="thumbnail">
							<img src="<?php echo $path.''.$file;?>" alt="" width="200px" height="200px">
							<div class="caption">
								<h4><a href="bracelet.php"><?php echo $name;?></a></h4>
							</div>
						</div>
					</li>
					<?php } ?><?php 
									$sql = mysql_query("SELECT * FROM tbl_necklace ORDER BY necklace_no DESC LIMIT 1") or die(mysql_error());
									while($row = mysql_fetch_array($sql)) {
										$path = "products/necklace/";
										$file = $row['path'];
										$name = $row['name'];
										$id = $row['necklace_no'];
										$item_no = mysql_result(mysql_query("SELECT item_no FROM tbl_item WHERE category='necklace' AND id='$id'"),0);
									
								?>
					<li class="span3">
						<div class="thumbnail">
								
							<img src="<?php echo $path.''.$file;?>" alt="" width="200px" height="200px">
							<div class="caption">
								<h4><a href="necklace.php"><?php echo $name;?></a></h4>
							</div>
						</div>
					</li>
					<?php } ?>
								<?php 
									$sql = mysql_query("SELECT * FROM tbl_earrings ORDER BY earrings_no DESC LIMIT 1") or die(mysql_error());
									while($row = mysql_fetch_array($sql)) {
										$path = "products/earrings/";
										$file = $row['path'];
										$name = $row['name'];
										$id = $row['earrings_no'];
										$item_no = mysql_result(mysql_query("SELECT item_no FROM tbl_item WHERE category='earrings' AND id='$id'"),0);
									
								?>
					<li class="span3">
						<div class="thumbnail">
							<img src="<?php echo $path.''.$file;?>" alt="" width="200px" height="200px">
							<div class="caption">
								<h4><a href="earrings.php"><?php echo $name;?></a></h4>
							</div>
						</div>
					</li>
					<?php } 
									$sql = mysql_query("SELECT * FROM tbl_pendant ORDER BY pendant_no DESC LIMIT 1") or die(mysql_error());
									while($row = mysql_fetch_array($sql)) {
										$path = "products/pendant/";
										$file = $row['path'];
										$name = $row['name'];
										$id = $row['pendant_no'];
										$item_no = mysql_result(mysql_query("SELECT item_no FROM tbl_item WHERE category='pendant' AND id='$id'"),0);
									
								?>
					<li class="span3">
						<div class="thumbnail">
							<img src="<?php echo $path.''.$file;?>" alt="" width="200px" height="200px">
							<div class="caption">
								<h4><a href="pendant.php"><?php echo $name;?></a></h4>
							</div>
						</div>
					</li>
							<?php } 
									$sql = mysql_query("SELECT * FROM tbl_rings ORDER BY rings_no DESC LIMIT 1") or die(mysql_error());
									while($row = mysql_fetch_array($sql)) {
										$path = "products/rings/";
										$file = $row['path'];
										$name = $row['name'];
										$id = $row['rings_no'];
										$item_no = mysql_result(mysql_query("SELECT item_no FROM tbl_item WHERE category='rings' AND id='$id'"),0);
									
								?>
					<li class="span3">
						<div class="thumbnail">
								
							<img src="<?php echo $path.''.$file;?>" alt="" width="200px" height="200px">
							<div class="caption">
								<h4><a href="rings.php"><?php echo $name;?></a></h4>
							</div>
							
						</div>
					</li><?php }
									$sql = mysql_query("SELECT * FROM tbl_set ORDER BY set_no DESC LIMIT 1") or die(mysql_error());
									while($row = mysql_fetch_array($sql)) {
										$path = "products/set/";
										$file = $row['path'];
										$name = $row['name'];
										$id = $row['set_no'];
										$item_no = mysql_result(mysql_query("SELECT item_no FROM tbl_item WHERE category='set' AND id='$id'"),0);
									
								?>
					<li class="span3">
						<div class="thumbnail">
								
							<img src="<?php echo $path.''.$file;?>" alt="" width="200px" height="200px">
							<div class="caption">
								<h4><a href="set.php"><?php echo $name;?></a></h4>
							</div>
							
						</div>
					</li><?php }?>
				</ul>

			</div>
		</div>
	</div>
	
	<hr>
    <!-- Start Footer -->
    <?php
    include'include/footer.php';
	?>
    <!-- End Footer -->		
	

    <script type="text/javascript" src="slider/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="slider/js/bootslider.js"></script>

	<script src="./js/jquery-1.10.0.min.js"></script>
	<script src="./js/bootstrap/js/bootstrap.min.js"></script>
	<script src="./js/holder.js"></script>
	<script src="./js/script.js"></script>

    
</body>
</html>