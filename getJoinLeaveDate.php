<?php

		session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
	

include("config.php");
$month = $_GET['month'];
$year = $_GET['year'];

$allUsers="select * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3)and adminID NOT IN(18,19) and empID!=0 and status = 1 and employeeType = 1 and MONTH(join_date)='$month' and YEAR(join_date)='$year' order by join_date";
$users=mysql_query("$allUsers");
$totalNum = mysql_num_rows($users);
if($totalNum > 0){
?>
<!--<div style='margin-left:10px;margin-right:10px;'>
<div id="txtHint">-->
Joined Employee
<table class="sortable" border="2" align="center" >
<thead><tr style="background:#9bbb59; color:#fff;height:25px;font-size:16px !important;"><th style="width:30px;"><b>Sr. No.</b></th><th style="width:40px;"><b>Emp ID</b></th><th style="width:45px;"><b>Name</b></th><th style="width:50px;"><b>Designation</b></th><th style="width:60px"><b>Role</b></th><th style="width:30px"><b>DOJ</b></th></tr></thead>

<?php
	$x=0;
	while($userArr=mysql_fetch_array($users)){ 
		if($userArr['userRole']== 1){
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
		
		$x++; 

		$class = ($x%2 == 0)? 'Background1': 'Background2';

?>
		

<tr class="<?php echo $class; ?>" >
<input type="hidden" name="empID" value="<?php echo "group3_".$userArr['empID'];?>">
<td><?php echo $x; ?></td><td><?php echo $userArr['empID'];?></td><td><?php echo $userArr['name'];?></td><td><?php echo $rowDesignation['jobDesignation'];?></td><td><?php echo $role;?></td>
<td><?php echo date('d-m-Y', strtotime($userArr['join_date']));?></td>
</tr>
<?php	}	?>
</table>
<!--</div>
</div>-->
<?php } ?>
<br/>
<?php
$resignedUsers="select * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3)and adminID NOT IN(18,19) and empID!=0 and status = 2 and employeeType = 1 and MONTH(DOL)='$month' and YEAR(DOL)='$year' order by join_date";
$resultResignedUsers=mysql_query("$resignedUsers");
$totalResignedNum = mysql_num_rows($resultResignedUsers);
if($totalResignedNum > 0){
?>
Resigned Employee
<table class="sortable" border="2" align="center" >
<thead><tr style="background:#9bbb59; color:#fff;height:25px;font-size:16px !important;"><th style="width:30px;"><b>Sr. No.</b></th><th style="width:40px;"><b>Emp ID</b></th><th style="width:45px;"><b>Name</b></th><th style="width:50px;"><b>Designation</b></th><th style="width:60px"><b>Role</b></th><th style="width:30px"><b>DOL</b></th></tr></thead>

<?php
	$x=0;
	while($resignedUserArr=mysql_fetch_array($resultResignedUsers)){ 
		if($resignedUserArr['userRole']== 1){
		$role = "Admin";
		}elseif($resignedUserArr['userRole']== 2){
		$role = "Team Leader";
		}else{
		$role = "Employee";
		}
	
		$desig = $resignedUserArr['designation'];
		$mysqlDesignation = "select * from job_designation where jobID = '$desig'";
		$resultDesignation = mysql_query($mysqlDesignation);
		$rowDesignation = mysql_fetch_assoc($resultDesignation);
		
		$x++; 

		$class = ($x%2 == 0)? 'Background1': 'Background2';
?>
		
<tr class="<?php echo $class; ?>" >
<td><?php echo $x; ?></td><td><?php echo $resignedUserArr['empID'];?></td><td><?php echo $resignedUserArr['name'];?></td><td><?php echo $rowDesignation['jobDesignation'];?></td><td><?php echo $role;?></td>
<td><?php echo date('d-m-Y', strtotime($resignedUserArr['DOL']));?></td>
</tr>
<?php	}	?>
</table>
<?php } ?>

<br/>
<?php
$abscondedUsers="select * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3)and adminID NOT IN(18,19) and empID!=0 and status = 3 and employeeType = 1 and MONTH(DOL)='$month' and YEAR(DOL)='$year' order by join_date";
$resultAbscondedUsers=mysql_query("$abscondedUsers");
$totalAbscondedNum = mysql_num_rows($resultAbscondedUsers);
if($totalAbscondedNum > 0){
?>
Absconded Employee
<table class="sortable" border="2" align="center" >
<thead><tr style="background:#9bbb59; color:#fff;height:25px;font-size:16px !important;"><th style="width:30px;"><b>Sr. No.</b></th><th style="width:40px;"><b>Emp ID</b></th><th style="width:45px;"><b>Name</b></th><th style="width:50px;"><b>Designation</b></th><th style="width:60px"><b>Role</b></th><th style="width:30px"><b>DOL</b></th></tr></thead>

<?php
	$x=0;
	while($rowAbscondedUser=mysql_fetch_array($resultAbscondedUsers)){ 
		if($rowAbscondedUser['userRole']== 1){
		$role = "Admin";
		}elseif($rowAbscondedUser['userRole']== 2){
		$role = "Team Leader";
		}else{
		$role = "Employee";
		}
	
		$desig = $rowAbscondedUser['designation'];
		$mysqlDesignation = "select * from job_designation where jobID = '$desig'";
		$resultDesignation = mysql_query($mysqlDesignation);
		$rowDesignation = mysql_fetch_assoc($resultDesignation);
		
		$x++; 

		$class = ($x%2 == 0)? 'Background1': 'Background2';
?>
		
<tr class="<?php echo $class; ?>" >
<td><?php echo $x; ?></td><td><?php echo $rowAbscondedUser['empID'];?></td><td><?php echo $rowAbscondedUser['name'];?></td><td><?php echo $rowDesignation['jobDesignation'];?></td><td><?php echo $role;?></td>
<td><?php echo date('d-m-Y', strtotime($rowAbscondedUser['DOL']));?></td>
</tr>
<?php	}	?>
</table>
<?php } ?>