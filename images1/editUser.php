<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1 && $_SESSION['status']==1)){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 	
			include_once ("Header.php");
		}

include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Update Employee</title>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
<script type="text/javascript">
$(function() {
var date = new Date();
var currentMonth = date.getMonth();
var currentDate = date.getDate();
var currentYear = date.getFullYear();
$('#startdate').datepicker({dateFormat: "yy-mm-dd"});
   
});
</script>
<script>
function team(type){
		if(type==1 || type==2 || type==3){
			document.getElementById("teamLead").style.display="table-row";
		}
		else {
			document.getElementById("teamLead").style.display="none";
		}
}

</script>
	<script>

		function deleteUser(userId,usrName) {

		

	var answer = confirm("You have selected to delete "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="deleteUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
<script>

function dol(type)

	{

		if(type==2 || type==3)

		{

			document.getElementById("lead").style.display="table-row";

		

		}

		else {

	

			document.getElementById("lead").style.display="none";

		

		}



	}

	</script>
<script>
function getUser(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    document.getElementById("personal").style.display="none";
    }
  }
xmlhttp.open("GET","getEmployees.php?q="+str,true);
xmlhttp.send();
}
</script>

	<script>
function getActiveEmployee(str)
{

var xmlhttp;    

if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    document.getElementById("personal").style.display="none";

    }
  }
xmlhttp.open("GET","getActiveEmployees.php?q="+str,true);
xmlhttp.send();
}
</script>
	
	
	
		<script>

		function resignUser(userId,usrName) {


	var answer = confirm("You have selected to resign "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="resignUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
	
		<script>

		function abscondUser(userId,usrName) {


	var answer = confirm("You have selected to abscond "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="abscondUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
<!--<script type="text/javascript" src="jquery-1.8.0.min.js"></script>-->
<script type="text/javascript">
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
	$.ajax({
	type: "POST",
	url: "search.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#result").html(html).show();
	}
	});
}return false;    
});

jQuery("#result").live("click",function(e){ 
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#result").fadeOut(); 
	}
});
$('#searchid').click(function(){
	jQuery("#result").fadeIn();
});
});
</script>
<script>
function getEmployee(empID)
{
	   window.location.href="editUser.php?empID="+empID;
	document.getElementById("employeeNumber").value=empID;
}
</script>
<style type="text/css">
	.content{
		width:250px;
		
	}
	#searchid
	{
		width:250px;
		border:solid 1px #000;
		padding:10px;
		font-size:14px;
		margin-right:50px;
	}
	#result
	{
		position:absolute;
		width:250px;
		padding:10px;
		display:none;
		margin-top:-1px;
		border-top:0px;
		overflow:hidden;
		border:1px #CCC solid;
		background-color: white;
		z-index:999;
	}
	.show
	{
		padding:10px; 
		border-bottom:1px #999 dashed;
		font-size:15px; 
		height:50px;
	}
	.show:hover
	{
		background:#4c66a4;
		color:#FFF;
		cursor:pointer;
	}
</style>
</head>
</body>

<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
<?php include("function.php");?>
<!--<div id="personal">-->
<div id="myDiv"></div>

<select name="employeeStatus" onchange="getUser(this.value)"  style='margin-top:10px;height:35px !important'>
	<option value="">Select Status</option>
	<option value="1">Active</option>
	<option value="2" >Resigned</option>
	<option value="3" >Absconded</option>
	</option>
</select>

