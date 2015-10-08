<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
include("config.php");
  $trackID=$_GET['trackID'];

 $getMailSentStatus=mysql_query("select * from tracking where trackID='$trackID'") or die(mysql_error());
 $mailSentStatus=mysql_fetch_assoc($getMailSentStatus);
 if($mailSentStatus['blockedMailSent'] == '1')
 {
	 mysql_query("update tracking set blockedMailSent='0' where  trackID='$trackID'");
 }
 else
 {
	 mysql_query("update tracking set blockedMailSent='1' where  trackID='$trackID'");

 }


  ?>