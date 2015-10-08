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
//$lead=$_POST['lead'];
$adminID = $_SESSION['adminID'];
$month=date('F');
//$mon=date('m');
//$year=date('Y');
$firstDate = date('Y-m-01');
$currentDate = date('Y-m-d');
$num = cal_days_in_month(CAL_GREGORIAN, $mon, $year) ;
?>
<script>
function validateForm() {
    var timeUpdate = document.forms["myForm"]["timeUpdate"].value;
    if (timeUpdate == null || timeUpdate == "") {
        alert("Idle Time must be filled out!");
        return false;
    }
    var notes = document.forms["myForm"]["notes"].value;
	if (notes == null || notes == "") {
       alert("Notes must be filled out!");
       return false;
    }
}


function validateFormLeave() {
    var timeUpdate = document.forms["myFormLeave"]["timeUpdateLeave"].value;
    if (timeUpdate == null || timeUpdate == "") {
        alert("Leave Time must be filled out!");
        return false;
    }
    var notes = document.forms["myFormLeave"]["notesLeave"].value;
	if (notes == null || notes == "") {
       alert("Notes must be filled out!");
       return false;
    }
}
</script>
<?php
if(isset($_POST['submit']) && !empty($_POST['timeUpdate']))
{
$owner=$_POST['owner'];
$timeUpdate=$_POST['timeUpdate'];
$notes=$_POST['notes'];
$type=$_POST['type'];
$dateAdd=$_POST['dateAdded'];
//$mail=$_POST['mail'];
//$msg=$_POST['msg'];
$query1=mysql_query("insert into leave_idle_timesheet values('','$owner','$timeUpdate','$notes','$dateAdd','$type')");

$msgTime = "Idle Time Added Successfully!'";

}

if(isset($_POST['submitLeave']) && !empty($_POST['timeUpdateLeave']))
{
$ownerLeave=$_POST['ownerLeave'];
$timeUpdateLeave=$_POST['timeUpdateLeave'];
$notesLeave=$_POST['notesLeave'];
$typeLeave=$_POST['typeLeave'];
$dateAddedLeave=$_POST['dateAddedLeave'];
//$mail=$_POST['mail'];
//$msg=$_POST['msg'];
$query1=mysql_query("insert into leave_idle_timesheet values('','$ownerLeave','$timeUpdateLeave','$notesLeave','$dateAddedLeave','$typeLeave')");

$msgTime = "Leave Time Added Successfully!'";

}
?>
<style>
#contactLeave {
display: none;
position: fixed;
top: 25%;
left: 35%;
width: 30%;
height: 40%;
padding: 16px;
background-color: white;
border: 5px solid #0C0;
z-index:1002;
}

#contact {
display: none;
position: fixed;
top: 25%;
left: 35%;
width: 30%;
height: 40%;
padding: 16px;
background-color: white;
border: 5px solid #0C0;
z-index:1002;
}
#bg{
display: none;
position: absolute;
top: 0%;
left: 0%;
width: 100%;
height: 100%;
background-color: black;
z-index:1001;
opacity:.50;
}
#cross {
  display: block;
  padding: 9px;
  position: absolute;
  right: -19px;
  top: -21px;
  z-index: 1039;
}

