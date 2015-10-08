<?php
		session_start();

		if(!isset($_SESSION['loggedIn'])){

		echo "<script>location.href='index.php';</script>";
		}

		if(($_SESSION['userRole']==1 && $_SESSION['status']==1 || ($_SESSION['userRole']==2 && $_SESSION['status']==1)) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}
include("config.php");

?>

<html>
<body>

<script>
function cancelLeave(leaveID,empID)
{
	var conf=confirm("Are You Sure, you want to cancel the leave");
	if(conf)
	{
		window.location="cancelLeave.php?leaveID="+leaveID+"&empID="+empID;
	}
	else
	{
	}
}
</script>
<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container">
<?php
$empid = $_SESSION['adminID'];
$query1="select * from webadmin where adminID='$empid'";
$result1=mysql_query($query1);
$row1=mysql_fetch_array($result1);

$date = date('y-m-d');
$querydet="select appliedFor,Notes,planned, leaveID, empID, typeLeave, status,appliedOn, reply from empleavedetails where appliedFor >= '$date' and empID='$empid'";
$resultdet=mysql_query($querydet) or die(mysql_error());
$num = mysql_num_rows($resultdet);
if($num > 0){
?>

<div class="leave_tracking_container-wrapper">
<form method="post" action="">
<table border="1px" align="center" style="border-collapse:collapse" class="leave_status_table">
<tr class="heading"><td colspan="4"><h1><?php echo $row1['name']; ?></h1></td></tr>
<tr><td class="content-headings">Date</td><td class="content-headings">Type</td><td class="content-headings">Reply</td><td class="content-headings">Status</td></tr>
<?php 
while($row=mysql_fetch_array($resultdet)){
?>
<tr>
<input type="hidden" name="empid" value="<?php echo $row['empID']; ?>">
<td><?php echo $row['appliedFor']; ?></td>
<td><?php if($row['typeLeave']==1){ echo "Half Day";}else{ echo "Full Day"; }?></td>
<td><?php echo $row['reply']; ?></td>
<td><?php if($row['status']==1){ echo "<span class='pending'>Pending</span>" ." | <span onclick='cancelLeave($row[leaveID],$row[empID])' style='cursor:pointer;text-decoration:underline'>Cancel</span>";}elseif($row['status']==2){ echo "<span class='rejected'>Rejected</span>";}elseif($row['status']==4){ echo "<span class='cancelled'>Cancelled";}
else{ echo "<span class='approved'>Approved</span>"?>
<?php if($row['planned'] == '1'){ echo "| <span  onclick='cancelLeave($row[leaveID],$row[empID])' style='cursor:pointer;text-decoration:underline'>Cancel</span>";} else {echo "| <span > Absent</span>";}} ?> </td></tr>
<?php
}

?>
</table>
</form>

</div>
</div>
<?php } else {?>
					<div style='align:center;margin-left:45%'>There is no leave records!</div>
<?php			}		
?>
<?php include("Footer.php"); ?>
</body>
</html>