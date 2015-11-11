<?php
session_start();
include("include/dbcon.php");
date_default_timezone_set('Etc/GMT+8'); 
?>
<?php 
						if(!isset($_SESSION['urCart'])) {
							echo "No items in your cart.";
						}
						
						if(isset($_POST['btnLogin'])) {
							$emailadd = $_POST['email'];
							$pass = md5($_POST['password']);
							
							if($emailadd=='') {
							}
							else if($pass=='') {
							}
							else {
								$myQuery = mysql_query("SELECT * FROM tbl_members  WHERE email='$emailadd' AND password='$pass'")
									   or die(mysql_error());
								if(mysql_num_rows($myQuery) >0) {
									while($row = mysql_fetch_array($myQuery)) {
										if($row['status']==0) {
											echo 'Your account is not yet verified.Verify first your  account';
										}
										else {
											$_SESSION['login']=$row['member_id'];
										}
									}
								}
								else {
									echo "Invalid Account";
								}
								
							}	
						}
						else if(isset($_POST['btnShipping'])) {
							$_SESSION['method']=1;
							$fname = $_POST['fname'];
							$lname = $_POST['lname'];
							$emailadd = $_POST['emailadd'];
							$address = $_POST['add'];
							$country = $_POST['country'];
							$region = $_POST['region'];
							$city = $_POST['city'];
							$_SESSION['fname'] = $fname;
							$_SESSION['lname'] = $lname;
							$_SESSION['emailadd'] = $emailadd;
							$_SESSION['country'] = $country;
							$_SESSION['region'] = $region;
							$_SESSION['city'] = $city;
							$_SESSION['add'] = $address;
						}
						else if(isset($_POST['btnPayment'])){
							$type = $_REQUEST['payment'];

							function isToken($token)
							{
								if (isset($token) && $token) {

									//verification values in BD
									$query = "SELECT payment_code FROM tbl_order WHERE payment_code='$token'";
									$sql = mysql_query($query);
									if (mysql_num_rows($sql) > 0) {
										return true;
									} else {
										return false;
									}
								} else {
									return false;
								}
							}

							function generateUniqueToken($number)
							{
								$arr = array('a', 'b', 'c', 'd', 'e', 'f',
											 'g', 'h', 'i', 'j', 'k', 'l',
											 'm', 'n', 'o', 'p', 'r', 's',
											 't', 'u', 'v', 'x', 'y', 'z',
											 'A', 'B', 'C', 'D', 'E', 'F',
											 'G', 'H', 'I', 'J', 'K', 'L',
											 'M', 'N', 'O', 'P', 'R', 'S',
											 'T', 'U', 'V', 'X', 'Y', 'Z',
											 '1', '2', '3', '4', '5', '6',
											 '7', '8', '9', '0');
								$token = "";
								for ($i = 0; $i < $number; $i++) {
									$index = rand(0, count($arr) - 1);
									$token .= $arr[$index];
								}

								if (isToken($token)) {
									return generateUniqueToken($number);
								} else {
									return $token;
								}
							}

							$memberID = $_SESSION['login'];
							$fname = $_SESSION['fname'];
							$lname = $_SESSION['lname'];
							$emailadd = $_SESSION['emailadd'];
							$address = $_SESSION['add'];
							$country = $_SESSION['country'];
							$region = $_SESSION['region'];
							$city = $_SESSION['city'];
							$date = date("Y-m-d");

							$urCart = $_SESSION['urCart'];
							$cartQty = $_SESSION['cartQty'];
							$price=0;
							$total=0;
							$qty=0;
							$items='';
							$quan='';
							$count = count($urCart);

							if($type=='paypal'){

							foreach ($urCart as $key => $value) {
											$category = mysql_result(mysql_query("SELECT category FROM tbl_item WHERE item_no='$value'"),0);
											$id = mysql_result(mysql_query("SELECT id FROM tbl_item WHERE item_no='$value'"),0);
											$price = mysql_result(mysql_query("SELECT price FROM tbl_$category WHERE ".$category."_no='$id'"),0);
											$stock = mysql_result(mysql_query("SELECT stock FROM tbl_$category WHERE ".$category."_no='$id'"),0);
											$qty = $cartQty[$key];
											$remain = $stock - $qty;
											mysql_query("UPDATE tbl_$category SET stock='$remain' WHERE ".$category."_no='$id'") or die(mysql_error());
								if($count==1) {
									$items = $value;
									$quan = $qty;
								}
								else if($count>=$key) {
									if($key==0) {
										$items = $value;
										$quan = $qty;
										$_SESSION['q'] = $quan; 
									}
									else {
										$items = $items.','.$value;
										$q = $quan + $qty;
										$quan = $quan.','.$qty;
										$_SESSION['q'] = $q;
									}
								}
							}
								$total = $_SESSION['subTotal'];
								$uniqueToken = generateUniqueToken(20);
						
								//echo $memberID.','.$items.','.$quan.','.$total.','.$country.','.$address.','.$code.','.$date.','.$uniqueToken;
								mysql_query("INSERT INTO tbl_order(member_id, items, quantity, amount, country, address, date, payment_code, status,action) 
											VALUES ('$memberID','$items','$quan','$total','$country','$address','$date','$uniqueToken','Pending','Pending')") or die(mysql_error());

								header("Location: verify/paypal/index.php");
							}else{
							
							$memberID = $_SESSION['login'];
							$fname = $_SESSION['fname'];
							$lname = $_SESSION['lname'];
							$emailadd = $_SESSION['emailadd'];
							$address = $_SESSION['add'];
							$country = $_SESSION['country'];
							$region = $_SESSION['region'];
							$city = $_SESSION['city'];
							$date = date("Y-m-d");
							
							$urCart = $_SESSION['urCart'];
							$cartQty = $_SESSION['cartQty'];
							$price=0;
							$total=0;
							$qty=0;
							$items='';
							$quan='';
							$count = count($urCart);
							foreach ($urCart as $key => $value) {
											$category = mysql_result(mysql_query("SELECT category FROM tbl_item WHERE item_no='$value'"),0);
											$id = mysql_result(mysql_query("SELECT id FROM tbl_item WHERE item_no='$value'"),0);
											$price = mysql_result(mysql_query("SELECT price FROM tbl_$category WHERE ".$category."_no='$id'"),0);
											$stock = mysql_result(mysql_query("SELECT stock FROM tbl_$category WHERE ".$category."_no='$id'"),0);
											$qty = $cartQty[$key];
											$remain = $stock - $qty;
											mysql_query("UPDATE tbl_$category SET stock='$remain' WHERE ".$category."_no='$id'") or die(mysql_error());
								if($count==1) {
									$items = $value;
									$quan = $qty;
								}
								else if($count>=$key) {
									if($key==0) {
										$items = $value;
										$quan = $qty;
									}
									else {
										$items = $items.','.$value;
										$quan = $quan.','.$qty;
									}
								}
							}
								$total = $_SESSION['subTotal'];
								$uniqueToken = generateUniqueToken(20);
								//echo $memberID.','.$items.','.$quan.','.$total.','.$country.','.$address.','.$code.','.$date.','.$uniqueToken;
								mysql_query("INSERT INTO tbl_order(member_id, items, quantity, amount, country, address, date, payment_code, status,action) 
											VALUES ('$memberID','$items','$quan','$total','$country','$address','$date','$uniqueToken','Pending','Pending')") or die(mysql_error());
							 $to = $emailadd;
							 $subject = 'Thank you for partnering with us :P:)';
							 $headers = "From: Nora's Jewelry\n";
							 $headers .= "Reply-To: norasjewelries@gmail.com \r\n";
							 $headers .= "MIME-Version: 1.0\r\n";
							 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							 $message = '<html><body>';
							 $message .= '<h4 align="center">Thank you'.$fname.' '. $lname.'. Here are the things you need to do.</h3>';
							 $message .= '<p align="center">';
							 $message .= '<b>First:</b> Deposit total amount of PHP'.$total.'in any of our accounts.<br>';
							 $message .= '<img src="images/bdo.gif" width="200px" height="50px"></img>xxxx-xxxx-xxxx<br>';
							 $message .= '<img src="images/bpi.jpg" width="150px" height="50px"></img>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;yyyy-yyyy-yyyy<br>';
							 $message .= '<img src="images/rcbc.jpg" width="150px" height="70px"></img>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zzzz-zzzz-zzzz<br><br>';
							 $message .= '<b>Last:</b> Once you have deposited the amount, go to this page <a href="#">http://norasjewelry.com/payment.php</a> <br>for the payment confirmation and fill up the form.';
							 $message .= '<br> Here\'s your payment code: <i>'.$uniqueToken.'</i> You\'ll be needing this to confirm your payment.';
							 $message .= "</p></body></html>";
							 mail($to, $subject, $message, $headers);	
							foreach($_SESSION as $key => $val)
							{
								if ($key !== 'login')
								{
								 unset($_SESSION[$key]);
								}
							}
							echo 'Please check your email, we send you the process of how to pay your orders. Thank You!!';
						}
					}
					?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title>Nora's Jewelry | Checkout</title>

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
			<div class="span12">
				<form action="" method="post">
				<h2>Checkout Process</h2>
				<div class="accordion" id="accordion2">
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
								STEP 1: CHECKOUT OPTIONS
							</a>
						</div>
						<?php 
							if(!isset($_SESSION['login']) && isset($_SESSION['urCart'])) {
						?>
						<div id="collapseOne" class="accordion-body collapse in">
							<div class="accordion-inner">
								<div class="span4">
									<h4>Registered User</h4>
										<label>Email</label>
										<input type="text" name="email" id="email" required/>
										
										<label>Password</label>
										<input type="text" name="password" id="password" required />
										<br />
										Register <a href="registration.php">Here</a>
										<br />
										<button type="submit" name="btnLogin" class="btn btn-primary" >Login</button>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
								STEP 2: SHIPPING DETAILS
							</a>
						</div>
						<?php 
						if(!isset($_SESSION['method']) && isset($_SESSION['urCart'])) {
							if(isset($_SESSION['login'])) {
								$memberID = $_SESSION['login'];
								$sql = mysql_query("SELECT * FROM tbl_members WHERE member_id='$memberID'") or die(mysql_error());
								while($row = mysql_fetch_array($sql)) {
									$fname =$row['first_name'];
									$lname = $row['last_name'];
									$email = $row['email'];
									$address = $row['address'];
									$country  = $row['country'];
									$region  = $row['region'];
									$city = $row['city'];
								}
						?>
						<div id="collapseThree" class="accordion-body collapse">
							<div class="accordion-inner">
									<label> First Name:</label>
									<input readonly type="text" class="large-field" value="<?php echo $fname; ?>" name="fname">

									<label> Last Name:</label>
									<input readonly type="text" class="large-field" value="<?php echo $lname; ?>" name="lname">

									<label> Email Address:</label>
									<input readonly type="text" class="large-field" value="<?php echo $email; ?>" name="emailadd">

									<label> Address</label>
									<input type="text" class="large-field" value="<?php echo $address; ?>" name="add">

									<label> Country:</label>
									<input type="text" class="large-field" value="<?php echo $country; ?>" name="country">

									<label> Region:</label>
									<input type="text" class="large-field" value="<?php echo $region; ?>" name="region">

									<label> City:</label>
									<input type="text" class="large-field" value="<?php echo $city; ?>" name="city">
									
								<br />
								<button type="submit" name="btnShipping" class="btn btn-primary">Continue</button>
							</div>
						</div>
						<?php } 
						}?>
						
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
								STEP 3: PAYMENT METHOD
							</a>
						</div>
						<?php 
							if(isset($_SESSION['login'])&& isset($_SESSION['method'])) {
						?>
						<div id="collapseFive" class="accordion-body collapse">
							<div class="accordion-inner">
									<label class="radio">
										<input type="radio" name="payment" id="optionsRadios1" value="paypal" checked>
										Paypal</b>
									</label>
									<label class="radio">
										<input type="radio" name="payment" id="optionsRadios2" value="bank">
										Bank to Bank</b>
									</label>
									<button type="submit" name="btnPayment" class="btn btn-primary">Continue</button>
								</div>
						</div>
					</div>
					<?php } ?>
					</div>
					
				</div>
			</form>
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