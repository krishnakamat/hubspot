<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
		echo "<script>location.href='index.php';</script>";
		}
		include("config.php");
		$ssbId=$_POST['ssbId'];
		$comments=$_POST['comments'];
		$status=$_POST['status'];
		$owner=$_POST['owner'];
		$firstReviewer=$_POST['firstReviewer'];
		$secondReviewer=$_POST['secondReviewer'];
		$notes=$_POST['notes'];


$insertTracking="update tracking set comments='$comments',status='$status',owner='$owner',firstReviewer='$firstReviewer',secondReviewer='$secondReviewer',notes='$notes' where trackID='$ssbId'";
mysql_query($insertTracking);
?>
	