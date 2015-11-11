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
	<title>Nora's Jewelry | Earrings</title>
	
	<script language="javascript">
		function SelectRedirect(){
		// ON selection of section this function will work
		//alert( document.getElementById('s1').value);

			switch(document.getElementById('type').value)
			{
				case "All":
				window.location="rings.php?type=All";
				break;

				case "South Sea Pearl":
				window.location="rings.php?type=South Sea Pearl";
				break;

				case "Fresh Water Pearl":
				window.location="rings.php?type=Fresh Water Pearl";
				break;
			}// end of switch 
		}
		////////////////// 
		function SelectPrice(){
		// ON selection of section this function will work
					var url = document.URL;
					var range_check = /[?&]type=([^&]+)/i;
					var match = range_check.exec(url);
					if (match != null) {
						range = 'type=' + match[1];
					} else {
						range = "type=All";
					}
					
			switch(document.getElementById('price').value)
			{
				case "a":
					window.location = "rings.php?" + range + "&range=a";
				break;
				
				case "b":
					window.location = "rings.php?" + range + "&range=b";
				break;
				
				case "c":
					window.location = "rings.php?" + range + "&range=c";
				break;
				
				case "d":
					window.location = "rings.php?" + range + "&range=d";
				break;
				
				case "e":
					window.location = "rings.php?" + range + "&range=e";
				break;
				
				case "f":
					window.location = "rings.php?" + range + "&range=f";
				break;

			}// end of switch 
		}
	</script>
	
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
				<form action="" method="post">
					<h4>Types</h4>
						<select id="type" name="type" onChange="SelectRedirect();">
							<option value="All" <?php if(isset($_REQUEST['type'])){ if($_REQUEST['type'] =="All"){echo "selected=\"selected\""; } }?>>All
							<option value="South Sea Pearl" <?php if(isset($_REQUEST['type'])){ if($_REQUEST['type']=="South Sea Pearl"){ echo "selected=\"selected\""; } } ?>>South Sea Pearl
							<option value="Fresh Water Pearl" <?php if(isset($_REQUEST['type'])) { if($_REQUEST['type']=="Fresh Water Pearl") { echo "selected=\"selected\""; } }?>>Fresh Water Pearl
						</select>
						<hr>
					<h4>Price</h4>           
						<select id="price" name="price" onChange="SelectPrice();">
							<option value="a" <?php if(isset($_REQUEST['range'])) { if($_REQUEST['range'] == "a") {?> selected="selected"<?php } }?>>All
							<option value="b" <?php if(isset($_REQUEST['range'])) { if($_REQUEST['range'] == "b") { ?> selected="selected"<?php } }?>>PHP 1-1000
							<option value="c" <?php if(isset($_REQUEST['range'])) { if($_REQUEST['range'] == "c") { ?> selected="selected"<?php } }?>>PHP 1001-2500
							<option value="d" <?php if(isset($_REQUEST['range'])) { if($_REQUEST['range'] == "d") { ?> selected="selected"<?php } }?>>PHP 2501-5000
							<option value="e" <?php if(isset($_REQUEST['range'])) { if($_REQUEST['range'] == "e") { ?> selected="selected"<?php } }?>>PHP 5001-10000
							<option value="f" <?php if(isset($_REQUEST['range'])) { if($_REQUEST['range'] == "f") { ?> selected="selected"<?php } }?>>PHP 10001-50000
						</select>
					</form>
				</div>

			</div>

		  <div class="span9">


				<ul class="thumbnails">
					<?php
						if(isset($_REQUEST['type']) && $_REQUEST['type']!='All') {
							$where = $_REQUEST['type'];
							if(isset($_REQUEST['range']) && $_REQUEST['range']!='a') {
								if($_REQUEST['range']=='b') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE type='$where' AND price >= 1 and price <= 1000") or die(mysql_error());
								}
								else if($_REQUEST['range']=='c') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE type='$where' AND price >= 1001 and price <= 2500") or die(mysql_error());
								}
								else if($_REQUEST['range']=='d') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE type='$where' AND price >= 2501 and price <= 5000") or die(mysql_error());
								}
								else if($_REQUEST['range']=='e') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE type='$where' AND price >= 5001 and price <= 10000") or die(mysql_error());
								}
								else if($_REQUEST['range']=='f') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE type='$where' AND price >= 10001 and price <= 50000") or die(mysql_error());
								}
							}
							else {
								$sql = mysql_query("SELECT * FROM tbl_rings WHERE type='$where'") or die(mysql_error());
							}
						}
						else {
							if(isset($_REQUEST['range']) && $_REQUEST['range']!='a') {
								if($_REQUEST['range']=='b') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE price >= 1 and price <= 1000") or die(mysql_error());
								}
								else if($_REQUEST['range']=='c') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE price >= 1001 and price <= 2500") or die(mysql_error());
								}
								else if($_REQUEST['range']=='d') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE price >= 2501 and price <= 5000") or die(mysql_error());
								}
								else if($_REQUEST['range']=='e') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE price >= 5001 and price <= 10000") or die(mysql_error());
								}
								else if($_REQUEST['range']=='f') {
									$sql = mysql_query("SELECT * FROM tbl_rings WHERE price >= 10001 and price <= 50000") or die(mysql_error());
								}
							}
							else {
								$sql = mysql_query("SELECT * FROM tbl_rings") or die(mysql_error());
							}
						}
						while($row = mysql_fetch_array($sql))
						{	
							$id = $row['rings_no'];
							$item_no = mysql_result(mysql_query("SELECT item_no FROM tbl_item WHERE category='rings' AND id='$id'"),0);
							$src = 'products/rings/';
							$path = $row['path'];
							$price = $row['price'];
							$name = $row['name'];
							$_SESSION['item_no'] = $item_no;
					?>
					<li class="span3">
						<div class="thumbnail">
							<img src="<?php echo "$src$path"; ?>" alt="" width="200px" height="200px">
							<div class="caption">
								<h4><?php echo $name; ?></h4>
								<p><?php echo 'Php'.$price ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a class="btn btn-primary" href="item.php?item_no=<?php echo $item_no;?>">View</a></p>
							</div>
						</div>
					</li>
					<?php
					}
					?>
				</ul>

			<!--<div class="pagination">
					<ul>
						<li class"disabled"><span>Prev</span></li>
						<li class"disabled"><span>1</span></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">Next</a></li>
					</ul>
			  </div>-->

			</div>
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