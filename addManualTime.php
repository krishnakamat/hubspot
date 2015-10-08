<?php
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php");
$ssbID=$_POST['ssbid'];
$hours2=$_POST['timeTaken'];
$owner=$_POST['owner'];
$teamLead=$_POST['teamleader'];
$notes1= mysql_real_escape_string($_POST['notes']);
$closedOn=$_POST['dateAdded'];
if(($notes1==' ') || ($notes1==null))
{
	$notes1="SSB ID Time Added Manually";
}
/*$getSsbDetail=mysql_query("select distinct * from closedssb where ssbID='$ssbID'");
$ssbDetail=mysql_fetch_assoc($getSsbDetail);
 $custSubName= $ssbDetail['custSubName'];
 $trackID=$ssbDetail['trackID'];
 $queue = $ssbDetail['queue'];
 $startDate=$ssbDetail['startDate'];
 $dueDate=$ssbDetail['dueDate'];
 $service=$ssbDetail['service'];
 $migrateUrl=$ssbDetail['migrateUrl'];
 $blogUrl=$ssbDetail['blogUrl'];
 $pages=$ssbDetail['pages'];
 $portalLoginLink=$ssbDetail['portalLoginLink'];
 $comments=$ssbDetail['comments'];
 $status=$ssbDetail['status'];
//echo $owner=$ssbDetail['owner'];
 $firstReviewer=$ssbDetail['firstReviewer'];
 $secondReviewer=$ssbDetail['secondReviewer'];
 $notes=$ssbDetail['notes'];
 $hours1=$ssbDetail['hours1'];
//echo $hours2=$ssbDetail['hours2'];
//$closedOn=$ssbDetail['closedOn'];
date_default_timezone_set('America/New_York');
//$closedOn=date("Y-m-d");
 $teamLead=$ssbDetail['teamLead'];

$insertSsb="insert into closedssb (trackID,ssbID,custSubName,queue,startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink,comments,status,owner,firstReviewer,secondReviewer,notes,hours1,hours2,closedOn,isManual,teamLead) 
values ('$trackID','$ssbID','$custSubName','$queue','$startDate','$dueDate','$service','$migrateUrl','$blogUrl','$pages','$portalLoginLink','$comments','$status','$owner','$firstReviewer','$secondReviewer','$notes','$hours1','$hours2','$closedOn','1','$teamLead')";
mysql_query($insertSsb);*/

$insertInOpenssb="insert into openssbtime(ssbID,owner,timeTaken,dateUpdated,teamLead,notes,status) values ('$ssbID','$owner','$hours2','$closedOn','$teamLead','$notes1',1)";
mysql_query($insertInOpenssb);
echo "<script language=javascript>";
echo "location.href='manualTime.php?msg=success'";
echo "</script>";

?>