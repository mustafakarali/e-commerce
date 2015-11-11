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
	if(isset($_POST['submit']))
{
$a = $_POST['fname'];
$b = $_POST['lname'];
$c = $_POST['email'];
$d= $_POST['address'];
$e = $_POST['city'];
$f = $_POST['region'];
$g = $_POST['country'];
		
		if(empty($a) || empty($b) || empty($c) || empty($d) || empty($e) || empty($f) || empty($g))
		{
			echo "";
		}
		
		else if(!preg_match('/^[A-Za-z\s]+$/',$a))
		{
			echo "";
		}
		
		else if(!preg_match('/^[A-Za-z\s]+$/',$b))
		{
			echo "";
		}
		
		else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$c))
		{
			echo "";
		}
		
		else{
		$a = $_POST['fname'];
$b = $_POST['lname'];
$c = $_POST['email'];
$d= $_POST['address'];
$e = $_POST['city'];
$f = $_POST['region'];
$g = $_POST['country'];
$memberID = $_SESSION['login'];
		
		$acsql =	mysql_query("UPDATE tbl_members SET first_name='$a',last_name='$b',email='$c',address='$d',city='$e',region='$f',country='$g' WHERE member_id='$memberID'")
								or die (mysql_error(). "Can't Update :( ");
		header("Location:profile.php");
		}
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
              <div id="myTabContent" class="tab-content">
			  <!-- start profile -->          
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Edit Profile</h5></div>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <div class="block-content collapse in">
								<form method="post" action="">
                                    <table>
                                            <tr>
												<td>First Name: </td>
												<td>&nbsp;</td>
												<td><input type="text" name="fname" value="<?php echo $fname ?>" required/></td>
												<td><?php
                            if(isset($_POST['submit'])){
                                $first = $_POST['fname'];
                                
                                if(!preg_match('/^[A-Za-z\s]+$/',$first)){
                                    echo "<script>alert (\"Cannot Contain Numbers or Special Characters!!\")</script>";
                                }
                            }
                    ?></td>
                                            </tr>
											<tr>
												<td>Last Name: </td>
												<td>&nbsp;</td>
												<td><input type="text" name="lname" value="<?php echo $lname ?>" required/></td>
												<td><?php
                            if(isset($_POST['submit'])){
                                $last = $_POST['lname'];
                                
                               if(!preg_match('/^[A-Za-z\s]+$/',$last)){
                                    echo "<script>alert (\"Cannot Contain Numbers or Special Characters!!\")</script>";
                                }
                            }
                ?>
            </td>
                                            </tr>
											<tr>
												<td>Email: </td>
												<td>&nbsp;</td>
												<td><input type="text" name="email" value="<?php echo $email ?>" required/></td>
												<td><?php
                            if(isset($_POST['submit'])){

                                $email = $_POST['email'];
                                $query_search = "select * from tbl_members where email= '".$email."'";
                                $query_exec = mysql_query($query_search) or die(mysql_error());
                                $rows = mysql_num_rows($query_exec);
  
                                if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email)){
                                    echo "<script>alert (\"Invalid Email Address!!\")</script>";
                                }
                            }
                ?>
                
            </td>
                                            </tr>
											<tr>
												<td>Address: </td>
												<td>&nbsp;</td>
												<td><input type="text" name="address" value="<?php echo $add ?>" required/></td>
                                            </tr>
											<tr>
												<td>City: </td>
												<td>&nbsp;</td>
												<td><input type="text" name="city" value="<?php echo $city ?>" required/></td>
                                            </tr>
											<tr>
												<td>Region: </td>
												<td>&nbsp;</td>
												<td><input type="text" name="region" value="<?php echo $region ?>" required/></td>
                                            </tr>
											<tr>
												<td>Country: </td>
												<td>&nbsp;</td>
												<td><input type="text" name="country" value="<?php echo $country ?>" required/></td>
                                            </tr>
											
                                            </tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td><button type="submit" name="submit" class="btn btn-primary">Update</button>
												<button type="reset" class="btn">Cancel</button></td>
                                            </tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
                                            </tr>
											
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
                                            </tr>
                                    </table>
									</form>
                                </div>
                            </div>
			  <!-- end profile -->
<?php

?>			  
			  
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