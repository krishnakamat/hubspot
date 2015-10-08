<?php
ob_start();
include("config.php");
//$value=$_GET['value'];
//$trackID=$_GET['trackId'];
//$toUpdate=$_GET['toUpdate'];
session_start();

$ssbID=$_REQUEST['ssbID'];
$owner=$_REQUEST['owner'];
$hours1=$_REQUEST['hours1'];
$notes=$_REQUEST['notes'];
$getTL="select teamLead from webadmin where adminID='$owner'";
$teamLeadQuery=mysql_query($getTL);
$teamLeadID=mysql_fetch_assoc($teamLeadQuery);
$teamLead=$teamLeadID['teamLead'];
mysql_query("update tracking set notes='$notes' where ssbID='$ssbID'"); 

if($hours1 !=null || $hours1 !='')
{
$getTrack=mysql_query("select * from tracking where ssbID='$ssbID'");
$trackArr=mysql_fetch_array($getTrack);
$trackID=$trackArr['trackID'];

mysql_query("insert into openssbtime (ssbID,owner,timeTaken,dateUpdated,teamLead) values ('$ssbID', '$owner','$hours1',now(),'$teamLead')");
}

echo "<script>window.history.go(-2)</script>";