<?php
		session_start();

		if(!isset($_SESSION['loggedIn'])){

		echo "<script>location.href='index.php';</script>";
		}

		if(($_SESSION['userRole']==1 && $_SESSION['status']==1 || ($_SESSION['userRole']==2 && $_SESSION['status']==1)) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}
include("config.php");

?>
<?php

$getEmployeeDetails="select * from webadmin where adminID='".$_SESSION['adminID']."'";
$emoloyeeDetailsQuery=mysql_query($getEmployeeDetails) or die(mysql_error());
$getEmployeeDetailsArr=mysql_fetch_array($emoloyeeDetailsQuery);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Personal Informations</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
</head>
<body>
<br/>
<br/>
<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container">
<!--<div style="border:1px solid #000;" id="personal">-->
	
		<form id="register" class="appnitro" enctype="multipart/form-data" method="post" autocomplete="off" action="submitEditUser.php" width="50%" align="center">
					<!--<div class="form_description">-->
			<div class="heading" style="background: none repeat scroll 0 0 #9bbb59;border-bottom-color: #ffffff; color: #ffffff; font-size: 20px; padding: 15px;text-align: center;">
			<h2><a href="personalInfo.php?empID=<?php echo $getEmployeeDetailsArr['empID']; ?>">Personal Details</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="personalDocs.php?empID=<?php echo $getEmployeeDetailsArr['empID']; ?>">Documents</a></h2>
			</div>	
			<br/>
			<h2 style="font-size:20px;" align="center"><?php 	echo $getEmployeeDetailsArr['name']."(".$getEmployeeDetailsArr['empID']." )"; ?></h2>
			
						
		
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
			<input id="element_1_1" name= "fname" readonly class="element text" maxlength="255" size="30" required value="<?php 	echo $getEmployeeDetailsArr['name']; ?>"/>
			
		</span>
	
		
		</li>		
		<li id="li_9" >
		<label class="description" for="element_9">Gender </label>
		<div>
		<select class="element select medium" id="element_9" required name="gender" disabled> 
<option value="1" <?php if($getEmployeeDetailsArr['gender']==1){ echo 'selected="selected"';}?> >Male</option>
<option value="2" <?php if($getEmployeeDetailsArr['gender']==2){ echo 'selected="selected"';}?>>Female</option>

		</select>
		</div> 
		</li>	
		<li id="li_11" >
		<label class="description" for="element_11">Marital Status </label>
		<div>
		<select class="element select medium" id="element_11" required name="marital_status" disabled> 
		<option value="1" <?php if($getEmployeeDetailsArr['maritalStatus']==1){ echo 'selected="selected"';}?> >Single</option>
		<option value="2" <?php if($getEmployeeDetailsArr['maritalStatus']==2){ echo 'selected="selected"';}?>>Married</option>

		</select>
		</div> 
		</li>	
		<li id="li_4" >
		<label class="description" for="element_4">Father Name</label>
		<div>
			<input id="resiNum" name="father_name" class="element text medium" type="text" readonly value="<?php echo $getEmployeeDetailsArr['father_name']; ?>"/> 
		</div> 
		</li>
		
		<li id="li_4" >
		<label class="description" for="element_4">Mother Name</label>
		<div>
			<input id="resiNum" name="mother_name" readonly class="element text medium" type="text" value="<?php echo $getEmployeeDetailsArr['mother_name']; ?>"/> 
		</div> 
		</li>
		<li id="li_4" >
		<label class="description" for="element_4">PAN CARD Number</label>
		<div>
			<input id="resiNum" name="PAN_Card" class="element text medium" type="text" readonly value="<?php echo $getEmployeeDetailsArr['PAN_Card']; ?>"/> 
		</div> 
		</li>

		<li id="li_8" >
		<label class="description" for="element_8">Date Of Birth </label>
		<span>
			<input id="element_8_1" name="month" class="element text" size="2" maxlength="2" required value="<?php 	 echo substr($getEmployeeDetailsArr['dob'], 5,2); ?>" type="text" readonly> /
			<label for="element_8_1">MM</label>
		</span>
		<span>
			<input id="element_8_2" name="date" class="element text" size="2" maxlength="2" required value="<?php 	 echo substr($getEmployeeDetailsArr['dob'], 8,2) ?>" type="text" readonly> /
			<label for="element_8_2">DD</label>
		</span>
		<span>
	 		<input id="element_8_3" name="year" class="element text" size="4" maxlength="4" required value="<?php 		echo substr($getEmployeeDetailsArr['dob'], 0,4) ?>" type="text" readonly>
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

		<label class="description" for="element_4">Employee Type</label>

		<div>

