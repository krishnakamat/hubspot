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
<head>
<!--<meta http-equiv="refresh" content="30">-->
</head>
<style>
.sortable{
	width:100%;
}
.totalHours {
  font-size: 11px;
  padding: 12px;
  position: absolute;
  top: -15px;
}
.ContentData {
  position: relative;
}
</style>	

 <!--<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

  
     <script>
 /*$(function() {
	var myDate = new Date();
    $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
	$("#datepicker").datepicker("setDate", myDate);
});*/
  
  </script>
<?php include("function.php");?>
	<?php 	if($_SESSION['userRole']==1 && $_SESSION['status']==1){?>
	
<div class="addData">
<div id="myDiv">
</div>

<br/>


</p>
<div class="ContentData">
<p style="clear:both"></p>
<?php if(isset($_GET['msg']))
	{
	  if($_GET['msg']=="success")
		{ ?>
			<span style="color:green;text-align:center;width:100%;display:inline-block;" align="center"> The SSB is Added Successfully as a closed SSBID</span>
		<?php 
		}
			
	}
?>
<?php
$getManualTime = "select distinct ssbID from openssbtime where status = 1 order by dateUpdated";
$resultManualTime = mysql_query($getManualTime);
?>

<br/>
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th width="50px">Sr. No.</th><th width="80px">SSB-ID</th>
<th width="80px">TeamLead</th><th width="80px">Owner</th><th width="80px">Time Taken</th><th width="80px">Time Edit</th>
<th width="80px">Date</th><th width="80px">Notes</th><th width="80px">Action</th></tr></thead>
<?php
$x=0;
while($rowManualTime = mysql_fetch_array($resultManualTime)){


$getManual = "select ssbID,owner,timeTaken,teamLead,dateUpdated,notes from openssbtime where status = 1 and ssbID = '".$rowManualTime['ssbID']."'";
$resultManual = mysql_query($getManual);
$rowsNum = mysql_num_rows($resultManual);
$i = 0; ?>
<form action="insertTime.php"  method="post">
<?php
while($rowManual = mysql_fetch_array($resultManual)){
		$x++; 
		$totalTimeTaken += $rowManual['timeTaken']; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
?>
<tr  class='<?php echo $class; ?>' ><td><b><?php echo $x;?></b></td><td><?php echo $rowManual['ssbID'];?>
									<input type="hidden" name="ssbID" value="<?php echo $rowManual['ssbID']; ?>"></td>
			<?php
			$getTeamlead = "select * from webadmin where adminID = '".$rowManual['teamLead']."'";
			$resultTeamlead = mysql_query($getTeamlead);
			$rowTeamlead = mysql_fetch_assoc($resultTeamlead);
			?>
		<td><?php echo $rowTeamlead['name'];?><input type="hidden" name="teamLead[]" value="<?php echo $rowTeamlead['adminID']; ?>"></td>
			<?php
			$getOwner = "select * from webadmin where adminID = '".$rowManual['owner']."'";
			$resultOwner = mysql_query($getOwner);
			$rowOwner = mysql_fetch_assoc($resultOwner);
			?>
		<td><?php echo $rowOwner['name'];?><input type="hidden" name="owner[]" value="<?php echo $rowOwner['adminID']; ?>"></td>
		<td><?php echo $rowManual['timeTaken'];?><input type="hidden" name="timeTaken[]" value="<?php echo $rowManual['timeTaken']; ?>"></td>
				<td><input type="text" name="updateTime[]" value="<?php echo $rowManual['timeTaken'];?>"></td>
				<!--<td><input type="text"  name="dateUpdated[]" id="" value="<?php echo date("d-m-Y",strtotime($rowManual['dateUpdated'])); ?>"></td>-->
				<td><input type="text"  name="dateUpdated[]" id="" value="<?php echo $rowManual['dateUpdated'] ; ?>"></td>
				<td><textarea rows=1 cols=8 type="text" name="notes[]" ><?php echo $rowManual['notes'];?></textarea></td>
						
				<?php if($i==0){ ?>
				<td rowspan="<?php echo $rowsNum; ?>"><input type="submit" value="Save"></td><?php } ?></tr>
<?php $i=1; } ?>
</form>
<?php  } ?>				

</table>
<div class="totalHours">
<?php echo "<b>Total Hours Pending Approval: ".$totalTimeTaken."</b>"; ?>
</div>

</div>
</div>
<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } ?>