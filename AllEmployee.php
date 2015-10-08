<?php
$username = "tracker_hubspot";
$password = "hubsp@t";
$hostname = "localhost"; 

//connection to the database
$con = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
mysql_select_db("tracker_hubspot",$con);

$getAllEmployee="select * from webadmin";
$employee=mysql_query($getAllEmployee) or die(mysql_error());
while($allEmployeeArr=mysql_fetch_array($employee))
{
	echo $allEmployeeArr['name'];
	}
	?>