.arrow {
  position: absolute;
  right: -4px;
  top: -5px;
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
  width: 302px !important;
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
tr{
	height:35px;
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
.notes{
	background: none repeat scroll 0 0 #fff;
    border: 1px solid;
    border-radius: 5px;
    box-shadow: 0 0 5px #000;
    display: none;
    padding: 7px;
    position: absolute;
    z-index: 1;
	margin-top:7px;
	
	}
.notesLeave{
	background: none repeat scroll 0 0 #fff;
    border: 1px solid;
    border-radius: 5px;
    box-shadow: 0 0 5px #000;
    display: none;
    padding: 7px;
    position: absolute;
    z-index: 1;
	margin-top:7px;
	}

	.time{
	background-color: #6495ED;
	color: #fff;
	padding: 5px 11px;
	cursor: pointer;
	display: inline-block;
	border: 2px solid transparent;
	font-weight:bold;
	position:relative;
	}
	.time:hover{
	 background-color: #64a103;
	 border:2px solid #6495ED;
	}
	@import url(http://fonts.googleapis.com/css?family=Khula:400,300,600,700,800);


</style>
<script type="text/javascript">
window.document.onkeydown = function (e)
{
if (!e) e = event;
if (e.keyCode == 27)
{
document.getElementById('contact').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('cross').style.display='none';
}
}

window.document.onkeydown = function (e)
{
if (!e) e = event;
if (e.keyCode == 27)
{
document.getElementById('contact1').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('cross').style.display='none';
}
}
</script>
<script>
function getIdleNotes(noteID){
//alert("hi");

	var elems = document.getElementsByClassName('notes');
	for(var i = 0; i < elems.length; i++) {
		elems[i].style.display = 'none';
	}
	//alert(noteID);
	document.getElementById("notes"+noteID).style.display="block";
}
function getIdleNotesOut(noteID){
	document.getElementById("notes"+noteID).style.display="none";
}

function getLeaveNotes(noteID){
/*alert(noteID);
var no = noteID;
var noo = no.split(".");
alert(noo);*/
/*for (var i = 0; i < noo.length; i++)
{
	alert(noo[i]);
}*/

//document.getElementById("demo").innerHTML = no;

	var elems = document.getElementsByClassName('notesLeave');
	for(var i = 0; i < elems.length; i++){
		elems[i].style.display = 'none';
	}
	//alert(noteID);
	document.getElementById("notesLeave"+noteID).style.display="block";
}
function getLeaveNotesOut(noteID){
	document.getElementById("notesLeave"+noteID).style.display="none";
}
function getManualNotes(noteID){
//alert("hi");

	var elems = document.getElementsByClassName('notes');
	for(var i = 0; i < elems.length; i++) {
		elems[i].style.display = 'none';
	}
	//alert(noteID);
	document.getElementById("notesManual"+noteID).style.display="block";
}
function getManualNotesOut(noteID){
	document.getElementById("notesManual"+noteID).style.display="none";
}
</script>
<script>
function timeDelete(timeID,dateUpdate) {
	
	//alert(dateUpdate);
	var conf = confirm('Are you sure that you want to delete idle time?');
	if(conf) {
			
		
	
	//alert("hi");
  if (timeID=="") {
    document.getElementById("time").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  document.getElementById("time"+timeID).style.display = "none";    
	  document.getElementById("notes"+timeID).style.display = "none";    
	  document.getElementById("deleteMsg").innerHTML = "Idle Time Deleted Successfully!";    
	  document.getElementById("timeChange"+dateUpdate).innerHTML=xmlhttp.responseText;
	  }
  }
  xmlhttp.open("GET","timeDelete.php?timeID="+timeID,true);
  xmlhttp.send();
}
}
</script>
<script>
function timeDeleteLeave(timeID,dateUpdate) {
	
	//alert(dateUpdate);
	var conf = confirm('Are you sure that you want to delete leave time?');
	if(conf) {
			
		
	
	//alert("hi");
  if (timeID=="") {
    document.getElementById("time").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  document.getElementById("time"+timeID).style.display = "none";    
	  document.getElementById("notesLeave"+timeID).style.display = "none";    
  	  document.getElementById("deleteMsg").innerHTML = "Leave Time Deleted Successfully!";    
	  document.getElementById("timeChangeLeave"+dateUpdate).innerHTML=xmlhttp.responseText;
	  }
  }
  xmlhttp.open("GET","timeDeleteLeave.php?timeID="+timeID,true);
  xmlhttp.send();
}
}
</script>

<?php include("function.php"); ?>
<?php 	if($_SESSION['userRole']==3 && $_SESSION['status']==1){?>
<div class="main-container-efficiency">
	
</head>
<body>

<?php 

$emp="select name,adminID,join_date from webadmin where userRole = 3 and status = 1 and adminID = '$adminID'";
$resultEmp=mysql_query($emp);
$rowEmp=mysql_fetch_array($resultEmp);
?>
<div class="efficiency_container">
<div class="ContentData" >
<p style="clear:both">

</p>
<div class="ready-close-container">

<div class="reviews">
<?php 
if($query1)
{
	echo "<h2 id='deleteMsg' style='text-align:center;color:green;'>".$msgTime."</h2>" ;
}
?>
<!--<h2 id="deleteMsg"></h2>-->
<h3><?php echo $rowEmp['name']; ?></h3>
<table class="sortable" border="2">
<thead><tr style="background:#ccc;">
<th style="padding-left:10px;">Date</th><th style="padding-left:10px;" >Idle</th>
<th style="padding-left:10px;" >Leave</th>
<th style="padding-left:10px;" >Manual</th><th style="padding-left:10px;" >Project</th>
</tr></thead>

<?php
while($firstDate <= $currentDate){
	 $day=date("N",strtotime($firstDate));
     //if($day==1 || $day==2 || $day==3 || $day==4 || $day==5){ ?>
<tr>
<?php if($day==6 || $day==7){ ?>
<td style='background-color:#cccccc;'>
<?php }else{?>
<td>	
<?php } ?>
<?php echo $firstDate; ?></td>
<?php 
$idleTime="SELECT timeID,notes,sum(timeAdded) as idle,dateAdded FROM leave_idle_timesheet
WHERE  owner='$adminID' && dateAdded='$firstDate' && type='2'";
$idle=mysql_query($idleTime) or die(mysql_error());
$idleArr=mysql_fetch_array($idle);
$idled= round($idleArr['idle'],2);
$dateAddedIdle= $idleArr['dateAdded'];
?>
<td><?php //echo $idled ; ?>

<?php //if($idleArr['notes'] !='' || $idleArr['notes'] != null ){
$idleTime1="SELECT timeID,notes,timeAdded,dateAdded FROM leave_idle_timesheet
WHERE  owner='$adminID' && dateAdded='$firstDate' && type='2'";
$idle1=mysql_query($idleTime1) or die(mysql_error());
$idleNum = mysql_num_rows($idle1);
if($idleNum > 1){
	$dateFormatIdle = str_replace("-","",$idleArr['dateAdded']);		

	echo "<span id='timeChange$dateFormatIdle'>" .$idled . "</span>"." ----- "; 
	while($idleArr1=mysql_fetch_array($idle1)){
		//if($idleArr1['notes'] !='' || $idleArr1['notes'] != null ){

?>
			
			<span id="time<?php echo $idleArr1['timeID'];?>" class="time" onmouseover="getIdleNotes(<?php echo $idleArr1['timeID'];?>)" onmouseout="getIdleNotesOut(<?php echo $idleArr1['timeID'] ; ?>)"><?php echo $idleArr1['timeAdded'];?>
			<img class="arrow" src="images/Close-icon.png" height="15px" width="15px"  onclick="timeDelete(<?php echo $idleArr1['timeID'];?>,<?php echo $dateFormatIdle ;?>)">

			</span>
			<?php if($idleArr1['notes'] !='' || $idleArr1['notes'] != null ){ ?>
			<div class="notes" id="notes<?php echo $idleArr1['timeID'];?>" style="display:none">
			<p>	<?php echo $idleArr1['notes'];?></p>
			</div>
<?php 	
		} else{ ?>
			<div class="notes" id="notes<?php echo $idleArr1['timeID'];?>" style="display:none">
			<p>	<?php echo "N/A" ; ?></p>
			</div>
<?php		
		}?>
<?php		
	}
} else { 
		//if($idleArr['notes'] !='' || $idleArr['notes'] != null ){
		if(!empty($idleArr['idle'])){ 
		?> 
			<span id="time<?php echo $idleArr['timeID'];?>" class="time" onmouseover="getIdleNotes(<?php echo $idleArr['timeID'];?>)" onmouseout="getIdleNotesOut(<?php echo $idleArr['timeID'] ; ?>)"><?php echo $idleArr['idle'];?>
			<img class="arrow" src="images/Close-icon.png" height="15px" width="15px" onclick="timeDelete(<?php echo $idleArr['timeID'];?>,<?php echo $dateAddedIdle ;?>)">

			</span>
			<?php if($idleArr['notes'] !='' || $idleArr['notes'] != null ){ ?>
			<div class="notes" id="notes<?php echo $idleArr['timeID'];?>" style="display:none">
			<p>	<?php echo $idleArr['notes'];?></p>
			</div>
	
<?php 	}else{ ?>
			<div class="notes" id="notes<?php echo $idleArr['timeID'];?>" style="display:none">
			<p>	<?php echo "N/A";?></p>
			</div>
<?php		}?>
<?php
		} else {
			echo 0 ; 
		} 
		 }	?>
		
<a style="float:right;cursor:pointer;text-decoration:none; background: #f9c95a;border-radius: 50%;width: 20px;height: 20px;" href = "javascript:void()" onClick = "
document.getElementById('dateAdded').value='<?=$firstDate?>';
document.getElementById('contact').style.display='block';
document.getElementById('bg').style.display='block';
document.getElementById('cross').style.display='block';">&nbsp;+</a>
</td>
<?php 
$leaveTime="SELECT timeID, notes, sum(timeAdded) as leaves,dateAdded FROM leave_idle_timesheet
WHERE  owner='$adminID' && dateAdded='$firstDate' && type='1'";
$leave=mysql_query($leaveTime) or die(mysql_error());
$leaveArr=mysql_fetch_array($leave);
$leaved= round($leaveArr['leaves'],2);
$timeID = $leaveArr['timeID'];
$dateAddedLeave= $leaveArr['dateAdded'];

//$strLeave = str_replace(",",".",$timeID);
?>
<td><?php //echo $leaved; ?>
<?php //if($leaveArr['notes'] !='' || $leaveArr['notes'] != null){
$leaveTime1="SELECT timeID, notes, timeAdded FROM leave_idle_timesheet
WHERE  owner='$adminID' && dateAdded='$firstDate' && type='1'";
$leave1=mysql_query($leaveTime1) or die(mysql_error());
$leaveNum = mysql_num_rows($leave1);
if($leaveNum > 1){
	$dateFormatLeave = str_replace("-","",$leaveArr['dateAdded']);		
	echo "<span id='timeChangeLeave$dateFormatLeave'>" .$leaved . "</span>"." ----- "; 

	//echo $leaved . " ----- "; 
	while($leaveArr1=mysql_fetch_array($leave1)){
		//if($leaveArr1['notes'] !='' || $leaveArr1['notes'] != null){ ?>
			<span id="time<?php echo $leaveArr1['timeID'];?>" class="time" onmouseover="getLeaveNotes(<?php echo $leaveArr1['timeID'] ; ?>)" onmouseout="getLeaveNotesOut(<?php echo $leaveArr1['timeID'] ; ?>)"><?php echo $leaveArr1['timeAdded'];?>
			<img class="arrow" src="images/Close-icon.png" height="15px" width="15px" onclick="timeDeleteLeave(<?php echo $leaveArr1['timeID'];?>,<?php echo $dateFormatLeave ;?>)">
			</span>
			<?php if($leaveArr1['notes'] !='' || $leaveArr1['notes'] != null){ ?>
			<div class="notesLeave" id="notesLeave<?php echo $leaveArr1['timeID'];?>" style="display:none">
			<p>	<?php echo $leaveArr1['notes'];?></p>
			</div>
<?php 	} else{?>
		<div class="notesLeave" id="notesLeave<?php echo $leaveArr1['timeID'];?>" style="display:none">
			<p>	<?php echo "N/A" ;?></p>
			</div>
<?php }
	} 
}else{ if(!empty($leaveArr['leaves'])){ 
		//if($leaveArr['notes'] !='' || $leaveArr['notes'] != null){ ?>
			<span id="time<?php echo $leaveArr['timeID'];?>" class="time" onmouseover="getLeaveNotes(<?php echo $leaveArr['timeID'] ; ?>)" onmouseout="getLeaveNotesOut(<?php echo $leaveArr['timeID'] ; ?>)"><?php echo $leaveArr['leaves'];?>
			<img class="arrow" src="images/Close-icon.png" height="15px" width="15px" onclick="timeDeleteLeave(<?php echo $leaveArr['timeID'];?>,<?php echo $dateAddedLeave ;?>)">
			</span>
			<?php if($leaveArr['notes'] !='' || $leaveArr['notes'] != null){ ?>
			<div class="notesLeave" id="notesLeave<?php echo $leaveArr['timeID'];?>" style="display:none">
			<p>	<?php echo $leaveArr['notes'];?></p>																
			</div>
<?php 	 }
else{ ?>
			<div class="notesLeave" id="notesLeave<?php echo $leaveArr['timeID'];?>" style="display:none">
			<p><?php echo "N/A"; ?></p>																
			</div>
<?php		}
} else{
	echo "0" ;
} }	?>

<a style="float:right;cursor:pointer;text-decoration:none; background: #f9c95a;border-radius: 50%;width: 20px;height: 20px;" href = "javascript:void()" onClick = "
document.getElementById('dateAddedLeave').value='<?=$firstDate?>';
document.getElementById('contactLeave').style.display='block';
document.getElementById('bg').style.display='block';
document.getElementById('cross').style.display='block';">&nbsp;+</a>
</td>
<?php
$manualTime="SELECT openssbID,sum(timeTaken) as manual,ssbID,notes FROM  openssbtime
where owner='$adminID' && dateUpdated='$firstDate' && status='1'";
$manual=mysql_query($manualTime) or die(mysql_error());
$manualArr=mysql_fetch_array($manual);
$manualled= round($manualArr['manual'],2);
?>
<td><?php //echo $manualled= round($manualArr['manual'],2); ?>
<?php //if($leaveArr['notes'] !='' || $leaveArr['notes'] != null){
$manualTime1="SELECT openssbID,timeTaken,ssbID,notes FROM  openssbtime
where owner='$adminID' && dateUpdated='$firstDate' && status='1'";
$manual1=mysql_query($manualTime1) or die(mysql_error());
$manualNum = mysql_num_rows($manual1);
if($manualNum > 1){
		echo $manualled . " ----- "; 
		while($manualArr1=mysql_fetch_array($manual1)){
			//if($manualArr1['notes'] !='' || $manualArr1['notes'] != null || $manualArr1['ssbID'] !='' || $manualArr1['ssbID'] != null){ ?>
				<span class="time" onmouseover="getManualNotes(<?php echo $manualArr1['openssbID'] ; ?>)" onmouseout="getManualNotesOut(<?php echo $manualArr1['openssbID'] ; ?>)"><?php echo $manualArr1['timeTaken'];?></span>
				<?php if($manualArr1['notes'] !='' || $manualArr1['notes'] != null || $manualArr1['ssbID'] !='' || $manualArr1['ssbID'] != null){ ?>
				<div class="notes" id="notesManual<?php echo $manualArr1['openssbID'];?>" style="display:none">
				<p>	<?php echo $manualArr1['ssbID']; ?></p>
				<hr/>
				<p> <?php echo $manualArr1['notes']; ?></p>
				</div>

<?php
			}else{?>
				<div class="notes" id="notesManual<?php echo $manualArr1['openssbID'];?>" style="display:none">
				<p>	<?php echo "N/A"; ?></p>
				</div>
<?php			}
		}
}else { if(!empty($manualArr['manual'])){
		//if($manualArr['notes'] !='' || $manualArr['notes'] != null || $manualArr['ssbID'] !='' || $manualArr['ssbID'] != null){ ?>
				<span class="time" onmouseover="getManualNotes(<?php echo $manualArr['openssbID'] ; ?>)" onmouseout="getManualNotesOut(<?php echo $manualArr['openssbID'] ; ?>)"><?php echo $manualArr['manual'];?></span>
				<?php if($manualArr['notes'] !='' || $manualArr['notes'] != null || $manualArr['ssbID'] !='' || $manualArr['ssbID'] != null){ ?>
				<div class="notes" id="notesManual<?php echo $manualArr['openssbID'];?>" style="display:none">
				<p>	<?php echo $manualArr['ssbID']; ?></p>
				<hr/>
				<p> <?php echo $manualArr['notes'];?></p>
				</div>
	
		<?php }else{?>
		<div class="notes" id="notesManual<?php echo $manualArr['openssbID'];?>" style="display:none">
				<p>	<?php echo "N/A" ; ?></p>
		</div>
			
<?php		}
}else{
		echo 0 ; 
	}
}	
?>

</td>
<?php
$manualTime="SELECT openssbID,sum(timeTaken) as manual,ssbID,notes FROM  openssbtime
where owner='$adminID' && dateUpdated='$firstDate' && status='0'";
$manual=mysql_query($manualTime) or die(mysql_error());
$manualArr=mysql_fetch_array($manual);
$manualled= round($manualArr['manual'],2);

?>
<td><?php //echo $manualled = round($manualArr['manual'],2); ?>
<?php //if($leaveArr['notes'] !='' || $leaveArr['notes'] != null){
$manualTime1="SELECT openssbID,timeTaken,ssbID,notes FROM  openssbtime
where owner='$adminID' && dateUpdated='$firstDate' && status='0'";
$manual1=mysql_query($manualTime1) or die(mysql_error());
$manualNum = mysql_num_rows($manual1);
if($manualNum > 1){
		echo $manualled . " ----- "; 
		while($manualArr1=mysql_fetch_array($manual1)){
			//if($manualArr1['notes'] !='' || $manualArr1['notes'] != null || $manualArr1['ssbID'] !='' || $manualArr1['ssbID'] != null){ ?>
				<span class="time" onmouseover="getManualNotes(<?php echo $manualArr1['openssbID'] ; ?>)" onmouseout="getManualNotesOut(<?php echo $manualArr1['openssbID'] ; ?>)"><?php echo $manualArr1['timeTaken'];?></span>
				<?php if($manualArr1['notes'] !='' || $manualArr1['notes'] != null || $manualArr1['ssbID'] !='' || $manualArr1['ssbID'] != null){ ?>
				<div class="notes" id="notesManual<?php echo $manualArr1['openssbID'];?>" style="display:none">
				<p>	<?php echo $manualArr1['ssbID']; ?></p>
				</div>

<?php
			}
		}
}else { if(!empty($manualArr['manual'])){
		//if($manualArr['notes'] !='' || $manualArr['notes'] != null || $manualArr['ssbID'] !='' || $manualArr['ssbID'] != null){ ?>
				<span class="time" onmouseover="getManualNotes(<?php echo $manualArr['openssbID'] ; ?>)" onmouseout="getManualNotesOut(<?php echo $manualArr['openssbID'] ; ?>)"><?php echo $manualArr['manual'];?></span>
				<?php if($manualArr['notes'] !='' || $manualArr['notes'] != null || $manualArr['ssbID'] !='' || $manualArr['ssbID'] != null){ ?>
				<div class="notes" id="notesManual<?php echo $manualArr['openssbID'];?>" style="display:none">
				<p>	<?php echo $manualArr['ssbID']; ?> </p>
				</div>
	
		<?php }else{?>
			<div class="notes" id="notesManual<?php echo $manualArr['openssbID'];?>" style="display:none">
				<p>	<?php echo "N/A" ; ?> </p>
			</div>
			
<?php		}
}else{
		echo 0 ; 
	}
}
	
?>

</td>
<!--<?php
$manualTime="SELECT sum(timeTaken) as manual FROM  openssbtime
where owner='$adminID' && dateUpdated='$firstDate' && status='0'";
$manual=mysql_query($manualTime) or die(mysql_error());
$manualArr=mysql_fetch_array($manual);
?>
<td><?php echo $manualled= round($manualArr['manual'],2); ?></td>-->
<!--<?php
$allClosed = "select sum(aa.timeTaken) as hrs1 from (SELECT distinct o.* FROM openssbtime o, closedssb c WHERE o.ssbID = c.ssbID and o.owner='$dat1[adminID]' and c.owner='$dat1[adminID]' and MONTH(c.closedOn)='$mon' and YEAR(c.closedOn)='$year' and c.isManual !='1') aa";
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
<td><?php echo $diff ; ?></td>-->

</tr>

<?php 
// }
$firstDate = date("Y-m-d",strtotime("+1 days",strtotime($firstDate)));
// }
}
 //} }?>
</table>
</div>
</div>
</div>

</div>
<a href="#" class="back-to-top"><span>Top</span></a>
</div>
<div id="contact">
<fieldset>	
<form name="myForm" method="post" action="" align="center" onsubmit="return validateForm()">
<h2 align="center">Add Idle Time</h2>
<input type="hidden" name="owner" value="<?php echo $adminID ; ?>"><br/>
Time:<br/><input type="text" name="timeUpdate" style='width:50%;'><br /><br/>
Notes:<br/><textarea name="notes"></textarea>
<input type="hidden" name="type" value="2"><br />
<input type="hidden" name="dateAdded" id="dateAdded" value=""><br />
<input type="submit" name="submit">
</form>
</fieldset>
<div id="cross">
<a href = "javascript:void(0)" onClick ="
document.getElementById('contact').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('cross').style.display='none';">
<img src="images/Close-icon.png" width="25px" height="25px" alt="img"></a>
</div>
</div>

<div id="contactLeave">
<fieldset>	
<form name="myFormLeave" method="post" action="" align="center" onsubmit="return validateFormLeave()">
<h2 align="center">Add Leave Time</h2>
<input type="hidden" name="ownerLeave" value="<?php echo $adminID ; ?>"><br/>
Time:<br/><input type="text" name="timeUpdateLeave" style='width:50%;'><br /><br/>
Notes:<br/><textarea name="notesLeave"></textarea>
<input type="hidden" name="typeLeave" value="1"><br />
<input type="hidden" name="dateAddedLeave" id="dateAddedLeave" value=""><br />
<input type="submit" name="submitLeave">
</form>
</fieldset>
<div id="cross">
<a href = "javascript:void(0)" onClick ="
document.getElementById('contactLeave').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('cross').style.display='none';">
<img src="images/Close-icon.png" width="25px" height="25px" alt="img"></a>
</div>
</div>	
<div id="bg"></div>
		
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>