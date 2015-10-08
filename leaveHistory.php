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
<?php if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' || $_SESSION['userRole']=='3')
{
?>
<?php
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
<form method="post" action="allLeaveStatus.php">
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
</div>
</div>
<?php
}
else
{
	echo "You are not Permitted to Access this Page";
}
?><?php include("Footer.php"); ?>