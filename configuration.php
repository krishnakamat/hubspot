<?php
$username = "root";
$password = "";
$hostname = "localhost"; 

//connection to the database
$con = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
mysql_select_db("thewebpl_hubspot");
?>

