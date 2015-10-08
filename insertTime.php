<?php
include("config.php");
$ssbID=$_POST['ssbID'];
$hours2=$_POST['timeTaken'];
$hours3=$_POST['updateTime'];
//$extraTime = $hours2 - $hours3;
$teamLead1=$_POST['teamLead'];
$owner=$_POST['owner'];
$notes1=mysql_real_escape_string($_POST['notes'][0]);
$closedOn=$_POST['dateUpdated'];

if(($notes==' ') || ($notes==null))
{
	$notes="SSB ID Time Added Manually";
}
$getSsbDetail=mysql_query("select distinct * from closedssb where ssbID='$ssbID'");
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
 $rating=$ssbDetail['rating'];
 $hours1=$ssbDetail['hours1'];
//echo $hours2=$ssbDetail['hours2'];
//$closedOn=$ssbDetail['closedOn'];
date_default_timezone_set('America/New_York');
//$closedOn=date("Y-m-d");
 $teamLead=$ssbDetail['teamLead'];

 foreach( $owner as $key=>$value ) {
	$hours2s = $hours2[$key];
	$hours3s = $hours3[$key];
	$owners = $owner[$key];
	$teamLeads = $teamLead1[$key];
	$closedOns = $closedOn[$key];
	$notess = $notes1[$key];
	$values = mysql_real_escape_string($value);
	echo $idle = ($hours2s) - ($hours3s);
	$notesManually = $notess . "(Manually Added Difference)";

$getOwnerId=mysql_query("select * from webadmin where adminID ='$values'");
$ownerId=mysql_fetch_array($getOwnerId);
$ownerTL =$ownerId['teamLead'];

$insertSsb="insert into closedssb (trackID,ssbID,custSubName,queue,startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink,comments,status,owner,firstReviewer,secondReviewer,notes,rating,hours1,hours2,closedOn,isManual,teamLead) 
values ('$trackID','$ssbID','$custSubName','$queue','$startDate','$dueDate','$service','$migrateUrl','$blogUrl','$pages','$portalLoginLink','$comments','$status','$values','$firstReviewer','$secondReviewer','$notes1','$rating','$hours1','$hours3s','$closedOns',1,'$ownerTL')";
mysql_query($insertSsb);

$insertInOpenssb="update openssbtime set status = 0 where ssbID = '$ssbID'";
mysql_query($insertInOpenssb);
	
 }
echo "<script language=javascript>";
echo "location.href='manuallyClosed.php?msg=success'";
echo "</script>";

?>