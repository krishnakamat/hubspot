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

<style>
	.allLeaves tr:hover
	{
		background-color:#eee;
	}
</style>
<!--<form action="" name="" method="post">-->
<div class="leave_tracking_container-wrapper">
<?php
$activeEmp = "select * from webadmin where status = 1 and employeeType = 1 and empID!=0 and adminID NOT IN(18,19)";
$resultActiveEmp = mysql_query($activeEmp);
$numActiveEmp = mysql_num_rows($resultActiveEmp);
?>
<div class="leave_tracking_container adminLeaveTracking">
<h2 style="margin-left:41px;">Active Employees:<b><?php echo "    ".$numActiveEmp; ?></b></h2>

<table align="center" border="1" class="allLeaves" style="border-collapse:collapse;">
<tr class="heading"><td colspan="6"><h2>All Leave Status</h2></td></tr>
<tr><td class="content-headings">Employee ID</td><td class="content-headings">Name</td><td class="content-headings">Accured</td><td class="content-headings">Used</td>
<td class="content-headings">Salary Adjustment</td><td class="content-headings">Remaining</td></tr>
<?php
$getLeaveStatus = "select *, webadmin.empID as employee from webadmin INNER JOIN empleavebalance on webadmin.adminID = empleavebalance.empID 
where webadmin.status = 1 and webadmin.employeeType = 1 order by webadmin.empID";
$resultLeaveStatus = mysql_query($getLeaveStatus);
while($rowLeaveStatus = mysql_fetch_array($resultLeaveStatus)){
if($rowLeaveStatus['adminID']!=18 && $rowLeaveStatus['adminID']!=19){
$date = date('y-m-d');
$getFullLeaveDetails = "select count(appliedFor) as count from empleavedetails where 
empID = '".$rowLeaveStatus['adminID']."' and appliedFor > '$date' and status = 3 and typeLeave = 2";
$resultFullLeaveDetails = mysql_query($getFullLeaveDetails);
$rowFullLeaveDetails = mysql_fetch_assoc($resultFullLeaveDetails);

$getHalfLeaveDetails = "select count(appliedFor) as count1 from empleavedetails where 
empID = '".$rowLeaveStatus['adminID']."' and appliedFor > '$date' and status = 3 and typeLeave = 1";
$resultHalfLeaveDetails = mysql_query($getHalfLeaveDetails);
$rowHalfLeaveDetails = mysql_fetch_assoc($resultHalfLeaveDetails);

$rem = $rowFullLeaveDetails['count'] + $rowHalfLeaveDetails['count1']/2 ;
$remainingLeave = ($rowLeaveStatus['accrued'] + $rowLeaveStatus['salaryAdjustment']) - $rowLeaveStatus['leaveUsed'] + $rem;
?>
<tr><td><?php echo $rowLeaveStatus['employee']; ?></td>
	<td><a href="leaveHistory.php?adminID=<?php echo $rowLeaveStatus['adminID'];  ?>"><?php echo $rowLeaveStatus['name']; ?></a></td>
	<td><?php echo $rowLeaveStatus['accrued']; ?></td>
	<td><?php echo $rowLeaveStatus['leaveUsed']; ?></td>
	<td><?php echo $rowLeaveStatus['salaryAdjustment']; ?></td>
	<?php
	
	
 	?>
	
	<?php if($remainingLeave < 0){ ?><td style="background:#F08080;"><?php }else{?><td><?php } echo $remainingLeave; ?></td></tr>
<?php } } ?>

</table>
</div>
</div>



<?php
}
else
{
	echo "You are not Permitted to Access this Page";
}
?><?php include("Footer.php"); ?>