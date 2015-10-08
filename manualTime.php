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
<style>


.loginReport  table{
width:100%;
}

.loginReport{
	float: left;
    margin: 0 5px;
	padding-left:20px;
	padding-top:20px;
}

.Reportwrapper p {
  background: none repeat scroll 0 0 #9bbb59;
  border-color: #000;
  border-style: solid;
  border-width: 1px 1px 0 ;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  margin: 0;
  padding: 5px;
  text-align: center;
  text-transform: capitalize;
}
.users {
  background: none repeat scroll 0 0 #dfebc7;
  color: green;
  font: 14px Trebuchet MS;
  margin: 1px;
  padding: 8px 10px;
}
	.users td{
	padding:10px 7px;
	line-height:10px;
	}
.users th {
  font-weight: bold;
  padding: 10px 7px;
}
.clientIssues{
	text-align:center;
	color:red;
	padding-top:5px;
}
</style>
<?php include("function.php"); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)||($_SESSION['userRole']==3 && $_SESSION['status']==1) ){?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script>
  $(function() {
               $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
				        $("#datepicker2").datepicker({ dateFormat: "yy-mm-dd" }).val()
  });
  </script>
	<div class="Reportwrapper">
	<p>Add Time Manually</p>
	<h3 class="clientIssues">This screen is ONLY for Client Issues, Leaves and Idle Time - DO NOT ADD ANY OTHER TIME</h3>
	<?php if(isset($_GET['msg']))
	{
	  if($_GET['msg']=="success")
		{
			echo "<span style='color:green;align:left'> The SSB is Added Successfully as a closed SSBID</span>";
		}
	  elseif($_GET['msg']=='notsuccess')
		{
		  echo "<span style='color:red'>The SSB is NOT closed Till now, Please add in your template Time Details</span>";
		}
		
	}
	?>

	<div class="loginReport">

	<p>Add Client Issues Time ( Only For Closed SSB )</p>
		<?php date_default_timezone_set('Asia/Kolkata');
$now=date("Y-m-d H:m:s");?>
<form action="addManualTime.php" method="post">
	<table   border="1" style="border-collapse:collapse;" ><tr class="users"><th>Owner</th><th>SSB</th><th>Time </th><th>Date </th><th>Notes </th></tr>

									<tr   class="users" style="height:30px"><td>
									<?php //$getOwnerId=mysql_query("select * from webadmin where name ='$_SESSION[name]'");
//$ownerId=mysql_fetch_array($getOwnerId);
// $ownerID = $ownerId['adminID'];?>
 <select name="owner" required ><!--<option value="<?php echo $ownerID; ?>"><?php echo $owner=$_SESSION['name']; ?></option>-->
 <option value="" >Select Owner</option>
 <?php
		$allMembers="select  * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3) and status = 1 and employeeType = 1 order by name ";
		$getAllMembers=mysql_query($allMembers);
		
					while($memberArr=mysql_fetch_array($getAllMembers))
				{
					?><option value="<?php echo $memberArr['adminID'];?>"><?php echo $memberArr['name'];?></option>
				<?php
				}
?>
 </select>
 <?php 
 $getTeamleader = "select * from webadmin where adminID = '". $_SESSION['adminID']."'";
 $resultTeamleader = mysql_query($getTeamleader);
 $rowTeamleader = mysql_fetch_assoc($resultTeamleader);
 ?>
 <input type="hidden" name="teamleader" value="<?php echo $rowTeamleader['teamLead']; ?>">									
</td>
<td><input type="text" name="ssbid" required pattern="[SSB-]+[0-9]{7,}"></td>
<td><input type="number" name="timeTaken"  step="0.1" min='0' required="required"  value=""/></td> 
<td><input type="text" required name="dateAdded" id="datepicker"></td>
<td><textarea name="notes" ></textarea></td></tr>
<tr   class="users" style="height:30px"><td colspan="5"><input type="submit" value="Add Time" ></td></tr>
</table>
</form>
	</div>

		<div class="loginReport">

	<p>Add Idle / Leave Time</p>
		
<form action="addIdleTime.php" method="post">
	<table   border="1" style="border-collapse:collapse;" ><tr class="users"><th>Owner</th><th>Time </th><th>Date </th><th>Type </th><th>Notes </th></tr>

									<tr   class="users" style="height:30px"><td>
									<?php //$getOwnerId=mysql_query("select * from webadmin where name ='$_SESSION[name]'");
//$ownerId=mysql_fetch_array($getOwnerId);
// $ownerID = $ownerId['adminID'];?>
 <select name="owner" required ><!--<option value="<?php echo $ownerID; ?>"><?php echo $owner=$_SESSION['name']; ?></option>-->
 <option value="" >Select Owner</option>
 <?php
		$allMembers="select  * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3) and status = 1 and employeeType = 1 order by name ";
		$getAllMembers=mysql_query($allMembers);
		
					while($memberArr=mysql_fetch_array($getAllMembers))
				{
					?><option value="<?php echo $memberArr['adminID'];?>"><?php echo $memberArr['name'];?></option>
				<?php
				}
?>
 </select>
									
									</td><td><input type="number" name="time"  step="0.1" min='0' required="required"  value=""/></td><td><input type="text" required name="dateAdded" id="datepicker2"></td><td><select required name="type"><option value="">--Select Type--</option><option value="2">Idle</option><option value="1">Leave</option></select> </td><td><textarea name="notes" ></textarea></td></tr>
										<tr   class="users" style="height:30px"><td colspan="5"><input type="submit" value="Add Time" ></td></tr>
</table>
</form>
	</div>



</div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
