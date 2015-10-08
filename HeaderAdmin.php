<?php
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
/*
$logout_redirect_url = "index.php"; // Set logout URL

$timeout =  86400 ; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
	//echo "sfc<br/>";
   $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        header("Location: $logout_redirect_url");
    }
}else{
$_SESSION['start_time'] = time();
}
*/
//ob_start();
	include("config.php");
date_default_timezone_set('Asia/Kolkata');
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
}
</style>
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
     <?php 
date_default_timezone_set('Asia/Kolkata');?>

<script type="text/javascript">

var currenttime = '<?php print date("F d, Y h:i:s", time())?>' //PHP method of getting server date
var curHour= '<?php print date("F d, Y H:i:s", time())?>' 

///////////Stop editting here/////////////////////////////////

var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate=new Date(currenttime)
var ampm=new Date(curHour)

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
	if(ampm.getHours()>=12)
	{var meridiem='PM';
	}
	else { var meridiem='AM';}
document.getElementById("servertime").innerHTML=datestring+" "+timestring+" "+meridiem
}



window.onload=function(){

	
setInterval("displaytime()", 1000)
}
</script>
<p class="zone india"><img src="images1/app-design1-115.png"> <b>India Standard Time: </b> <span id="servertime"></span></p>


<?php 
date_default_timezone_set('America/New_York');?>
<script type="text/javascript">

var currenttime1 = '<?php print date("F d, Y h:i:s", time())?>' //PHP method of getting server date
var curHour1= '<?php print date("F d, Y H:i:s", time())?>' 

///////////Stop editting here/////////////////////////////////

var montharray1=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate1=new Date(currenttime1)
var ampm1=new Date(curHour1)

function padlength1(what1){
var output1=(what1.toString().length==1)? "0"+what1 : what1
return output1
}

function displaytime1(){
serverdate1.setSeconds(serverdate1.getSeconds()+1)
var datestring1=montharray1[serverdate1.getMonth()]+" "+padlength1(serverdate1.getDate())+", "+serverdate1.getFullYear()
var timestring1=padlength1(serverdate1.getHours())+":"+padlength1(serverdate1.getMinutes())+":"+padlength1(serverdate1.getSeconds())
	if(ampm1.getHours()>=12)
	{var meridiem1='PM';
	}
	else { var meridiem1='AM';}

document.getElementById("servertime1").innerHTML=datestring1+" "+timestring1+" "+meridiem1
}

window.onload=function(){
setInterval("displaytime1()", 1000)
	
setInterval("displaytime()", 1000)
}

</script>
<p class="zone new-york"><img src="images1/app-design1-114.png"> <b>New York Time:</b> <span id="servertime1"></span></p>

  </div>
   <div class="header-right">
   <form method="get" action="searchSsb.php">
   <input type="text" name="ssbID" required="" placeholder="Search SSB ID">
   <button value="Go" type="submit">Go</button></form>
   </div>
  
  <div class="clear"></div>
</div>
</div>

<!-- menu start -->
<div class="header-bottom" >
  <div class="page-center">
