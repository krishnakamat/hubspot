<?php
session_start();
		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
		include("config.php");
	 $value= $_GET['value'];
	$toUpdate=$_GET['toUpdate'];
	$adminID=$_GET['adminID'];

if($toUpdate=='1'){
mysql_query("update webadmin set email='$value' where adminID='$adminID'");
}
if($toUpdate=='2'){
mysql_query("update webadmin set teamLead='$value' where adminID='$adminID'");
}
if($toUpdate=='3'){
mysql_query("update webadmin set userRole='$value' where adminID='$adminID'");
}
			//	header('location:editUser.php?msg=Added Successfully');

			

