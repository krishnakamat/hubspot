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
		}

include("config.php");
?>
<style>


.loginReport  table{
width:100%;
}
.loginReport{
	float: left;
    margin: 0 5px;
	padding-left:20px;
	padding-top:20px;
}
.Reportwrapper p {
  background: none repeat scroll 0 0 #9bbb59;
  border-color: #000;
  border-style: solid;
  border-width: 1px 1px 0 ;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  margin: 0;
  padding: 5px;
  text-align: center;
  text-transform: capitalize;
}
.users {
  background: none repeat scroll 0 0 #dfebc7;
  color: green;
  font: 14px Trebuchet MS;
  margin: 1px;
  padding: 8px 10px;
}
.users td{
	padding:10px 7px;
	line-height:30px;
}
.users th {
 font-weight: bold;
 padding: 10px 7px;
 line-height:10px;
}
.users input{
padding:7px 7px;
line-height:10px;
}
</style>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>


<script>
function getUser(role)
	{
		if(role==1 || role==2 || role==3)
		{
			document.getElementById("lead").style.display="table-row";
		
		}
		else {
	
			document.getElementById("lead").style.display="none";
		
		}

	}
	</script>
	<link rel="stylesheet" type="text/css" href="view.css" media="all">

<script type="text/javascript" src="view.js"></script>

<script type="text/javascript" src="calendar.js"></script>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
<div class="Reportwrapper">
	<div class="loginReport">
	
	<p>Add New User</p>
	<form id="register" class="appnitro" enctype="multipart/form-data" method="post" action="insertUser.php">

							

			<ul >

			</li>	
<?php
if($_GET['msg']=='success'){
echo "Information Submitted Successfully!";
}
if($_GET['msg']=='failed'){
echo "Not Submitted!";
}
?>			

				<li class="section_break">

			<h3>Personal Details</h3>

			<p></p>

		</li>	

			

					<li id="li_1" >

		<label class="description" for="element_1">Name </label>

		<span>

			<input id="element_1_1" name= "fname" class="element text" maxlength="255" size="10" required value=""/>

			<label>First</label>

		</span>

		<span>

			<input id="element_1_2" name= "mname" class="element text" maxlength="255" size="10" value=""/>

			<label>Middle</label>

		</span> 

		<span>

			<input id="element_1_2" name= "lname" class="element text" maxlength="255" required size="10" value=""/>

			<label>Last</label>

		</span>

		</li><li id="li_6" >

		<label class="description" for="element_6">Image </label>

		<div>

			<input id="element_6" name="image" class="element file" type="file"/> 

		</div>  

		</li>		<li id="li_9" >

		<label class="description" for="element_9">Gender </label>

		<div>

		<select class="element select medium" id="element_9" required name="gender"> 

			<option value=""  selected="selected">-- Select --</option>

<option value="1" >Male</option>

<option value="2" >Female</option>



		</select>

		</div> 

		</li>			<li id="li_11" >

		<label class="description" for="element_11">Marital Status </label>

		<div>

		<select class="element select medium" id="element_11" required name="marital"> 

			<option value=""  selected="selected">-- Select -- </option>

<option value="1" >Single</option>

<option value="2" >Married</option>



		</select>

		</div> 

		</li>	
			<li id="li_4" >
		<label class="description" for="element_4">Father Name</label>
		<div>
			<input id="resiNum" name="father_name" class="element text medium" type="text" value=""/> 
		</div> 
		</li>
		
		<li id="li_4" >
		<label class="description" for="element_4">Mother Name</label>
		<div>
			<input id="resiNum" name="mother_name" class="element text medium" type="text" value=""/> 
		</div> 
		</li>
		<li id="li_4" >
		<label class="description" for="element_4">PAN CARD Number</label>
		<div>
			<input id="resiNum" name="PAN_Card" class="element text medium" type="text" value=""/> 
		</div> 
		</li>

		<li id="li_8" >

		<label class="description" for="element_8">Date Of Birth </label>

		<span>

			<input id="element_8_1" name="month" class="element text" size="2" maxlength="2" value="" type="text"> /

			<label for="element_8_1">MM</label>

		</span>

		<span>

			<input id="element_8_2" name="date" class="element text" size="2" maxlength="2" value="" type="text"> /

			<label for="element_8_2">DD</label>

		</span>

		<span>

	 		<input id="element_8_3" name="year" class="element text" size="4" maxlength="4" value="" type="text">

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

		</script>

		 

		

		</li>

		<li class="section_break">

			<h3>Job Details</h3>

			<p></p>

		</li>	
		
		<li id="li_4" >

		<label class="description" for="element_4">Employee Type</label>

		<div>

<select name="employeeType" required>

<?php ?>



<!--<option value="">--Select--</option>-->

<?php 

$employeeType="select * from employeeType";

$getemployeeType=mysql_query($employeeType);

while($employeeTypeArr=mysql_fetch_array($getemployeeType))

{?>

<option value="<?php echo $employeeTypeArr['empTypeID'];?>"><?php echo $employeeTypeArr['empType'];?></option>

<?php } ?>

