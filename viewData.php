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
			ini_set('session.gc_maxlifetime', 3600);
		}

?>

<?php include("function.php"); ?>
	<style>
	.sortable{
	width:100%;
	}
	.timeAdded{
	display:none;
	position:absolute;
	background:#fff;
	border:3px;
	border-radius:3px;
	box-shadow: 0 0 10px #000;
	padding:5px;
	}
	body { 
	font-size:14px !important; 
	}
	.employeeTime{
	float: left;
    height: 200px;
    margin: 35px 0;
    width: 100%;
}
.empName {
  border: 18px solid #e4e4e4;
  color: #8cc751;
  float: left;
  font-family: "Khula",sans-serif;
  font-size: 18px;
  font-weight: 300;
  line-height: 20px;
  margin: 0 0 0 30px;
  padding: 9px 10px;
  text-align: center;
  width: 144px;
}
.empName img
{
	margin: 0 auto 10px;
	display:block;

}
.employee-efficiency-right {
  background: none repeat scroll 0 0 #e4e4e4;
  float: left;
  margin: 0 0 0 10px;
  padding: 10px;
  color: #818181;
  font-family: open sans;
  font-size: 12px;
  line-height: 15px;
}
.employee-efficiency-right > div {
  font-family: "Khula",sans-serif !important;
  font-size: 15px !important;
  font-weight: 300;
  line-height: 18px !important;
  padding: 9px 5px 5px;
  text-align: center;
}
	.empTime
	{
	height:125px;
	width: 120px;
	float:left;
	background: #FFF;
	border: 6px solid #e4e4e4;
	border-left: 3px solid #e4e4e4;
	border-right: 3px solid #e4e4e4;
	}
	.sheetTime {
  background: none repeat scroll 0 0 #ffffff;
  border-top: 2px solid #e4e4e4;
  font-size: 27px;
  margin: 7px 0 0;
  padding: 30px;
}
.empBilled p.sheetTime,
.efficiency p {
   border-bottom: 2px dotted #8cc751;
    border-top: medium none;
    color: #8cc751;
    font-size: 30px;
    line-height: 30px;
    margin: 7px 0 32px;
    padding: 0 0 36px;
}
	.empLeave
{
	height:125px;
	background: #FFF;
	width:120px;
	float:left;
	border: 6px solid #e4e4e4;
	border-left: 3px solid #e4e4e4;
	border-right: 3px solid #e4e4e4;
	}
		.empIdle
{
	height:125px;
	background: #FFF;
	width: 120px;
	float:left;
	border: 6px solid #e4e4e4;
	border-left: 3px solid #e4e4e4;
	border-right: 3px solid #e4e4e4;
	}
	.empBilled {
  background: none repeat scroll 0 0 #ffffff;
  float: left;
  font-size: 15px !important;
  height: 215px;
  line-height: 20px !important;
  margin: 6px 0 0 48px;
  width: 162px;
  border-right: 9px solid #e4e4e4;
  position: relative;
}

