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
.sortable{
		width:100%
		}
		 .sortable tr:hover
{
    background-color:grey !important;
	color:#fff;
padding:1px !important;
}
#projectReports
{
clear:both;
}

.lead {
    background: none repeat scroll 0 0 #9bbb59;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    margin: 5px;
    padding: 5px;
    width: 100%;
}
.projectReport{
 background-color:#DFEBC7;
 	float: left;
    height: 60px;
    margin: 0 5px;
    width: 100%;

}

.projectReport select {
  height: 27px !important;
  padding: 5px;
  width: 170px !important;
}

.ownerProjectReports {
  padding: 5px;
}
.leadOwner {
  background: none repeat scroll 0 0 #DFEBC7;
  color: #678725;
  font-size: 14px;
  font-weight: bold;
}
.leadOwner :hover {
  background: none repeat scroll 0 0 #DFEBC7;
color:#678725;
}
.ownerProjectReports p {
  background: none repeat scroll 0 0 #9bbb59;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  height: 20px;
  padding:5px;
}
.Reportwrapper p {
  background: none repeat scroll 0 0 #9bbb59;
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
.history{
background: none repeat scroll 0 0 #fff;
    border: 2px solid;
    border-radius: 5px;
    box-shadow: 0 0 12px #000;
    display: none;
    padding: 5px;
    position: absolute;
    z-index: 1}

.history button {
  background: url("images/close_pop.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
  float: right;
  margin-right: -21px;
  margin-top: -23px;
  height: 34px;
  width: 34px;
  border: 0;

}

</style>
<?php include("function.php"); ?>
<?php 	if($_SESSION['type']=='1' || $_SESSION['type']=='2'){?>


	<div class="Reportwrapper">

	
	
</div>
<div id="projectReports"><?php

include("config.php");
?>

<div class="over-due">

	<?php $today=date('Y-m-d', time()+86400); ?> 
	<div class="ownerProjectReports"> <table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>First Reviewer</th><th>Owner</th><th >SSB-ID</th><th>Customer Subscription Name</th><!--<th>Start Date</th><th>Due Date</th>--><th>Service</th><th>URL To Migrate</th><th>Status</th></tr></thead>

<?php
							
							$allSsb="select * from webadmin where type='1'";
							$ssb=mysql_query($allSsb);
							?>
										
												<?php
												$x=0;
												while($ssbArr=mysql_fetch_array($ssb))
												{
													$x++; 

												$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
													?>
																		<!--<tr class="leadOwner"><td colspan="12"><?php echo $ssbArr['adminID'];?></td></tr>--><?php 
													$projects="select * from tracking where dueDate<'$today' and firstReviewer='$ssbArr[adminID]' and status !='Ready To Close' and status !='Blocked'";
													$projectQuery=mysql_query($projects);
													$dueProjectCount=mysql_num_rows($projectQuery);
													while($projectArr=mysql_fetch_array($projectQuery))
													{
													
													
													?>

												<tr style="position:relative" class='<?php echo $class; ?> <?php echo str_replace('.','',str_replace(' ', '-',$projectArr['status']));?>' ><td>
												
												
												<?php // $projectArr['firstReviewer'];
												$getFirstReviewer=mysql_query("select name from webadmin where adminID='$projectArr[firstReviewer]'");
												$reviewerArr=mysql_fetch_assoc($getFirstReviewer);
												echo $reviewerArr['name'];
												
												
												?></td><td  >
														<?php //echo $projectArr['owner'];

															$getOwner=mysql_query("select name from webadmin where adminID='$projectArr[owner]'");
															$ownerArr=mysql_fetch_assoc($getOwner);
															echo $ownerArr['name'];
														?>
														</td><td><?php echo $projectArr['ssbID'];?></td><td><?php echo $projectArr['custSubName'];?></td>
													<!--	<td><?php echo $projectArr['startDate'];?></td>	
														<td><?php echo $projectArr['dueDate'];?></td>--><td><?php echo $projectArr['service'];?></td>
														<td><?php echo $projectArr['migrateUrl'];?></td>
														<td >	<?php echo $projectArr['status'];?> </td>
														</tr>
														<?php
													}
														 @$dueProjectCounts +=$dueProjectCount;
														
												}?>
<p>Over Due Projects (<?php  echo " ".$dueProjectCounts." "; ?>) &nbsp; Due Date Before : <?php echo $today; ?> </p>

												
						</table><?php
if($dueProjectCounts == 0)
	{
													?>
													<style>
													.over-due{
													display:none;
													}
													</style>
													<?php
	}
	?>

									<br/>
						</div>

</div><?php

$dueDay=date('Y-m-d', time()+86400); 

//*****************************For Weekend Days Inclusion**************************//
 $today1=date('Y-m-d'); 
$today=strtotime($today1);
 $day = date("D", $today); 

 if($day=='Fri')
	{
	 $dueDay=date('Y-m-d', time()+(86400*3)); 

	}

//*********************************************************************************************//

?> <div class="due-today">
	<div class="ownerProjectReports"> <table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>First Reviewer</th><th>Owner</th><th >SSB-ID</th><th>Customer Subscription Name</th><!--<th>Start Date</th><th>Due Date</th>--><th>Service</th><th>URL To Migrate</th><th>Status</th></tr></thead>

<?php
							
							$allSsb="select * from webadmin where type='1'";
							$ssb=mysql_query($allSsb);
							?>
										
												<?php
												$x=0;
												while($ssbArr=mysql_fetch_array($ssb))
												{
													$x++; 

												$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
													?>
																		<!--<tr class="leadOwner"><td colspan="12"><?php echo $ssbArr['adminID'];?></td></tr>--><?php 

													$projects="select * from tracking where dueDate='$dueDay' and firstReviewer='$ssbArr[adminID]' and status !='Ready To Close' and status !='Blocked'";
													$projectQuery=mysql_query($projects);
													$projectCount=mysql_num_rows($projectQuery);
													//echo $projectCount;
													while($projectArr=mysql_fetch_array($projectQuery))
													{
													
													
													?>

												<tr style="position:relative" class='<?php echo $class; ?> <?php echo str_replace('.','',str_replace(' ', '-',$projectArr['status']));?>' ><td>
												
												
												<?php // $projectArr['firstReviewer'];
												$getFirstReviewer=mysql_query("select name from webadmin where adminID='$projectArr[firstReviewer]'");
												$reviewerArr=mysql_fetch_assoc($getFirstReviewer);
												echo $reviewerArr['name'];
												
												
												?></td><td  >
														<?php //echo $projectArr['owner'];

															$getOwner=mysql_query("select name from webadmin where adminID='$projectArr[owner]'");
															$ownerArr=mysql_fetch_assoc($getOwner);
															echo $ownerArr['name'];
														?>
														</td><td><?php echo $projectArr['ssbID'];?></td><td><?php echo $projectArr['custSubName'];?></td>
													<!--	<td><?php echo $projectArr['startDate'];?></td>	
														<td><?php echo $projectArr['dueDate'];?></td>--><td><?php echo $projectArr['service'];?></td>
														<td><?php echo $projectArr['migrateUrl'];?></td>
														<td >	<?php echo $projectArr['status'];?> </td>
														</tr>
												<?php
													}
														 $projectCounts +=$projectCount;
														
												}?>
<p>Projects Due For Today (<?php  echo " ".$projectCounts." "; ?>) &nbsp; Due Date : <?php echo $dueDay; ?> </p>
<?php
if($projectCounts == 0)
	{
													?>
													<style>
													.due-today{
													display:none;
													}
													</style>
													<?php
	}
	?>
												
						</table>

									<br/>
						</div></div>
						
						<?php 
 if($day=='Thu' || $day=='Fri')
	{
						?>
						 <div class="due-weeknd">
	<div class="ownerProjectReports"> <table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>First Reviewer</th><th>Owner</th><th >SSB-ID</th><th>Customer Subscription Name</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th>Status</th></tr></thead>

<?php
							
							$allSsb="select * from webadmin where type='1'";
							$ssb=mysql_query($allSsb);
							?>
										
												<?php
												$x=0;
												while($ssbArr=mysql_fetch_array($ssb))
												{
													$x++; 

												$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
													?>
																		<!--<tr class="leadOwner"><td colspan="12"><?php echo $ssbArr['adminID'];?></td></tr>--><?php 

													$projects="SELECT * from tracking where (dueDate = DATE(NOW() + INTERVAL (7 - DAYOFWEEK(NOW())) DAY) || dueDate = DATE(NOW() + INTERVAL (8 - DAYOFWEEK(NOW())) DAY)) and firstReviewer='$ssbArr[adminID]' and status !='Ready To Close' and status !='Blocked'";
													$projectQuery=mysql_query($projects);
													$projectCountWeekend=mysql_num_rows($projectQuery);
													//echo $projectCount;
													while($projectArr=mysql_fetch_array($projectQuery))
													{
													
													
													?>

												<tr style="position:relative" class='<?php echo $class; ?> <?php echo str_replace('.','',str_replace(' ', '-',$projectArr['status']));?>' ><td>
												
												
												<?php // $projectArr['firstReviewer'];
												$getFirstReviewer=mysql_query("select name from webadmin where adminID='$projectArr[firstReviewer]'");
												$reviewerArr=mysql_fetch_assoc($getFirstReviewer);
												echo $reviewerArr['name'];
												
												
												?></td><td  >
														<?php //echo $projectArr['owner'];

															$getOwner=mysql_query("select name from webadmin where adminID='$projectArr[owner]'");
															$ownerArr=mysql_fetch_assoc($getOwner);
															echo $ownerArr['name'];
														?>
														</td><td><?php echo $projectArr['ssbID'];?></td><td><?php echo $projectArr['custSubName'];?></td>
														<td><?php echo $projectArr['startDate'];?></td>	
														<td><?php echo $projectArr['dueDate'];?></td><td><?php echo $projectArr['service'];?></td>
														<td><?php echo $projectArr['migrateUrl'];?></td>
														<td >	<?php echo $projectArr['status'];?> </td>
														</tr>
												<?php
													}
														 $projectCountWeekends +=$projectCountWeekend;
														
												}?>
<p>Projects Due For Weekend (<?php  echo " ".$projectCountWeekends." "; ?>)</p>
												
						</table>

									<br/>
						</div>
						<?php
	}
									?>
						
						
						</div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
