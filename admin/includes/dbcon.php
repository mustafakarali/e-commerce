<?php
	$server = "localhost";
	$user = "root";
	$pass ="";
	$db = "db_tago";
	
	$dbcon = mysql_connect($server, $user, $pass)
			or die(mysql_error());
			
	$mydb = mysql_select_db($db, $dbcon);
?>