.empBilled:before {
    background: url("images1/left-arrow.jpg") no-repeat scroll center center rgba(0, 0, 0, 0);
    content: "";
    height: 41px;
    left: -21px;
    position: absolute;
    top: 80px;
    width: 22px;
}
.efficiency p {
	border: none
}
.efficiency > p {
  font-size: 20px;
  padding: 8px;
}
.efficiency-wrapper {
	margin: 26px 0 0;
}
 .chart > p {
 clear: both;
 color: #ff0000;
 display: block;
 font-size: 16px;
 font-weight: bold;
 line-height: 20px;
 padding: 26px 0 15px;
 text-align: center;
}
.efficiency_container {
  background: none repeat scroll 0 0 #ffffff;
  display: inline-block;
  float: left;
  margin: 30px 0 38px 40px;
  width: 1199px;
  padding: 0 0 36px;
}
p.total_time {
  float: right !important;
}
.empTotalTime {
  background: none repeat scroll 0 0 #ffffff;
  float: left !important;
  height: 73px;
  margin-left: -906px;
  margin-top: 149px;
  width: 663px;
}
.empTotalTime > p {
    color: #8cc751;
    float: left;
    font-size: 17px !important;
    padding: 8px;
}
.not-up-to-date {
    color: #d40809 !important;
    float: none !important;
    margin: 43px 0 0;
    position: relative;
	padding: 10px 0;
}
.not-up-to-date:before {
  background: url("images1/arrow-not-update.jpg") no-repeat scroll center center rgba(0, 0, 0, 0);
  content: "";
  height: 11px;
  left: 290px;
  position: absolute;
  top: -11px;
  width: 28px;
}
.up-to-date {
	color: #8BC750;
}
.not-update-status {
	background: url("images1/error-sign.jpg") no-repeat scroll left 25px center #ffc9c9;
	margin: 0 -5px;
}
.update-status {
  background: none repeat scroll 0 0 #caf2a2;
  color: #d40809 !important;
  float: none !important;
  margin: 43px -5px 0;
  padding: 10px 0;
  position: relative;
}
.update-status:before {
  background: url("images1/arrow-update.jpg") no-repeat scroll left 25px center rgba(0, 0, 0, 0);
  content: "";
  height: 15px;
  left: 262px;
  position: absolute;
  top: -13px;
  width: 54px;
}
	</style>
	<script>

	function showTime(status)
		{
	//	alert("showTimeDiv"+status);
			document.getElementById("showTimeDiv"+status).style.display="block";
		}
	
	function hideTime(status)
		{
			document.getElementById("showTimeDiv"+status).style.display="none";
		}

function showNotes(status)
		{
			document.getElementById("notes"+status).style.display="block";
		}


	function hideNotes(status)
		{
			document.getElementById("notes"+status).style.display="none";
		}
