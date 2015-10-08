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
</head>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
include("function.php");

$activeEmpNum = "select * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3) and status = 1 and adminID NOT IN(18,19) and empID!=0 and employeeType = 1";
$resultEmpNum = mysql_query($activeEmpNum);
$fetchEmpNum = mysql_num_rows($resultEmpNum);
?>
<br/>
<br/>
<?php if($status == 1){?>
<span><?php echo "Active Employees:". $fetchEmpNum; ?></span>
<?php } ?>
<?php if($status == 2){?>
<span><?php echo "Resigned Employees:". $fetchEmpNum; ?></span>
<?php } ?>
<?php if($status == 3){?>
<span><?php echo "Absconded Employees:". $fetchEmpNum; ?></span>
<?php } ?>
<table class="sortable" border="2" align="center" >
<thead><tr style="background:#9bbb59; color:#fff;height:25px;font-size:16px !important;"><th style="width:30px;"><b>Sr. No.</b></th><th style="width:40px;"><b>Emp ID</b></th><th style="width:45px;"><b>Name</b></th><th style="width:50px;"><b>Designation</b></th><th style="width:60px"><b>Role</b></th><th style="width:30px"><b>Experience(Years)</b></th><th style="width:30px"><b>Document</b></th></tr></thead>

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
		$exp = $userArr['experience'];
		$joinDate = $userArr['join_date'];
		$currDate = date("Y-m-d");
		//$date1 = '2000-01-25';
		//$date2 = '2010-02-20';

		$ts1 = strtotime($joinDate);
		$ts2 = strtotime($currDate);

		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
		$totalExp = round(($exp + $diff)/12, 1) ;
		
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

				<tr class="<?php echo $class; ?>" ><td ><?php echo $x; ?></td><td><?php echo $userArr['empID'];?></td><td><?php echo $userArr['name'];?></td><td ><?php echo $rowDesignation['jobDesignation'];?></td><td><?php echo $role;?></td><td><?php echo $totalExp;?></td>
				<td><a class="group3" href="documents/<?php echo $userArr['empID']."_".$rowDoc['docDetail'];?>" title="<?php echo $documents['docName']; ?>"><?php echo $rowDoc['docName'];?></a></td>

		</tr>

	<?php

	}

	?>
	
</table>
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
</html>