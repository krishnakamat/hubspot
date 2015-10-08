<?php ob_start();
		include("config.php");
		$name=$_POST['fname']." ".$_POST['mname']." ".$_POST['lname'];
		$fname=$_POST['fname'];
		$mname=$_POST['mname'];
		$lname=$_POST['lname'];
		$image=$_FILES['image']['name'];
		 move_uploaded_file($_FILES["image"]["tmp_name"],"profileImages/" .$image);
		$gender=$_POST['gender'];
		$marital=$_POST['marital'];
		$father_name=$_POST['father_name'];
		$mother_name=$_POST['mother_name'];
		$PAN_Card=$_POST['PAN_Card'];
		$email=$_POST['email'];
		$date_of_birth=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
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
		
		$basic=$_POST['basic'];
		$h_r_a=$_POST['h_r_a'];
		$conv_allowance=$_POST['conv_allowance'];
		$med_allowance=$_POST['med_allowance'];
		$exec_allowance=$_POST['exec_allowance'];
		$gross_amt=$_POST['gross_amt'];

		$getLastEmpID=mysql_query("SELECT max(empID) maxEmp from webadmin");
		$lastEmpID=mysql_fetch_assoc($getLastEmpID);
		$empID=$lastEmpID['maxEmp']+1;


		

		$checkAvailability="SELECT count(email) emails FROM webadmin WHERE email = '$email' ";
		$getAvailability=mysql_query($checkAvailability);
		while($emailArr=mysql_fetch_array($getAvailability))
					
					{
						$availability= $emailArr['emails'];
					}
				if($availability<1)
				{

				$insertOwner="insert into webadmin(empID,name,photograph,gender,maritalStatus,dob,experience,designation,join_date,correspondenceAddress,permanentAddress,mobileNum,secNum,emergencyNum,father_name,mother_name,PAN_Card,other_email,email,teamLead,userRole)values('$empID','$name','$image','$gender','$marital','$date_of_birth','$experience','$designation','$join_date','$correspondenceAddress','$permanentAddress','$numberPersonal','$numberSecondary','$numberEmergency','$father_name','$mother_name','$PAN_Card','$otherEmail','$email','$teamLead','$userRole')";
				mysql_query($insertOwner);
				
				$getAdminID="select * from webadmin where email='$email'";
				$resultAdminID=mysql_query($getAdminID);
				$rowAdminID=mysql_fetch_array($resultAdminID);
				$empID=$rowAdminID['empID'];
				$adminID=$rowAdminID['adminID'];
				
				
				$personal_details="insert into personal_details(firstName,midName,lastName,gender,maritalStatus,dob,experience,designation,join_date,address1,address2,mobileNum,secNum,emergencyNum,father_name,mother_name,PAN_Card,other_email,work_email,role)values('$fname','$mname','$lname','$gender','$marital','$date_of_birth','$experience','$designation','$join_date','$correspondenceAddress','$permanentAddress','$numberPersonal','$numberSecondary','$numberEmergency','$father_name','$mother_name','$PAN_Card','$otherEmail','$email','$userRole')";
					//mysql_query($personal_details);
					
					$insertSalary="insert into salary_structure(empID,basic,h_r_a,conveyance_allowance,medical_allowance,executive_allowance,gross_amount,to_account,name_in_bank)values('$empID','$basic','$h_r_a','$conv_allowance','$med_allowance','$exec_allowance','$gross_amt','$account_number','$name_in_bank')";
					//mysql_query($insertSalary);

					
					$to = "soniaprjpt654@gmail.com";
					
					$subject = "Employeee Registration";

					echo $message = "
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
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					$headers .= 'From: The WebPlant Pvt. Ltd. <webplantapp@gmail.com>' . "\r\n";

					mail($to,$subject,$message,$headers);
					
					
			$insertEmpLeaveBalance="insert into empleavebalance(empID,accrued,leaveUsed,salaryAdjustment)values('$empID',0.5,0,0)";
			mysql_query($insertEmpLeaveBalance);
				
								header('location:addUser.php?msg=Added Successfully');
				}
				else{
						echo "<script>location.href='addUser.php?msg=emailErr'</script>";
				}



?>