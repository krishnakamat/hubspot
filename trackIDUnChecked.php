<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
include("config.php");
$trackID=$_GET['trackID'];
mysql_query("update tracking set target=0 where trackID='$trackID'");

