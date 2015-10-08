<?php
		session_start();

		if(!isset($_SESSION['loggedIn'])){

		echo "<script>location.href='index.php';</script>";
		}

		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}
		include("config.php");
?>
<?php if($_SESSION['userRole']=='1')
{
?>
<?php
if(isset($_POST['submit'])){
$empid = $_POST['empid'];
$approved = $_POST['approved'];
$date = date('y-m-d');
if($approved==3){

$querydet="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where empID='$empid' and typeLeave = 1 and status = 1";
$resultdet=mysql_query($querydet);
$rowdet=mysql_fetch_array($resultdet);
$balcount = $rowdet['count']/2;

$querydet1="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where empID='$empid' and typeLeave = 2 and status = 1";
$resultdet1=mysql_query($querydet1);
$rowdet1=mysql_fetch_array($resultdet1);
$balcount1 = $rowdet1['count'];
$bal = $balcount + $balcount1;
$query1="select * from empleavebalance where empID = '$empid'";
$result1=mysql_query($query1);
$row1=mysql_fetch_array($result1);
$levused = $row1['leaveUsed'];
$leaveUsed = $levused + $bal;
$sql_cart_cate_update="UPDATE empleavebalance SET leaveUsed = '$leaveUsed' WHERE empID = '$empid'"; 
mysql_query($sql_cart_cate_update);
$approved = "update empleavedetails set status = 3 where empID='$empid' and status = 1";
$resultApproved = mysql_query($approved);
// Start Mail
$getAdmins="select email from webadmin where userRole ='1' and status='1'";
$admins=mysql_query($getAdmins);
while($adminArr=mysql_fetch_array($admins))
{
	$adminMail .=$adminArr['email'].","; 
}
$adminMails = rtrim($adminMail,",");
 
$dateApproved = '';
$dateApprovedQry = mysql_query("select appliedFor from empleavedetails where empID='$empid' and status = 3 and appliedFor >= '$date'");
while($dateApprovedArr = mysql_fetch_array($dateApprovedQry)){
		$dateApproved .= $dateApprovedArr['appliedFor'] . ',';
	}
		$dateApproved= rtrim($dateApproved,", ");
		$dateToday = date("Y-m-d h:i:s");

	$empNameQry=mysql_query("select * from webadmin where adminID='$empid'");
	$empNameArr=mysql_fetch_assoc($empNameQry);
	$empName=$empNameArr['name'];
	$email=$empNameArr['email'];
	$subject = "Leave Approved By HR";

	$msg="<p>Hello Administrator</p>
			<br/>
			<p>Employee <b>$empName's</b>&nbsp;leave(s) has been <b>Approved</b> leave for </p>
			<p>Date: <b>$dateApproved</b></p>
			<p>Approved on: $dateToday</p>
			<br/>
			<p>Regards</p>
			<p> Leave Tracker</p>
			";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:<'.$email.'>';
	mail($adminMails, "$subject", $msg,$headers);
	
	// End Mail
header("location:adminLeaveTracking.php");
}
if($approved==2){
$approved = "update empleavedetails set status = 2 where empID='$empid' and status = 1";
$resultApproved = mysql_query($approved);

//	Start Mail
$getAdmins="select email from webadmin where userRole ='1' and status='1'";			//
$admins=mysql_query($getAdmins);
while($adminArr=mysql_fetch_array($admins))
{
	$adminMail .=$adminArr['email'].","; 
}
	$adminMails = rtrim($adminMail,",");
 $dateRejected = '';
 $dateRejectedQry = mysql_query("select appliedFor from empleavedetails where empID='$empid' and status = 2 and appliedFor >= '$date'");
 while($dateRejectedArr = mysql_fetch_array($dateRejectedQry)){
			$dateRejected .= $dateRejectedArr['appliedFor'] . ',';
 }
			$dateRejected= rtrim($dateRejected,", ");

 	$dateToday = date("Y-m-d h:i:s");
	$empNameQry=mysql_query("select * from webadmin where adminID='$empid'");
	$empNameArr=mysql_fetch_assoc($empNameQry);
	$empName=$empNameArr['name'];
	$email=$empNameArr['email'];
	$subject = "Leave Rejected By HR";

	$msg="<p>Hello Administrator</p>
			<br/>
			<p>Employee <b>$empName's</b>&nbsp;leave(s) has been <b>Rejected</b> leave for </p>
			<p>Date: <b>$dateRejected</b></p>
			
			<p>Approved on: $dateToday</p>
			<br/>
			<p>Regards</p>
			<p> Leave Tracker</p>
			";
  
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:<'.$email.'>';
	mail($adminMails, "$subject", $msg,$headers);
//	End Mail	
header("location:adminLeaveTracking.php");
	}

}
?>

<!-- End -->




<?php
$date = date('y-m-d');
$queryPend = "select appliedFor, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1";
$resultPend = mysql_query($queryPend);
$rownum = mysql_num_rows($resultPend);
if($rownum > 0){
?>

<!--<form action="" name="" method="post">-->
<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container adminLeaveTracking">
<table align="center" border="1" style="border-collapse:collapse;">
<tr class="heading pending"><td colspan="6"><h1>Pending Leave</h1></td></tr>
<tr><td class="content-headings">Name</td><td class="content-headings">Total Leave</td><td class="content-headings">Date</td>
<td class="content-headings">Notes</td><td class="content-headings">Approve/Reject</td><td class="content-headings">Action</td></tr>


<?php

$rr = "select distinct(empID) from empleavedetails where status = 1";
$q = mysql_query($rr);
while($rrr = mysql_fetch_array($q)){
$qn = "select * from webadmin where adminID = '$rrr[empID]'";
$resn = mysql_query($qn);
$rn = mysql_fetch_array($resn);

$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status,appliedFor, typeLeave from empleavedetails where status = 1 and typeLeave=1 and empID = '$rrr[empID]'";
$resultto1 = mysql_query($queryto1);
while($rowto1 = mysql_fetch_array($resultto1)){
//$appliedFor = $rowto1['appliedFor'].$rowto1['appliedFor'];
if($rowto1['count']%2==0){
	$row1 = $rowto1['count']/2;
}
else{
	$row1 = $rowto1['count']/2 ;
}

$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave,appliedFor from empleavedetails where status = 1 and typeLeave=2 and empID = '$rrr[empID]'";
$resultto2 = mysql_query($queryto2);
while($rowto2 = mysql_fetch_array($resultto2)){
//$appliedFor += $rowto2['appliedFor'];
$row2 = $rowto2['count'];
$row3 = $row1 + $row2;

 ?>
 <tr><td><?php echo $rn['name']; ?></td><td><?php echo $row3; ?></td>
 <td><?php 
 $querydate = "select Notes,leaveID,empID,status,appliedFor, typeLeave from empleavedetails where status = 1 and empID = '$rrr[empID]'";
$resultdate = mysql_query($querydate);
while($rowdate=mysql_fetch_array($resultdate)){
 
 echo $rowdate['appliedFor']; 
 if($rowdate['typeLeave']=='1'){
	echo "  (H)<br/>";
}else{
	echo "  (F)<br/>";
}	

} ?></td>
 <!-- 29-12-2014 -->
 
 <td>
 <?php
 $rr1 = "select Notes from empleavedetails where status = 1 and empID = '$rrr[empID]'";
$q1 = mysql_query($rr1);
while($rrr1 = mysql_fetch_array($q1)){
echo $rrr1['Notes']."<br/>"; 
}
?>

 </td>
 <form method="post">
 <td>
 <input type="hidden" name="empid" value="<?php echo $rrr['empID']; ?>">
 <input type="radio" value="3" name="approved">Approve &nbsp;&nbsp;<input type="radio" value="2" name="approved">Reject &nbsp;&nbsp;
 <input type="submit" name="submit" value="Submit"></td>
 </form>
 
 <!-- End -->
 <td><a href="adminLeaveStatus.php?empid=<?php echo $rrr['empID']; ?>&status=1">Action</a></td></tr>
 <?php
 }
}
}
?>


</table>
</div>
</div>


<?php
}
?>
<?php
$date = date('y-m-d');
//$queryPend = "select DATEDIFF(toDate,fromDate) AS DiffDate, appliedFor, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and appliedFor >= '$date'";

$queryPend = "select appliedFor, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 2 and appliedFor >= '$date'";
$resultPend = mysql_query($queryPend);
$rownum = mysql_num_rows($resultPend);
if($rownum > 0){

?>

<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container adminLeaveTracking">
<form action="" name="" method="post">
<table align="center" border="1" style="border-collapse:collapse;">
<tr class="heading rejected"><td colspan="4" class="content-headings"><h1>Rejected Leave</h1></td></tr>
<tr><td class="content-headings">Name</td><td class="content-headings">Total Leave</td><td class="content-headings">Date</td><td class="content-headings">Action</td></tr>


<?php

$rr = "select distinct(empID) from empleavedetails where status = 2 and appliedFor >= '$date'";
$q = mysql_query($rr);
while($rrr = mysql_fetch_array($q)){
$qn = "select * from webadmin where adminID = '$rrr[empID]'";
$resn = mysql_query($qn);
$rn = mysql_fetch_array($resn);

 //$queryto1 = "select count(typeLeave) as count, sum(DATEDIFF(toDate,fromDate)) AS DiffDate, fromDate, toDate, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=1 and empID = '$rrr[empID]' and appliedFor >= '$date'";
 
$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 2 and typeLeave=1 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultto1 = mysql_query($queryto1);
while($rowto1 = mysql_fetch_array($resultto1)){


if($rowto1['count']%2==0){
	$row1 = $rowto1['count']/2;
}
else{
	$row1 = $rowto1['count']/2 ;
}

//$queryto2 = "select count(typeLeave) as count, sum(DATEDIFF(toDate,fromDate)) AS DiffDate, fromDate, toDate, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=2 and empID = '$rrr[empID]' and toDate >= '$date'";
$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 2 and typeLeave=2 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultto2 = mysql_query($queryto2);
while($rowto2 = mysql_fetch_array($resultto2)){
$row2 = $rowto2['count'];
$row3 = $row1 + $row2;

 ?>
 <tr><td><?php echo $rn['name']; ?></td><td><?php echo $row3; ?></td>
  <td><?php 
 $querydate = "select Notes,leaveID,empID,status,appliedFor, typeLeave from empleavedetails where status = 2 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultdate = mysql_query($querydate);
while($rowdate=mysql_fetch_array($resultdate)){
 
 echo $rowdate['appliedFor']."<br/>"; } ?></td>
 
 <td><a href="adminLeaveStatus.php?empid=<?php echo $rrr['empID']; ?>&status=2">Action</a></td></tr>
 <?php
 }
}
}
?>


</table>
</form>
</div>
</div>
<?php
}
?>


<?php
$date = date('y-m-d');
//$queryPend = "select DATEDIFF(toDate,fromDate) AS DiffDate, appliedFor, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and appliedFor >= '$date'";

$queryPend = "select appliedFor, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 3 and appliedFor >= '$date'";
$resultPend = mysql_query($queryPend);
$rownum = mysql_num_rows($resultPend);
if($rownum > 0){

?>

<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container adminLeaveTracking">
<form action="" name="" method="post">
<table align="center" border="1" style="border-collapse:collapse;">
<tr class="heading approved"><td colspan="4"><h1>Approved Leave</h1></td></tr>
<tr><td class="content-headings">Name</td><td class="content-headings">Total Leave</td><td class="content-headings">Date</td><td class="content-headings">Action</td></tr>


<?php

$rr = "select distinct(empID) from empleavedetails where status = 3 and appliedFor >= '$date'";
$q = mysql_query($rr);
while($rrr = mysql_fetch_array($q)){
$qn = "select * from webadmin where adminID = '$rrr[empID]'";
$resn = mysql_query($qn);
$rn = mysql_fetch_array($resn);

 //$queryto1 = "select count(typeLeave) as count, sum(DATEDIFF(toDate,fromDate)) AS DiffDate, fromDate, toDate, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=1 and empID = '$rrr[empID]' and appliedFor >= '$date'";
 
$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 3 and typeLeave=1 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultto1 = mysql_query($queryto1);
while($rowto1 = mysql_fetch_array($resultto1)){


if($rowto1['count']%2==0){
	$row1 = $rowto1['count']/2;
}
else{
	$row1 = $rowto1['count']/2 ;
}

//$queryto2 = "select count(typeLeave) as count, sum(DATEDIFF(toDate,fromDate)) AS DiffDate, fromDate, toDate, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=2 and empID = '$rrr[empID]' and toDate >= '$date'";
$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 3 and typeLeave=2 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultto2 = mysql_query($queryto2);
while($rowto2 = mysql_fetch_array($resultto2)){
$row2 = $rowto2['count'];
$row3 = $row1 + $row2;

 ?>
 <tr><td><?php echo $rn['name']; ?></td><td><?php echo $row3; ?></td>
  <td><?php 
 $querydate = "select Notes,leaveID,empID,status,appliedFor, typeLeave from empleavedetails where status = 3 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultdate = mysql_query($querydate);
while($rowdate=mysql_fetch_array($resultdate)){
 
 echo $rowdate['appliedFor'];
echo "<br/>";
 } ?></td>
 
 <td><a href="adminLeaveStatus.php?empid=<?php echo $rrr['empID']; ?>&status=3">Action</a></td></tr>
 <?php
 }
}
}
?>


</table>
</form>
</div>
</div>
<?php
}
?>


<?php
$date = date('y-m-d');
//$queryPend = "select DATEDIFF(toDate,fromDate) AS DiffDate, appliedFor, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and appliedFor >= '$date'";

$queryPend = "select appliedFor, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 4 and appliedFor >= '$date'";
$resultPend = mysql_query($queryPend);
$rownum = mysql_num_rows($resultPend);
if($rownum > 0){

?>


<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container adminLeaveTracking">
<form action="" name="" method="post">
<table align="center" border="1" style="border-collapse:collapse;">
<tr class="heading cancelled2"><td colspan="3"><h1>Cancelled Leave</h1></td></tr>
<tr><td class="content-headings">Name</td><td class="content-headings">Total Leave</td><td class="content-headings">Date</td></tr>


<?php

$rr = "select distinct(empID) from empleavedetails where status = 4 and appliedFor >= '$date'";
$q = mysql_query($rr);
while($rrr = mysql_fetch_array($q)){
$qn = "select * from webadmin where adminID = '$rrr[empID]'";
$resn = mysql_query($qn);
$rn = mysql_fetch_array($resn);

 //$queryto1 = "select count(typeLeave) as count, sum(DATEDIFF(toDate,fromDate)) AS DiffDate, fromDate, toDate, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=1 and empID = '$rrr[empID]' and appliedFor >= '$date'";
 
$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 4 and typeLeave=1 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultto1 = mysql_query($queryto1);
while($rowto1 = mysql_fetch_array($resultto1)){


if($rowto1['count']%2==0){
	$row1 = $rowto1['count']/2;
}
else{
	$row1 = $rowto1['count']/2 ;
}

//$queryto2 = "select count(typeLeave) as count, sum(DATEDIFF(toDate,fromDate)) AS DiffDate, fromDate, toDate, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=2 and empID = '$rrr[empID]' and toDate >= '$date'";
$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 4 and typeLeave=2 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultto2 = mysql_query($queryto2);
while($rowto2 = mysql_fetch_array($resultto2)){
$row2 = $rowto2['count'];
$row3 = $row1 + $row2;

 ?>
 <tr><td><?php echo $rn['name']; ?></td><td><?php echo $row3; ?></td>
  <td><?php 
 $querydate = "select Notes,leaveID,empID,status,appliedFor, typeLeave from empleavedetails where status = 4 and empID = '$rrr[empID]' and appliedFor >= '$date'";
$resultdate = mysql_query($querydate);
while($rowdate=mysql_fetch_array($resultdate)){
 
 echo $rowdate['appliedFor']."<br/>"; 
 
 } ?></td>
 
 </tr>
 <?php
 }
}
}
?>


</table>
</form>
</div>
</div>
<?php
}
?>


<?php
}
else
{
	echo "You are not Permitted to Access this Page";
}
?><?php include("Footer.php"); ?>