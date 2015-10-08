<?php
include("config.php");
$empid = $_GET['q'];
$dateCount1="select count(appliedFor) as count, Notes, leaveID, status, typeLeave, appliedFor from empleavedetails where empID='$empid' and typeLeave = 1 and appliedFor >= '$appliedOn' and status = 1";
$resultdateCount1=mysql_query($dateCount1);
$rowdateCount1=mysql_fetch_array($resultdateCount1);
$balcount = $rowdateCount1['count']/2;

$dateCount2="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where empID='$empid' and typeLeave = 2 and appliedFor >= '$appliedOn' and status = 1";
$resultdateCount2=mysql_query($dateCount2);
$rowdateCount2=mysql_fetch_array($resultdateCount2);
$balcount1 = $rowdateCount2['count'];

$balcount2 = $balcount + $balcount1;

$leaveBalance="select * from empleavebalance where empID='$empid'";
$resultleaveBalance=mysql_query($leaveBalance);
$rowleaveBalance=mysql_fetch_array($resultleaveBalance);
$accuratebal = $rowleaveBalance['accrued'] + $rowleaveBalance['salaryAdjustment'] - $rowleaveBalance['leaveUsed'] - $balcount2;
if($accuratebal > 0){
echo $accuratebal;
}else{
echo "0";
}
?>