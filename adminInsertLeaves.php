<?php
ob_start();
include("config.php");
$adminid = $_POST['adminid'];
$name = $_POST['na'];
$type = $_POST['type'];
$date = $_POST['date1'];
$notes = mysql_real_escape_string($_POST['notes']);
$appliedOn = date("y-m-d");
$planned = $_POST['planned'];
if(!isset($planned))
{
	$planned = 1;
}
else
{
	$planned = 0;
}

$getAdmins="select email from webadmin where userRole ='1' and status='1'";
$admins=mysql_query($getAdmins);
while($adminArr=mysql_fetch_array($admins))
{
	$adminMail .=$adminArr['email'].","; 
}
 $adminMails = rtrim($adminMail,",");


$query1="select * from empleavebalance where empID = '$adminid'";		//
$result1=mysql_query($query1);
$row1=mysql_fetch_array($result1);
$levused = $row1['leaveUsed'];


if(!empty($_POST['date1']) && $type==1){

	$todayDate = date('y-m-d');
	$date = $_POST['date1'];
	$ts1 = strtotime($todayDate);
	$ts2 = strtotime($date);
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);
	$diff1 = (($year2 - $year1) * 12) + ($month2 - $month1);
	$bal = 0;
	for($i=1; $i<=$diff1; $i++){
	$bal = $bal + 1.5;
	}
	$query = "select count(appliedFor) as count from empleavedetails where appliedFor =  '$date' and (status = 1 or status = 3)";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$count = $row['count'];
	if($count >= 5){
	$appliedStatus = $count;
	}
	$satsunDate = strtotime("$_POST[date1]");
	$forholiday = date('Y-m-d',$satsunDate);
	$satsunDate = date("l", $satsunDate);
	$lower = strtolower($satsunDate);
	if(($lower == "monday") or ($lower == "tuesday") or ($lower == "wednesday") or ($lower == "thursday") or ($lower == "friday")){
	$holiday = "select * from holiday where Date = '$forholiday'";
	$resultholiday =mysql_query($holiday);
	$rowholiday=mysql_num_rows($resultholiday);
	if($rowholiday > 0){
	$totalholiday = $totalholiday + 1;
	}else	//($rowholiday < 1)
	$diff = (strtotime($date)- strtotime($date))/24/3600 + 0.5;
	$leaveUsed = $levused + $diff;									//
	$leaveUsed = "update empleavebalance set leaveUsed = '$leaveUsed' where empID = '$adminid'";
	mysql_query($leaveUsed);	
	}else{
	$diff=0;
	}
	
	$halfLeaveTwice = "select * from empleavedetails where appliedFor = '$date' and (status = 1 or status = 3 ) and empID='$adminid'";
	$halfResultTwice = mysql_query($halfLeaveTwice);
	$halfRowTwice = mysql_num_rows($halfResultTwice);
}

