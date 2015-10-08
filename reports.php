<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){					include_once ("HeaderAdmin.php");		}		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 						include_once ("Header.php");		}

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
<?php include("function.php");
date_default_timezone_set('America/New_York'); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>
	<div class="Reportwrapper">
	<div class="dayReport">
	<?php $today=date("Y-m-d"); ?>
	<p>Day Report (<?php echo  date("d-M-Y", strtotime($today));?>)</p>
	<table  border="1" style="border-collapse:collapse;"><tr class="users"><th>Project</th><th>Count </th><th>Hours</th></tr>
	<tr  class="users" style="height:180px" ><td><?php $allServices="select distinct service from closedssb where closedOn='$today' && isManual !='1' group by service "; 
								  $service=mysql_query($allServices);
								  while($serviceArr=mysql_fetch_array($service))
										{
											echo $serviceArr['service'];
											echo "<br/>";
										}
	
	
	
	?></td>
	
			<td><?php $allServices2="select count(distinct ssbID) as servicecount from closedssb where closedOn='$today' && isManual !='1'   group by service"; 
								  $service2=mysql_query($allServices2);
									
								//  echo (mysql_num_rows($service2));
								  while($serviceArr2=mysql_fetch_array($service2))
									{
											echo $serviceArr2['servicecount'];
										//	echo $serviceArr2['ssbID'];
										echo "<br/>";
										}
	
	
	
	?> </td>	
			<td><?php $allServices1="select sum(hours2) as hrs from closedssb where closedOn='$today' && isManual !='1' group by service"; 
								  $service1=mysql_query($allServices1);
								  while($serviceArr1=mysql_fetch_array($service1))
										{
											echo round($serviceArr1['hrs'],2);
											echo "<br/>";
										}
	
	
	
	?></td></tr>
	<tr class="users"><td>Manual Entries</td><td><?php $allServices2Manual="select count(distinct ssbID) as servicecountDay from closedssb where closedOn='$today' && isManual='1'"; 
								  $service2Manual=mysql_query($allServices2Manual);
									
								//  echo (mysql_num_rows($service2));
								  $serviceArr2Manual=mysql_fetch_assoc($service2Manual);
											 $todayManual=$serviceArr2Manual['servicecountDay'];
										//	echo $serviceArr2['ssbID'];
										echo $todayManual;
										
	
	
	
	?> </td><td>
<?php $allServices1Manual="select sum(hours2) as hrsDay from closedssb where closedOn='$today' && isManual='1'"; 
								  $service1Manual=mysql_query($allServices1Manual);
								  while($serviceArr1Manual=mysql_fetch_array($service1Manual))
										{
											echo round($serviceArr1Manual['hrsDay'],2);
											echo "<br/>";
										}
	
	
	
	?>
	</td>
	<tr class="users" ><td>Total</td><td><?php $allServices9="select  count(distinct ssbID) as allProjects from closedssb where closedOn='$today' "; 
								  $service9=mysql_query($allServices9);
								  $serviceArr9=mysql_fetch_assoc($service9);
								
											$todayClosed = round($serviceArr9['allProjects'],2);
											echo $todayClosed-$todayManual;
									
	
	
	
	?></td><td><?php $allServices3="select sum(hours2) as allhrs from closedssb where closedOn='$today'"; 
								  $service3=mysql_query($allServices3);
								  while($serviceArr3=mysql_fetch_array($service3))
										{
											echo round($serviceArr3['allhrs'],2);
											echo "<br/>";
										}
	
	
	
	?></td></tr>

	</table>
	</div>

	<div class="monthReport">
	
	<?php $month=date('m'); 
	$year=date('Y');
	?>
	<p>Month Report (<?php echo  date("M"); ?><?php echo " - ".date('Y'); ?>)</p>
	<table   border="1" style="border-collapse:collapse;" ><tr class="users"><th>Project</th><th>Count </th><th>Hours</th></tr>
	<tr   class="users" style="height:180px"><td><?php $allServices4="select distinct service from closedssb where MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year' && isManual !='1' group by service "; 
								  $service4=mysql_query($allServices4);
								  while($serviceArr4=mysql_fetch_array($service4))
										{
											echo $serviceArr4['service'];
											echo "<br/>";
										}
	
	
	
	?></td></td>
	
			<td><?php $allServices5="select count(distinct ssbID) as servicecount from closedssb where MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year' && isManual !='1'  group by service"; 
								  $service5=mysql_query($allServices5);
								    
								  while($serviceArr5=mysql_fetch_array($service5))
										{
										echo $serviceArr5['servicecount'];
										echo "<br/>";
										}
	
	
	
	?> </td>	
			<td><?php $allServices6="select sum(hours2) as hrs from closedssb where MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year'  && isManual !='1' group by service"; 
								  $service6=mysql_query($allServices6);
								  while($serviceArr6=mysql_fetch_array($service6))
										{
											echo round($serviceArr6['hrs'],2);
											echo "<br/>";
										}
	
	
	
	?></td></tr>
	<tr  class="users" ><td>Manual Entries</td><td><?php $allServicesManualCount="select count(distinct ssbID) as servicecountManual from closedssb  where MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year' && isManual='1'"; 
								  $serviceManualCount=mysql_query($allServicesManualCount);
								  while($serviceArrManualCount=mysql_fetch_array($serviceManualCount))
										{
											echo round($serviceArrManualCount['servicecountManual'],2);
											echo "<br/>";
										}
										
	
	
	
	?></td><td><?php $allServicesManual="select sum(hours2) as ManHrs from closedssb where MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year' and isManual='1' "; 
								  $serviceManual=mysql_query($allServicesManual);
								  while($serviceArrManual=mysql_fetch_array($serviceManual))
										{
											echo round($serviceArrManual['ManHrs'],2);
											echo "<br/>";
										}
										
	
	
	
	?></td></tr>
	<tr class="users"><td>Total</td><td>
	<?php $allServices8="select  count(distinct ssbID) as allProjects from closedssb where MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year' && isManual !='1'"; 
								  $service8=mysql_query($allServices8);
								  while($serviceArr8=mysql_fetch_array($service8))
										{
											echo round($serviceArr8['allProjects'],2);
											echo "<br/>";
										}
	
	
	
	?></td><td><?php $allServices7="select sum(hours2) as allhrs from closedssb where MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year'"; 
								  $service7=mysql_query($allServices7);
								  while($serviceArr7=mysql_fetch_array($service7))
										{
											echo round($serviceArr7['allhrs'],2);
											echo "<br/>";
										}
	
	
	
	?></td></tr>

	</table>
	
	</div>
	<div class="ownerReport">
	<p>Owner Report</p>
	<table>
		<?php $allOwners="select count(owner) as ownercount,owner,custSubName from tracking group by owner order by ownercount desc";
								  $owner=mysql_query($allOwners);
								  $x=0;
								  while($ownerArr=mysql_fetch_array($owner))
										{
									  $x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
									  ?>
									  
				<tr class='<?php echo $class; ?>'><td > <b><?php echo $x." . "; ?></b> <?php
				 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ownerArr[owner]'");
						$ownerArr1=mysql_fetch_array($getOwnerName);
						$ownerName= $ownerArr1['name'];

				
				echo $ownerName ;?></td><td><?php echo $ownerArr['ownercount']; ?></td><td><a target="_blank" href="viewDetails.php?owner=<?php echo $ownerArr['owner'];?>">View Data</a></td></tr>



									<?php 	}
	
	
	
	?>
</table>
	</div>

</div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>