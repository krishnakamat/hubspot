<?php
/*session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}*/
include("config.php");
$value=$_GET['value'];
session_start();
$updatedBy=$_SESSION['name'];
$trackID=$_GET['trackId'];
$toUpdate=$_GET['toUpdate'];
//echo $toUpdate
//echo $value;
//echo $trackID;
date_default_timezone_set('America/New_York');
$closedOn=date("Y-m-d");
$savedOn=date("Y-m-d H:i:s");
//if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
if($toUpdate=='1'){
mysql_query("update tracking set status='$value' where trackID='$trackID'");
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$value','Status','$savedOn','$updatedBy')");
if($value=='Closed')
	{
		mysql_query("INSERT INTO closedssb  SELECT trackID,ssbID,custSubName,queue,startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink,comments,status,owner,firstReviewer,secondReviewer,notes,hours1,hours2,'$closedOn' FROM tracking WHERE trackID='$trackID'");
		mysql_query("Delete from tracking where trackID='$trackID'");
	}
}
elseif($toUpdate=='2'){
$getTL="select teamLead from webadmin where adminID='$value'";
$teamLeadQuery=mysql_query($getTL);
$teamLeadID=mysql_fetch_assoc($teamLeadQuery);
$teamLead=$teamLeadID['teamLead'];
mysql_query("update tracking set owner='$value',teamLead='$teamLead' where trackID='$trackID'");

$currentStatus="select status from tracking where trackID='$trackID'";
$currStat=mysql_query("$currentStatus");
$curStat=mysql_fetch_assoc($currStat);
$presentStatus=$curStat['status'];
if($presentStatus=='Not Started'){


	mysql_query("update tracking set status='In Progress' where trackID='$trackID'");
	mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','In Progress','Status','$savedOn','$updatedBy')");

}
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$value','Owner','$savedOn','$updatedBy')");

}

elseif($toUpdate=='3'){
mysql_query("update tracking set firstReviewer='$value' where trackID='$trackID'");
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$value','First Reviewer','$savedOn','$updatedBy')");
}

elseif($toUpdate=='4'){
mysql_query("update tracking set secondReviewer='$value' where trackID='$trackID'");
mysql_query("insert into trackinghistory (trackID,status,updates,date,updatedBy) values ('$trackID','$value','Second Reviewer','$savedOn','$updatedBy')");
}
//}
//echo "hi";