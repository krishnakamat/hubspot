<?php
		session_start();
		ini_set('session.gc_maxlifetime',86400);
		ini_set('session.cookie_lifetime',86400);
		// ini_get('session.gc_maxlifetime');
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
.dayReport{

}
.dayReport table{
width:100%;
}
.monthReport  table{
width:100%;
}
.ownerReport  table{
width:100%;
}
.ownerReport  table tr{
width:30%;
}

.monthReport{
	float: left;
    height: 300px;
    margin: 0 5px;
    width: 300px;
}
.ownerReport{
float:left;
width:600px;
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
.ownerReport table {
  border: 1px solid #000;
  display: block;
  overflow: hidden;
  width: 100%;
}
.ownerReport tbody {
  display: block;
  width: 100%;
}
.ownerReport table tr {
  display: block;
  float: left;
  padding: 2px 1%;
  width: 48%;
}
.ownerReport td {
  display: inline-block;
  width: 20%;
}
.ownerReport td:first-child {
  width: 55%;
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
	line-height:30px;
	}
.users th {
  font-weight: bold;
  padding: 10px 7px;
}
</style>
<?php include("function.php");
date_default_timezone_set('America/New_York'); ?>
<script>

function getElapsedDay(days,reviewer)
{
	var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("allProject").innerHTML=xmlhttp.responseText;

    }
  }
  	function allProject()
	{
		
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("allProjectNum").innerHTML=xmlhttp.responseText;

    }
  }
  xmlhttp.open("GET","allProjectNum.php?days="+days+"&reviewer="+reviewer,true);
xmlhttp.send();

	}
	allProject();
xmlhttp.open("GET","cmsCos.php?days="+days+"&reviewer="+reviewer,true);
xmlhttp.send();

	
}
</script>
<?php $today=date("Y-m-d"); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
	<div class="Reportwrapper">
	<div class="dayReport">
	<?php $today=date("Y-m-d"); ?>
	<p>Welcome To Dashboard  (<?php echo  date("d-M-Y", strtotime($today));?>)</p>

<!------- SELECT FIRST REVIEWER------->
	<form action="" method="get" >
<select  name="firstReviewer" onchange="this.form.submit()" >
<option value="">----Select Reviewer----</option>
<?php
			$allAdUsers="select * from webadmin where type='1'";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>		<option value="<?php echo $userAdArr['adminID'];?>"><?php echo $userAdArr['name'];?></option>
				

	<?php 	}	?>