if(!empty($_POST['date2']) && $type==2){
	$todayDate = date('y-m-d');
	$date2 = $_POST['date2'];
	$date3 = $_POST['date3'];
	$ts1 = strtotime($todayDate);
	$ts2 = strtotime($date2);
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);
	$diff1 = (($year2 - $year1) * 12) + ($month2 - $month1);
	$bal = 0;
	for($i=1; $i<=$diff1; $i++){
	$bal = $bal + 1.5;
	}
	//$d = '$date2';
	$firstDate=strtotime($date2);
	$secondDate=strtotime($date3);
	$firstDate1=date('y-m-d',$firstDate);
	$secondDate1=date('y-m-d',$secondDate);
	//while (strtotime($d) <= strtotime($date3)) {
	while ($firstDate1 <= $secondDate1) {
	$query = "select count(appliedFor) as count from empleavedetails where appliedFor =  '$firstDate1' and (status = 1 or status = 3)";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$count = $row['count'];
	if($count >= 5){
		$appliedStatus = $count;
	}
	$firstDate1 = date ("Y-m-d", strtotime("+1 day", $firstDate1));
	}
	
	$diff=0;
	$totalholiday = 0;
	while(strtotime($date2) <= strtotime($date3)){
	$satsunDate = strtotime($date2);
	$forholiday=date('y-m-d',$satsunDate);
	$satsunDate = date("l", $satsunDate);
	$lower = strtolower($satsunDate);
	if(($lower == "monday") or ($lower == "tuesday") or ($lower == "wednesday") or ($lower == "thursday") or ($lower == "friday")){
	$holiday = "select * from holiday where Date = '$forholiday'";
	$resultholiday =mysql_query($holiday);
	$rowholiday=mysql_num_rows($resultholiday);
		if($rowholiday > 0){
			$totalholiday = $totalholiday + 1;
		}
	$diff = $diff + (strtotime($date2)- strtotime($date2))/24/3600 + 1;
	}
	//$diff = (strtotime($date3)- strtotime($date2))/24/3600 + 1; 
	$date2 = date ("Y-m-d", strtotime("+1 day", strtotime($date2)));
	}
	$diff = $diff-$totalholiday;			//
	
	$firstDateTwice=strtotime("$_POST[date2]");
	$secondDateTwice=strtotime("$_POST[date3]");
	$firstDate1Twice=date('Y-m-d',$firstDateTwice);
	$secondDate1Twice=date('Y-m-d',$secondDateTwice);
	//while (strtotime($d) <= strtotime($date3)) {
	while ($firstDate1Twice <= $secondDate1Twice) {
	$fullLeaveTwice = "select * from empleavedetails where appliedFor = '$firstDate1Twice' and (status = 1 or status = 3 ) and empID='$adminid'";
	$fullResultTwice = mysql_query($fullLeaveTwice);
	$fullRowTwice = mysql_num_rows($fullResultTwice);
	if($fullRowTwice > 0){
	$diff = 0;
	break ;
	}
	$firstDate1Twice = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate1Twice)));
	}
	$leaveUsed = $levused + $diff;
	$leaveUsed = "update empleavebalance set leaveUsed = '$leaveUsed' where empID = '$adminid'";
	mysql_query($leaveUsed);
}
$dateCount1="select count(appliedFor) as count, Notes, leaveID, status, typeLeave, appliedFor from empleavedetails where empID='$adminid' and typeLeave = 1 and appliedFor >= '$appliedOn' and status = 1";
$resultdateCount1=mysql_query($dateCount1);
$rowdateCount1=mysql_fetch_array($resultdateCount1);
$balcount = $rowdateCount1['count']/2;

$dateCount2="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where empID='$adminid' and typeLeave = 2 and appliedFor >= '$appliedOn' and status = 1";
$resultdateCount2=mysql_query($dateCount2);
$rowdateCount2=mysql_fetch_array($resultdateCount2);
$balcount1 = $rowdateCount2['count'];

$balcount2 = $balcount + $balcount1;

$leaveBalance="select * from empleavebalance where empID='$adminid'";
$resultleaveBalance=mysql_query($leaveBalance);
$rowleaveBalance=mysql_fetch_array($resultleaveBalance);
//$bal = $rowleaveBalance['accrued'] - $rowleaveBalance['leaveUsed'];
$accuratebal = $rowleaveBalance['accrued'] + $rowleaveBalance['salaryAdjustment'] + $bal - $rowleaveBalance['leaveUsed'] - $balcount2 ;	//


