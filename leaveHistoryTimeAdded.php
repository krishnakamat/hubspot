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
$mon=date('m');
$year=date('Y');
$getLeaveBalance = "select * from empleavebalance where empID = '".$_GET['adminID']."'";
$resultLeaveBalance = mysql_query($getLeaveBalance);
$rowLeaveBalance = mysql_fetch_array($resultLeaveBalance);
$remainingLeave = ($rowLeaveBalance['accrued'] + $rowLeaveBalance['salaryAdjustment']) - $rowLeaveBalance['leaveUsed'];

$getName = "select * from webadmin where adminID='".$_GET['adminID']."'";
$resultName = mysql_query($getName);
$rowName = mysql_fetch_array($resultName);
?>

<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container adminLeaveTracking">
<form method="post" action="timeTrackingList.php">
<table align="center" border="1" style="border-collapse:collapse;max-width:800px;">
<tr class="heading"><td colspan="6" width="50%"><h2>Leave History</h2><div style="float:left;"><?php echo $rowName['name'];?><?php echo "(".$rowName['empID'].")";?></div></td></tr>
<tr><td class="content-headings">Date</td><td class="content-headings" width="50px">Day</td><td class="content-headings" width="100px;">Type</td><td class="content-headings">Status</td><td class="content-headings">Notes</td></tr>
<?php
$getLeaveDetails = "select * from empleavedetails where status = 3 and empID='".$_GET['adminID']."'";
$resultLeaveDetails = mysql_query($getLeaveDetails);
while($fetchLeaveDetails = mysql_fetch_array($resultLeaveDetails)){
$getdate = strtotime($fetchLeaveDetails['appliedFor']);
$day = date('l', $getdate);
?>
<tr><td><?php echo date("d-M-Y",strtotime($fetchLeaveDetails['appliedFor'])); ?></td><td><?php echo $day ;?></td><td><?php if($fetchLeaveDetails['typeLeave']==1){ echo "Half Day";}?><?php if($fetchLeaveDetails['typeLeave']==2){ echo "Full Day";}?></td><td><?php if($fetchLeaveDetails['status']==1){ echo "Pending";}?><?php if($fetchLeaveDetails['status']==2){ echo "Rejected";}?><?php if($fetchLeaveDetails['status']==3){ echo "Approved";}?> <?php if($fetchLeaveDetails['planned'] == 0) { echo " ( <span style='color:#235A81'>Unplanned</span> ) "; }?></td><td><?php echo $fetchLeaveDetails['Notes'];?></td></tr>
<?php } ?>
<tr><td colspan="6">Remaining Leave:<b><?php echo "  ".$remainingLeave." (This includes the future leave(s))" ;?></b><input type="submit" value="Back"></td></tr>
</table>
</form>
<br/>
<br/>
<?php
$selectLeave = "select * from leave_idle_timesheet where owner = '".$_GET['adminID']."' and MONTH(dateAdded) = '$mon' 
and YEAR(dateAdded) = '$year' and type = 1";
$resultLeave = mysql_query($selectLeave);
$numLeave = mysql_num_rows($resultLeave);
if($numLeave > 0){?>
<table align="center" border="1" style="border-collapse:collapse;max-width:800px;">
<tr class="heading"><td colspan="6" width="50%"><h2>Added Leave Time</h2></td></tr>
<tr><td>Date</td><td>Day</td><td>Hours</td></tr>
<?php
	while($rowLeave = mysql_fetch_assoc($resultLeave)){ 
	$dateAdded = $rowLeave['dateAdded'];
	$timeAdded = $rowLeave['timeAdded'];
	$getdate1 = strtotime($dateAdded);
	$getday = date('l', $getdate1);
	?>
		<tr><td><?php echo date("d-M-Y",strtotime($dateAdded)) ; ?></td>
		<?php if($getday=='Saturday' || $getday=='Sunday') { ?>
		<td style='background-color:#cccccc;'>
		<?php }else{ ?>
		<td>
		<?php } ?>
		<?php echo $getday; ?></td>
				<td><?php echo $timeAdded ; ?></td></tr>
<?php	/*$owner = $rowLeave['owner'];
	$dateAdded = $rowLeave['dateAdded'];
	$timeAdded = $rowLeave['timeAdded'];
	$getdate1 = strtotime($dateAdded);
	$getday = date('l', $getdate1);
	$leaveDetails = "select * from empleavedetails where empID = '$owner' and appliedFor = '$dateAdded' and status = 3";
	$resLeaveDetails = mysql_query($leaveDetails);
	$numLeaveDetails = mysql_num_rows($resLeaveDetails);
	//$rowLeaveDetails = mysql_fetch_assoc($resLeaveDetails);
		if($numLeaveDetails < 1){ ?>
				<tr><td><?php echo date("d-M-Y",strtotime($dateAdded)) ; ?></td><td><?php echo $getday; ?></td>
				<td><?php echo $timeAdded ; ?></td></tr>
		
<?php
		}*/
		
	}
?>
</table>
<?php } ?>
</div>
</div>
<?php
}
else
{
	echo "You are not Permitted to Access this Page";
}
?><?php include("Footer.php"); ?>