<?php
	session_start();
	include("includes/dbcon.php");
	$login = 0;
	
	if(isset($_POST['submit'])) {
	
		$uname = $_POST['username'];
		$pass = $_POST['pass'];
		
		$d1 = mysql_real_escape_string(trim($uname, "/\'\" \;"));
		$d2 = md5(mysql_real_escape_string(trim($pass, "/\'\" \;")));
		
		if(empty($d1) || empty($d2)) {
			$msg =  "<div class='notice'>
		<p class='warn'>Whoops! We didn't recognize your username or password. Please try again.</p>
	</div>";
	echo $msg;
		}
		else {
			$myQuery = mysql_query("SELECT * FROM tbl_admin  WHERE username='$d1' AND password='$d2'")
					   or die(mysql_error(). "Can't select") ;

				if(mysql_num_rows($myQuery)>0) {
					$login = 1;
					$_SESSION['login'] = $login;
					header("Location: dashboard.php");
				}
				else {
					$_SESSION['login'] = $login;
					$msg =  "<div class='notice'>
		<p class='warn'>Whoops! We didn't recognize your username or password. Please try again.</p>
	</div>";
	echo $msg;
				}
			}
	}
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> 	<html lang="en"> <!--<![endif]-->
<head>

	<!-- General Metas -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	<!-- Force Latest IE rendering engine -->
	<title>Administrator | Login</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/layout.css">
	
</head>
<body>




	<!-- Primary Page Layout -->

	<div class="container">
		
		<div class="form-bg">
			<form method="POST" action="">
				<h2>Login</h2>
				<p><input type="text" placeholder="Username" name="username"></p>
				<p><input type="password" placeholder="Password" name="pass"></p>
				<button type="submit" name="submit"></button>
			<form>
		</div>


	</div><!-- container -->

	<!-- JS  -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
	<script>window.jQuery || document.write("<script src='js/jquery-1.5.1.min.js'>\x3C/script>")</script>
	<script src="js/app.js"></script>
	
<!-- End Document -->
</body>
</html>