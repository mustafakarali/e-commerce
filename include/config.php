<?php

$dbservertype='mysql';
$servername='localhost';
$dbusername='root';
$dbpassword='';
$dbname='db_tago';

connecttodb($servername,$dbname,$dbusername,$dbpassword);

function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
	global $link;
	$link=mysql_connect ("$servername","$dbuser","$dbpassword");
	if(!$link){die("Could not connect to MySQL");}
	mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
}

?>