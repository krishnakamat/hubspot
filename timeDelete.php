<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
include("config.php");
$timeID=$_GET['timeID'];
$getDate = "select * from leave_idle_timesheet where timeID = '$timeID'";
$resultDate = mysql_query($getDate);
$rowDate = mysql_fetch_assoc($resultDate);
$owner = $rowDate['owner'];
$dateAdded = $rowDate['dateAdded'];
mysql_query("delete from leave_idle_timesheet where timeID='$timeID'");

$idleTime="SELECT timeID,notes,sum(timeAdded) as idle,dateAdded FROM leave_idle_timesheet
WHERE  owner='$owner' && dateAdded='$dateAdded' && type='2'";
$idleResult=mysql_query($idleTime) or die(mysql_error());
$idleArrNum = mysql_num_rows($idleResult);
$idleArr=mysql_fetch_array($idleResult);
//if($idleArrNum > 1){
echo $idled= round($idleArr['idle'],2);
//}