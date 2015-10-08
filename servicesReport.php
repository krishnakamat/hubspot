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
.dayReport{
float:left;
width:300px;
height:300px;

}
.dayReport table{
width:100%;
}
.monthReport  table{
width:100%;
}

.loginReport  table{
width:100%;
}

.loginReport{
	float: left;
    height: 300px;
    margin: 0 5px;
    width: 300px;
}
.ownerReport  table{
width:100%;
}
.ownerReport  table tr{
width:30%;
}

.monthReport{
	float: left;
    height: 300px;
    margin: 0 5px;
    width: 300px;
}
.ownerReport{
float:left;
width:600px;
}

.Reportwrapper p {
  background: none repeat scroll 0 0 #9bbb59;
  border-color: #000;
  border-style: solid;
  border-width: 1px 1px 0 ;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  margin: 0;
  padding: 5px;
  text-align: center;
  text-transform: capitalize;
}
.ownerReport table {
  border: 1px solid #000;
  display: block;
  overflow: hidden;
  width: 100%;
}
.ownerReport tbody {
  display: block;
  width: 100%;
}
.ownerReport table tr {
  display: block;
  float: left;
  padding: 2px 1%;
  width: 48%;
}
.ownerReport td {
  display: inline-block;
  width: 20%;
}
.ownerReport td:first-child {
  width: 55%;
}
.users {
  background: none repeat scroll 0 0 #dfebc7;
  color: green;
  font: 14px Trebuchet MS;
  margin: 1px;
  padding: 8px 10px;
}
	.users td{
	padding:10px 7px;
	line-height:30px;
	}
.users th {
  font-weight: bold;
  padding: 10px 7px;
}
</style>
<?php include("function.php"); ?>
<?php 	if($_SESSION['type']=='1'|| $_SESSION['type']=='2'){?>
	<div class="Reportwrapper">
	<div class="dayReport">
	<?php $month=date('m');
	$year=date('Y');
	?>
	<p>CMS > COS Full Migration</p>
	<table  border="1" style="border-collapse:collapse;"><tr class="users"><th>Status</th><th>Count </th></tr>
	<tr  class="users"><td>Closed</td><td>
<?php $closedCmsFM="select count(distinct ssbID) as closedCmsFM from closedssb where service='CMS>COS Full Migration' and MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year'"; 
				$obtainedCmsFM=mysql_query($closedCmsFM);
				$cmsFM=mysql_fetch_assoc($obtainedCmsFM);
				echo $cmsFM['closedCmsFM'];

?>
	</td>	</tr>
	<tr class="users" ><td>In Progress</td><td><style>
	 .statusReport
	{
		display:none;
	}
	.totalProgress:hover .statusReport {
  background: none repeat scroll 0 0 #ccc;
  display: block !important;
  height: auto;
  left: 300px;
  position: absolute;
  top: 109px;
  width: 200px;
}
.statreport td{
line-height:27px;
}
	
	</style>
<?php $progressCmsFM="select count(*) as progressCms from tracking where (status='In Progress' || status='Ready For Review' || status='First Rev. Issues Sent'  || status='First Review Done'  || status='Second Rev. Issues Sent' )  and service='CMS>COS Full Migration'"; 
				$inProgressCmsFM=mysql_query($progressCmsFM);
				$cmsFMprogress=mysql_fetch_assoc($inProgressCmsFM);?>
				<div  class="totalProgress"><?php echo $cmsFMprogress['progressCms'];?><div class="statusReport">
						
							<table  class="statreport"><tr><td>In Progress</td><td> <?php $inProgress="select count(*) as inprogress from tracking where (status='In Progress' )  and service='CMS>COS Full Migration'"; 
				$getinProgress=mysql_query($inProgress);
				$totalInprogress=mysql_fetch_assoc($getinProgress);
				echo $totalInprogress['inprogress'];
				?></td></tr>

							<tr><td>Ready For Review</td><td><?php $readyReview="select count(*) as readyForReview from tracking where (status='Ready For Review' )  and service='CMS>COS Full Migration'"; 
				$getReadyReview=mysql_query($readyReview);
				$totalReadyReview=mysql_fetch_assoc($getReadyReview);
				echo $totalReadyReview['readyForReview'];
				?></td></tr>

							<tr><td>First Rev. Issues Sent</td><td><?php $firstIssue="select count(*) as firstIssue from tracking where (status='First Rev. Issues Sent'  )  and service='CMS>COS Full Migration'"; 
				$getFirstIssue=mysql_query($firstIssue);
				$totalFirstIssue=mysql_fetch_assoc($getFirstIssue);
				echo $totalFirstIssue['firstIssue'];
				?></td></tr>

							<tr><td>First Review Done</td><td><?php $firstReview="select count(*) as firstReview from tracking where (status='First Review Done' )  and service='CMS>COS Full Migration'"; 
				$getFirstReview=mysql_query($firstReview);
				$totalFirstReview=mysql_fetch_assoc($getFirstReview);
				echo $totalFirstReview['firstReview'];
				?></td></tr>

							<tr><td>Second Rev. Issues Sent</td><td><?php $secondIssue="select count(*) as secondIssue from tracking where ( status='Second Rev. Issues Sent' )  and service='CMS>COS Full Migration'"; 
				$getSecondIssue=mysql_query($secondIssue);
				$totalSecondIssue=mysql_fetch_assoc($getSecondIssue);
				echo $totalSecondIssue['secondIssue'];
				?></td></tr></table>

							</div></div>
				

</td></tr>
		<tr class="users" ><td>Not Assigned</td><td>
<?php $notAssignedCmsFM="select count(*) as notassigned from tracking where owner='Not Assigned' and service='CMS>COS Full Migration '"; 
				$obtainedNACmsFM=mysql_query($notAssignedCmsFM);
				$nAcmsFM=mysql_fetch_assoc($obtainedNACmsFM);
				echo $nAcmsFM['notassigned'];

?>

</td></tr>
<tr class="users" ><td>Template Completed</td><td>
<?php $completedCmsTemp="select count(*) as completedCms from tracking where service='CMS>COS Full Migration' and status='CMS->COS Template Done'"; 
				$obtainedCmsTemp=mysql_query($completedCmsTemp);
				$cmsTemp=mysql_fetch_assoc($obtainedCmsTemp);
				echo $cmsTemp['completedCms'];

?>

</td></tr>


	</table>
	</div>

		

</div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
