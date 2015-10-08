<?php

		session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
	

include("config.php");
$empID = $_GET['empID'];
$empName = "select name from webadmin where empID = '$empID'";
$resultName = mysql_query($empName);
$rowName = mysql_fetch_assoc($resultName);
$name = $rowName['name'];
if($_GET['sta']==2){
$query = "insert into disabledemp(empID,name)values('$empID','$name')";
$result = mysql_query($query) or die("Could not execute query");
}
if($_GET['sta']==1){
$query = "delete from disabledemp where empID = '$empID'";
$result = mysql_query($query) or die("Could not execute query");
}
//echo "<script language=javascript>";
//echo "location.href='editUser.php?msg=Deleted Successfully'";
//echo "</script>";


?>
<table class="sortable" border="2" align="center" >
<thead><tr style="background:#9bbb59; color:#fff;height:25px;font-size:16px !important;"><th style="width:30px;"><b>Sr. No.</b></th><th style="width:40px;"><b>Emp ID</b></th><th style="width:45px;"><b>Name</b></th><th style="width:50px;"><b>Designation</b></th><th style="width:60px"><b>Role</b></th><th style="width:30px"><b>Disable/Enable</b></th></tr></thead>

<?php

			$allUsers="select * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3)and adminID NOT IN(18,19) and empID!=0 and status = 1 and employeeType = 1 order by name";

			$users=mysql_query("$allUsers");

			$x=0;



			while($userArr=mysql_fetch_array($users))

	{ if($userArr['userRole']== 1){
		$role = "Admin";
		}elseif($userArr['userRole']== 2){
		$role = "Team Leader";
		}else{
		$role = "Employee";
		}
	
		
		$desig = $userArr['designation'];
		$mysqlDesignation = "select * from job_designation where jobID = '$desig'";
		$resultDesignation = mysql_query($mysqlDesignation);
		$rowDesignation = mysql_fetch_assoc($resultDesignation);
		
		 $document = "select * from documents where empID = '$userArr[empID]' and docType = 2";
		$resultDoc = mysql_query($document);
		$rowDoc = mysql_fetch_assoc($resultDoc);

				$x++; 



				$class = ($x%2 == 0)? 'Background1': 'Background2';

				?>
				
		<?php
		$disabledEmp = "select * from disabledemp where empID = '".$userArr['empID']."'";
		$resultEmp = mysql_query($disabledEmp);
		$rowEmp = mysql_num_rows($resultEmp);
		
		
		?>		

		<tr class="<?php echo $class; ?>" >
			<input type="hidden" name="empID" value="<?php echo "group3_".$userArr['empID'];?>">
			<td><?php echo $x; ?></td><td><?php echo $userArr['empID'];?></td><td><?php echo $userArr['name'];?></td><td><?php echo $rowDesignation['jobDesignation'];?></td><td><?php echo $role;?></td><td><?php if ($rowEmp > 0) echo "<input type='checkbox' checked value=$userArr[empID] onclick = disableEmp(this.value,1) > &nbsp;&nbsp;Disable"; 
			else echo "<input type='checkbox' value=$userArr[empID] onclick = disableEmp(this.value,2)>&nbsp;&nbsp;Enable"; ?></td>
			

		</tr>

	<?php

	}

	?>
	
</table>