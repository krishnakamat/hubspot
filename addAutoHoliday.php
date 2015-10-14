<?php
	$today = date('Y-m-d');

	include("config.php");

	$date_array = array();
	$getLeaveDates = mysql_query("select * from holiday");

	while( $allLeaveDates = mysql_fetch_assoc( $getLeaveDates)){
		$date_array[] = $allLeaveDates['Date']; // Inside while loop
	}
	if (in_array("$today", $date_array)) {
		$getLeaveName = mysql_query("select * from holiday where Date = '$today'");
		$leaveName = mysql_fetch_assoc($getLeaveName);
		$leave = $leaveName['holidayName'];

		$getAllActiveMember = "select * from webadmin where employeeType='1' and userRole = '3' and status ='1'";
		$allMembers = mysql_query($getAllActiveMember);
		while($members_array = mysql_fetch_array($allMembers))
		{
			$adminID = $members_array['adminID'];
			$addLeaveTime = "insert into leave_idle_timesheet (owner,timeAdded,notes,dateAdded,type) values ('$adminID','8','$leave','$today','1')";
			$leaveAdded = mysql_query($addLeaveTime);
		}
		$to = "krishnakumarkamat@gmail.com";
		$subject = "Leave Time added to all employee for - $leave";
		$headers ="MIME-Version: 1.0\r\n" 
		. "Content-Type: text/html; charset=\"iso-8859-1\"\r\n" 
		. "Content-Transfer-Encoding: 7bit\r\n";
		$headers .= "From: krishna@thewebplant.in" ;
		$message = "Hi Administrator, The Leave for $leave is added to all active team members successfully";

		mail($to, $subject, $message, $headers);

	}
	else {
		echo "No Holiday For Today"; 
	}
?>