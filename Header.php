<?php

// server should keep session data for AT LEAST 1 hour

			ini_set('session.gc_maxlifetime', 3600);


//ob_start();
	include("config.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Admin</title>

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style1.css">
<link rel="stylesheet" href="css/style11.css">

<link href="css/search.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style_tb.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script src="sorttable.js"></script>
<script type="text/javascript">
$(function() {		
	$("#tablesorter-demo").tablesorter({sortList:[[0,1]], widgets: ['zebra']});
	$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
});	
</script>
<style>
.zone {
    display: inline-block;
    font-size: 14px;
    padding: 14px 20px 0;
    color:#fff;
}</style>
</head>
<body>

<div class="wrapper">

<div class="header">

  <div class="inner-header page-center">
<div class="custom-logo">
<a href="http://thewebplant.com/" />
<img src="images1/logo.png"  title="The Webplant" alt="The Webplant" />
</a>
</div>
  <div class="header-left">
   <style>
   .header-left {
padding: 3px 0 50px 24px;
}
.addData
{
font-size:12px;
}
</style>

  </div>
   
  
  <div class="clear"></div>
</div>
</div>

<!-- menu start -->
<div class="header-bottom" >
  <div class="page-center">
<ul id="nav"><li class="parent level0 ">
   <a  href="viewData.php" ><img src="images1/m2.png"><span>Home</span></a>
   </li>
    <li class="parent level0 "> 
		<a  href="#" onclick="return false"><img src="images1/m5.png"><span>Reports</span></a>
		<ul> 
           <li class="level1"> 
           <a href="viewReports.php">
           <span>Team Reports</span></a>
           </li>
		    <li class="level1"> 
           <a href="reports.php">
           <span>All Reports</span></a>
           </li>
           <li class="level1"> 
           <a href="hoursReport.php">
           <span>Hour Report</span></a>
           </li>
           <li class="level1"> 
           <a href="weekReport.php">
           <span>Week Closed Report</span></a>
           </li>
           <li class="level1"> 
           <a href="teamHourAnalysis.php">
           <span>Hour Analysis Report</span></a>
           </li>
           <li class="level1"> 
           <a href="allReports.php">
           <span>Dashboard</span></a>
           </li>
		   <li class="level1"> 
           <a href="timeTracking.php">
           <span>Team Analysis</span></a>
           </li>
		    <li class="level1"> 
           <a href="timeTrackingList.php">
           <span>Time Sheet Summary</span></a>
           </li>
		 </ul>
	</li>
	 
	<li class="parent level0 "> 
	<a  href="manualTime.php" ><img src="images1/m7.png"><span>Add Time Manually</span></a>
	</li>
	<li class="parent level0 "> 
	<a  href="addUpdateTime.php" ><img src="images1/m7.png"><span>Manage Time</span></a>
	</li>
	<li class="parent level0 "> 
	<?php if($_SESSION['userRole']==2 || $_SESSION['userRole']==3){ ?>
	<a href="#"> <span>Leave Tracker</span></a>
		<ul> 
			<li class="level1"> 
           <a href="leaveTracking.php">
           <span>Apply For Leave</span></a>
           </li>
		   <li class="level1"> 
           <a href="leaveStatus.php">
           <span>Leave Status</span></a>
           </li> 
		     <li class="level1"> 
           <a href="allLeaveStatus.php">
           <span>All Leave Status</span></a>
           </li>
		    <li class="level1"> 
           <a href="leaveCalendar.php">
           <span>Leave Calendar</span></a>
           </li>
        </ul>
   <?php 
   }
   ?>
   </li>
    <li class="parent level0 "> 
	<?php if($_SESSION['userRole']==2 || $_SESSION['userRole']==3){ ?>
   <a href="personalInfo.php"> <span>My Profile</span></a>
   <?php 
   }
   ?>
	</li>
    </ul>
  </li>
</ul>
<div class="header-right"><a class="link home" href="welcome.php">Home</a>|<a class="link logout" href="logout.php">Logout</a></div>
</div>
</div>