<?php
ob_start();
include("config.php");
//$value=$_GET['value'];
//$trackID=$_GET['trackId'];
//$toUpdate=$_GET['toUpdate'];
session_start();
$updatedBy=$_SESSION['name'];
$ssbID=$_REQUEST['ssbID'];
$comments=mysql_real_escape_string($_REQUEST['comments']);
$status=$_REQUEST['status'];
$owner=$_REQUEST['owner'];
$firstReviewer=$_REQUEST['firstReviewer'];
$secondReviewer=$_REQUEST['secondReviewer'];
$notes=mysql_real_escape_string($_REQUEST['notes']);
$rating=$_REQUEST['rating'];
$hours1=$_REQUEST['hours1'];
//$hours2=$_REQUEST['hours2'];
$custSubName=$_REQUEST['custSubName'];
$queue=$_REQUEST['queue'];
$startDate=$_REQUEST['startDate'];
$dueDate=$_REQUEST['dueDate'];
$service=$_REQUEST['service'];
$migrateUrl=$_REQUEST['migrateUrl'];
$blogUrl=$_REQUEST['blogUrl'];
$pages=$_REQUEST['pages'];
$portalLoginLink=$_REQUEST['portalLoginLink'];
//$teamLead=$_REQUEST['teamLead'];

$hours2=implode(",",$_REQUEST['hours2']);
//print_r($hours2);
$timeTaken = explode(",", $hours2);
echo "<br/>";
$owners=implode(",",$_REQUEST['owners']);
$teamLeads=implode(",",$_REQUEST['teamLeads']);
//print_r($hours2);
$ownersName = explode(",", $owners);
$teamLeadName = explode(",", $teamLeads);

echo "<br/>";

   $lastOwner= end($ownersName);

  $lastTime=  end($timeTaken);



// $task=$_REQUEST['task'];
//For entering into openssbtime
$getOwnerId=mysql_query("select * from webadmin where adminID ='$lastOwner'");
$ownerId=mysql_fetch_array($getOwnerId);
 $ownerID =$ownerId['adminID'];

//$getTaskName=mysql_query("select * from tasks where task='$task'");
//$taskNameArr=mysql_fetch_assoc($getTaskName);
//$taskName=$taskNameArr['taskID'];

//print_r(($timeTaken+$ownersName) );

//echo $toUpdate
//echo $value;
//echo $trackID;

//$task=$_REQUEST['task'];

date_default_timezone_set('America/New_York');
$closedOn=date("Y-m-d");
$savedOn=date("Y-m-d H:i:s");

$getTrack=mysql_query("select * from tracking where ssbID='$ssbID'");
$trackArr=mysql_fetch_array($getTrack);
$trackID=$trackArr['trackID'];
$ownerTL =$ownerId['teamLead'];
if($lastTime !='' || $lastTime != null)
{
/* For direct insert */ mysql_query("insert into openssbtime (ssbID,owner,timeTaken,dateUpdated,teamLead) values ('$ssbID', '$lastOwner','$lastTime','$closedOn','$ownerTL')");
/* For id from name mysql_query("insert into openssbtime (ssbID,owner,task,timeTaken,dateUpdated) values ('$ssbID', '$ownerID','$taskName','$lastTime','$closedOn')");*/
}

mysql_query("update tracking set status='$status',comments='$comments',owner='$owner',firstReviewer='$firstReviewer',secondReviewer='$secondReviewer',
notes='$notes',rating='$rating' where ssbID='$ssbID'");

if($trackArr['status'] !=$status){
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$status','Status','$savedOn','$updatedBy')");
if($status=='Closed')
{	
	for($i=0, $count = count($timeTaken);$i<$count;$i++) {
				  $timeUsed  = $timeTaken[$i];
				  $ownersdata = $ownersName[$i];
				  $teamLead = $teamLeadName[$i];
					

					if($timeUsed != null || $timeUsed != '')
			{
					  $queryPerform=	mysql_query("INSERT INTO closedssb (trackID,ssbID,custSubName,queue,startDate,dueDate,service,migrateUrl,blogUrl,
					  pages,portalLoginLink,comments,status,owner,firstReviewer,secondReviewer,notes,rating,hours2,closedOn,isManual,teamLead) 
					  values ('$trackID','$ssbID','$custSubName','$queue','$startDate','$dueDate','$service','$migrateUrl','$blogUrl','$pages',
					  '$portalLoginLink','$comments','$status','$ownersdata','$firstReviewer','$secondReviewer','$notes','$rating','$timeUsed','$closedOn',
					  '0','$teamLead')");
					 // echo $timeUsed."yes"."<br/>";
			}
					//  echo "INSERT INTO closedssb (trackID,ssbID,custSubName,queue,startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink,comments,status,owner,firstReviewer,secondReviewer,notes,hours2,closedOn) values ('$trackID','$ssbID','$custSubName','$queue','$startDate','$dueDate','$service','$migrateUrl','$blogUrl','$pages','$portalLoginLink','$comments','$status','$ownersdata','$firstReviewer','$secondReviewer','$notes','$timeUsed','$closedOn')"."<br/>";
										}
			
				

	mysql_query("Delete from tracking where  ssbID='$ssbID'");
}
}
if($trackArr['owner'] !=$owner){
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$owner','Owner','$savedOn','$updatedBy')");
}
if($trackArr['firstReviewer'] !=$firstReviewer){
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$firstReviewer','First Reviewer','$savedOn','$updatedBy')");
}
if($trackArr['secondReviewer'] !=$secondReviewer){
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$secondReviewer','Second Reviewer','$savedOn','$updatedBy')");
}

echo "<script>window.history.go(-2)</script>";