</select>

		</div> 

		</li>	

			<li id="li_4" >

		<label class="description" for="element_4">Designation</label>

		<div>

<select name="designation" required onchange="getUser(this.value)">

<?php ?>



<option value="">--Select--</option>

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

<select name="role" required >

<option value="">--Select--</option>

<?php 

$jobRole="select * from job_role where isActive='1'";

$getJobRole=mysql_query($jobRole);

while($jobRoleArr=mysql_fetch_array($getJobRole))

{?>

<option value="<?php echo $jobRoleArr['roleID'];?>"><?php echo $jobRoleArr['roleName'];?></option>

<?php } ?>



</select>		</div> 

		</li>


<li id="lead" style="display:none;margin-left:500px" >
<label class="description" for="element_4">Team Lead</label>
<div>
<select name="teamLead">
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

		<span>

			<input id="element_2_1" name="join_mm" class="element text" size="2"  required maxlength="2" value="" type="text"> /

			<label for="element_2_1">MM</label>

		</span>

		<span>

			<input id="element_2_2" name="join_dd" class="element text" size="2" required maxlength="2" value="" type="text"> /

			<label for="element_2_2">DD</label>

		</span>

		<span>

	 		<input id="element_2_3" name="join_yy" class="element text" size="4" required maxlength="4" value="" type="text">

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

		<label class="description" for="element_4">Total Experience In Months(At the time of Joining) </label>

		<div>

			<input id="element_4" name="experience" class="element text medium" type="number" maxlength="255" value=""/> (Use 0(ZERO) for Freshres)

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

					<label for="element_1_1">Correspondence Address</label>

			<textarea id="element_1_1" name="correspondenceAddress" class="element text large" rows="3" cols="50" ></textarea>

		</span>



		<span>

					<label for="element_1_2">Permanent Address</label>

			<textarea id="element_1_2" name="permanentAddress" class="element text large"  rows="3" cols="50" ></textarea>

		</span>

		

		<div class="left">

		</li>		<li id="li_2" >

		<label class="description" for="element_2">Contact Number  </label>

		<span>

		<label>Personal Number</label>

			<input id="element_2_1" name="numberPersonal" class="element text" size="12" maxlength="12" pattern="[0-9]{10}" title="Must Be A 10 Digit Number" required  type="text"> 	

		</span>

		<label class="description" for="element_3"></label>

			<span>

					<label>Secondary Number</label>



			<input id="secNum" name="numberSecondary" class="element text" size="12" maxlength="12"   pattern="[0-9]{10}" title="Must Be A 10 Digit Number"  value="" type="text">

		</span>

			<label class="description" for="element_3"></label>

			<span>

					<label>Emergency Number</label>



			<input id="emergencyNum" name="numberEmergency" class="element text" size="12"  pattern="[0-9]{10}" title="Must Be A 10 Digit Number"  maxlength="12"  value="" type="text">

		</span>

		 

		</li>	

		

	<li id="li_4" >

		<label class="description" for="element_4">Work Email </label>

		<div>

			<input id="resiNum" name="email" class="element text medium" type="email" maxlength="255" value=""/> 

		</div> 

		</li>		
		
		<li id="li_5" >

		<label class="description" for="element_5">Other Email </label>

		<div>

			<input id="element_5" name="otherEmail" class="element text medium" type="email" maxlength="255" value=""/> 

		</div> 

		</li>

	
		<span id='message'></span>

		<li class="section_break">

			<h3>Salary Details</h3>

		</li>		

	</ul>	
	<!--
	<div>
    <label for="how-many">How Many? </label>
    <input type="text" id="how-many" class="wheelable" value="1" name="how-many" />
