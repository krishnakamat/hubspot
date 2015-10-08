<?php
ob_start();
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){			include_once ("HeaderAdmin.php");		}		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 				include_once ("Header.php");		}

include("config.php");

$month=date('F');
$mon=date('m');
$year=date('Y');
$num = cal_days_in_month(CAL_GREGORIAN, $mon, $year) ;
if(isset($_POST['go'])){
	$monthNum = $_POST['month'];
	$month = date('F', mktime(0, 0, 0, $monthNum, 10));
	$mon = $_POST['month'];
	$year = $_POST['year'];
	$num = cal_days_in_month(CAL_GREGORIAN, $mon, $year) ;
}	
?><?php include("function.php"); ?>
<?php if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>


		<link rel="stylesheet" href="common.css">
		<link rel="stylesheet" href="03.css">
	
<style>
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
.projectReport input {
  background: #cc5200 none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-weight: bold;
  padding: 7px;
}
.projectReport {
  display: inline-block;
}

.projectReport form {
	float: left;
	padding: 29px 38px 0;
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
  width: 281px !important;
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
	</style>
		<body>
<div class="Reportwrapper">

	<div class="projectReport">

<form method="post" action="" name="teamLeads">
<select name="month">
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

<select name="year">
<option value="">--Year--</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
</select>
<input type="submit" value="Go" name="go">
</form>
	<div class="team-report-right">

	<ul><li>
		<span>For Team:</span> <?php
		 /*$getTlName=mysql_query("select * from webadmin where adminID ='$lead'");
							$leadArr=mysql_fetch_array($getTlName);
							$leadName = $leadArr['name'];*/

		
		echo "<span style='text-align:center'>All</span>"; ?>
</li><li>
		 <span> <?php echo $year; ?></span> <?php echo $month; 
					?></li></ul>
	</div>
	</div>
	
</div>
		<div id="wrapper">
			<div class="chart">
				<h2>Report For Month: <?php echo $month."-".$year; 
				?><span style="color:red"><?php
			
  $allHours1="select sum(hours2) as allhrs from closedssb where MONTH(closedOn) = '$mon' && YEAR (closedOn) = '$year'";
  $hoursData1=mysql_query($allHours1);
  $data1=mysql_fetch_assoc($hoursData1);
  echo "    Total Hours:  ".round($data1['allhrs'],2);
				
				?> </span></h2>
				<table id="data-table" border="1" cellpadding="10" cellspacing="0" >
					<caption>Completed Projects  in hours</caption>
					<thead>
						<tr>
							<td>&nbsp;</td>
					<?php	for($i=1; $i<=$num; $i++) {?>
  <th scope="col"><?php echo $i; ?></th><?php
}
						?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">Hours</th>
							<?php	for($i=1; $i<=$num; $i++) {?>
  <td><?php
  $date=$year."-".$mon."-".$i;
   $date;
  $i;  ?>
  <?php 
  $allHours="select sum(hours2) as hrs from closedssb where closedOn='$date' group by closedOn";
  $hoursData=mysql_query($allHours);
  $data=mysql_fetch_assoc($hoursData);
  echo round($data['hrs'],2);
  
  ?>
  
  
  
  </td><?php
}
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
		<script src="03.js"></script>
		
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>