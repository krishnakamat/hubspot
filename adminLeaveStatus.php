<?php
		session_start();

		if(!isset($_SESSION['loggedIn']))

		echo "<script>location.href='index.php';</script>";

						if($_SESSION['type']=='2'){

							include_once ("Header.php");

						}

						else{

							include_once ("HeaderAdmin.php");

}
include("config.php");

?>
<style>
.rejected > span {
  display: block;
  margin: 0 0 10px;
}
</style>
<?php

if(isset($_POST['submit'])){
$reply = $_POST['reply'];
//echo $reply;

$approved = $_POST['approved'];
$unplan = $_POST['planned'];
$empid = $_POST['empid'];
$datechk = $_POST['date'];
$dateval = implode(",",$datechk);
//echo $dateval;
if(isset($unplan) && $unplan==2){
	$planned = 0;
}else{
	$planned = 1;
}
if($approved==3){
$query = "update empleavedetails set status = 3 , reply='$reply', planned='$planned' where leaveID IN($dateval)";
$result = mysql_query($query);
//echo "<br/>";
$query1 = "update empleavedetails set status = 2 where leaveID NOT IN($dateval) and status = 1 and empID = '".$_GET['empid']."' ";
$result1 = mysql_query($query1);
//header("location:adminLeaveTracking.php");
}
if($approved==2){
$query = "update empleavedetails set status = 2 , reply='$reply', planned='$planned' where leaveID IN($dateval)";
$result = mysql_query($query);
$query1 = "update empleavedetails set status = 3 where leaveID NOT IN($dateval) and status = 1 and empID = '".$_GET['empid']."' ";
$result1 = mysql_query($query1);
//header("location:adminLeaveTracking.php");
}


$querydet="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where leaveID IN($dateval) and empID='".$_GET['empid']."' and typeLeave = 1 ";
$resultdet=mysql_query($querydet);
$rowdet=mysql_fetch_array($resultdet);
$balcount = $rowdet['count']/2;

$querydet1="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where leaveID IN($dateval) and empID='".$_GET['empid']."' and typeLeave = 2 ";
$resultdet1=mysql_query($querydet1);
$rowdet1=mysql_fetch_array($resultdet1);
$balcount1 = $rowdet1['count'];

$bal = $balcount + $balcount1;
//echo $bal;
$query1="select * from empleavebalance where empID = '".$_GET['empid']."'";
$result1=mysql_query($query1);
$row1=mysql_fetch_array($result1);
$levused = $row1['leaveUsed'];
$leaveUsed = $levused + $bal;
if($approved==3){
			$sql_cart_cate_update="UPDATE empleavebalance SET leaveUsed = '$leaveUsed' WHERE empID = '".$_GET['empid']."'"; 
			mysql_query($sql_cart_cate_update);
			//Start Mail
			$getAdmins="select email from webadmin where userRole ='1' and status='1'";			//
			$admins=mysql_query($getAdmins);
			while($adminArr=mysql_fetch_array($admins)){
					$adminMail .=$adminArr['email'].","; 
			}
					$adminMails = rtrim($adminMail,",");
			$dateApproved = '';
			$dateApprovedQry = mysql_query("select appliedFor from empleavedetails where empID='$empid' and status = 3 and appliedFor >= '$date'");
			while($dateApprovedArr = mysql_fetch_array($dateApprovedQry)){
					$dateApproved .=  $dateApprovedArr['appliedFor'] . ',';
			}
					$dateApproved= rtrim($dateApproved,", ");

			$dateToday = date("Y-m-d h:i:s");
			$empNameQry=mysql_query("select * from webadmin where adminID='".$_GET['empid']."'");
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
			//End Mail
			header("location:adminLeaveTracking.php");
			}
if($approved==2){
			$r = $levused - $bal;
			$sql_cart_cate_update="UPDATE empleavebalance SET leaveUsed = '$r' WHERE empID = '".$_GET['empid']."'"; 
			mysql_query($sql_cart_cate_update);
			//		Start Mail
			$getAdmins="select email from webadmin where userRole ='1' and status='1'";			//
			$admins=mysql_query($getAdmins);
			while($adminArr=mysql_fetch_array($admins)){
					$adminMail .=$adminArr['email'].","; 
			}
			$adminMails = rtrim($adminMail,",");
			$dateRejected = '';
			$dateRejectedQry = mysql_query("select appliedFor from empleavedetails where empID='".$_GET['empid']."' and status = 2 and appliedFor >= '$date'");
			while($dateRejectedArr = mysql_fetch_array($dateRejectedQry)){
					$dateRejected .= $dateRejectedArr['appliedFor'] . ',';
			}$dateRejected= rtrim($dateRejected,", ");

			$dateToday = date("Y-m-d h:i:s");
			$empNameQry=mysql_query("select * from webadmin where adminID='".$_GET['empid']."'");
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
			//End Mail
			header("location:adminLeaveTracking.php");
			}
}
?>