<div class="content" style="margin-top:-20px;margin-left:300px">
<input type="text" class="search" id="searchid" placeholder="Search for people" /><br /> 
<div id="result">
</div>
</div>
<div style='float:right;margin-right:10px;margin-top:-40px'>
<form method="post" action="">
<table >
<input name="search" type="button" value="Search Active Employee" onclick= "getUser(1);">
</table>
</form>
</div>
<br/>
<div id="txtHint">Employee info will be listed here...</div>
<?php 
	include("config.php");
	$getEmployeeDetails="select * from webadmin where empID= '$_GET[empID]'";
					$emoloyeeDetailsQuery=mysql_query($getEmployeeDetails) or die(mysql_error());
					$getEmployeeDetailsArr=mysql_fetch_array($emoloyeeDetailsQuery);
					?>
					<div id="personal">

					<?php if(isset($_GET['empID']) || (	$_GET['empID'] != '')) { ?>
					
					
		<form id="register" class="appnitro" enctype="multipart/form-data" method="post" autocomplete="off" action="submitEditUser.php" width="50%" align="center">
					<div class="form_description">
			<h2><a href="editUser.php?empID=<?php echo $_GET['empID']; ?>">Personal Details</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="saveDocuments.php?empID=<?php echo $_GET['empID']; ?>">Documents</a></h2><br/>
			
			<h2><?php 	echo $getEmployeeDetailsArr['name']."(".$getEmployeeDetailsArr['empID']." )"; ?></h2>
			
						
		</div>	
		
<?php
if($_GET['msg']=='success'){
echo "Updated Successfully!";
echo "<br/>";
}
if($_GET['msg']=='failed'){
echo "Not Updated!";
}		
	
?>




			<ul  id="allEmployee">
			
					<li id="li_1" >
					<input type="hidden" value="<?php echo $_GET['empID']; ?>" name="empID">
		<label class="description" for="element_1">Name </label>
		<span>
			<input id="element_1_1" name= "fname" class="element text" maxlength="255" size="30" required value="<?php 	echo $getEmployeeDetailsArr['name']; ?>"/>
			
		</span>
	
		
		</li>		<li id="li_9" >
		<label class="description" for="element_9">Gender </label>
		<div>
		<select class="element select medium" id="element_9" required name="gender"> 
			<option value="<?php 	echo $getEmployeeDetailsArr['gender']; ?>" selected="selected"><?php 	 if($getEmployeeDetailsArr['gender'] == '1'){echo "Male"; } else {echo "Female"; } ?></option>
<option value="1" >Male</option>
<option value="2" >Female</option>

		</select>
		</div> 
		</li>	
		<li id="li_11" >
		<label class="description" for="element_11">Marital Status </label>
		<div>
		<select class="element select medium" id="element_11" required name="marital_status"> 
			<option value="<?php echo $getEmployeeDetailsArr['maritalStatus']; ?>" selected="selected"><?php 	if($getEmployeeDetailsArr['maritalStatus']== '1' ){ echo "Single";} else { echo "Married"; } ?></option>
<option value="1" >Single</option>
<option value="2" >Married</option>

		</select>
		</div> 
		</li>	
		<li id="li_4" >
		<label class="description" for="element_4">Father Name</label>
		<div>
			<input id="resiNum" name="father_name" class="element text medium" type="text" value="<?php echo $getEmployeeDetailsArr['father_name']; ?>"/> 
		</div> 
		</li>
		
		<li id="li_4" >
		<label class="description" for="element_4">Mother Name</label>
		<div>
			<input id="resiNum" name="mother_name" class="element text medium" type="text" value="<?php echo $getEmployeeDetailsArr['mother_name']; ?>"/> 
		</div> 
		</li>
		<li id="li_4" >
		<label class="description" for="element_4">PAN CARD Number</label>
		<div>
			<input id="resiNum" name="PAN_Card" class="element text medium" type="text" value="<?php echo $getEmployeeDetailsArr['PAN_Card']; ?>"/> 
		</div> 
		</li>

		<li id="li_8" >
		<label class="description" for="element_8">Date Of Birth </label>
		<span>
			<input id="element_8_1" name="month" class="element text" size="2" maxlength="2" required value="<?php 	 echo substr($getEmployeeDetailsArr['dob'], 5,2); ?>" type="text"> /
			<label for="element_8_1">MM</label>
		</span>
		<span>
			<input id="element_8_2" name="date" class="element text" size="2" maxlength="2" required value="<?php 	 echo substr($getEmployeeDetailsArr['dob'], 8,2) ?>" type="text"> /
			<label for="element_8_2">DD</label>
		</span>
		<span>
	 		<input id="element_8_3" name="year" class="element text" size="4" maxlength="4" required value="<?php 		echo substr($getEmployeeDetailsArr['dob'], 0,4) ?>" type="text">
			<label for="element_8_3">YYYY</label>
		</span>
	
		<span id="calendar_8">
			<img id="cal_img_8" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_8_3",
			baseField    : "element_8",
			displayArea  : "calendar_8",
			button		 : "cal_img_8",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
			$(function() {
    $('#profile-image').on('click', function() {
        $('#profile-image-upload').click();
    });
});

		</script>
		 
		</li>
			<li class="section_break">
			<h3>Job Details</h3>
			<p></p>
		</li>	
			<li id="li_4" >
		<label class="description" for="element_4">Designation</label>
		<div>

<?php
$jobDesignation1="select * from job_designation where jobID = '$getEmployeeDetailsArr[designation]'";
$getJobDesignation1=mysql_query($jobDesignation1);
$jobDesignationArr1=mysql_fetch_array($getJobDesignation1)

?>		
		
<select name="designation" required onchange="team(this.value)">
<option value="">--Select--</option>
<option value="<?php echo $jobDesignationArr1['jobID']; ?>" selected><?php echo $jobDesignationArr1['jobDesignation']; ?></option>
<?php 
$jobDesignation="select * from job_designation";
$getJobDesignation=mysql_query($jobDesignation);
while($jobDesignationArr=mysql_fetch_array($getJobDesignation))
{?>
<option value="<?php echo $jobDesignationArr['jobID'];?>"><?php echo $jobDesignationArr['jobDesignation'];?></option>
<?php } ?>
</select>
		</div> 
		</li>		
			<li id="li_4" >
		<label class="description" for="element_4">UserRole</label>
		<div>
		
<?php
$jobRole1="select * from job_role where isActive='1' and roleID = '$getEmployeeDetailsArr[userRole]'";
$getJobRole1=mysql_query($jobRole1);
$jobRoleArr1=mysql_fetch_array($getJobRole1);
?>		
		
<select name="userRole" required>
<option value="">--Select--</option>
<option value="<?php echo $jobRoleArr1['roleID']; ?>" selected><?php echo $jobRoleArr1['roleName']; ?></option>
<?php 
$jobRole="select * from job_role where isActive='1'";
$getJobRole=mysql_query($jobRole);
while($jobRoleArr=mysql_fetch_array($getJobRole))
{?>
<option value="<?php echo $jobRoleArr['roleID'];?>"><?php echo $jobRoleArr['roleName'];?></option>
<?php } ?>

</select>		</div> 
		</li>		
<li id="teamLead" style="display:none;margin-left:10px" >
<label class="description" for="element_4" style="margin-left:10px;">Team Lead</label>
<div>
<select name="teamLead" style="margin-left:10px;">
<option value="">--Select Team--</option>
<?php 
$allReviewer1="select  * from webadmin where (userRole = 1 or userRole = 2) and status = 1";
$getAllReviewer1=mysql_query($allReviewer1);
while($reviewerArr1=mysql_fetch_array($getAllReviewer1)){?>
	<option value="<?php echo $reviewerArr1['adminID'];?>"><?php echo $reviewerArr1['name'];?></option>
<?php } ?>
</select>	
</div> 

		</li>	
				<li id="li_2" >
		<label class="description" for="element_2">Date OF Joining </label>
		<?php $joinMonth= substr($getEmployeeDetailsArr['join_date'], 5,2);
		$joinDate= substr($getEmployeeDetailsArr['join_date'], 8,2); 
		$joinYear= substr($getEmployeeDetailsArr['join_date'], 0,4);
		?>
		<span>
			<input id="element_2_1" name="joining_mm" class="element text" size="2" required maxlength="2" value="<?php echo $joinMonth; ?>" type="text"> /
			<label for="element_2_1">MM</label>
		</span>
		<span>
			<input id="element_2_2" name="joining_dd" class="element text" size="2" required maxlength="2" value="<?php  echo $joinDate; ?>" type="text"> /
			<label for="element_2_2">DD</label>
		</span>
		<span>
	 		<input id="element_2_3" name="joining_yy" class="element text" size="4" required maxlength="4" value="<?php  echo $joinYear; ?>" type="text">
			<label for="element_2_3">YYYY</label>
		</span>
	
		<span id="calendar_2">
			<img id="cal_img_2" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_2_3",
			baseField    : "element_2",
			displayArea  : "calendar_2",
			button		 : "cal_img_2",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>
		
			<li id="li_4" >
		<label class="description" for="element_4">Total Experience (At the time of Joining) </label>
		<div>
			<input id="element_4" name="experience" class="element text medium" type="text" maxlength="255" required value="<?php echo $getEmployeeDetailsArr['experience']; ?>"/> (Use 0(ZERO) for Freshers)
		</div> 
		</li>		
			</li>		
			<li class="section_break">
			<h3>Contact Details</h3>
			<p></p>
		</li>	
				<li id="li_1" >
		<label class="description" for="element_1">Address </label>
		
<span>
					<label for="element_1_1">Corresponcence Address</label>
			<textarea id="element_1_1" name="correspondenceAddress" class="element text large"  rows="2" cols="50" required ><?php echo $getEmployeeDetailsArr['correspondenceAddress']; ?></textarea>
		</span>
	
		<span>
					<label for="element_1_2">Permanent Address</label>
			<textarea id="element_1_2" name="permanentAddress" class="element text large"  rows="2" cols="50" ><?php echo $getEmployeeDetailsArr['permanentAddress']; ?></textarea>
		</span>
		<div class="left">
	<li id="li_2" >
		<label class="description" for="element_2">Contact Number  </label>
		<span>
		<label>Personal Number</label>
			<input id="element_2_1" name="mobileNum" class="element text" size="10" maxlength="10"  value="<?php echo $getEmployeeDetailsArr['mobileNum']; ?>" type="text" required> 	
		</span>
		<label class="description" for="element_3"></label>
			<span>
					<label>Secondary Number</label>

			<input id="secNum" name="secNum" class="element text" size="10" maxlength="10"  value="<?php echo $getEmployeeDetailsArr['secNum']; ?>" type="text">
		</span>
			<label class="description" for="element_3"></label>
			<span>
					<label>Emergency Number</label>

			<input id="emergencyNum" name="emergencyNum" class="element text" size="10" maxlength="10"  value="<?php echo $getEmployeeDetailsArr['emergencyNum']; ?>" type="text" required>
		</span>
		 
		</li>	
		
	<li id="li_4" >
		<label class="description" for="element_4">Work Email </label>
		<div>
			<input id="resiNum" name="workEmail" class="element text medium" type="email" maxlength="255"   value="<?php echo $getEmployeeDetailsArr['email']; ?>"/> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Other Email </label>
		<div>
			<input id="element_5" name="otherEmail" class="element text medium" type="email" maxlength="255" required value="<?php echo $getEmployeeDetailsArr['other_email']; ?>"/> 
		</div> 
		</li>
			<!--	<li id="li_5" >

		<label class="description" for="element_5">Password </label>

		<div>

			<input id="password" name="password" class="element text medium" type="password" maxlength="255" required value="<?php echo base64_decode($getEmployeeDetailsArr['password']); ?>"/> 

		</div> 

		</li>
			<li id="li_5" >

		<label class="description" for="element_5">Confirm Password </label>

		<div>

			<input id="confirmPassword" name="confirmPassword" class="element text medium" type="password" maxlength="255" required value='<?php echo base64_decode($getEmployeeDetailsArr['password']); ?>' /> 

		</div> 

		</li>-->
		
		<div class="profilePic">
			<style>
		
#profile-image {
    cursor: pointer;
	background:url("profileImages/<?php 	echo $getEmployeeDetailsArr['photograph']; ?>") no-repeat 0 0;
	background-size: 100% auto;
 	width: 151px;
    height: 151px;
}
.hidden{
  position: absolute;
    left: -9999px;
	}
