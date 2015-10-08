<?php //ob_start();
		session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
		include("config.php");
		
		$getLastEmpID=mysql_query("SELECT max(empID) maxEmp from webadmin");
		$lastEmpID=mysql_fetch_assoc($getLastEmpID);
		$empID=$lastEmpID['maxEmp']+1;
		
		$name=$_POST['fname']." ".$_POST['mname']." ".$_POST['lname'];
		$fname=$_POST['fname'];
		$mname=$_POST['mname'];
		$lname=$_POST['lname'];
		$image=$empID."_".$_FILES['image']['name'];
		 move_uploaded_file($_FILES["image"]["tmp_name"],"profileImages/" .$image);
		$gender=$_POST['gender'];
		$marital=$_POST['marital'];
		$father_name=$_POST['father_name'];
		$mother_name=$_POST['mother_name'];
		$PAN_Card=$_POST['PAN_Card'];
		$email=$_POST['email'];
		$date_of_birth=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
		$employeeType=$_POST['employeeType'];
		$designation=$_POST['designation'];
		$userRole=$_POST['role'];
		$teamLead=$_POST['teamLead'];
		$join_date=$_POST['join_yy']."-".$_POST['join_mm']."-".$_POST['join_dd'];
		$experience=$_POST['experience'];
		$correspondenceAddress=$_POST['correspondenceAddress'];			
		$permanentAddress=$_POST['permanentAddress'];
		$numberPersonal=$_POST['numberPersonal'];
		$numberSecondary=$_POST['numberSecondary'];
		$numberEmergency=$_POST['numberEmergency'];
		$otherEmail=$_POST['otherEmail'];
		$account_number=$_POST['account_number'];
		$name_in_bank=$_POST['name_in_bank'];
		//number_format($number, 2, '.', '');
		
		$basic=$_POST['basic'];
		$h_r_a=$_POST['h_r_a'];
		$p_f=$_POST['p_f'];
		$e_s_i=$_POST['e_s_i'];
		$conv_allowance=$_POST['conv_allowance'];
		$med_allowance=$_POST['med_allowance'];
		$exec_allowance=$_POST['exec_allowance'];
		$gross_amt=$_POST['gross_amt'];
		
		//$basic=base64_encode($_POST['basic']);
		//$h_r_a=base64_encode($_POST['h_r_a']);
		//$conv_allowance=base64_encode($_POST['conv_allowance']);
		//$med_allowance=base64_encode($_POST['med_allowance']);
		//$exec_allowance=base64_encode($_POST['exec_allowance']);
		//$gross_amt=base64_encode($_POST['gross_amt']);


		


		

		$checkAvailability="SELECT count(email) emails FROM webadmin WHERE email = '$email' ";
		$getAvailability=mysql_query($checkAvailability);
		while($emailArr=mysql_fetch_array($getAvailability))
					
					{
						$availability= $emailArr['emails'];
					}
				if($availability<1)
				{

				$insertOwner="insert into webadmin(empID,name,photograph,gender,maritalStatus,dob,experience,employeeType,designation,join_date,correspondenceAddress,permanentAddress,mobileNum,secNum,emergencyNum,father_name,mother_name,PAN_Card,to_account,name_in_bank,other_email,email,teamLead,userRole)values('$empID','$name','$image','$gender','$marital','$date_of_birth','$experience','$employeeType','$designation','$join_date','$correspondenceAddress','$permanentAddress','$numberPersonal','$numberSecondary','$numberEmergency','$father_name','$mother_name','$PAN_Card','$account_number','$name_in_bank','$otherEmail','$email','$teamLead','$userRole')";
				mysql_query($insertOwner);
				
				$getAdminID="select * from webadmin where email='$email'";
				$resultAdminID=mysql_query($getAdminID);
				$rowAdminID=mysql_fetch_array($resultAdminID);
				$empID=$rowAdminID['empID'];
				$adminID=$rowAdminID['adminID'];
				
				
				$personal_details="insert into personal_details(empID,firstName,midName,lastName,photograph,gender,maritalStatus,dob,experience,employeeType,designation,join_date,address1,address2,mobileNum,secNum,emergencyNum,father_name,mother_name,PAN_Card,to_account,name_in_bank,other_email,work_email,role)values('$empID','$fname','$mname','$lname','$image','$gender','$marital','$date_of_birth','$experience','$employeeType','$designation','$join_date','$correspondenceAddress','$permanentAddress','$numberPersonal','$numberSecondary','$numberEmergency','$father_name','$mother_name','$PAN_Card','$account_number','$name_in_bank','$otherEmail','$email','$userRole')";
					//mysql_query($personal_details);
					
					$insertSalary="insert into salary_structure(empID,basic,h_r_a,conveyance_allowance,medical_allowance,executive_allowance,employeePF,employerPF,ESI,gross_amount)values('$empID','$basic','$h_r_a','$conv_allowance','$med_allowance','$exec_allowance','$p_f','$p_f','$e_s_i','$gross_amt')";
					//mysql_query($insertSalary);

					
					$to = "deepti@thewebplant.com";
					
					$subject = "Employeee Registration";

					$message = "
					<html>
					<body>
					<table cellpadding='10' style='border:1px solid;'>
					<tr><td colspan='2' style='align:center;'><h3>Employee Registration Information</h3></td></tr>
					<tr><td style='width:60px;'><strong>Employeee ID</strong></td><td>$empID</td></tr>
					<tr><td><strong>Name</strong></td><td>$name</td><tr>
					<tr><td><strong>Personal Details</strong></td><td>$personal_details</td></tr>
					<tr><td><strong>Salary Structure</strong></td><td>$insertSalary</td></tr>
					</table>
					</body>
					</html>
					";
					//$from = 'Sender <noreply@sender.com>';
					$from = '<webplantapp@gmail.com>';
                    $headers = "From: " .($from) . "\r\n";
                    $headers .= "Reply-To: ".($from) . "\r\n";
                    $headers .= "Return-Path: ".($from) . "\r\n";
					$headers .= "Organization: Sender Organization\r\n";
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
					$headers .= "X-Priority: 3\r\n";
                    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

					//$headers .= 'From: The WebPlant Pvt. Ltd. <webplantapp@gmail.com>' . "\r\n";

					mail($to,$subject,$message,$headers);
					
					
			$insertEmpLeaveBalance="insert into empleavebalance(empID,accrued,leaveUsed,salaryAdjustment)values('$adminID',0.5,0,0)";
			mysql_query($insertEmpLeaveBalance);
				
								header('location:addUser.php?msg=Added Successfully');
				}
				else{
						echo "<script>location.href='addUser.php?msg=emailErr'</script>";
				}



?>