<?php
include("include/dbcon.php");

$email = $_REQUEST['email'];
$key = $_REQUEST['key'];

	
$query = mysql_query("SELECT * FROM tbl_members WHERE email = '$email'");
$verify = mysql_num_rows($query);
if($verify){
	while($row = mysql_fetch_object($query)){
			$status = $row->status;
		 }
		
		if($status != 1){
			$query2 = mysql_query("UPDATE tbl_members SET status = 1 WHERE email = '$email' and activation_key='$key'");
			echo '<div style="color: green; font-size: 27px; padding-left: 475px; padding-top: 200px;">Your Account is now activated.<br />
					<a style="text-decoration: none; text-align: center; color: #000; font-size:12px;" href="../index.php">return</a>
				</div>';
			}else{
			echo '<div style="color: red; font-size: 27px; padding-left: 475px; padding-top: 200px">Your account is already activated.<br />
					<a style="text-decoration: none; text-align: center; color: #000; font-size:12px;" href="../index.php">return</a>
					</div>';
			}
		}else{
			echo '<div style="color: red; font-size: 27px; padding-left: 475px; padding-top: 200px">You are not registered.<br /><a style="text-decoration: none; text-align: center; color: #000; font-size:12px;" href="../index.php">return</a></div>';
		}
?>