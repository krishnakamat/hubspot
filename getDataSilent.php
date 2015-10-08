<?php
$username = "tracker_hubspot";
$password = "hubsp@t";
$hostname = "localhost"; 
error_reporting(0);
$email = $_REQUEST['x_email'];
$custName = $_REQUEST['x_cust_name'];
$eventName =  $_REQUEST['x_event_name'];
//connection to the database
$con = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
mysql_select_db("tracker_hubspot",$con);

$updateQuery = "update transaction set transStatus = '1' where transID = '1'";
$update = mysql_query($updateQuery) or die(mysql_error());

$insertQuery = "update transaction set transName = '$custName' where transID ='1'";
$update1 = mysql_query($insertQuery) or die(mysql_error());

if($update){
	echo "success";	
}

?>