if($halfRowTwice > 0){
		header("location:applyEmployeeLeaves.php?adminid=$adminid&msg=Twice");
}	
elseif($fullRowTwice > 0){
		header("location:applyEmployeeLeaves.php?adminid=$adminid&msg=Twice");
}	
//elseif($diff <= $accuratebal && $diff!=0 && $type==1){
elseif($type==1 && $diff!=0){												
	$query1 = "INSERT INTO `empleavedetails` (`leaveID`, `empID`, `appliedOn`, `typeLeave`, `appliedFor`, `Notes`, `status`, `planned`) VALUES('', '$adminid', '$appliedOn', '$type', '$date', '$notes', 3,'$planned')";
	$result1=mysql_query($query1) or die(mysql_error());

	$empNameQry=mysql_query("select * from webadmin where adminID='$adminid'");
	$empNameArr=mysql_fetch_assoc($empNameQry);
	$empName=$empNameArr['name'];
	$email=$empNameArr['email'];
	$subject = "Leave Approved for $empName";

	if($planned == 0)
	{
		$unplanned = 'Unplanned';
	}
	echo $msg="<p>Hello Administrator</p>
			<br/>
			<p>Employee <b>$empName's Leave</b>&nbsp;has been applied for $unplanned Half Day leave on the date(s) below </p>
			<p>Date: <b>$date</b></p>
			<p>Notes: $notes</p>
			<p>Applied on: $appliedOn</p>
			<br/>
			<p>Regards</p>
			<p> Leave Tracker</p>
			";
	
  
  //send email
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:<'.$email.'>';
	//send email
	//mail($adminMails, "$subject", $msg,$headers);


	if(!empty($appliedStatus)){
			header("location:applyEmployeeLeaves.php?adminid=$adminid&msg=success&status=$appliedStatus");
	}else{
			header("location:applyEmployeeLeaves.php?adminid=$adminid&msg=success");
	}
	
}
//elseif($diff <= $accuratebal && $type==2 && $diff!=0){
elseif($type==2 && $diff!=0){ 	
	$date2 = $_POST[date2];
	$date3 = $_POST[date3];
	while (strtotime($date2) <= strtotime($date3)) {
	$satsunDate = strtotime($date2);
	$forinsertholiday=date('Y-m-d',$satsunDate);
	$satsunDate = date("l", $satsunDate);
	echo $lower = strtolower($satsunDate);
	if(($lower == "monday") or ($lower == "tuesday") or ($lower == "wednesday") or ($lower == "thursday") or ($lower == "friday")){
	$holiday = "select * from holiday where Date = '$forinsertholiday'";
	$resultholiday =mysql_query($holiday);
	$rowholiday=mysql_num_rows($resultholiday);
	//$totalholiday = $totalholiday + 1;
	if($rowholiday < 1){
	
	$query2 = "INSERT INTO `empleavedetails` (`leaveID`, `empID`, `appliedOn`, `typeLeave`, `appliedFor`, `Notes`, `status`, `planned`) VALUES('', '$adminid', '$appliedOn', '$type', '$date2', '$notes', 3,'$planned')";
	$result2=mysql_query($query2) or die(mysql_error());
	}
	//}
	}
	$date2 = date ("Y-m-d", strtotime("+1 day", strtotime($date2)));
	$dateOfLeave=date("Y-m-d", strtotime("-1 day", strtotime($date2)));
	$datesLeaved .=$dateOfLeave.", ";
	}
	
	$datesLeaves= rtrim($datesLeaved,", ");
	$empNameQry=mysql_query("select * from webadmin where adminID='$adminid'");
	$empNameArr=mysql_fetch_assoc($empNameQry);
	$empName=$empNameArr['name'];
	$email=$empNameArr['email'];
	$subject = "Leave Approved for $empName";
	if($planned == 0)
	{
		$unplanned = 'Unplanned';
	}

	echo $msg="<p>Hello Administrator</p>
			<br/>
			<p>Employee <b>$empName's</b>&nbsp;leave(s) has been applied for  $unplanned Full Day leave on the date(s) below </p>
			<p>Date: <b>$datesLeaves</b></p>
			<p>Notes: $notes</p>
			<p>Applied on: $appliedOn</p>
			<br/>
			<p>Regards</p>
			<p> Leave Tracker</p>
			";
	
  
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:<'.$email.'>';
  //send email
 // mail($adminMails, "$subject", $msg,$headers);

	if(!empty($appliedStatus)){
	
			header("location:applyEmployeeLeaves.php?adminid=$adminid&msg=success&status=$appliedStatus");
	}else{
			header("location:applyEmployeeLeaves.php?adminid=$adminid&msg=success");
	}
	
}
elseif($totalholiday==1){
	header("location:applyEmployeeLeaves.php?holiday=true");
}
elseif($diff==0){
			header("location:applyEmployeeLeaves.php?weekend=true");
}
else{
header("location:applyEmployeeLeaves.php?msg=Err");
}

?>