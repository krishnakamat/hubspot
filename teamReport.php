<?php
	
		session_start();
		if(!isset($_SESSION['loggedIn'])){
		echo "<script>location.href='index.php';</script>";
		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
					include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 	
					include_once ("Header.php");
		}


include("config.php");
$lead=$_POST['lead'];

$month=date('F');
$mon=date('m');
$year=date('Y');
$num = cal_days_in_month(CAL_GREGORIAN, $mon, $year) ;
		
?>
<style>
.sortable{
		width:100%
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
.chart > p {
  color: red;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
}

</style>

<?php include("function.php"); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>

	<div class="Reportwrapper">

	<div class="projectReport">
	<p>For Team: <?php
	 $getTlName=mysql_query("select * from webadmin where adminID ='$lead'");
						$leadArr=mysql_fetch_array($getTlName);
						$leadName = $leadArr['name'];

	
	echo $leadName; ?>, &nbsp; Report For Month: <?php echo $month."-".$year; 
				?></p>
<form name="teamLeads" action="teamReport.php" method="post" >
	<select name="lead" onchange="this.form.submit()"><option value="">---Select Team Lead---</option>
   <?php
			$allAdUsers="select * from webadmin where type='1'";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>		<option value="<?php echo $userAdArr['adminID'];?>"><?php echo $userAdArr['name'];?></option>
				

	<?php 	}	?>
</select>	</div>
	
</div>


		<link rel="stylesheet" href="commongroup.css">
		<link rel="stylesheet" href="03.css">
	</head>
	<body>
<h2> </h2>
		<div id="wrapper">
			<div class="chart">
				
				<table id="data-table" border="1" cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<td>&nbsp;</td>
						<?php
  $allOwner1="select * from webadmin where type='2' and teamLead='$lead'";
  $ownerData1=mysql_query($allOwner1);
  while($dat1=mysql_fetch_array($ownerData1))
							{?>
  <th scope="col" ><?php echo $dat1['name']; ?></th><?php 
}
						?>
					
						<th scope="col"><?php echo  $leadName; 
							$getLeadID="select adminID from webadmin where name='$leadName'";
					$leadID=mysql_query($getLeadID);
					$leadIDArr=mysql_fetch_assoc($leadID);
						?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">Hours</th>
							<?php
  $allOwner="select * from webadmin where type='2' and teamLead='$lead'";
						
  $ownerData=mysql_query($allOwner);
  while($dat=mysql_fetch_array($ownerData))
							{
						
  
  ?>
  <?php 
  $allHours="select sum(hours2) as hrs  from closedssb where (owner='$dat[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' ) group by owner";
		
  $hoursData=mysql_query($allHours);
  $data=mysql_fetch_assoc($hoursData);

   @$sum += $data['hrs']; 
  ?> <td><?php echo round($data['hrs'],2); ?>  </td>
 <?php
  			}
  ?>
  <td><?php 
  $allHoursLead="select sum(hours2) as hrs  from closedssb where (owner='$leadIDArr[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' ) group by owner";
		
  $hoursDataLead=mysql_query($allHoursLead);
  $dataLead=mysql_fetch_assoc($hoursDataLead);
  echo $leadTime=round($dataLead['hrs'],2); 
  ?>
</td>

  
						</tr>
					<tr>
							<th scope="row">Project Count</th>
							<?php
  $allOwner123="select * from webadmin where type='2' and teamLead='$lead'";
  $ownerData123=mysql_query($allOwner123);
  while($dat123=mysql_fetch_array($ownerData123))
							{
  ?>
 <?php
 $project="select count(distinct ssbID) as number  from closedssb  where   (owner='$dat123[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' )";
//  echo $project;
  echo "<br/>";
  $projectData=mysql_query($project);
  while($dataProj=mysql_fetch_array($projectData))
								{

  ?>
 <td><?php echo $dataProj['number'];?></td>
 <?php
   @$resources .= $dat123['adminID'].","; 
  }

							}
 ?>
  <td><?php 
  $projectLead="select count(distinct ssbID) as number  from closedssb  where   (owner='$leadIDArr[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' )";
//  echo $project;
  echo "<br/>";
  $projectDataLead=mysql_query($projectLead); 
 $dataProjLead=mysql_fetch_assoc($projectDataLead);
 echo $dataProjLead['number'];?></td>

						</tr>
					
					</tbody>
					
				</table>
			<p>Total Hours: <?php 
			
  $allHourssum="select sum(hours2) as hrssum  from closedssb where (teamLead='$lead' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' )";
		//echo $allHourssum;
  $hoursDatasum=mysql_query($allHourssum) or die(mysql_error());
  $datasum=mysql_fetch_assoc($hoursDatasum);

   echo round($datasum['hrssum'],2); 
  
 // echo round($sum+$leadTime,2);?>&nbsp; Total Projects : <?php 

				 $resourcesArr=rtrim($resources,",");
				 $getTeamHours=mysql_query("select count(distinct ssbID) as ProjectNumber  from closedssb  where   (teamLead ='$lead' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' )");
				  $getTeamHoursData=mysql_fetch_assoc($getTeamHours);
				  echo $getTeamHoursData['ProjectNumber'];
				 ?></p>
			</div>
				
		</div>
				
		<!-- JavaScript at the bottom for fast page loading -->
		
		<!-- Grab jQuery from Google -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		
		<!-- Example JavaScript -->
		<script src="ownergraph.js"></script>
		
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>