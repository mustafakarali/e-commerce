<?php
session_start();
include("include/dbcon.php");
if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {	
							if(empty($_SESSION['urCart'])) {
									
							}
							else {	
								$urCart = $_SESSION['urCart'];
								$cartQty = $_SESSION['cartQty'];
							}
	$memberID = $_SESSION['login'];
	$sql = mysql_query("Select * from tbl_members WHERE member_id='$memberID'");
	while($row=mysql_fetch_array($sql))
	{
		$fname = $row['first_name'];
		$lname = $row['last_name'];
		$email = $row['email'];
		$add = $row['address'];
		$city = $row['city'];
		$region = $row['region'];
		$country = $row['country'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title>Nora's Jewelry | Profile</title>

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
				<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:0px;">
                <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                <li><a href="#wishlist" data-toggle="tab">Wishlist</a></li>
                <li><a href="#curorder" data-toggle="tab">Current Orders</a></li> 
                <li><a href="#hisorder" data-toggle="tab">History of Orders</a></li>
				
			</ul>
              <div id="myTabContent" class="tab-content">
			  <!-- start profile -->
                <div class="tab-pane fade active in" id="profile">
					
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Profile</h5></div>
                                    <div class="pull-right"><a href="editProfile.php">
                                      <button class="btn" style="margin-bottom:5px;"> Edit Profile</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table>
                                            <tr>
												<td>First Name: </td>
												<td>&nbsp;</td>
												<td><input type="text" value="<?php echo $fname ?>" readonly /></td>
                                            </tr>
											<tr>
												<td>Last Name: </td>
												<td>&nbsp;</td>
												<td><input type="text" value="<?php echo $lname ?>" readonly /></td>
                                            </tr>
											<tr>
												<td>Email: </td>
												<td>&nbsp;</td>
												<td><input type="text" value="<?php echo $email ?>" readonly /></td>
                                            </tr>
											<tr>
												<td>Address: </td>
												<td>&nbsp;</td>
												<td><input type="text" value="<?php echo $add ?>" readonly /></td>
                                            </tr>
											<tr>
												<td>City: </td>
												<td>&nbsp;</td>
												<td><input type="text" value="<?php echo $city ?>" readonly /></td>
                                            </tr>
											<tr>
												<td>Region: </td>
												<td>&nbsp;</td>
												<td><input type="text" value="<?php echo $region ?>" readonly /></td>
                                            </tr>
											<tr>
												<td>Country: </td>
												<td>&nbsp;</td>
												<td><input type="text" value="<?php echo $country ?>" readonly /></td>
                                            </tr>
                                        
                                    </table>
                                </div>
                            </div>
				</p>
                </div>
			  <!-- end profile -->
			  
			  <!-- start wishlist -->
                <div class="tab-pane fade" id="wishlist">
					
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Wishlist</h5></div>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th>Receipt Number</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$memberID = $_SESSION['login'];
													$category = mysql_query("SELECT i.category, i.id, i.item_no FROM tbl_item i, tbl_wish w WHERE w.member_id='$memberID' AND w.item_no=i.item_no") or die(mysql_error());
													while($row = mysql_fetch_array($category)) {
														$cat = $row['category'];
														$id = $row['id'];
														$itemNo = $row['item_no'];
														$sql = mysql_query("SELECT * FROM tbl_$cat  WHERE ".$cat."_no='$id'") or die(mysql_error());
														while($row = mysql_fetch_object($sql))
														{
															echo "<tr>";
															echo "<td> <a href=\"item.php?item_no=$itemNo\">" . $row->name . "</a></td>";
															echo "<td align='center'>" . "<img border=\"0\" src=\"products/$cat/".$row->path."\" width=\"75\" height=\"75\">" . "</td>";
															echo "<td>" . $row->price . "</td>";
															echo "</tr>";
														}
													}
													
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
				</p>
                </div>
			  <!-- end wishlist -->
			  
			  <!-- start curorder -->
                <div class="tab-pane fade" id="curorder">
					
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Current Orders</h5></div>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th>Transaction Code</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$memberID = $_SESSION['login'];
													$sql = mysql_query("SELECT * FROM tbl_order WHERE member_id='$memberID' AND status='Pending'") or die(mysql_error());
													while($row=mysql_fetch_object($sql)) {
															echo "<tr>";
															echo "<td>" . $row->payment_code . "</td>";
															echo "<td>" . $row->date . "</td>";
															echo "<td>" . $row->amount . "</td>";
															echo "<td>" . $row->status . "</td>";
															echo "</tr>";
														}
													
													
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
				</p>
                </div>
			  <!-- end curorder -->
			  
			  <!-- start hisorder -->
                <div class="tab-pane fade" id="hisorder">
					
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>History of Orders</h5></div>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th>Receipt Number</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$memberID = $_SESSION['login'];
													$sql = mysql_query("SELECT * FROM tbl_order WHERE member_id='$memberID' AND action='Completed'") or die(mysql_error());
													while($row=mysql_fetch_object($sql)) {
															echo "<tr>";
															echo "<td>" . $row->receipt . "</td>";
															echo "<td>" . $row->date . "</td>";
															echo "<td>" . $row->amount . "</td>";
															echo "<td>" . $row->action . "</td>";
															echo "</tr>";
														}
													
													
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
				</p>
                </div>
			  <!-- end hisorder -->
			  
			</div>
	</div>

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
<?php } ?>