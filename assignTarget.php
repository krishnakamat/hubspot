<?php
		@session_start();
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
table{
	width:60%;
}
h3{
	text-align:center;
}

table {
  border-collapse: collapse;
}
.sortable{
		width:100%
}
.main-container-efficiency {
  margin: 0 auto;
  max-width: 1263px;
  position: relative;
}
td {
padding:5px;
}

.ready-close-container {
  background: none repeat scroll 0 0 #ffffff;
  margin: auto;
  padding: 40px;
  width: 91%;
  height:auto;
}
.reviews
{
	float:left;
	margin-left:50px;
	
}

@import url(http://fonts.googleapis.com/css?family=Khula:400,300,600,700,800);

.searchDiv input, select {
  font-size: 13px !important;
}

</style>
<script src="jss/jquery-latest.min.js"></script>
<link rel="stylesheet" href="css/theme.blue.css">
<script src="jss/jquery.tablesorter.js"></script>
<script>
$(function() {

  // call the tablesorter plugin
  $("table").tablesorter({
    theme : 'blue',

    // change the multi sort key from the default shift to alt button
    sortMultiSortKey: 'altKey'
  });

});
</script>
<?php include("function.php"); 
$currMonth = $_REQUEST['currMonth'];
$currYear = $_REQUEST['currYear'];
if(!isset($currMonth))
{
$month = date('m');
}
else{
	$month = $currMonth;
}
if(!isset($currYear))
{
$year = date('Y');
}else{
	$year = $currYear;
}
?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>
<div class="main-container-efficiency">

<body>
<div class="efficiency_container">
<div class="ContentData" >
<p style="clear:both"></p>
<div class="ready-close-container">
		<h3><?php if(isset($msg)){ echo $msg ; } ?></h3>
		<form action='' method='POST'> 
			<table border="2px" align="center">
				<tr><td style="text-align:center;font-size:18px;width:50%">Assign Target</td>
				<td>
				<select name="currMonth" id="month" style="width:100px !important">
				<option <?php if ($month == '01') echo ' selected="selected"'; ?> value="01">January</option>
				<option <?php if ($month == '02') echo ' selected="selected"'; ?> value="02">February</option>
				<option <?php if ($month == '03') echo ' selected="selected"'; ?> value="03">March</option>
				<option <?php if ($month == '04') echo ' selected="selected"'; ?> value="04">April</option>
				<option <?php if ($month == '05') echo ' selected="selected"'; ?> value="05">May</option>
				<option <?php if ($month == '06') echo ' selected="selected"'; ?> value="06">June</option>
				<option <?php if ($month == '07') echo ' selected="selected"'; ?> value="07">July</option>
				<option <?php if ($month == '08') echo ' selected="selected"'; ?> value="08">August</option>
				<option <?php if ($month == '09') echo ' selected="selected"'; ?> value="09">September</option>
				<option <?php if ($month == '10') echo ' selected="selected"'; ?> value="10">October</option>
				<option <?php if ($month == '11') echo ' selected="selected"'; ?> value="11">November</option>
				<option <?php if ($month == '12') echo ' selected="selected"'; ?> value="12">December</option>
				</select>
				<select name="currYear" id="month" style="width:100px !important">
				<option value="2015">2015</option>
				</select>
				<input type='submit' value='Go'>
				</td></tr>
				</table>
				</form>
				<table border="2px" align="center">
			<form method="post" action="assignTargetSubmit.php">
	
					   <?php
					$allAdUsers="select * from webadmin where (userRole = 1 or userRole = 2) and status = 1 and teamLead !=0";
					$usersAd=mysql_query("$allAdUsers");
					$sno = 1;
					while($userAdArr=mysql_fetch_array($usersAd)){?>
					<?php
						$adminID =$userAdArr['adminID'];
					$getTeamTarget = "select * from assigntarget where teamLead='$adminID' and month = '$month' and year ='$year'";
					$teamTarget =mysql_query($getTeamTarget);
					$target = mysql_fetch_assoc($teamTarget);
					 $targetTime = $target['time'];
					?>
							<tr><td><?php echo "<b>".$sno.". </b>";  ?><input type='hidden' name='adminID[]' value='<?php echo $adminID;?>'><?php echo $userAdArr['name'];?></td><td><input value="<?php echo $targetTime; ?>" style="width:200px;height:25px;padding-left:5px" type='text' name='target[]'></td>	</tr>
					<?php 
					$sno ++;	
					}	?>
							
	
	
		<tr><td colspan="2" align="center">
		<input type='hidden' value='<?php echo $month; ?>' name='month'>
		<input type='hidden' value='<?php echo $year; ?>' name='year'>
		<input type="submit" value="Submit" name="submit"></td></tr>
		</table>
		</form>
</div>
</div>

</div>
<a href="#" class="back-to-top"><span>Top</span></a>
</div>		
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>