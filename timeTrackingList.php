<?php
		@session_start();
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
if(isset($_POST['go'])){
	$monthNum = $_POST['month'];
	$month = date('F', mktime(0, 0, 0, $monthNum, 10));
	$mon = $_POST['month'];
	$year = $_POST['year'];
	$lead = $_POST['lead'];
	$num = cal_days_in_month(CAL_GREGORIAN, $mon, $year) ;
	$firstDay = $year."-".$mon."-"."01";
	$lastDay = $year."-".$mon."-".$num;
	
	$no=0;
	for($i=$firstDay;$i<=$lastDay;$i++){
    $day=date("N",strtotime($i));
		if($day==6 || $day==7){
			$no++;
		}
	}
}else{
		
	$firstDay=date('Y-m-01');
	$today=date('Y-m-d');
	$datetime1 = date_create($firstDay);
	$datetime2 = date_create($today);
	$interval = date_diff($datetime1, $datetime2);
	$daysTillToday= $interval->format('%a');
	//	echo $daysTillToday;
	$hoursTillToday=$daysTillToday * 8;

	$no=0;
	for($i=$firstDay;$i<=$today;$i++){
		$day=date("N",strtotime($i));
		if($day==6 || $day==7){
			$no++;
		}
	}
}
?>
<style>
.projectReport input {
  background: #cc5200 none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-weight: bold;
  padding: 7px;
}
table {
  border-collapse: collapse;
}
.sortable{
		width:100%
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
.Reportwrapper {
  background: none repeat scroll 0 0 #333333;
  margin: 0 auto !important;
  max-width: 1203px;
  padding: 0 36px;
  width: 100%;
  position: relative
}
.Reportwrapper:after {
  background: url("images1/border-arrow.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
  bottom: -33px;
  content: "";
  height: 33px;
  left: 0;
  position: absolute;
  width: 38px;
}
.projectReport {
  display: inline-block;
}
.projectReport form {
	float: left;
	padding: 29px 38px 0;
}
.team-report-right {
  background: url("images1/border-arrow.jpg") no-repeat scroll left top -1px, url("images1/border-arrow.jpg") no-repeat scroll right top -1px rgba(0, 0, 0, 0);
  float: left;
  padding: 2px 10px 0 40px;
}
.team-report-right ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
.team-report-right ul li {
	float: left;
	color: #8AC750;
	font-family: open sans;
    font-size: 15px;
    font-weight: normal;
    line-height: 22px;
    padding: 26px 60px;
    text-decoration: none;
}
.team-report-right ul li:first-child {
    background: url("images1/for-team-img.jpg") no-repeat scroll left center rgba(0, 0, 0, 0);
    padding-left: 60px;
}
.team-report-right ul li:nth-child(2) {
    background: url("images1/calender-img.jpg") no-repeat scroll left center rgba(0, 0, 0, 0);
    padding-left: 60px;
}
.team-report-right ul li span {
	display: block;
	color: #9a9a9a;
    font-size: 16px;
    line-height: 22px;
}
.projectReport select {
  -moz-appearance: none;
  background: url("images1/select-arrow.jpg") no-repeat scroll right top rgba(0, 0, 0, 0);
  border: 1px solid #515151;
  color: #818181;
  font-family: open sans;
  font-size: 17px;
  height: 45px !important;
  line-height: 18px;
  outline: medium none;
  overflow: hidden;
  padding: 5px;
  text-indent: 0.01px;
  text-overflow: "";
}
.Reportwrapper p {
  
  border-width: 1px 1px 0 ;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  margin: 0;
  padding: 5px;
  text-align: center;
  text-transform: capitalize;
}
.main-container-efficiency {
  margin: 0 auto;
  max-width: 1263px;
  position: relative;
}
.efficiency_container {
  background: none repeat scroll 0 0 #ffffff;
  display: inline-block;
  float: left;
  margin: 30px 0 38px 40px;
  width: 1199px;
  padding: 0 0 36px;
}
.employee_name {
  border-bottom: 5px solid #9BBB59;
}
.employee_name ul {
	list-style: none;
	margin: 0;
	padding: 0 0 0 2px;
	
}
.employee_name ul li{
	display: inline-block;
	border-right: 1px solid #AFAFAF;
	margin: 0 -2px;
}

.employee_name a {
  color: #9a9a9a;
  display: inline-block;
  font-family: "Khula",sans-serif;
  font-size: 18px;
  font-weight: 300;
  line-height: 23px;
  padding: 19px 10px;
  text-decoration: none;
}

.employee_name span {
  font-size: 13px;
  line-height: 18px;
}
.employee_name a:hover {
	background: #8CC751;
	color: #FFF;
}

.efficiency-wrapper {
	margin: 26px 0 0;
}

.back-to-top {
  bottom: 90px;
  color: #818181;
  display: inline-block !important;
  float: right;
  font-family: "Khula",sans-serif;
  padding: 10px;
  position: fixed;
  text-align: right;
   font-size: 19px;
  font-weight: 300;
  line-height: 20px;
  z-index: 9999;
  text-decoration: none;
}


td {
padding:5px;
font-size:14px;
}
th {
padding:5px;
font-size:14px;
font-weight:bold;
width:200px;
}
.ready-close-container {
  background: none repeat scroll 0 0 #ffffff;
  margin: auto;
  padding: 40px;
  width: 91%;
  height:auto;
}
.reviews
{
	float:left;
	margin-left:50px;
	
}

@import url(http://fonts.googleapis.com/css?family=Khula:400,300,600,700,800);


</style>
<script src="jss/jquery-latest.min.js"></script>
<link rel="stylesheet" href="css/theme.blue.css">
<script src="jss/jquery.tablesorter.js"></script>
<script>
$(function() {

  // call the tablesorter plugin
  $("table").tablesorter({
    theme : 'blue',

    // change the multi sort key from the default shift to alt button
    sortMultiSortKey: 'altKey'
  });

});
</script>
<?php include("function.php"); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>
<div class="main-container-efficiency">
	<div class="Reportwrapper">
	<div class="projectReport">
	<form name="teamLeads" action="timeTrackingList.php" method="post" >
	<select name="lead" onchange="this.form.submit()" style="width:235px !important">
		<option value="">---Select Team Lead---</option>
		<option value="All">All Employees</option>
								
   <?php
			$allAdUsers="select * from webadmin where (userRole = 1 or userRole = 2) and status = 1";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>		<option value="<?php echo $userAdArr['adminID'];?>"><?php echo $userAdArr['name'];?></option>
				

	<?php 	}	?>
</select>
</form>
<form method="post" action="" name="teamLeads" style='margin-left:-20px;padding-left:0px;'>
<input type="hidden" value="<?php echo $lead;?>" name="lead" />
<select name="month" class="date1" style="width:140px !important">
<option value="">--Month--</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>

<select name="year" class="date1">
<option value="">--Year--</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
</select>
<input type="submit" value="Go" name="go">
</form>
	<div class="team-report-right">
	<ul><li>
		<span>For Team:</span> <?php
		if($_POST['lead']!='All'){
		 $getTlName=mysql_query("select * from webadmin where adminID ='$lead'");
							$leadArr=mysql_fetch_array($getTlName);
							$leadName = $leadArr['name'];

		
		echo $leadName;
		}else{
		echo "All";	
		}?>
</li><li>
		 <span> <?php echo $year; ?></span> <?php echo $month; 
					?></li></ul>
	</div>
	</div>
	
</div>
</head>
<body>
<?php if(!empty($lead)){
if($_POST['lead']=='All'){
$allOwner1="select w1.name,w1.teamLead,w1.adminID,w1.join_date from webadmin as w1 where w1.adminID != w1.teamLead and 
w1.teamLead !=0 and w1.teamLead != 'Null' and w1.teamLead != '' and w1.status = 1 and w1.userRole = 3 order by w1.name";
}else{
$allOwner1="select name,teamLead,adminID,join_date from webadmin where userRole = 3 and status = 1 and teamLead='$lead' order by name";
}
$ownerData1=mysql_query($allOwner1);
$totalRows = mysql_num_rows($ownerData1);
?>
<div class="efficiency_container">
<div class="ContentData" >
<p style="clear:both"></p>
<div class="ready-close-container">
<div class="reviews">
<h3>Total Employees: <?php echo $totalRows; ?></h3>
<table class="tablesorter" border="2">
<thead><tr style="background:#ccc;">
<th style="padding-left:10px;">Name</th>
<?php if($_POST['lead']=='All'){ ?>
<th style="padding-left:10px;">Team Leader</th>
<?php } ?>
<th style="padding-left:10px;" >Manual Time</th>
<th style="padding-left:10px;" >Leave Time</th>
<th style="padding-left:10px;" >Idle Time</th><th style="padding-left:10px;" >Project Time</th>
<th style="padding-left:10px;" >Closed Logged Time</th>
<th style="padding-left:10px;" >Billed Time</th><th style="padding-left:10px;" >Efficiency</th>
<th style="padding-left:10px;" >Non Billed Time</th>
<th style="padding-left:10px;" >TOJ (In Month(s))</th>
</tr></thead>

<?php

while($dat1=mysql_fetch_array($ownerData1)){
	
$start = $dat1['join_date'];
$end = date('Y-m-d');
$diff = (strtotime($end)- strtotime($start))/24/3600; 
//echo $diff;
?>
<tr>
<td><a href="timeTrackingEmployee.php?adminID=<?php echo $dat1['adminID']; ?>"><?php echo $dat1['name']; ?></a></td>
<?php 
$teamName = "select name from webadmin where adminID = '$dat1[teamLead]'";
$resultTeamName = mysql_query($teamName);
$rowTeamName = mysql_fetch_assoc($resultTeamName);
?>
<?php if($_POST['lead']=='All'){ ?>
<td><?php echo $rowTeamName['name']; ?></td>
<?php } ?>
<?php
$manualTime="SELECT sum(hours2) as manual FROM  closedssb
where owner='$dat1[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year' && isManual='1'";
$manual=mysql_query($manualTime) or die(mysql_error());
$manualArr=mysql_fetch_array($manual);
?>
<td><?php echo $manualled= round($manualArr['manual'],2); ?></td>

<?php $leaveTime="SELECT sum(timeAdded) as leaves,dateAdded FROM leave_idle_timesheet
WHERE  owner='$dat1[adminID]' && MONTH(dateAdded)='$mon' && YEAR(dateAdded)='$year' && dateAdded <= CURDATE() && type='1'";
$leave=mysql_query($leaveTime) or die(mysql_error());
$leaveArr=mysql_fetch_array($leave);
$leaved= round($leaveArr['leaves'],2);

$leaveDetailsHalf = "select * from empleavedetails where empID = '$dat1[adminID]' and appliedFor <= '$end' and status = 3 
and typeLeave = 1 and MONTH(appliedFor)='$mon' and YEAR(appliedFor)='$year'";
$resultLeaveDetailsHalf = mysql_query($leaveDetailsHalf);
$rowLeaveDetailsHalf = mysql_num_rows($resultLeaveDetailsHalf);
$totalHalf = $rowLeaveDetailsHalf * 4 ;

$leaveDetailsFull = "select * from empleavedetails where empID = '$dat1[adminID]' and appliedFor <= '$end' and status = 3 
and typeLeave = 2 and MONTH(appliedFor)='$mon' and YEAR(appliedFor)='$year'";
$resultLeaveDetailsFull = mysql_query($leaveDetailsFull);
$rowLeaveDetailsFull = mysql_num_rows($resultLeaveDetailsFull);
$totalFull = $rowLeaveDetailsFull * 8;
$totalLeaves = $no * 8 + $totalHalf + $totalFull ;

?>
<?php if($leaved > $totalLeaves){ ?>
<td style='background-color:#FF4500;'>
<?php echo "<a href='leaveHistoryTimeAdded.php?adminID=$dat1[adminID]' target='_blank'>".$leaved."</a>"; ?>
</td><?php }else{ ?>
<td>
<?php echo $leaved; ?>
</td>
<?php } ?>
<?php 
$idleTime="SELECT sum(timeAdded) as idle FROM leave_idle_timesheet
WHERE  owner='$dat1[adminID]' && MONTH(dateAdded)='$mon' && YEAR(dateAdded)='$year' && type='2'";
$idle=mysql_query($idleTime) or die(mysql_error());
$idleArr=mysql_fetch_array($idle);
?>
<td><?php echo $idled= round($idleArr['idle'],2); ?></td>
<?php
$manualTime="SELECT sum(timeTaken) as manual FROM  openssbtime
where owner='$dat1[adminID]' && MONTH(dateUpdated)='$mon' && YEAR(dateUpdated)='$year' && status='0'";
$manual=mysql_query($manualTime) or die(mysql_error());
$manualArr=mysql_fetch_array($manual);
?>
<td><?php echo $manualled= round($manualArr['manual'],2); ?></td>
<?php
$allClosed = "select sum(aa.timeTaken) as hrs1 from (SELECT distinct o.* FROM openssbtime o, closedssb c WHERE o.ssbID = c.ssbID and o.owner='$dat1[adminID]' and c.owner='$dat1[adminID]'  and MONTH(o.dateUpdated)='$mon' and YEAR(o.dateUpdated)='$year' and MONTH(c.closedOn)='$mon' and YEAR(c.closedOn)='$year') aa";
$close=mysql_query($allClosed) or die(mysql_error());
$closedArr=mysql_fetch_array($close);
?>
<td><?php echo $closed= round($closedArr['hrs1'],2); ?></td>
<?php $billedTime="SELECT sum(hours2) as billed FROM closedssb
WHERE  owner='$dat1[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year'";
$billed=mysql_query($billedTime) or die(mysql_error());
$billedArr=mysql_fetch_array($billed);
//@$billedSum += $billedArr['billed']; 
?>
<td><?php echo $billed= round($billedArr['billed'],2); ?></td>
<?php 
if($billed != '0'){
	$efficiency = round((($billed/$closed) * 100),2);
		if($efficiency > 100){
			$efficiency = 100;
		}
}else{
	$efficiency=0;
	} 

?>
<td><?php echo $efficiency." %"; ?></td>
<td><?php echo $nonBilled = $closed - $billed; ?></td>
<td><?php echo round($diff/30) ; ?></td>
</tr>

<?php 
 }
 //} }?>
</table>
</div>
</div>
</div>

</div>
<a href="#" class="back-to-top"><span>Top</span></a>
<?php } ?>

</div>
			
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>