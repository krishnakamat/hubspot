<?php
include("config.php");
$name=$_POST['fname'];
$arr = explode(" ",$name);
$count = str_word_count($name);
if($count==3){
$fname = $arr[0];
$mname = $arr[1];
$lname = $arr[2];
}
if($count==2){
$fname = $arr[0];
$lname = $arr[1];
$mname = '';
}
$empID=$_POST['empID'];
$image=$empID."_".$_FILES['image']['name'];
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
$correspondenceAddress=$_POST['correspondenceAddress'];
$permanentAddress=$_POST['permanentAddress'];
$mobileNum=$_POST['mobileNum'];
$secNum=$_POST['secNum'];
$emergencyNum=$_POST['emergencyNum'];
$workEmail=$_POST['workEmail'];
$otherEmail=$_POST['otherEmail'];
$employeeType=$_POST['employeeType'];
$designation=$_POST['designation'];
$userRole=$_POST['userRole'];
$teamLead=$_POST['teamLead'];
$experience=$_POST['experience'];

 $join_date=$_POST['joining_yy']."-".$_POST['joining_mm']."-".$_POST['joining_dd'];
 $leaving_date=$_POST['leaving_yy']."-".$_POST['leaving_mm']."-".$_POST['leaving_dd'];
 $account_number=$_POST['account_number'];
 $pf_account_number=$_POST['pf_account_number'];
 $name_in_bank=$_POST['name_in_bank'];

$save_details="update webadmin set name='$name',photograph='$image',gender='$gender',maritalStatus='$marital_status',dob='$date_of_birth',
status='$employee_status',experience='$experience',correspondenceAddress='$correspondenceAddress',permanentAddress='$permanentAddress',
mobileNum='$mobileNum',secNum='$secNum',emergencyNum='$emergencyNum',email='$workEmail',teamLead='$teamLead',other_email='$otherEmail',
employeeType='$employeeType',designation='$designation',userRole='$userRole',join_date='$join_date',father_name='$father_name',
mother_name='$mother_name',PAN_Card='$PAN_Card',to_account='$account_number',pf_account_number='$pf_account_number',name_in_bank='$name_in_bank',
DOL='$leaving_date'  where empID='$empID'";
$save_details_query=mysql_query($save_details) or die(mysql_error());

$personal_details="update personal_details set firstName='$fname',midName='$mname',lastName='$lname',photograph='$image',gender='$gender',
maritalStatus='$marital_status',dob='$date_of_birth',employee_status='$employee_status',experience='$experience',address1='$correspondenceAddress',
address2='$permanentAddress',mobileNum='$mobileNum',secNum='$secNum',emergencyNum='$emergencyNum',work_email='$workEmail',other_email='$otherEmail',
employeeType='$employeeType',designation='$designation',role='$userRole',join_date='$join_date',father_name='$father_name',mother_name='$mother_name',
PAN_Card='$PAN_Card',to_account='$account_number',pf_account_number='$pf_account_number',name_in_bank='$name_in_bank',DOL='$leaving_date'
 where empID='$empID'";


//$to_account = $rowsalary['to_account'];
//$name_in_bank = $rowsalary['name_in_bank'];
/*$gross_amt=$_POST['gross_amt'];
if($rowsalary['gross_amount']!=$gross_amt){			
$salaryHistory = "insert into salary_history(salID,empID,basic,h_r_a,conveyance_allowance,medical_allowance,executive_allowance,employeePF,employerPF,ESI,gross_amount,updatedSalary,updatedOn)values((select salID,empID,basic,h_r_a,conveyance_allowance,medical_allowance,executive_allowance,employeePF,employerPF,ESI,gross_amount from salary_structure where empID='$empID'),'$gross_amt','$date')";
}else{
$salaryHistory = "No Change!";
}*/

if(!empty($_POST['salaryOffered']) && $_POST['salaryOffered']!=0){
$date = date('Y-m-d');
/*$salary = "select * from salary_structure where empID='$empID'";
$resultsalary = mysql_query($salary);
$rowsalary = mysql_fetch_array($resultsalary);
$salID = $rowsalary['salID'];
//$empID = $rowsalary['empID'];
$basic = $rowsalary['basic'];
$h_r_a = $rowsalary['h_r_a'];
$conveyance_allowance = $rowsalary['conveyance_allowance'];
$medical_allowance = $rowsalary['medical_allowance'];
$executive_allowance = $rowsalary['executive_allowance'];
$employeePF = $rowsalary['employeePF'];
$employerPF = $rowsalary['employerPF'];
$ESI = $rowsalary['ESI'];
$gross_amount = $rowsalary['gross_amount'];	*/

$basic1=$_POST['basic'];
$h_r_a1=$_POST['h_r_a'];
$p_f1 = $_POST['p_f'];
$e_s_i = $_POST['e_s_i'];
$conv_allowance=$_POST['conv_allowance'];
$med_allowance=$_POST['med_allowance'];
$exec_allowance=$_POST['exec_allowance'];
$gross_amt=$_POST['gross_amt'];	

$salaryHistory = "insert into salary_history(salID,empID,basic,h_r_a,conveyance_allowance,medical_allowance,executive_allowance,employeePF,employerPF,ESI,gross_amount)select salID,empID,basic,h_r_a,conveyance_allowance,medical_allowance,executive_allowance,employeePF,employerPF,ESI,gross_amount from salary_structure where empID='$empID'";

	
$save_salary="update salary_structure set basic='$basic1',h_r_a='$h_r_a1',conveyance_allowance='$conv_allowance',medical_allowance='$med_allowance',executive_allowance='$exec_allowance',employeePF='$p_f1',employerPF='$p_f1',ESI='$e_s_i',gross_amount='$gross_amt' where empID='$empID'";


}else{
$save_salary="No Change!";
$salaryHistory="No Change!";
}




					$to = "deepti@thewebplant.com";
					
					$subject = "Employeee Updation";

					$message = "
					<html>
					<body>
					<table cellpadding='10' style='border:1px solid;'>
					<tr><td colspan='2' style='align:center;'><h3>Employee Updation Information</h3></td></tr>
					<tr><td style='width:60px;'><strong>Employeee ID</strong></td><td>$empID</td></tr>
					<tr><td><strong>Name</strong></td><td>$name</td><tr>
					<tr><td><strong>Personal Details</strong></td><td>$personal_details</td></tr>
					<tr><td><strong>Salary History</strong></td><td>$salaryHistory</td></tr>
					<tr><td><strong>Salary Structure</strong></td><td>$save_salary</td></tr>
					</table>
					</body>
					</html>
					";
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					$headers .= 'From: The WebPlant Pvt. Ltd. <webplantapp@gmail.com>' . "\r\n";

					$mail = mail($to,$subject,$message,$headers);



if($mail){
header("location:editUser.php?msg=success&empID=$empID");
}else{
header("location:editEmployee.php?msg=failed&&empID=$empID");
}


?>