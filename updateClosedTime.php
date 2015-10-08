<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
$closedID=$_GET['closedID'];
$newValue=$_GET['newValue'];
//echo $closedID."-".$newValue;
include("config.php");


$updateTime="update closedssb set hours2='$newValue' where closedID='$closedID'";
mysql_query("$updateTime");

echo "<script> window.history.go(-1); </script>";