</style>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script type="text/javascript">
$(function() {
   $("#uploadFile1").on("change", function()
   {
       var files = !!this.files ? this.files : [];
       if (!files.length || !window.FileReader) return; 

       if (/^image/.test( files[0].type)){ 
           var reader = new FileReader(); 
           reader.readAsDataURL(files[0]); 

           reader.onloadend = function(){ 
               $("#profile-image").css("background-image", "url("+this.result+")");
           }
       }
   });
});
</script>
		
<div id="profile-image">		</div>
<input  id="uploadFile1"  name="image" value="" type="file">
		<input type="hidden" name="profileImage" value="<?php echo $getEmployeeDetailsArr['photograph']; ?>">
</div>
		<li class="section_break">
			<h3>Salary Details</h3>
			<p></p>
		</li>		</ul><ul  class="salary_details">
			<li id="li_2" >
		<label class="description" for="element_2">Salary Offered </label>
		<div>
			<input id="salaryOffered" name="salaryOffered" class="element text medium" type="text" maxlength="255" required value='<?php echo $getEmployeeDetailsArr['gross_amount']; ?>'/> 
		</div> 
		</li>	
			<li id="li_2" >
		<label class="description" for="element_2">Basic </label>
			<script>
			function getSalaryPartition()
			{
				var basic= document.getElementById("basic").value;
				var salaryOffered=document.getElementById("salaryOffered").value;
				var hra=basic/2;
				document.getElementById("hra").value=hra;
				var conveyance=800;
				document.getElementById("conv_allowance").value=conveyance;
				var medical= 0;
				document.getElementById("med_allowance").value=medical;
				var executive=parseFloat(salaryOffered)-(parseFloat(basic)+parseFloat(hra)+parseFloat(conveyance)+parseFloat(medical));
				document.getElementById("exec_allowance").value=executive;
				var gross=salaryOffered;
				document.getElementById("gross_amt").value=gross;
			}

		function getManualPartition()
		{
			var basic= document.getElementById("basic").value;
				var salaryOffered=document.getElementById("salaryOffered").value;
				var hra=document.getElementById("hra").value;
				var conveyance=document.getElementById("conv_allowance").value;
				var medical= document.getElementById("med_allowance").value;
				var executive=parseFloat(salaryOffered)-(parseFloat(basic)+parseFloat(hra)+parseFloat(conveyance)+parseFloat(medical));
				document.getElementById("exec_allowance").value=executive;
				var gross=salaryOffered;
				document.getElementById("gross_amt").value=gross;
		}
		</script>
		<div>
			<input id="basic" name="basic" class="element text medium" type="text" maxlength="255"                                      value="<?php echo $getEmployeeDetailsArr['basic']; ?>"/>  <input type="button" onclick="getSalaryPartition()" value="Go">
		</div> 
		</li>	
			<li id="li_2" >
	<span>
				<label>HRA</label>
			<input id="hra" name="h_r_a" class="element text" type="text" maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['h_r_a']; ?>" size="10" onkeyup="getManualPartition();"/> 
		</span>
		<span>
					<label>Conveyance Allowance</label>
			<input id="conv_allowance" name="conv_allowance" class="element text" type="text" maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['conveyance_allowance']; ?>"  size="10" onkeyup="getManualPartition()"/> 		
		</span> 
		<span>
					<label>Medical Allowance</label>
			<input id="med_allowance" name="med_allowance" class="element text" type="text" maxlength="10" required value="<?php echo $getEmployeeDetailsArr['medical_allowance']; ?>"  size="10" onkeyup="getManualPartition()"/>
		</span>
		<span>
		<label>Executive Allowance</label>
		<input id="exec_allowance" name="exec_allowance"    class="element text" type="text" maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['executive_allowance']; ?>"  size="10"/> 		
		</span>
		
		<li id="li_2" >
		<label class="description" for="element_2"> Gross Amount </label>
		<div>
			<input id="gross_amt" name="gross_amt" class="element text medium" type="text" maxlength="255" value="<?php 	echo $getEmployeeDetailsArr['gross_amount']; ?>"/> 
		</div> 
		</li>				</ul><ul><li class="section_break">
			<h3>Deposit Details</h3>
			<p></p>
		</li>		

		<li id="li_4" >
		<label class="description" for="element_4">Account Number </label>
		<div>
			<input id="element_4" name="account_number" class="element text medium" type="text" maxlength="255" value="<?php 	echo $getEmployeeDetailsArr['accountNumber']; ?>"/> 
		</div> 
		</li>	<li id="li_8" >
		<label class="description" for="element_8">Name In Bank</label>
		<div>
			<input id="element_4" name="name_in_bank" class="element text medium" type="text" maxlength="255" value="<?php 	echo $getEmployeeDetailsArr['NameInBank']; ?>"/> 

		</div> 
		</li>		
		<li id="li_8" >
		<label class="description" for="element_8">Employee Status </label>
		<div>
		<select class="element select medium" id="element_8" required name="employee_status" onchange="dol(this.value)"> 
		<option value="<?php echo $getEmployeeDetailsArr['status']; ?>" selected="selected"><?php 	 if($getEmployeeDetailsArr['status'] == '1'){echo "Active"; } if($getEmployeeDetailsArr['status'] == '2'){echo "Resigned";}if($getEmployeeDetailsArr['status'] == '3') {echo "Absconded"; } ?></option>
<option value="1" >Active</option>
<option value="2" >Resigned</option>
<option value="3" >Absconded</option>

		</select>
		</div> 
		</li>		
<?php 
if($getEmployeeDetailsArr['status']==2 || $getEmployeeDetailsArr['status']==3){
?>	
<li id="lead">
<?php }else{ ?>
<li id="lead" style="display:none">
<?php } ?>
		<label class="description" for="element_7">Date Of Leaving </label>

		<span>
		
			<!--<input id="element_8_11" name="leaving_month" class="element text" size="2" maxlength="2" required value="" type="text"> -->
			<input type='text' name="date1" id="startdate" value="<?php echo $getEmployeeDetailsArr['DOL']; ?>"  size="40">
			

		</span>



		 

		

		</li>	
		
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="905826" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
	</div>	
	
	
	
	<?php } } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
