<?php
$username = "root";
$password = "";
$hostname = "localhost"; 
error_reporting(0);
//connection to the database
$con = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
mysql_select_db("hubspot",$con);
//echo "data";
?>