<html>
<head>
<script type="text/javascript">
function val(){
	if($('input[name="date[]"]:checked').length == 0) {
    alert('Please choose the date');
	return false;
}
if($('input[name="approved"]:checked').length == 0) {
    alert('Please choose the action');
	return false;
}
}
</script>
</head>

<body>

 <div class="admin-leave-status">
<div class="leave_tracking_container">
<?php
if($_GET['status']==1){
$date = date('y-m-d');
//$querydet="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn from empleavedetails where status = 1 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$querydet="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn from empleavedetails where status = 1 and empID='".$_GET['empid']."' ";
$resultdet=mysql_query($querydet) or die(mysql_error());
$num = mysql_num_rows($resultdet);
if($num > 0){
?>
<form method="post" name="test" action="" onsubmit="return val();">
<table border="1" style="border-collapse:collapse;" class="admin-leave-status-table">
<tr class="heading pending"><td colspan="6"><h1>Pending Leave</h1></td>
</tr>
<tr><td style="cellpadding:15px" class="content-headings">Name</td><td class="content-headings">Days</td><td class="content-headings">Date</td><td class="content-headings">Notes</td><td class="content-headings">Reply</td><td class="content-headings">Action</td></tr>
<?php
//$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=1 and empID = '".$_GET['empid']."' and appliedFor >= '$date'";
$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=1 and empID = '".$_GET['empid']."'";
$resultto1 = mysql_query($queryto1);
$rowto1 = mysql_fetch_array($resultto1);
$row1 = $rowto1['count']/2 ;

//if($rowto1['count']%2==0){
	//$row1 = $rowto1['count']/2;
//}
//else{
	//$row1 = $rowto1['count']/2 ;
//}

//$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=2 and empID = '".$_GET['empid']."' and appliedFor >= '$date'";
$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 1 and typeLeave=2 and empID = '".$_GET['empid']."'";
$resultto2 = mysql_query($queryto2);
$rowto2 = mysql_fetch_array($resultto2);
$row2 = $rowto2['count'];
$row3 = $row1 + $row2;

$query="select * from webadmin where adminID='".$_GET['empid']."'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
?>
<input type="hidden" name="empid" value="<?php echo $rowto2['empID']; ?>"> 

<tr><td><?php echo $row['name'];?></td><td align="center"><?php echo $row3;?></td><td><?php //echo $rowdet['fromDate'] . "   to   " ;?><?php //echo $rowdet['toDate'];?>
<?php 
while($rowdet=mysql_fetch_array($resultdet)){
?>
<input type="checkbox" value="<?php echo $rowdet['leaveID']; ?>" name="date[]" checked >
<?php
echo $rowdet['appliedFor'];
if($rowdet['typeLeave']==1){
	echo "  (Half Day)<br/>";
}else{
	echo "  (Full Day)<br/>";
}	
}
?>
</td>
<td align="center">
<?php 
//$querydett="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn from empleavedetails where status = 1 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$querydett="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn from empleavedetails where status = 1 and empID='".$_GET['empid']."' ";
$resultdett=mysql_query($querydett) or die(mysql_error());
while($rowdett=mysql_fetch_array($resultdett)){
echo $rowdett['Notes']."<br/>";
}
?>
</td><td><textarea id="reply" name="reply" rows="4" cols="21"><?php if(isset($reply)) echo $reply; ?></textarea></td>
<td align="center">
<span><input type="checkbox" name="planned" value="2"> Unplanned Leave</span><br/><br/>
<label class="approved"><input type="radio" id="approve" name="approved" value="3" >Approve</label> 
		<label class="rejected"><input type="radio" id="reject" name="approved" value="2" >Reject</label>
		</div>
		</td></tr>
<tr><td colspan="6" align="right" ><input style="margin-right:2px" type="submit" value="Submit" name="submit" class="pending" ></td></tr>
</table>
</form>

<?php } }?>




