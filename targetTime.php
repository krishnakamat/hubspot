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

<body>
<div class="efficiency_container">
<div class="ContentData" >
<p style="clear:both"></p>
<div class="ready-close-container">
<div class="reviews">
<table class="tablesorter" border="2">
<thead><tr style="background:#ccc;">
<th style="padding-left:10px;">Team Leader</th>
<th style="padding-left:10px;" >Time </th>
<th style="padding-left:10px;" >Expected</th>
<th style="padding-left:10px;" >Lag</th>
</tr></thead>
 <?php
		$month=date("m");
		$year=date("Y");
$getCloseProjects = "select teamLead, COUNT(distinct closedssb.trackID) as counter, closedOn, sum(hours2) as hours
FROM closedssb where MONTH(closedOn)=$month and YEAR(closedOn)=$year and teamLead!=0 GROUP BY teamLead order by counter DESC";
$resultCloseProjects = mysql_query($getCloseProjects);
$numProjects = mysql_num_rows($resultCloseProjects);
while($rowProjects = mysql_fetch_array($resultCloseProjects)){
?>
<tr>
<td>
<?php $teamLead = $rowProjects['teamLead'];
$getName = "select * from webadmin where adminID = '$teamLead'";
$resultName = mysql_query($getName);
$leadName = mysql_fetch_assoc($resultName);
echo $leadName['name'];
?></td>
<td><?php   echo $billed1 = $rowProjects['hours'];
$getMember = "select * from webadmin where teamLead = '$teamLead' and status='1' and userRole='3'";
$resultMember = mysql_query($getMember);
$lastMonth = date('m', strtotime('last month'));
$lastYear = date('Y', strtotime('last month'));
$timeEfficient = 0;
while($member = mysql_fetch_array($resultMember))
	{
	 $member = $member['adminID'];

	////--------------------Efficiency-------------------///
		
		$allHours1="SELECT sum(timeTaken) as hrs1 FROM openssbtime where owner='$member' && MONTH(dateUpdated)='$month' && YEAR(dateUpdated)='$year'";
		$hoursData1=mysql_query($allHours1) or die(mysql_error());
		$data1=mysql_fetch_array($hoursData1);
		$sheetTime= round($data1['hrs1'],2); 

		$allClosed = "select sum(aa.timeTaken) as hrs1 from (SELECT distinct o.* FROM openssbtime o, closedssb c WHERE o.ssbID = c.ssbID and o.owner='$member' and c.owner='$member'  and MONTH(o.dateUpdated)='$month' and YEAR(o.dateUpdated)='$year' and MONTH(c.closedOn)='$month' and YEAR(c.closedOn)='$year') aa";
		$close=mysql_query($allClosed) or die(mysql_error());
		$closedArr=mysql_fetch_array($close);
		$closed= round($closedArr['hrs1'],2);

		$difference = $sheetTime - $closed;
		$billedTime="SELECT sum(hours2) as billed FROM closedssb WHERE  owner='$member' && MONTH(closedOn)='$lastMonth' && YEAR(closedOn)='$lastYear'";

		$allClosed1 = "select sum(aa.timeTaken) as hrs1 from (SELECT distinct o.* FROM openssbtime o, closedssb c WHERE o.ssbID = c.ssbID and o.owner='$member' and c.owner='$member'  and MONTH(o.dateUpdated)='$lastMonth' and YEAR(o.dateUpdated)='$lastYear' and MONTH(c.closedOn)='$lastMonth' and YEAR(c.closedOn)='$lastYear') aa";
		$close1=mysql_query($allClosed1) or die(mysql_error());
		$closedArr1=mysql_fetch_array($close1);

		$closed1= round($closedArr1['hrs1'],2);
		$billed=mysql_query($billedTime) or die(mysql_error());
		$billedArr=mysql_fetch_array($billed);
		@$billedSum += $billedArr['billed']; 
		
		$billed= round($billedArr['billed'],2);
		if($billed != '0'){ 
			$efficiency = round((($billed/$closed1) * 100),2);
			if($efficiency > 100)
				{
				$efficiency = 100;
				}
			 }else{$efficiency=0;} 
		 $timeEfficiency = $difference * ($efficiency / 100);
			////--------------------Efficiency-------------------///
			$timeEfficient += $timeEfficiency;

	}				
			$totalTime = $billed1 + $timeEfficient;
			echo "-----".$totalTime;
?>
</td>
<td>
<?php

	?>
</td>
<td></td>
</tr>
<?php
}
?>
</table>
</div>
</div>
</div>

</div>
<a href="#" class="back-to-top"><span>Top</span></a>


</div>
			
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>