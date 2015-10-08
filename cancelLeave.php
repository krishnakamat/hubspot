<?php
include("config.php");

$leaveID=$_GET['leaveID'];
$empId = $_GET['empID'];

/* ADMINS**********************************/

$getAdmins="select email from webadmin where userRole ='1' and status='1'";
$admins=mysql_query($getAdmins);
while($adminArr=mysql_fetch_array($admins))
{
	$adminMail .=$adminArr['email'].","; 
}
 $adminMails = rtrim($adminMail,",");

 /*************************************/



$querydet="select count(appliedFor) as count, Notes, leaveID, status, typeLeave, appliedFor from empleavedetails where leaveID = '$leaveID' and empID='$empId' and typeLeave = 1 and status =3 ";
//echo "<br/>";
$resultdet=mysql_query($querydet);
$rowdet=mysql_fetch_array($resultdet);
$balcount = $rowdet['count']/2;
//echo "<br/>";
$querydet1="select count(appliedFor) as count, Notes, leaveID, status, typeLeave, appliedFor from empleavedetails where leaveID = '$leaveID' and empID='$empId' and typeLeave = 2 and status = 3 ";
//echo "<br/>";
$resultdet1=mysql_query($querydet1);
$rowdet1=mysql_fetch_array($resultdet1);
$balcount1 = $rowdet1['count'];
//echo "<br/>";
$bal = $balcount + $balcount1;

$query1="select * from empleavebalance where empID = '$empId'";
$result1=mysql_query($query1);
$row1=mysql_fetch_array($result1);
$levused = $row1['leaveUsed'];
//$leaveUsed = $levused + $bal;
//if($approved==3){
	//		$sql_cart_cate_update="UPDATE empleavebalance SET leaveUsed = '$leaveUsed' WHERE empID = '$empid'"; 
		//	mysql_query($sql_cart_cate_update);
			//}
//if($approved==2){
			$r = $levused - $bal;
			$sql_cart_cate_update="UPDATE empleavebalance SET leaveUsed = '$r' WHERE empID = '$empId'"; 
			mysql_query($sql_cart_cate_update);
			//}
$updateQuery=mysql_query("update empleavedetails set Notes='Leave cancelled', status='4' where leaveID='$leaveID'") or die(mysql_query());

if($updateQuery)

{
	$dateCancelledQry = mysql_query("select appliedFor from empleavedetails where leaveID='$leaveID'");
	$dateCancelledArr = mysql_fetch_array($dateCancelledQry);
	$dateCancelled = $dateCancelledArr['appliedFor'];
	
	$dateToday = date("Y-m-d h:i:s");

	$empNameQry=mysql_query("select * from webadmin where adminID='$empId'");
	$empNameArr=mysql_fetch_assoc($empNameQry);
	$empName=$empNameArr['name'];
	$email=$empNameArr['email'];
	$subject = "Leave Cancelled By $empName";

	$msg="<p>Hello Administrator</p>
			<br/>
			<p>Employee <b>$empName</b> &nbsp; has <b>Cancelled</b> leave for </p>
			<p>Date: <b>$dateCancelled</b></p>
			
			<p>Cancelled on: $dateToday</p>
			<br/>
			<p>Regards</p>
			<p> Leave Tracker</p>
			";
	//		echo $msg;
	
  
  //send email
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:<'.$email.'>';
	//send email
	mail($adminMails, "$subject", $msg,$headers);
	?>
	<script>
	window.location="leaveStatus.php";
	</script>

<?php
}
?>