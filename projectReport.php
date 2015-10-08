<?php
	session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php");
$lead=$_GET['lead'];
?>

	<p class="lead">Team Lead:  <?php 
 $getOwnerName=mysql_query("select * from webadmin where adminID ='$lead'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$leadName = $ownerArr['name'];
						echo $leadName;
  ?>
	<div class="ownerProjectReports"> <table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th >SSB-ID</th><th>Customer Subscription Name</th><th>Queue</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th>Pages</th><th>Status</th><th>Owner</th><th>First Reviewer</th><th>Second Reviewer</th></tr></thead>

<?php
								$allUsers="select * from webadmin where teamLead='$lead' and userRole = 3 and status = 1";
								$users=mysql_query($allUsers);
								while($userArr=mysql_fetch_array($users))
						{
							$allSsb="select * from tracking where status !='Closed' && owner='$userArr[adminID]' ";
							$ssb=mysql_query($allSsb);
							?>
					<tr class="break"><td colspan="12">		</td></tr>		
					<tr class="leadOwner"><td colspan="12">	<?php echo $userArr['name'];?>	</td></tr>
										
												<?php
												$x=0;
												while($ssbArr=mysql_fetch_array($ssb))
												{
													$x++; 

												$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
													?>
												<tr style="position:relative"  onmouseover="getHistory(<?php echo $ssbArr['trackID'];?>)" class='<?php echo $class; ?>  <?php echo str_replace('.','',str_replace(' ', '-',$ssbArr['status']));?>' ><td><?php echo $ssbArr['ssbID'];?></td><td><?php echo $ssbArr['custSubName'];?></td>
														<td><?php echo $ssbArr['queue'];?></td><td><?php echo $ssbArr['startDate'];?></td>	
														<td><?php echo $ssbArr['dueDate'];?></td><td><?php echo $ssbArr['service'];?></td>
														<td><?php echo $ssbArr['migrateUrl'];?></td>
														<td><?php echo $ssbArr['pages'];?></td><td >
																<?php echo $ssbArr['status'];?> <div class="history" id="history<?php echo $ssbArr['trackID'];?>">
																																			<b>	History For <?php echo $ssbArr['ssbID'];?></b>
																																<?php
																																$selectHistory="Select * from trackinghistory where trackID='$ssbArr[trackID]'";
																																$getHistory=mysql_query($selectHistory);
																															?>
																															<table border="1" class="sortable" style="border-collapse:collapse"><thead><th>Updated Data</th><th>Updated To</th><th>Date</th><th>Updated By</th></thead>
																															<?php
																															$x=0;
																																while($historyArr=mysql_fetch_array($getHistory))
																																{
																																$x++; 

																															$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
																																?>
																																	<tr class='<?php echo $class; ?>' ><td><?php echo $historyArr['updates'];?></td><td>
																																	
	<?php	if(is_numeric($historyArr['status']))
		{
		 $getOwnerName=mysql_query("select * from webadmin where adminID ='$historyArr[status]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$statusName = $ownerArr['name'];
							echo $statusName;

		}
		else{
		
?>
		<?php echo $historyArr['status']; ?>
	<?php 	} ?>
																																	
																																	</td><td><?php echo $historyArr['date'];?></td><td><?php echo $historyArr['updatedBy'];?></td></tr>
																																
																																<?php
																																}

																																?>
																																</table>
																																																															
																																																															
																																</div></td>
														<td  >
														<?php echo $ssbArr['owner'];?>
														</td>
														<td>
												<?php echo $ssbArr['firstReviewer'];?></td>
														<td ><?php echo $ssbArr['secondReviewer'];?></td>
														</tr>
												<?php
												}?>

												
						<?php
						}?></table>

									<br/>
						</div>