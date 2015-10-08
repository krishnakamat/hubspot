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

include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="view.css" media="all">

<style>
th{
text-align:center !important;
}
td{
padding-left:11px !important;
}

</style>
<link rel="stylesheet" href="colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				var empID = document.getElementByID
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
<script>
function getJoinLeaveDate(month,year)
{	

var xmlhttp;    
if (month=="" && year=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getJoinLeaveDate.php?month="+month+"&year="+year,true);
xmlhttp.send();
}									
</script>		
</head>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
include("function.php");
$month = date("m");
$year = date("Y");
?>
<div style='margin-left:10px;'>
<div>
	<span style="float:left;">Month</span>
	<select name="month" id="month" onchange="getJoinLeaveDate(this.value,document.getElementById('year').value)"  style="margin:0px 0 0 15px;height:35px !important;float:left;">
		<option value="">--Select--</option>
		<option value="01" <?php if($month == 01){ echo "selected"; } ?>>January</option>
		<option value="02" <?php if($month == 02){ echo "selected"; } ?>>February</option>
		<option value="03" <?php if($month == 03){ echo "selected"; } ?>>March</option>
		<option value="04" <?php if($month == 04){ echo "selected"; } ?>>April</option>
		<option value="05" <?php if($month == 05){ echo "selected"; } ?>>May</option>
		<option value="06" <?php if($month == 06){ echo "selected"; } ?>>June</option>
		<option value="07" <?php if($month == 07){ echo "selected"; } ?>>July</option>
		<option value="08" <?php if($month == 08){ echo "selected"; } ?>>August</option>
		<option value="09" <?php if($month == 09){ echo "selected"; } ?>>September</option>
		<option value="10" <?php if($month == 10){ echo "selected"; } ?>>October</option>
		<option value="11" <?php if($month == 11){ echo "selected"; } ?>>November</option>
		<option value="12" <?php if($month == 12){ echo "selected"; } ?>>December</option>
		</option>
	</select>
</div>
<div>
	<span style="float:left;">Year</span>
	<select name="year" id="year" onchange="getJoinLeaveDate(document.getElementById('month').value,this.value)" onchange="getUser(this.value)"  style="margin:0px 0 0 15px;height:35px !important;float:left;">
		<option value="">--Select--</option>
		<option value="2015" <?php if($year == 2015){ echo "selected"; } ?>>2015</option>
		<option value="2014" <?php if($year == 2014){ echo "selected"; } ?>>2014</option>
		<option value="2013" <?php if($year == 2013){ echo "selected"; } ?>>2013</option>
		<option value="2012" <?php if($year == 2012){ echo "selected"; } ?>>2012</option>
		<option value="2011" <?php if($year == 2011){ echo "selected"; } ?>>2011</option>
		<option value="2010" <?php if($year == 2010){ echo "selected"; } ?>>2010</option>
		<option value="2009" <?php if($year == 2009){ echo "selected"; } ?>>2009</option>
		</option>
	</select>
</div>
</div>
<br/>
<br/>
<div style='margin-left:10px;margin-right:10px;'>
<div id="txtHint">
<?php
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
</div>
</div>
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
</html>