<ul id="nav">
  <li class="parent level0 "> 
  <?php if($_SESSION['userRole']==1){ ?><a href="takeBackupp.php"> <?php } else {?> <a href="#"> <?php } ?><img src="images1/m1.png"> <span>Add SSB Data</span></a>
  </li>
   <li class="parent level0"> 
           <a href="addTracking.php"><img src="images1/m2.png"> 
           <span>SSB Data Tracking</span></a>
   </li>
    <li class="parent level0"> 
  <a onclick="return false" href="#"><img src="images1/m3.png"> <span>Manage User</span></a>
      <ul>
		<?php  if($_SESSION['userRole']==1){ ?>
          <li class="level1"> 
           <a href="addUser.php">
           <span>Add a New User</span></a>
           </li>
		   
           <li class="level1"> 
           <a href="editHubspotUser.php">
           <span>Edit Hubspot User</span></a>
           </li>

		    <li class="level1"> 
           <a href="editUser.php">
           <span>View/Edit User</span></a>
           </li>
		   <li class="level1"> 
           <a href="joiningLeavingDate.php">
           <span>Joined/Left Employee</span></a>
           </li>
		    <?php }  ?>
		   <li class="level1"> 
           <a href="viewHeirarchy.php">
           <span>Team Structure</span></a>
           </li>
		   <li class="level1"> 
           <a href="activeEmp.php">
           <span>Active Employee</span></a>
           </li>
		   <?php  if($_SESSION['userRole']==1){ ?>
		   <li class="level1"> 
           <a href="disabledEmp.php">
           <span>Disabled Employee</span></a>
           </li>
		   <li class="level1"> 
           <a href="exportEmployees.php">
           <span>Export Emp Details</span></a>
           </li>
		    <?php }  ?>
		  

      </ul>
  </li>
   <li class="parent level0 "> 
  <a href="closedProject.php"><img src="images1/m4.png"> <span>Closed SSBs</span></a>
  </li>
           
    <li class="parent level0 "> 
   <a onclick="return false" href="#"><img src="images1/m5.png"> <span>Reports</span></a>
    <ul>
       
		   
           <!--<li class="level1"> 
           <a href="viewReports.php">
           <span>Team Reports</span></a>
           </li>-->
		    <li class="level1"> 
           <a href="reports.php">
           <span>All Reports</span></a>
           </li>
            <!-- <li class="level1"> 
           <a href="hoursReport.php">
           <span>Hour Report</span></a>
           </li>
           <li class="level1"> 
           <a href="weekReport.php">
           <span>Week Closed Report</span></a>
           </li>-->
           <li class="level1"> 
           <a href="teamHourAnalysis.php">
           <span>Hour Analysis Report</span></a>
           </li>
		   <li class="level1"> 
           <a href="countReadyClose.php">
           <span>Repeated Ready To Close</span></a>
           </li>
		   <li class="level1"> 
           <a href="starRating.php">
           <span>Star Rating Report</span></a>
           </li>
		    <!-- <li class="level1"> 
           <a href="allReports.php">
           <span>Dashboard</span></a>
           </li>-->
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
   <a href="updateProjectStatus.php"><img src="images1/m6.png"> <span>Comments</span></a>
  </li>
  <li class="parent level0 "> 
   <a href="manualTime.php"><img src="images1/m7.png"> <span>Add Time Manually</span></a>
   <ul>
       
		   
           <li class="level1"> 
           <a href="allManual.php">
           <span>Closed Manual Hours</span></a>
           </li>
		    <li class="level1"> 
           <a href="manuallyClosed.php">
           <span>Approve Manual Hours</span></a>
           </li>
		   </ul>
  </li>
  <li class="parent level0 "> 
  <?php if($_SESSION['userRole']==1){ ?>
   <a href="#"> <span>Leave Tracker</span></a>
       <ul> 
			<li class="level1"> 
           <a href="adminLeaveTracking.php">
           <span>Leave Tracking</span></a>
           </li>
		   <li class="level1"> 
           <a href="allLeaveStatus.php">
           <span>All Leave Status</span></a>
           </li>
			 <li class="level1"> 
           <a href="leaveTracking.php">
           <span>Apply For Leave</span></a>
           </li>
		     <li class="level1"> 
           <a href="leaveStatus.php">
           <span>My Leave Status</span></a>
           </li>
		   <li class="level1"> 
           <a href="applyEmployeeLeaves.php">
           <span>Apply Employee Leaves</span></a>
           </li>
           <li class="level1"> 
           <a href="leaveCalendar.php">
           <span>Leave Calendar</span></a>
           </li>
		   
		   </ul>
   
   
   <?php } ?>
   
   <?php
   if($_SESSION['userRole']==2 || $_SESSION['userRole']==3){ ?>
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
	<?php if($_SESSION['userRole']==2){ ?>
   <a href="personalInfo.php"> <span>My Profile</span></a>
   <?php 
   }
   ?>
	</li>
</ul>
<div class="header-right"> 
	<a class="link home" href="welcome.php">Home</a>|<a class="link logout" href="logout.php">Logout</a>
  </div>
  </div>
  </div>
<!-- menu end -->