<?php
if($_GET['status']==2){
$date = date('y-m-d');
$querydet="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn, reply from empleavedetails where status = 2 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$resultdet=mysql_query($querydet) or die(mysql_error());
$num = mysql_num_rows($resultdet);
if($num > 0){
?>



<form method="post" name="test" action="">
<table align="center" border="1" style="border-collapse:collapse;" class="admin-leave-status-table">
<tr class="heading rejected"><td colspan="6"><h1>Rejected Leave</h1></td>
</tr>
<tr><td class="content-headings">Name</td><td class="content-headings">Days</td><td class="content-headings">Date</td><td class="content-headings">Notes</td><td class="content-headings">Reply</td><td class="content-headings">Action</td></tr>
<?php
$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave,reply from empleavedetails where status = 2 and typeLeave=1 and empID = '".$_GET['empid']."' and appliedFor >= '$date'";
$resultto1 = mysql_query($queryto1);
$rowto1 = mysql_fetch_array($resultto1);

if($rowto1['count']%2==0){
	$row1 = $rowto1['count']/2;
}
else{
	$row1 = $rowto1['count']/2;
}

$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave, reply from empleavedetails where status = 2 and typeLeave=2 and empID = '".$_GET['empid']."' and appliedFor >= '$date'";
$resultto2 = mysql_query($queryto2);
$rowto2 = mysql_fetch_array($resultto2);
$row2 = $rowto2['count'];
$row3 = $row1 + $row2;


$query="select * from webadmin where adminID='".$_GET['empid']."'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
?>
<input type="hidden" name="empid" value="<?php echo $rowto2['empID']; ?>"> 

<tr><td align="center"><?php echo $row['name'];?></td><td align="center"><?php echo $row3;?></td><td align="center"><?php //echo $rowdet['fromDate'] . "   to   " ;?><?php //echo $rowdet['toDate'];?>
<?php 
while($rowdet=mysql_fetch_array($resultdet)){
?>
<input type="checkbox" value="<?php echo $rowdet['leaveID']; ?>" name="date[]" checked>
<?php
echo $rowdet['appliedFor'];
if($rowdet['typeLeave']==1){
	echo "  (Half Day)<br/>";
}else{
	echo "  (Full Day)<br/>";
}	
}
?>
</td>
<td align="center">
<?php 
$querydett="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn,reply from empleavedetails where status = 2 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$resultdett=mysql_query($querydett) or die(mysql_error());
while($rowdett=mysql_fetch_array($resultdett)){
echo $rowdett['Notes']."<br/>";
}
?>
</td><td><textarea id="reply" name="reply" rows="4" cols="21"><?php 

$querydet="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn,reply from empleavedetails where status = 2 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$resultdet=mysql_query($querydet) or die(mysql_error());
while($rowdet=mysql_fetch_array($resultdet)){if(!empty($rowdet['reply'])) echo $rowdet['reply']."\n"; }?></textarea></td>
<td align="center">
 <label class="approved"><input type="radio" id="approve" name="approved" value="3" >Approve</label>
		</td></tr>
<tr><td colspan="6" align="right" ><input style="margin-right:2px" type="submit" value="Submit" name="submit" onclick="return val();" class="rejected"></td></tr>
</table>
</form>

<?php } }?>



