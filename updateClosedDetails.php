<?php
ob_start();
include("config.php");
//$value=$_GET['value'];
//$trackID=$_GET['trackId'];
//$toUpdate=$_GET['toUpdate'];
$ssbID=$_REQUEST['ssbID'];
$comments=$_REQUEST['comments'];
$status=$_REQUEST['status'];
$owner=$_REQUEST['owner'];
$firstReviewer=$_REQUEST['firstReviewer'];
$secondReviewer=$_REQUEST['secondReviewer'];
$notes=$_REQUEST['notes'];
$hours1=$_REQUEST['hours1'];
$hours2=$_REQUEST['hours2'];
//echo $toUpdate
//echo $value;
//echo $trackID;

$getTrack=mysql_query("select * from tracking where ssbID='$ssbID'");
$trackArr=mysql_fetch_array($getTrack);
$trackID=$trackArr['trackID'];

mysql_query("update closedssb set status='$status',comments='$comments',owner='$owner',firstReviewer='$firstReviewer',secondReviewer='$secondReviewer',notes='$notes',hours1='$hours1',hours2='$hours2' where ssbID='$ssbID'");

if($trackArr['status'] !=$status){
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$status','Status',now())");
if($status !='Closed')
{
	$sendToTracking=mysql_query("INSERT INTO tracking SELECT distinct trackID,ssbID,custSubName,queue,startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink,comments,status,owner,firstReviewer,secondReviewer,notes,hours1,hours2,'0' FROM closedssb WHERE  ssbID='$ssbID'");
	if($sendToTracking)
	{
		mysql_query("Delete from closedssb where  ssbID='$ssbID'");
	}
}
}
if($trackArr['owner'] !=$owner){
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$owner','Owner',now())");
}
if($trackArr['firstReviewer'] !=$firstReviewer){
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$firstReviewer','First Reviewer',now())");
}
if($trackArr['secondReviewer'] !=$secondReviewer){
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$secondReviewer','Second Reviewer',now())");
}


//header("location:getClosedDetails.php?ssbID=$ssbID&updated=Updated Successfully");