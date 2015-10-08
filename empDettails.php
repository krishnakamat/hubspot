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
include('config.php');
?> <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
   <script type="text/javascript"> 
	$(function() {        
	$("#startdate1").datepicker({ dateFormat: "yy-mm-dd" }).val()      
	$("#enddate1").datepicker({ dateFormat: "yy-mm-dd" }).val()   
	});   
	</script>
	<br/>
	<div class="ContentData">
	<form action='' method='post'>
		<fieldset style='padding-left:30px'>
		Start Date: <input type='text' onClick="daysClear();" name="date1" id="startdate1" ><br/>
		End Date: <input type="text" onClick="daysClear();" name="date2" id="enddate1">
		<input type='submit' name='submit' value='Submit'>
		</fieldset>
	</form>
	<br/>
<?php
if(isset($_POST['submit'])){
	$startDate = $_POST['date1'];
	$endDate = $_POST['date2'];
}
else {
	$startDate = date('Y-m-01');
	$endDate = date('Y-m-d');
}
$getEmpDetail = "SELECT * FROM `empleavedetails` WHERE `appliedFor` >= '$startDate' and `appliedFor` <= '$endDate' and status !='4' order by `appliedFor`  ";

$empQry = mysql_query($getEmpDetail);
?>
<style>
td{
padding:5px;
}

.leave-2
{
	background: #B3C6E7;
	
}
tr:hover {
    background: #E09238;
}
</style>
<table border='1' style='border-collapse:collapse; padding:5px'>
<tr><td>S. No.</td><td>Name</td><td>Date</td><td>Leave Type</td><td>Planned/Unplanned</td><td>Status</td></tr>
<?php 
$x=0;
while($empQryData = mysql_fetch_array($empQry))
{ $x++;
	 $empId=$empQryData['empID'];
	?>
	<tr class='leave-<?php echo $empQryData['typeLeave']; ?>' >
	<td><?php echo $x; ?> </td>
	<td><?php //echo $empQryData['empID'];
	$getName = "select * from webadmin where adminID ='$empId'";
	$name=mysql_query($getName);
	$empName = mysql_fetch_assoc($name);
	echo $empName['name'];
	?></td>
	<td><?php echo $empQryData['appliedFor']; ?></td>
	<td ><?php //echo $empQryData['type']; 
	if($empQryData['typeLeave']=='1'){
	echo "Half Day";
	}
	else if($empQryData['typeLeave']=='2'){
	echo "Full Day";
	}
	?></td>
	<td><?php //echo $empQryData['planned'];
	if($empQryData['planned']=='1'){
	echo "Planned";
	}
	else if($empQryData['planned']=='0'){
	echo "<b style='color:red'>UnPlanned</b>";
	}
	?></td>
	
	<td><?php //echo $empQryData['status'];
	if($empQryData['status']=='3'){
	echo "Approved";
	}
	else if($empQryData['status']=='2'){
	echo "Rejected";
	}
	
	else if($empQryData['status']=='1'){
	echo "Un Approved";
	}
	
		
	?></td></tr>
<?php }

?>
</table>
</div>
<?php include("Footer.php"); ?>