<select name="employeeType" required disabled>

<?php ?>



<!--<option value="">--Select--</option>-->

<?php 

$employeeType="select * from employeeType";

$getemployeeType=mysql_query($employeeType);

while($employeeTypeArr=mysql_fetch_array($getemployeeType))

{?>

<option value="<?php echo $employeeTypeArr['empTypeID'];?>" <?php if($getEmployeeDetailsArr['employeeType']==$employeeTypeArr['empTypeID']){ echo 'selected="selected"'; } ?>><?php echo $employeeTypeArr['empType'];?></option>

<?php } ?>

</select>

		</div> 

		</li>			
			<li id="li_4" >
		<label class="description" for="element_4" disabled>Designation</label>
		<div>

<?php
$jobDesignation1="select * from job_designation where jobID = '$getEmployeeDetailsArr[designation]'";
$getJobDesignation1=mysql_query($jobDesignation1);
$jobDesignationArr1=mysql_fetch_array($getJobDesignation1)

?>		
		
<select name="designation" required onchange="team(this.value)" disabled>
<option value="">--Select--</option>
<!--<option value="<?php echo $jobDesignationArr1['jobID']; ?>" selected><?php echo $jobDesignationArr1['jobDesignation']; ?></option>-->
<?php 
$jobDesignation="select * from job_designation";
$getJobDesignation=mysql_query($jobDesignation);
while($jobDesignationArr=mysql_fetch_array($getJobDesignation))
{?>
<option value="<?php echo $jobDesignationArr['jobID'];?>" <?php if($jobDesignationArr1['jobID']==$jobDesignationArr['jobID']) echo 'selected="selected"'; ?>><?php echo $jobDesignationArr['jobDesignation'];?></option>
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
		
<select name="userRole" required disabled>
<option value="">--Select--</option>
<?php 
$jobRole="select * from job_role where isActive='1'";
$getJobRole=mysql_query($jobRole);
while($jobRoleArr=mysql_fetch_array($getJobRole))
{?>
<option value="<?php echo $jobRoleArr['roleID'];?>" <?php if($jobRoleArr1['roleID']==$jobRoleArr['roleID']){ echo 'selected="selected"'; }?>><?php echo $jobRoleArr['roleName'];?></option>
<?php } ?>

</select>		</div> 
		</li>
<?php
$lead = $getEmployeeDetailsArr['teamLead'];
if(!empty($lead)){
?>		
<li id="teamLead" style="margin-left:-5px">	
<?php }else{ ?>	
<li id="teamLead" style="display:none;margin-left:10px" >
<?php } ?>
<label class="description" for="element_4" style="margin-left:10px;">Team Lead</label>
<div>
<?php 
$getTeam="select  * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3) and empID = '".$_GET['empID']."'";
$resultTeam=mysql_query($getTeam) or die(mysql_error());
$fetchTeam=mysql_fetch_array($resultTeam) ;
//$teamName="select * from webadmin where adminID = '$fetchTeam[teamLead]'";
//$getTeamName=mysql_query($teamName);
//$teamNameArr=mysql_fetch_array($getTeamName);
?>
<select name="teamLead" style="margin-left:10px;">
<option value="">--Select Team--</option>
<!--<option value="<?php echo $teamNameArr['adminID'];?>" selected><?php echo $teamNameArr['name']; ?></option>-->
<?php 
$allReviewer1="select  * from webadmin where (userRole = 1 or userRole = 2) and status = 1";
$getAllReviewer1=mysql_query($allReviewer1);
while($reviewerArr1=mysql_fetch_array($getAllReviewer1)){?>
	<option value="<?php echo $reviewerArr1['adminID'];?>" <?php if($reviewerArr1['adminID']==$fetchTeam['teamLead']){echo 'selected="selected"';} ?>><?php echo $reviewerArr1['name'];?></option>
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
			<input id="element_2_1" name="joining_mm" class="element text" size="2" required maxlength="2" readonly value="<?php echo $joinMonth; ?>" type="text"> /
			<label for="element_2_1">MM</label>
		</span>
		<span>
			<input id="element_2_2" name="joining_dd" class="element text" size="2" required maxlength="2" readonly value="<?php  echo $joinDate; ?>" type="text"> /
			<label for="element_2_2">DD</label>
		</span>
		<span>
	 		<input id="element_2_3" name="joining_yy" class="element text" size="4" required maxlength="4" readonly value="<?php  echo $joinYear; ?>" type="text">
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
			<input id="element_4" name="experience" class="element text medium" type="text" readonly maxlength="255"  value="<?php echo $getEmployeeDetailsArr['experience']; ?>"/> (Use 0(ZERO) for Freshers)
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
			<textarea id="element_1_1" name="correspondenceAddress" class="element text large"  rows="2" cols="50" readonly><?php echo $getEmployeeDetailsArr['correspondenceAddress']; ?></textarea>
		</span>
	
		<span>
					<label for="element_1_2">Permanent Address</label>
			<textarea id="element_1_2" name="permanentAddress" class="element text large"  rows="2" cols="50" readonly><?php echo $getEmployeeDetailsArr['permanentAddress']; ?></textarea>
		</span>
		<div class="left">
	<li id="li_2" >
		<label class="description" for="element_2">Contact Number  </label>
		<span>
		<label>Personal Number</label>
			<input id="element_2_1" name="mobileNum" class="element text" size="10" maxlength="10"  value="<?php echo $getEmployeeDetailsArr['mobileNum']; ?>" type="text" readonly > 	
		</span>
		<label class="description" for="element_3"></label>
			<span>
					<label>Secondary Number</label>

			<input id="secNum" name="secNum" class="element text" size="10" maxlength="10"  value="<?php echo $getEmployeeDetailsArr['secNum']; ?>" type="text" readonly>
		</span>
			<label class="description" for="element_3"></label>
			<span>
					<label>Emergency Number</label>

			<input id="emergencyNum" name="emergencyNum" class="element text" size="10" maxlength="10"  value="<?php echo $getEmployeeDetailsArr['emergencyNum']; ?>" type="text" readonly>
		</span>
		 
		</li>	
		
	<li id="li_4" >
		<label class="description" for="element_4">Work Email </label>
		<div>
			<input id="resiNum" name="workEmail" class="element text medium" type="email" maxlength="255" readonly  value="<?php echo $getEmployeeDetailsArr['email']; ?>"/> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Other Email </label>
		<div>
			<input id="element_5" name="otherEmail" class="element text medium" type="email" maxlength="255" readonly value="<?php echo $getEmployeeDetailsArr['other_email']; ?>"/> 
		</div> 
		</li>
			
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
<!--<input  id="uploadFile1"  name="image" value="" type="file">-->
		<input type="hidden" name="profileImage" value="<?php echo $getEmployeeDetailsArr['photograph']; ?>">
</div>
		<li class="section_break">
			<h3>Salary Details</h3>
			<p></p>
		</li>		</ul><ul  class="salary_details">
			<li id="li_2" >
		<label class="description" for="element_2">Salary Offered </label>
		<div>
			<input id="salaryOffered" name="salaryOffered" class="element text medium" type="text" readonly maxlength="255" required value='<?php echo $getEmployeeDetailsArr['gross_amount']; ?>'/> 
		</div> 
		</li>	
			<li id="li_2" >
		<label class="description" for="element_2">Basic </label>
		
		<div>
			<input id="basic" name="basic" class="element text medium" type="text" readonly maxlength="255"                                      value="<?php echo $getEmployeeDetailsArr['basic']; ?>"/>  
		</div> 
		</li>	
			<li id="li_2" >
	<span>
				<label>HRA</label>
			<input id="hra" name="h_r_a" class="element text" type="text" readonly maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['h_r_a']; ?>" size="10" /> 
		</span>
		<span>
				<label>PF</label>
			<input id="pf" name="p_f" class="element text" type="text" readonly maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['h_r_a']; ?>" size="10" /> 
		</span>
		<span>
				<label>ESI</label>
			<input id="esi" name="e_s_i" class="element text" type="text" readonly maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['h_r_a']; ?>" size="10" /> 
		</span>
		
		<span>
					<label>Conveyance Allowance</label>
			<input id="conv_allowance" name="conv_allowance" class="element text" type="text" readonly maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['conveyance_allowance']; ?>"  size="10" /> 		
		</span> 
		<span>
					<label>Medical Allowance</label>
			<input id="med_allowance" name="med_allowance" class="element text" type="text" readonly maxlength="10" required value="<?php echo $getEmployeeDetailsArr['medical_allowance']; ?>"  size="10" />
		</span>
		<span>
		<label>Executive Allowance</label>
		<input id="exec_allowance" name="exec_allowance"    class="element text" type="text" readonly maxlength="10" required value="<?php 	echo $getEmployeeDetailsArr['executive_allowance']; ?>"  size="10"/> 		
		</span>
		
		<li id="li_2" >
		<label class="description" for="element_2"> Gross Amount </label>
		<div>
			<input id="gross_amt" name="gross_amt" class="element text medium" type="text" readonly maxlength="255" value="<?php 	echo $getEmployeeDetailsArr['gross_amount']; ?>"/> 
		</div> 
		</li>				</ul><ul><li class="section_break">
			<h3>Deposit Details</h3>
			<p></p>
		</li>		

		<li id="li_4" >
		<label class="description" for="element_4">Account Number </label>
		<div>
			<input id="element_4" name="account_number" class="element text medium" type="text" readonly maxlength="255" value="<?php 	echo $getEmployeeDetailsArr['to_account']; ?>"/> 
		</div> 
		</li>	<li id="li_8" >
		<label class="description" for="element_8">Name In Bank</label>
		<div>
			<input id="element_4" name="name_in_bank" class="element text medium" type="text" readonly maxlength="255" value="<?php 	echo $getEmployeeDetailsArr['name_in_bank']; ?>"/> 

		</div> 
		</li>		
		<li id="li_8" >
		<label class="description" for="element_8">Employee Status </label>
		<div>
		<select class="element select medium" id="element_8" required name="employee_status" onchange="dol(this.value)" disabled> 
		<!--<option value="<?php echo $getEmployeeDetailsArr['status']; ?>" selected="selected"><?php 	 if($getEmployeeDetailsArr['status'] == '1'){echo "Active"; } if($getEmployeeDetailsArr['status'] == '2'){echo "Resigned";}if($getEmployeeDetailsArr['status'] == '3') {echo "Absconded"; } ?></option>-->
<option value="1" <?php if($getEmployeeDetailsArr['status']==1) echo 'selected="selected"'; ?> >Active</option>
<option value="2" <?php if($getEmployeeDetailsArr['status']==2) echo 'selected="selected"'; ?> >Resigned</option>
<option value="3" <?php if($getEmployeeDetailsArr['status']==3) echo 'selected="selected"'; ?> >Absconded</option>
</select>
		</div> 
		</li>		


		<?php 
if($getEmployeeDetailsArr['status']==2 || $getEmployeeDetailsArr['status']==3){
?>	
<li id="li_2" class="leadd">
<?php }else{ ?>
<li id="li_2" class="leadd">
<?php } ?>	
			
		<label class="description" for="element_3">Date OF Leaving </label>
		<?php $joinMonth= substr($getEmployeeDetailsArr['DOL'], 5,2);
		$joinDate= substr($getEmployeeDetailsArr['DOL'], 8,2); 
		$joinYear= substr($getEmployeeDetailsArr['DOL'], 0,4);
		?>
		<span>
			<input id="element_3_1" name="leaving_mm" class="element text" size="2" readonly required maxlength="2" value="<?php echo $joinMonth; ?>" type="text"> /
			<label for="element_3_1">MM</label>
		</span>
		<span>
			<input id="element_3_2" name="leaving_dd" class="element text" size="2" readonly required maxlength="2" value="<?php  echo $joinDate; ?>" type="text"> /
			<label for="element_3_2">DD</label>
		</span>
		<span>
	 		<input id="element_3_3" name="leaving_yy" class="element text" size="4" readonly required maxlength="4" value="<?php  echo $joinYear; ?>" type="text">
			<label for="element_3_3">YYYY</label>
		</span>
	
		<span id="calendar_3">
			<img id="cal_img_3" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_3_3",
			baseField    : "element_3",
			displayArea  : "calendar_3",
			button		 : "cal_img_3",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>
		
		
		
			
	  </ul>
	</form>	
  </div>	
<!--</div>-->
</div>
</div>


<?php
echo ini_get("session.gc_maxlifetime");

include("Footer.php"); ?>
