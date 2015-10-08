<?php
include("config.php");
$fname=$_POST['fname'];
$image=$_FILES['image']['name'];
 move_uploaded_file($_FILES["image"]["tmp_name"],"profileImages/" .$image);
$profileImage=$_POST['profileImage'];
if($image=='' || $image==null)
{
	$image=$profileImage;
}
$gender=$_POST['gender'];
$marital_status=$_POST['marital_status'];
$father_name=$_POST['father_name'];
$mother_name=$_POST['mother_name'];
$PAN_Card=$_POST['PAN_Card'];
$date_of_birth=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
$employee_status=$_POST['employee_status'];
$empID=$_POST['empID'];
$correspondenceAddress=$_POST['correspondenceAddress'];
$permanentAddress=$_POST['permanentAddress'];
$mobileNum=$_POST['mobileNum'];
$secNum=$_POST['secNum'];
$emergencyNum=$_POST['emergencyNum'];
$workEmail=$_POST['workEmail'];
$otherEmail=$_POST['otherEmail'];
$designation=$_POST['designation'];
$userRole=$_POST['userRole'];
$experience=$_POST['experience'];

 $join_date=$_POST['joining_yy']."-".$_POST['joining_mm']."-".$_POST['joining_dd'];
 $account_number=$_POST['account_number'];
 $name_in_bank=$_POST['name_in_bank'];

$save_details="update webadmin set name='$fname',photograph='$image',gender='$gender',maritalStatus='$marital_status',dob='$date_of_birth',status='$employee_status',experience='$experience',correspondenceAddress='$correspondenceAddress',permanentAddress='$permanentAddress',mobileNum='$mobileNum',secNum='$secNum',emergencyNum='$emergencyNum',email='$workEmail',other_email='$otherEmail',designation='$designation',userRole='$userRole',join_date='$join_date',father_name='$father_name',mother_name='$mother_name',PAN_Card='$PAN_Card'  where empID='$empID'";
$save_details_query=mysql_query($save_details) or die(mysql_error());

$personal_details="update personal_details set name='$fname',photograph='$image',gender='$gender',maritalStatus='$marital_status',dob='$date_of_birth',employee_status='$employee_status',experience='$experience',address1='$correspondenceAddress',address2='$permanentAddress',mobileNum='$mobileNum',secNum='$secNum',emergencyNum='$emergencyNum',work_email='$workEmail',other_email='$otherEmail',designation='$designation',role='$userRole',join_date='$join_date',father_name='$father_name',mother_name='$mother_name',PAN_Card='$PAN_Card'  where empID='$empID'";

$date1 = $_POST['date1'];
if(!empty($date1) || $date1!='NULL'){
$personal_details_dol = "update webadmin set DOL = '$date1' where empID='$empID'";
$result = mysql_query($personal_details_dol);
}

$basic1 = $_POST['basic'];
$h_r_a1 = $_POST['h_r_a'];
$conv_allowance = $_POST['conv_allowance'];
$med_allowance = $_POST['med_allowance'];
$exec_allowance = $_POST['exec_allowance'];
$gross_amt = $_POST['gross_amt'];
$account_number = $_POST['account_number'];
$name_in_bank1 = $_POST['name_in_bank'];

$save_salary="update salary_structure set basic='$basic1',h_r_a='$h_r_a1',conveyance_allowance='$conv_allowance',medical_allowance='$med_allowance',executive_allowance='$exec_allowance',gross_amount='$gross_amt',to_account='$account_number',name_in_bank='$name_in_bank1' where empID='$empID'";

					$to = "soniaprjpt654@gmail.com";
					
					$subject = "Employeee Registration";

					echo $message = "
					<html>
					<body>
					<table cellpadding='10' style='border:1px solid;'>
					<tr><td colspan='2' style='align:center;'><h3>Employee Registration Information</h3></td></tr>
					<tr><td style='width:60px;'><strong>Employeee ID</strong></td><td>$empID</td></tr>
					<tr><td><strong>Name</strong></td><td>$fname</td><tr>
					<tr><td><strong>Personal Details</strong></td><td>$personal_details</td></tr>
					<tr><td><strong>Salary Structure</strong></td><td>$save_salary</td></tr>
					</table>
					</body>
					</html>
					";
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					$headers .= 'From: The WebPlant Pvt. Ltd. <webplantapp@gmail.com>' . "\r\n";

					mail($to,$subject,$message,$headers);
//$save_salary_query=mysql_query($save_salary) or die(mysql_error());

/*$date = date('Y-m-d');
$salary = "select * from salary_structure where empID='$adminID'";
$resultsalary = mysql_query($salary);
$rowsalary = mysql_fetch_array($resultsalary);
if($rowsalary['gross_amount']!=$gross_amt){			
$salID = $rowsalary['salID'];
$empID = $rowsalary['empID'];
$basic = $rowsalary['basic'];
$h_r_a = $rowsalary['h_r_a'];
$conveyance_allowance = $rowsalary['conveyance_allowance'];
$medical_allowance = $rowsalary['medical_allowance'];
$executive_allowance = $rowsalary['executive_allowance'];
$gross_amount = $rowsalary['gross_amount'];
$to_account = $rowsalary['to_account'];
$name_in_bank = $rowsalary['name_in_bank'];
$salaryHistory = "insert into salary_history (salID,empID,basic,h_r_a,conveyance_allowance,medical_allowance,executive_allowance,gross_amount,to_account,name_in_bank,updatedSalary,updatedOn)values( '$salID','$empID','$basic','$h_r_a','$conveyance_allowance','$medical_allowance','$executive_allowance','$gross_amount','$to_account','$name_in_bank','$gross_amt','$date')";
$resultsalaryHistory = mysql_query($salaryHistory);
}*/


if($save_details_query or $save_salary_query){
header("location:editUser.php?msg=success&empID=$empID");
}else{
header("location:editEmployee.php?msg=failed&&empID=$empID");
}


?>