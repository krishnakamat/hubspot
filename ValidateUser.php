<?php
ob_start();
include("config.php");
//ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
//maybe you want to precise the save path as well
//then start the session
session_start();
	//echo ini_get('session.gc_maxlifetime');
	
	$employeeid = $_POST['employee_id1'];
	$employeepass = md5($_POST['password1']);
	
	if(!isset($employeeid) || !isset($employeepass)) {
		header('location: index.php?error=1');
	}

	if(isset($employeepass)) {
		$check_exists = "Select * from webadmin where email="."'$employeeid'";
		$check_result = mysql_query($check_exists) or die(mysql_error());
		$row = mysql_fetch_array($check_result);
		$cookie_name = "user";
		$cookie_value = $row['userRole'];
		setcookie($cookie_name, $cookie_value, time() + 7200, "/");
		date_default_timezone_set('Asia/Kolkata');
		$now=date("Y-m-d H:i:s");

		if(mysql_num_rows($check_result) > '0' ) {
			if($row['password']==md5('NotUpdated'))
			{
				header('location: updatePassword.php?userID='.$row['adminID']);	
			}
			elseif($row['password'] != $employeepass)
			{
				header('location: index.php?error=2');
			}
		 elseif($row['password'] == $employeepass) {
			$disabledEmp = "select * from disabledemp where empID = '".$row['empID']."'";
			$resultEmp = mysql_query($disabledEmp);
			$rowEmp = mysql_num_rows($resultEmp);
			if($rowEmp < 1) {
			mysql_query("update webadmin set lastlogin='$now' where email='$employeeid'");
			$_SESSION['loggedIn'] = "Y";
			//$_SESSION['type']=$row['type'];
			$_SESSION['userRole']=$cookie_value;
			$_SESSION['name']=$row['name'];
			$_SESSION['adminID']=$row['adminID'];
			$_SESSION['status']=$row['status'];
			 $_SESSION['start'] = time();
			  $_SESSION['expire'] = $_SESSION['start'] + 7200;
			header('location: welcome.php');
			
			
		 }else{
				header("location:notAuthUser.php");
		}
		}
		}
		else{
		header('location: index.php?error=2');
	}
	}
	
?>

<?php
	mysql_close($conn);
	ob_end_flush();
?> 