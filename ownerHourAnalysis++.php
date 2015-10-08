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
}				
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
.graph 
{
	padding-top:50px;
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
    font-size: 19px;
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
  width: 211px !important;
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
 clear: both;
 color: #ff0000;
 display: block;
 font-size: 16px;
 font-weight: bold;
 line-height: 20px;
 padding: 26px 0 15px;
 text-align: center;
}
.employeeTime
{
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

.empTotalTime {
  background: none repeat scroll 0 0 #ffffff;
  float: left !important;
  height: 73px;
  margin-left: -906px;
  margin-top: 149px;
  width: 663px;
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
	
	
.sheetTime {
  background: none repeat scroll 0 0 #ffffff;
  border-top: 2px solid #e4e4e4;
  font-size: 27px;
  margin: 7px 0 0;
  padding: 30px;
}

	.efficiency > p {
  font-size: 20px;
  padding: 8px;
}
.empTotalTime > p {
    color: #8cc751;
    float: left;
    font-size: 17px !important;
    padding: 8px;
}

p.total_time {
  float: right !important;
}

.update-status {
  background: none repeat scroll 0 0 #caf2a2;
  color: #d40809 !important;
  float: none !important;
  margin: 43px -5px 0;
  padding: 10px 0;
  position: relative;
}


.not-update-status {
	background: url("images1/error-sign.jpg") no-repeat scroll left 25px center #ffc9c9;
	margin: 0 -5px;
	}


.not-up-to-date {
    color: #d40809 !important;
    float: none !important;
    margin: 43px 0 0;
    position: relative;
	padding: 10px 0;
}

.up-to-date {
	color: #8BC750;
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
	margin: 0 -5px;
	
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

.main-container-efficiency {
  margin: 0 auto;
  max-width: 1263px;
  position: relative;
}

.not-up-to-date {
    color: #d40809 !important;
    float: none !important;
    margin: 43px 0 0;
    position: relative;
	padding: 10px 0;
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

span.li-billed {
    margin: 5px 0 0;
}

.li-billed-hour {
  float: right;
}

.employee_name a:hover {
	background: #8CC751;
	color: #FFF;
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

.efficiency-wrapper {
	margin: 26px 0 0;
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

.efficiency p {
	border: none
}

.max-min-efficiency {
  position: absolute;
  right: 112px;
  top: 21px;
}
.time-sheet-hrs {
  position: absolute;
  right: 112px;
  top: 4px;
}

.time-sheet-hrs li {
 
  font-family: "Khula",sans-serif;
  font-size: 19px;
  font-weight: 300;
  line-height: 20px;
  padding: 8px 0;
  text-decoration: none;
}
.max-min-efficiency li {
  color: #8ac750 !important;
  font-family: "Khula",sans-serif;
  font-size: 19px;
  font-weight: 300;
  line-height: 20px;
  padding: 8px 0;
  text-decoration: none;
}

.max-min-efficiency li:first-child {
	background: url("images1/top-employee.jpg") no-repeat left top;
	padding-left: 50px;
}
.max-min-efficiency li:last-child {
	background: url("images1/bottom-employee.jpg") no-repeat left 2px top 5px;
	padding-left: 50px;
	color: #C40A0B !important;
	 padding-bottom: 13px;
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


@import url(http://fonts.googleapis.com/css?family=Khula:400,300,600,700,800);


</style>

<?php include("function.php"); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>
<div class="main-container-efficiency">
	<div class="Reportwrapper">
	<?php

	 $firstDay=date('Y-m-01');
	 $today=date('Y-m-d');
	$datetime1 = date_create($firstDay);
	$datetime2 = date_create($today);
	$interval = date_diff($datetime1, $datetime2);
	$daysTillToday= $interval->format('%a');
//	echo $daysTillToday;
	$hoursTillToday=$daysTillToday * 8;

	?>

	<div class="projectReport">
	<form name="teamLeads" action="ownerHourAnalysis.php" method="post" >
	<select name="lead" onchange="this.form.submit()"><option value="">---Select Team Lead---</option>
   <?php
			$allAdUsers="select * from webadmin where (userRole = 1 or userRole = 2) and status = 1";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>		<option value="<?php echo $userAdArr['adminID'];?>"><?php echo $userAdArr['name'];?></option>
				

	<?php 	}	?>
</select>
</form>
<form method="post" action="" name="teamLeads">
<input type="hidden" value="<?php echo $lead;?>" name="lead" />
<select name="month" class="date1">
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
		 $getTlName=mysql_query("select * from webadmin where adminID ='$lead'");
							$leadArr=mysql_fetch_array($getTlName);
							$leadName = $leadArr['name'];

		
		echo $leadName; ?>
</li><li>
		 <span> <?php echo $year; ?></span> <?php echo $month; 
					?></li></ul>
	</div>
	</div>
	
</div>

<h2> </h2>

		<link rel="stylesheet" href="commongroup.css">
		<link rel="stylesheet" href="03.css">
		<div id="efficiency-wrapper">
		
			<div class="chart">
			<div class="efficiency_container">
			<table id="data-table" border="1" cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<td>&nbsp;</td>
						<?php
  $allOwner1="select name,adminID,photograph from webadmin where userRole = 3 and status = 1 and teamLead='$lead'";
  $ownerData1=mysql_query($allOwner1);
  while($dat1=mysql_fetch_array($ownerData1))
							{
	  ?>
		                                           

 <th scope="col"><?php echo $dat1['name']; ?></th>

							<?php } ?>


 <th scope="col"><?php echo $leadName; ?> </th>
							</tr></thead>
							<tbody>
						<tr>
							<th scope="row">TimeSheet Hours</th>
<?php
    
  $allOwner1="select name,adminID,photograph from webadmin where userRole = 3 and teamLead='$lead'";
  $ownerData1=mysql_query($allOwner1);
  while($dat1=mysql_fetch_array($ownerData1))
							{
	  
$allClosed = "select sum(aa.timeTaken) as hrs1 from (SELECT distinct o.* FROM openssbtime o, closedssb c WHERE o.ssbID = c.ssbID and o.owner='$dat1[adminID]' and c.owner='$dat1[adminID]' and MONTH(c.closedOn)='$mon' and YEAR(c.closedOn)='$year' and c.isManual !='1') aa";
   
  $close=mysql_query($allClosed) or die(mysql_error());
$closedArr=mysql_fetch_array($close);
@$closedSum += $closedArr['hrs1']; 
   ?>
    <td>
<?php
  echo $closed= round($closedArr['hrs1'],2);
   ?>
 </td>

 <?php } ?>
 <td>
 <?php
$allClosedLead = "select sum(aa.timeTaken) as hrs1 from (SELECT distinct o.* FROM openssbtime o, closedssb c WHERE o.ssbID = c.ssbID and o.owner='$lead' and c.owner='$lead' and MONTH(c.closedOn)='$mon' and YEAR(c.closedOn)='$year' and c.isManual !='1') aa";
   
  $closeLead=mysql_query($allClosedLead) or die(mysql_error());
$closedLeadTime=mysql_fetch_array($closeLead);
echo $closedLead = round($closedLeadTime['hrs1'],2);

?>
</td>
 </tr>

   
  <tr>
							<th scope="row">Billing Hours</th>
   <?php 
   $allOwner1="select name,adminID,photograph from webadmin where userRole = 3 and teamLead='$lead'";
  $ownerData1=mysql_query($allOwner1);
  while($dat1=mysql_fetch_array($ownerData1))
							{
   $billedTime="SELECT sum(hours2) as billed FROM   closedssb WHERE  owner='$dat1[adminID]' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year'";
 //echo $allHours1;
     
  $billed=mysql_query($billedTime) or die(mysql_error());
$billedArr=mysql_fetch_array($billed);

   @$billedSum += $billedArr['billed']; 
?> <td>
<?php
   echo $billed= round($billedArr['billed'],2);
   ?>
 </td>

  <?php
}?>
  <td>
  <?php
$billedTimeLead="SELECT sum(hours2) as billed FROM   closedssb WHERE  owner='$lead' && MONTH(closedOn)='$mon' && YEAR(closedOn)='$year'";
 //echo $allHours1;
     
  $billedLead=mysql_query($billedTimeLead) or die(mysql_error());
$billedArrLead=mysql_fetch_array($billedLead);
 echo $billedLeadTime= round($billedArrLead['billed'],2);
?>
</td>
  

  </tr>
					</tbody>
				</table>
 <ul class="time-sheet-hrs">
 
	<li class="" style="color:#3399FF">TimeSheet Hours: <?php echo $closedSum+$closedLead; ?> <sup>Hrs.</sup></li>

	<li class="" style="color:#ED9B4D">Billed Hours:  <?php echo $billedSum+$billedLeadTime; ?> <sup>Hrs.</sup></li>


</ul>
			</div>
			</div>	
			</div>
	<!-- Grab jQuery from Google -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		
		<!-- Example JavaScript -->
		<script src="ownergraph.js"></script>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>