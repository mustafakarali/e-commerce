					<?php
						if(isset($_POST['btnLogin'])) {
							$emailadd = $_POST['uname'];
							$pass = md5($_POST['pass']);
							
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
											echo "<script>alert (\"Your account is not yet verified.Verify first your  account!!\")</script>";
										}
										else {
											$_SESSION['login']=$row['member_id'];
											$_SESSION['first']=$row['first_name'];
											$_SESSION['last']=$row['last_name'];
											echo "<script language=\"javascript\">";
											echo "var url = document.URL;";
											echo "window.location = url";
											echo "</script>";
										}
									}
								}
								else {
									echo "<script>alert (\"Invalid Account!!\")</script>";
								}
								
							}	
						}
					?>
					<div id="myModal" class="modal hide" style="width:500px;">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3>Sign In</h3>
											</div>
											<div class="modal-body">
												<p>
					<form class="form login-form" style="margin-left:120px;" action="" method="post">
						<div>
							<label>Username</label>
							<input id="Username" name="uname" type="text" required>

							<label>Password</label>
							<input id="Password" name="pass" type="password" required><br>

							<br /><br />

							<button type="submit" name="btnLogin" class="btn btn-success">Login</button>
						</div>
						<br />
						<a href="register.php">Register here.</a>
					</form>
												</p>
											</div>
						</div>