</select>

	</form>


	<table  border="1" style="border-collapse:collapse;"><tr class="users"><th>Status</th><th>Count </th><th>Action </th></tr>
	<p><?php 	if(isset($_REQUEST['firstReviewer']))
	{
					$getFirstReviewer ="select * from webadmin where adminID='$_REQUEST[firstReviewer]'";
					$firstReviewer=mysql_query($getFirstReviewer);
					$firstReviewerArr=mysql_fetch_assoc($firstReviewer);
					echo $firstReviewerArr['name'];
	}
	?>	
		
		</p>
	<tr  class="users" ><td>Not Started</td>
	<td>
	<?php 
	$twoDayBack=date("Y-m-d", strtotime('-1 days'));
	$getNotStarted=mysql_query("Select *,count(ssbID) as totalNotStarted from tracking where status='Not Started' order by startDate ");
	while($getNotStartedArr=mysql_fetch_array($getNotStarted))
	{
		echo $getNotStartedArr['totalNotStarted'];
	}

	?>
	
	
	</td><td><a href="searchResults.php?status[]=Not Started">Go To All Not Started SSBs</a></td></tr>
	
		<tr  class="users" >	<td>CMS -> COS Template Done </td>	

	<td>
	<?php 
	if(isset($_REQUEST['firstReviewer']))
	{
	$firstReviewer=$_REQUEST['firstReviewer'];
		$getCMStoCOS=mysql_query("Select *,count(ssbID) as totalCMStoCOS from tracking where status='CMS->COS Template Done' and startDate  <  '$twoDayBack' and firstReviewer='$firstReviewer' order by startDate ");
	}
	else
	{
	$getCMStoCOS=mysql_query("Select *,count(ssbID) as totalCMStoCOS from tracking where status='CMS->COS Template Done' and startDate  <  '$twoDayBack' order by startDate ");
	}
	while($getCMStoCOSArr=mysql_fetch_array($getCMStoCOS))
	{
		echo $getCMStoCOSArr['totalCMStoCOS'];
	}

	?>
	
	
	</td><td>
	
	<?php if(isset($_REQUEST['firstReviewer']))
	{?>
	<a href="searchResults.php?status[]=CMS->COS Template Done&firstReviewer[]=<?php echo $firstReviewer; ?>">
	<?php } else {?>
		<a href="searchResults.php?status[]=CMS->COS Template Done">
	<?php 
	}
	?>
	Go To All CMS -> COS Template Done SSBs</a></td></tr>
	
			

			<tr  class="users" >	<td>All Projects (Elapsed more than
				<?php if(isset($_REQUEST['firstReviewer']))
	{?>
			<select onchange="getElapsedDay(this.value,<?php echo $_REQUEST['firstReviewer']; ?>)" name="elapsedDay">
	<?php } else { ?>
<select onchange="getElapsedDay(this.value )" name="elapsedDay">
<?php } ?>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			</select> days) &nbsp; (Blocked Not Included)</td>	
	
			<td>
			<div id="allProject">
			<?php 
					 $days = '4';  
			$days=$days-1;
				$numDaysBack=date("Y-m-d", strtotime("- $days days"));
		if(isset($_REQUEST['firstReviewer']))
	{
	$firstReviewer=$_REQUEST['firstReviewer'];
	$getAllTracking=mysql_query("Select *,count(ssbID) as allSsb from tracking where (status !='Blocked') and startDate    <  '$numDaysBack' and firstReviewer='$firstReviewer' order by startDate ");
		}
	else
	{
			$getAllTracking=mysql_query("Select *,count(ssbID) as allSsb from tracking where (status !='Blocked') and startDate    <  '$numDaysBack' order by startDate ");
		//	echo "Select *,count(ssbID) as allSsb from tracking where (status !='CMS->COS Template Done' and status !='Not Started') and startDate    <  '$numDaysBack' order by startDate ";
	}
	while($getAllTrackingArr=mysql_fetch_array($getAllTracking))
	{
		echo $getAllTrackingArr['allSsb'];
	}

	?>
	
			</div>
			</td><td>
				<div id="allProjectNum">
	<?php if(isset($_REQUEST['firstReviewer']))
	{?>
			<a target="_blank" href="getMaxElapsedSSb.php?days=<?php echo $days; ?>&&firstReviewer=<?php echo $firstReviewer; ?>">
		<?php } else {?>
		<a target="_blank" href="getMaxElapsedSSb.php?days=<?php echo $days; ?>">
	<?php 
	}
	?> Go To All Projects SSBs</a>
	</div>
			</td></tr>
				<tr  class="users" >	<td>Blocked (Email Not Sent)</td>	<td>
			<?php 
					if(isset($_REQUEST['firstReviewer']))
	{
	$firstReviewer=$_REQUEST['firstReviewer'];
	$getAllTracking=mysql_query("Select *,count(ssbID) as allSsb from tracking where (status ='Blocked' ) and blockedMailSent ='0'  and startDate  <  '$twoDayBack' and firstReviewer='$firstReviewer'  order by startDate ");
	}
	else
	{
	$getAllTracking=mysql_query("Select *,count(ssbID) as allSsb from tracking where (status ='Blocked' ) and blockedMailSent ='0'  and startDate  <  '$twoDayBack' order by startDate ");
	}
	while($getAllTrackingArr=mysql_fetch_array($getAllTracking))
	{
		echo $getAllTrackingArr['allSsb'];
	}

	?>
	
			
			</td><td>
						
	<?php if(isset($_REQUEST['firstReviewer']))
	{?>
			<a href="searchResults.php?status[]=Blocked&firstReviewer[]=<?php echo $firstReviewer; ?>">
	<?php }
	else
	{?>
			<a href="searchResults.php?status[]=Blocked">
	<?php }
	?>Go To All Blocked (Email Not Sent) SSBs</a></td></tr>


	</table>
	<p>	<a  href="ssbAdminData.php">Go To Your SSBs</a></p>

	<!--<p>	<a  href="leaveTracker/adminLeaveTracking.php">Go To Leave Tracker</a></p>-->

	</div>



<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>