</div>
	
	
	<script>
	document.getElementById("salaryOffered").innerHTML=format()
	</script>-->
	
	
	<script>
	function format2(){
	var numbers = document.getElementById("salaryOffered").value;
    var a = numbers.format();
	document.getElementById("salaryOffered").innerHTML = a;
	
}
	
	</script>
	
	
	
	<ul class="salary_details">

		<li id="li_2" >

		<label class="description" for="element_2">Salary Offered </label>

		<div>

		<input id="salaryOffered" name="salaryOffered" class="element text medium" type="number" maxlength="255" value="" onclick="format2()"/> 

		</div> 

		</li>	

			

			<li id="li_2" >

		<label class="description" for="element_2">Basic </label>

		<div>

		<script>
		function getSalaryPartition() {
			//if (str.length == 0) {
				//document.getElementById("hra").innerHTML = "";
				//  return;
			//} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var a = xmlhttp.responseText;
			var arr = a.split(",");
			var salaryOffered=document.getElementById("salaryOffered").value;
            var hra = document.getElementById("hra").value=arr[2];
            var pf = document.getElementById("pf").value=arr[0];
            var esi = document.getElementById("esi").value=arr[1];
            var conv_allowance = document.getElementById("conv_allowance").value=arr[3];
            var med_allowance = document.getElementById("med_allowance").value=arr[4];
			var executive=parseFloat(salaryOffered)-(parseFloat(basic)+parseFloat(hra)+parseFloat(pf)+parseFloat(esi)+parseFloat(conv_allowance)+parseFloat(med_allowance));
			document.getElementById("exec_allowance").value=executive;
			var gross=salaryOffered;
			document.getElementById("gross_amt").value=gross;
			}
        }
		var basic= document.getElementById("basic").value;
        xmlhttp.open("GET", "getHra.php?basic="+basic, true);
		

        xmlhttp.send();
    //}
}

			/*function getSalaryPartition()

			{

				var basic= document.getElementById("basic").value;

				var salaryOffered=document.getElementById("salaryOffered").value;

				var hra=basic/2;

				document.getElementById("hra").value=hra;
				
				var pf=(basic/100)*12.5;
				
				document.getElementById("pf").value=pf;
				
				var esi=(basic/100)*4.5;
				
				document.getElementById("esi").value=esi;

				var conveyance=800;

				document.getElementById("conv_allowance").value=conveyance;

				var medical= 0;

				document.getElementById("med_allowance").value=medical;

				var executive=parseFloat(salaryOffered)-(parseFloat(basic)+parseFloat(hra)+parseFloat(pf)+parseFloat(esi)+parseFloat(conveyance)+parseFloat(medical));

				document.getElementById("exec_allowance").value=executive;

				var gross=salaryOffered;

				document.getElementById("gross_amt").value=gross;

			}*/



		function getManualPartition()

		{



			var basic= document.getElementById("basic").value;

				var salaryOffered=document.getElementById("salaryOffered").value;

				var hra=document.getElementById("hra").value;
				
				var pf=document.getElementById("pf").value;
				
				var esi=document.getElementById("esi").value;

				var conveyance=document.getElementById("conv_allowance").value;

				var medical= document.getElementById("med_allowance").value;

				var executive=parseFloat(salaryOffered)-(parseFloat(basic)+parseFloat(hra)+parseFloat(pf)+parseFloat(esi)+parseFloat(conveyance)+parseFloat(medical));

				document.getElementById("exec_allowance").value=executive;

				var gross=salaryOffered;

				document.getElementById("gross_amt").value=gross;

			

		}

		</script>

			<input id="basic" name="basic" class="element text" type="text" maxlength="255" value=""/> <input type="button" onclick="getSalaryPartition()" value="Go">



		</div> 

		</li>	

			<li id="li_2" >

	<span>

				<label>HRA</label>

			<input id="hra" name="h_r_a" class="element text" type="text" maxlength="10" value="0" size="10" onkeyup="getManualPartition();"/> 

		</span>
		<span>

				<label>PF</label>

			<input id="pf" name="p_f" class="element text" type="text" maxlength="10" value="0" size="10" onkeyup="getManualPartition();"/> 

		</span>
			<span>

				<label>ESI</label>

			<input id="esi" name="e_s_i" class="element text" type="text" maxlength="10" value="0" size="10" onkeyup="getManualPartition();"/> 

		</span>

		<span>

					<label>Conveyance Allowance</label>

			<input id="conv_allowance" name="conv_allowance" class="element text" type="text" maxlength="10" value="0" size="10" onkeyup="getManualPartition()"/> 		

		</span> 

		<span>

					<label>Medical Allowance</label>

			<input id="med_allowance" name="med_allowance" class="element text" type="text" maxlength="10" value="0"  size="10" onkeyup="getManualPartition()"/>

		</span>

		<span>

		<label>Executive Allowance</label>

		<input id="exec_allowance" name="exec_allowance"    class="element text" type="text" maxlength="10" value="0" size="10"/> 		

		</span>

	

		</li>	

		

		<li id="li_2" >

		<label class="description" for="element_2"> Gross Amount </label>

		<div>

			<input id="gross_amt" name="gross_amt" class="element text medium" type="text" maxlength="255" value=""/> 

		</div> 

		</li>	</ul>	<ul><li class="section_break">

			<h3>Deposit Details</h3>

			<p></p>

		</li>		<li id="li_4" >

		<label class="description" for="element_4">Account Number </label>

		<div>

			<input id="element_4" name="account_number" class="element text medium" type="text" maxlength="255" value=""/> 

		</div> 

		</li>	
		<li id="li_4" >

		<label class="description" for="element_4">PF Account Number </label>

		<div>

			<input id="element_4" name="pf_account_number" class="element text medium" type="text" maxlength="255" value=""/> 

		</div> 

		</li>	
		<li id="li_8" >

		<label class="description" for="element_8">Name In Bank</label>

		<div>

			<input id="element_4" name="name_in_bank" class="element text medium" type="text" maxlength="255" value=""/> 



		</div> 

		</li>		

				



			<li class="buttons">

			    <input type="hidden" name="form_id" value="905826" />

			    

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />

		</li>

			</ul>

		</form>

</div>
	</div>
	


<?php @$msg=$_GET['msg']; 
		if($msg=='emailErr')
	{
			echo "<h3>Sorry Email ID already Exists</h3>";
	}
		if($msg=='Added Successfully')

	{

			echo "<h3>User Added Successfully!</h3>";

	}

?>
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>

