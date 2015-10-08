<?php
ob_start();
		@session_start();
			if(!isset($_SESSION['loggedIn']))
		echo "<script>location.href='index.php';</script>";
				if($_SESSION['type']=='2'){
					include_once ("Header.php");
				}
				else{
					include_once ("HeaderAdmin.php");
				}

include("config.php");

$month=date('F');
$mon=date('m');
$year=date('Y');
$num = cal_days_in_month(CAL_GREGORIAN, $mon, $year) ;
		
?><?php include("function.php"); ?>
<?php 	if($_SESSION['type']=='1' || $_SESSION['type']=='2'){?>


		<link rel="stylesheet" href="ownergraph.css">
		<link rel="stylesheet" href="03.css">
	</head>
	<body>
<h2>Report For Month: <?php echo $month."-".$year; 
				?><span style="color:red"><?php
			
  $allHours1="select sum(hours2) as allhrs from closedssb where MONTH(closedOn) = '$mon'  && YEAR (closedOn) = '$year' ";
  $hoursData1=mysql_query($allHours1);
  $data1=mysql_fetch_assoc($hoursData1);
  echo "    Total Hours:  ".round($data1['allhrs'],2);
				
				?> </span></h2>
		<div id="wrapper">
			<div class="chart">
				
				<table id="data-table" border="1" cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<td>&nbsp;</td>
						<?php
  $allOwner1="select * from webadmin where type='2'";
  $ownerData1=mysql_query($allOwner1);
  while($dat1=mysql_fetch_array($ownerData1))
							{?>
  <th scope="col" ><?php echo $dat1['name']; ?></th><?php
}
						?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">Hours</th>
							<?php
  $allOwner="select * from webadmin where type='2'";
  $ownerData=mysql_query($allOwner);
  while($dat=mysql_fetch_array($ownerData))
							{

  
  ?><td>
  <?php 
  $allHours="select sum(hours2) as hrs from closedssb where owner='$dat[adminID]' && MONTH(closedOn)= '$mon'  && YEAR (closedOn) = '$year'  group by owner ";
  //echo $allHours;
  $hoursData=mysql_query($allHours);
  $data=mysql_fetch_assoc($hoursData);
  ?> <?php echo round($data['hrs'],2);
  
  			}
  ?>
				
  
  
  </td><?php

						?>
						
						</tr>
					
					</tbody>
				</table>
			</div>
		</div>
		
		<!-- JavaScript at the bottom for fast page loading -->
		
		<!-- Grab jQuery from Google -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		
		<!-- Example JavaScript -->
		<script src="ownergraph.js"></script>
		
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>