<br/>

<?php
if($_GET['status']==3){
$date = date('y-m-d');
$querydet="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn from empleavedetails where status = 3 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$resultdet=mysql_query($querydet) or die(mysql_error());
$num = mysql_num_rows($resultdet);
if($num > 0){
?>
<form method="post" name="test" action="">
<table align="center" border="1" style="border-collapse:collapse;" class="admin-leave-status-table">
<tr class="heading approved"><td colspan="6" align="center" ><h1>Approved Leave</h1></td>
</tr>
<tr><td class="content-headings">Name</td><td class="content-headings">Days</td><td class="content-headings">Date</td><td class="content-headings">Notes</td><td class="content-headings">Reply</td><td class="content-headings">Action</td></tr>
<?php
$queryto1 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 3 and typeLeave=1 and empID = '".$_GET['empid']."' and appliedFor >= '$date'";
$resultto1 = mysql_query($queryto1);
$rowto1 = mysql_fetch_array($resultto1);

if($rowto1['count']%2==0){
	$row1 = $rowto1['count']/2;
}
else{
	$row1 = $rowto1['count']/2 ;
}

$queryto2 = "select count(typeLeave) as count, Notes,leaveID,empID,status, typeLeave from empleavedetails where status = 3 and typeLeave=2 and empID = '".$_GET['empid']."' and appliedFor >= '$date'";
$resultto2 = mysql_query($queryto2);
$rowto2 = mysql_fetch_array($resultto2);
$row2 = $rowto2['count'];
$row3 = $row1 + $row2;


$query="select * from webadmin where adminID='".$_GET['empid']."'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
?>
<input type="hidden" name="empid" value="<?php echo $rowto2['empID']; ?>"> 

<tr><td align="center"><?php echo $row['name'];?></td><td align="center"><?php echo $row3;?></td><td align="center"><?php //echo $rowdet['fromDate'] . "   to   " ;?><?php //echo $rowdet['toDate'];?>
<?php 
while($rowdet=mysql_fetch_array($resultdet)){
?>
<input type="checkbox" value="<?php echo $rowdet['leaveID']; ?>" name="date[]" checked >
<?php
echo $rowdet['appliedFor'];
if($rowdet['typeLeave']==1){
	echo "  (Half Day)<br/>";
}else{
	echo "  (Full Day)<br/>";
}	
}
?>
</td>
<td align="center">
<?php 
$querydett="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn, planned from empleavedetails where status = 3 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$resultdett=mysql_query($querydett) or die(mysql_error());
while($rowdett=mysql_fetch_array($resultdett)){
$unplan = $rowdett['planned'] ;
echo $rowdett['Notes']."<br/>";
}
?>
</td><td><textarea id="reply" name="reply" rows="4" cols="21">

<?php 

$querydet="select appliedFor,Notes, leaveID, empID, typeLeave, status,appliedOn,reply from empleavedetails where status = 3 and appliedFor >= '$date' and empID='".$_GET['empid']."' ";
$resultdet=mysql_query($querydet) or die(mysql_error());
while($rowdet=mysql_fetch_array($resultdet)){if(!empty($rowdet['reply'])) echo $rowdet['reply']."\n"; }?>
</textarea></td>
<td align="center">
<label class="rejected">
<?php
if($unplan == 0){
	echo '<span>Unplanned</span>';
}
?>
<input type="radio" id="reject" name="approved" value="2" >Reject</label>
</td></tr>
<tr><td colspan="6" align="right"><input style="margin-right:2px" type="submit" value="Submit" name="submit" onclick="return val();" class="approved"></td></tr>
</table>
</form>

<?php } }?>
</div></div>
<?php include("Footer.php"); ?>
</body>
</html>