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

$leaveTime="SELECT timeID,notes,sum(timeAdded) as leaves ,dateAdded FROM leave_idle_timesheet
WHERE  owner='$owner' && dateAdded='$dateAdded' && type='1'";

$leaveResult=mysql_query($leaveTime) or die(mysql_error());
$leaveArrNum = mysql_num_rows($leaveResult);
$leaveArr=mysql_fetch_array($leaveResult);
//if($idleArrNum > 1){
echo $leaved= round($leaveArr['leaves'],2);
//}
?>