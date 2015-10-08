<?php
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php");
$owner=$_POST['owner'];
$time=$_POST['time'];
$notes=$_POST['notes'];
$dateAdded=$_POST['dateAdded'];
$type=$_POST['type'];

$addManualTime="insert into leave_idle_timesheet (owner,timeAdded,notes,dateAdded,type) values('$owner','$time','$notes','$dateAdded','$type')";
$manualTimeQuery=mysql_query($addManualTime) or die(mysql_error());
if($manualTimeQuery)
{
echo "Added Successfully";
}
echo "<script language=javascript>";
echo "location.href='manualTime.php?msg=Added Successfully'";
echo "</script>";
