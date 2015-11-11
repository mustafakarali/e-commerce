<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title>Nora's Jewelry | Sign In</title>

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

	<div class="container">
		<div class="row">
			<div class="span3" style="margin-left:35%">


				<div class="well">
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
						<a href="register.php">register</a>&nbsp;&#124;&nbsp;<a href="#">forgot password?</a>
					</form>
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