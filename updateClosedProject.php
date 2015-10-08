<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
include("config.php");
$value=$_GET['value'];
$trackID=$_GET['trackId'];
$toUpdate=$_GET['toUpdate'];
//echo $toUpdate
//echo $value;
//echo $trackID;
if($toUpdate=='1'){
mysql_query("update closedssb set status='$value' where trackID='$trackID'");
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$value','Status',now())");
if($value !='Closed')
	{  
		mysql_query("INSERT INTO tracking SELECT * FROM closedssb WHERE trackID='$trackID'");
		mysql_query("Delete from closedssb where trackID='$trackID'");
	}
}
elseif($toUpdate=='2'){
mysql_query("update closedssb set owner='$value' where trackID='$trackID'");
mysql_query("update tracking set status='In Progress' where trackID='$trackID'");
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$value','Owner',now())");
}

elseif($toUpdate=='3'){
mysql_query("update closedssb set firstReviewer='$value' where trackID='$trackID'");
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$value','First Reviewer',now())");
}

elseif($toUpdate=='4'){
mysql_query("update closedssb set secondReviewer='$value' where trackID='$trackID'");
mysql_query("insert into trackinghistory (trackID,status,updates,date) values ('$trackID','$value','Second Reviewer',now())");

}
//echo "hi";