</script>

	<script src="sorttable.js"></script>
	
	<?php 	if($_SESSION['userRole']==3 && $_SESSION['status']==1){?>
	
<?php
$firstDay=date('Y-m-01');
$today=date('Y-m-d');
$datetime1 = date_create($firstDay);
$datetime2 = date_create($today);
$interval = date_diff($datetime1, $datetime2);
$daysTillToday= $interval->format('%a');
$hoursTillToday=$daysTillToday * 8;

$mon=date('m');
$year=date('Y');
$owner=$_SESSION['name'];
include("config.php");

 $getOwnerName=mysql_query("select * from webadmin where name ='$owner'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerID = $ownerArr['adminID'];


?>

<div class="addData">
<div id="myDiv">
</div>
<?php
function getBusinessDays($date1, $date2){

    if(!is_numeric($date1)){
        $date1 = strtotime($date1);
    }

    if(!is_numeric($date2)){
        $date2 = strtotime($date2);
    }

    if($date2 < $date1){
        $temp_date = $date1;
        $date1 = $date2;
        $date2 = $temp_date;
        unset($temp_date);
    }

    $diff = $date2 - $date1;

    $days_diff = intval($diff / (3600 * 24));
    $current_day_of_week = intval(date("N", $date1));
    $business_days = 0;

    for($i = 1; $i <= $days_diff; $i++){
        if(!in_array($current_day_of_week, array("Sunday" => 7, "Saturday" => 6))){
            $business_days++;
        }

        $current_day_of_week++;
        if($current_day_of_week > 7){
            $current_day_of_week = 1;
        }
    }

    return $business_days+1;
}

?>
<div class="ContentData">
<form action="insertTracking.php"  method="post">
<br/><b>Owned SSBs</b>
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>E</th><th >SSB-ID</th><!--<th>Customer Sub Name</th>--><th>Queue</th><!--<th>Start Date</th>--><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th>Pages</th><th>Status</th><th>Owner</th><th>First Reviewer</th><th>Second Reviewer</th><th>Time</th></tr></thead>
<?php
	
$allSsb="select * from tracking where status !='Closed' && owner='$ownerID' ";
//echo $allSsb;
$ssb=mysql_query($allSsb);
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
	?>
<tr  onmouseover="showNotes(<?php echo $ssbArr['trackID']; ?>)"   onmouseout="hideNotes(<?php echo $ssbArr['trackID']; ?>)" <?php if($ssbArr['target']==1){ echo "style='background-color:#BFBF19;'";} ?>><td>


<?php

$startDay=$ssbArr['startDate']; 

$beginday=date($startDay);
$lastday=date("Y-m-d");

//$getDateDiff=mysql_query("SELECT DATEDIFF(now(),'$startDay') AS DiffDate"); 
//$arrDate=mysql_fetch_assoc($getDateDiff);
//echo $arrDate['DiffDate']+1;

/*$beginday=date($startDay);
$lastday=date("Y-m-d");
//echo $lastday;
$nr_work_days = getWorkingDays($beginday,$lastday);
echo $nr_work_days;*/

if ($beginday != $lastday)
	echo getBusinessDays($beginday, $lastday);
else 
	  echo 1;

?></td><td><?php echo $ssbArr['ssbID'];?>

<?php $query = "SELECT * FROM openssbtime WHERE ssbID = '{$ssbArr['ssbID']}' and owner='$ownerID'";
$result = mysql_query($query);
if(mysql_num_rows($result) == 0) 
	{?> 
			<img src="images/addTime.png" height="12px" width="12px" onmouseover="showTime(<?php echo $x; ?>)" onmouseout="hideTime(<?php echo $x; ?>)">
	<?php }
	else
	{
	}

?><div id="showTimeDiv<?php echo $x; ?>" style="display:none;position:absolute" class="timeAdded">
	Add Your Time Elapsed
</div>


</td><!--<td><?php echo $ssbArr['custSubName'];?></td>-->
		<td><?php echo $ssbArr['queue'];?></td><!--<td><?php echo $ssbArr['startDate'];?></td>	-->
		<td><?php echo $ssbArr['dueDate'];?></td><td><?php echo $ssbArr['service'];?></td>
		<td><?php echo $ssbArr['migrateUrl'];?>
		
		<?php if($ssbArr['notes'] !='' || $ssbArr['notes'] != null || $ssbArr['comments'] !='' || $ssbArr['comments'] != null)
	{
			?>
		<div class="notes" id="notes<?php echo $ssbArr['trackID'];?>" >
		
		<p>	<?php echo $ssbArr['notes'];?></p>
			<p>	<?php echo $ssbArr['comments'];?></p>
																																																											
		</div>
	<?php } else {}
		?>
		
		</td>
		<td><?php echo $ssbArr['pages'];?></td><td contenteditable="false" class='<?php echo $class; ?> <?php echo str_replace('.','',str_replace(' ', '-',$ssbArr['status']));?>'>
				<?php echo $ssbArr['status'];?></td>
		<td  >
	<?php	 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ssbArr[owner]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerName = $ownerArr['name'];?>
		<?php echo $ownerName;?>
		</td>
		<td>
				 <?php $getFRName=mysql_query("select * from webadmin where adminID ='$ssbArr[firstReviewer]'");
					$firstRArr=mysql_fetch_array($getFRName);
					$firstRName = $firstRArr['name'];?>
		<?php echo $firstRName;?></td>
		<td >
			<?php $getSRName=mysql_query("select * from webadmin where adminID ='$ssbArr[secondReviewer]'");
						$secondRArr=mysql_fetch_array($getSRName);
						$secondRName = $secondRArr['name'];?>
		<?php echo $secondRName;?></td><td><a href="addMemberTime.php?ssbID=<?php echo $ssbArr['ssbID'];?>">Add Details   </a></td>
		</tr>
<?php
}?>

</table>
<?php 
	$getFollowedssb = "select * from followers where owner='$ownerID'";
	$ssbFollow = mysql_query($getFollowedssb);
	if(mysql_num_rows($ssbFollow) > 0){
	?>
<br/><b>Followed SSBs</b>
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>E</th><th >SSB-ID</th><!--<th>Customer Sub Name</th>--><th>Queue</th><!--<th>Start Date</th>--><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th>Pages</th><th>Status</th><th>Owner</th><th>First Reviewer</th><th>Second Reviewer</th><th>Time</th></tr></thead>
<?php
	
	
	while($ssbFollowed = mysql_fetch_array($ssbFollow))
	{
		$ssbIDFollow = $ssbFollowed['ssbID'];
			$allSsb="select * from tracking where status !='Closed' && ssbID='$ssbIDFollow' ";
			//echo $allSsb;
			$ssb=mysql_query($allSsb);
			$x=0;
			$ssbArr=mysql_fetch_assoc($ssb);
				$x++; 

			$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
			if(mysql_num_rows($ssb) > 0){
				?>
			<tr  onmouseover="showNotes(<?php echo $ssbArr['trackID']; ?>)"   onmouseout="hideNotes(<?php echo $ssbArr['trackID']; ?>)" <?php if($ssbArr['target']==1){ echo "style='background-color:#BFBF19;'";} ?>><td>


			<?php

			$startDay=$ssbArr['startDate']; 

			$beginday=date($startDay);
			$lastday=date("Y-m-d");

			if ($beginday != $lastday)
				echo getBusinessDays($beginday, $lastday);
			else 
				  echo 1;

			?></td><td><?php echo $ssbArr['ssbID'];?>

			<?php $query = "SELECT * FROM openssbtime WHERE ssbID = '{$ssbArr['ssbID']}' and owner='$ownerID'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0) 
				{?> 
						<img src="images/addTime.png" height="12px" width="12px" onmouseover="showTime(<?php echo $x; ?>)" onmouseout="hideTime(<?php echo $x; ?>)">
				<?php }
				else
				{
				}

			?><div id="showTimeDiv<?php echo $x; ?>" style="display:none;position:absolute" class="timeAdded">
				Add Your Time Elapsed
			</div>


			</td><!--<td><?php echo $ssbArr['custSubName'];?></td>-->
					<td><?php echo $ssbArr['queue'];?></td><!--<td><?php echo $ssbArr['startDate'];?></td>	-->
					<td><?php echo $ssbArr['dueDate'];?></td><td><?php echo $ssbArr['service'];?></td>
					<td><?php echo $ssbArr['migrateUrl'];?>
					
					<?php if($ssbArr['notes'] !='' || $ssbArr['notes'] != null || $ssbArr['comments'] !='' || $ssbArr['comments'] != null)
				{
						?>
					<div class="notes" id="notes<?php echo $ssbArr['trackID'];?>" >
					
					<p>	<?php echo $ssbArr['notes'];?></p>
						<p>	<?php echo $ssbArr['comments'];?></p>
																																																														
					</div>
				<?php } else {}
					?>
					
					</td>
					<td><?php echo $ssbArr['pages'];?></td><td contenteditable="false" class='<?php echo $class; ?> <?php echo str_replace('.','',str_replace(' ', '-',$ssbArr['status']));?>'>
							<?php echo $ssbArr['status'];?></td>
					<td  >
				<?php	 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ssbArr[owner]'");
									$ownerArrFollower=mysql_fetch_array($getOwnerName);
									$ownerName = $ownerArrFollower['name'];?>
					<?php echo $ownerName;?>
					</td>
					<td>
							 <?php $getFRName=mysql_query("select * from webadmin where adminID ='$ssbArr[firstReviewer]'");
								$firstRArr=mysql_fetch_array($getFRName);
								$firstRName = $firstRArr['name'];?>
					<?php echo $firstRName;?></td>
					<td >
						<?php $getSRName=mysql_query("select * from webadmin where adminID ='$ssbArr[secondReviewer]'");
									$secondRArr=mysql_fetch_array($getSRName);
									$secondRName = $secondRArr['name'];?>
					<?php echo $secondRName;?></td><td><a href="addMemberTime.php?ssbID=<?php echo $ssbArr['ssbID'];?>">Add Details   </a></td>
					</tr>


			<?php
	}
				}
			?>			</table>
			<?php
	}
			?>

</form>
</div>
</div>

<?php if($ownerArr['teamLead'] != '' || $ownerArr['teamLead'] != 0){ ?>
<div id="efficiency-wrapper">
<div class="chart">
<div class="efficiency_container">							 
<div class="employeeTime" id="employee<?php echo $ownerArr['adminID']; ?>">
<div class="empName">
<img src="profileImages/<?php echo $ownerArr['photograph']; ?>">
<?php echo $ownerArr['name']; ?></div>
<div class="employee-efficiency-right">
<div class="empTime">Logged In Time
<?php $allHours1="SELECT sum(timeTaken) as hrs1 FROM openssbtime where owner='$ownerArr[adminID]' && MONTH(dateUpdated)='$mon' && YEAR(dateUpdated)='$year'";
$hoursData1=mysql_query($allHours1) or die(mysql_error());
$data1=mysql_fetch_array($hoursData1);
?>
<p class="sheetTime"><?php echo $sheet= round($data1['hrs1'],2); ?></p>
</div>

<div class="empTime">Manual Time
<?php $manualTime="SELECT sum(hours2) as manual FROM   closedssb
 where owner='$ownerArr[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' && isManual='1'";
 //echo $allHours1;
$manual=mysql_query($manualTime) or die(mysql_error());
$manualArr=mysql_fetch_array($manual);
?><p class="sheetTime"><?php echo $manualled= round($manualArr['manual'],2); ?></p>
</div>

<div class="empLeave">Leave Time
<?php $leaveTime="SELECT sum(timeAdded) as leaves FROM   leave_idle_timesheet
WHERE  owner='$ownerArr[adminID]' && MONTH(dateAdded)='$mon' && YEAR(dateAdded)='$year' && type='1'";
$leave=mysql_query($leaveTime) or die(mysql_error());
$leaveArr=mysql_fetch_array($leave);
?>
<p class="sheetTime"><?php echo $leaved= round($leaveArr['leaves'],2); ?></p>
</div>

<div class="empIdle">Idle Time
<?php $idleTime="SELECT sum(timeAdded) as idle FROM   leave_idle_timesheet
WHERE  owner='$ownerArr[adminID]' && MONTH(dateAdded)='$mon' && YEAR(dateAdded)='$year' && type='2'";
 //echo $allHours1;    
$idle=mysql_query($idleTime) or die(mysql_error());
$idleArr=mysql_fetch_array($idle);
?><p class="sheetTime"><?php
echo $idled= round($idleArr['idle'],2);
?></p>
</div>

<div class="empTime">Closed Logged Time
<?php
$allClosed = "select sum(aa.timeTaken) as hrs1 from (SELECT distinct o.* FROM openssbtime o, closedssb c WHERE o.ssbID = c.ssbID and o.owner='$ownerArr[adminID]' and c.owner='$ownerArr[adminID]'  and MONTH(o.dateUpdated)='$mon' and YEAR(o.dateUpdated)='$year' and MONTH(c.closedOn)='$mon' and YEAR(c.closedOn)='$year') aa";
$close=mysql_query($allClosed) or die(mysql_error());
$closedArr=mysql_fetch_array($close);
?>

<p class="sheetTime"><?php echo $closed= round($closedArr['hrs1'],2); ?></p>
</div>
  
<div class="empBilled">Billed Time
<?php $billedTime="SELECT sum(hours2) as billed FROM   closedssb
WHERE  owner='$ownerArr[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year'";
 //echo $allHours1;
     
$billed=mysql_query($billedTime) or die(mysql_error());
$billedArr=mysql_fetch_array($billed);
@$billedSum += $billedArr['billed']; 
?>
<p class="sheetTime"><?php echo $billed= round($billedArr['billed'],2); ?></p>
<div class="efficiency">
Efficiency:
<p><?php if($billed != '0'){ $efficiency = round((($billed/$closed) * 100),2);
if($efficiency > 100)
					{
					$efficiency = 100;
					}
 }else{$efficiency=0;} echo $efficiency." %";

?></p>
</div>
</div>
<div class="empTotalTime">
<p>Total Time</p>
<p class="total_time"> 
<?php

$totalLoggedHours = $sheet+$leaved+ $idled;

echo $totalLoggedHours;
//echo $daysTillToday;

if(date("d") != '01')
								{
if((($totalLoggedHours / $hoursTillToday ) == '1') || (($totalLoggedHours / $hoursTillToday) >'1'))
								{ 
										echo "<div class='update-status'><p class='up-to-date'>Time UP TO DATE</p></div>";
								}
								elseif((($totalLoggedHours / $hoursTillToday ) < '1'))
								{
										echo "<div class='not-update-status'><p class='not-up-to-date'>Time NOT UP TO DATE , Need to be $hoursTillToday</p></div>";
								}
								}
?></p>

</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
<?php include("Footer.php"); ?>
<?php
//echo ini_get("session.gc_maxlifetime");
}else{ echo "You Are Not Permitted to Access This Page"; } ?>
