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
$cookie_name = "user";
$cookie_value = $_SESSION['userRole'];
setcookie($cookie_name, $cookie_value, time() + 7200);
//echo $cookie_value;
if(!isset($_COOKIE[$cookie_name])) {
	echo "<script> window.location='index.php'; </script>";
	header('location:index.php');
	} else {
    $cookie_value = $cookie_value;
}
		
?>
	<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
<?php
include("config.php");
include("function.php");
?>
<html><head>
 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
   <script type="text/javascript"> 
$(function() {        
$("#startdate1").datepicker({ dateFormat: "yy-mm-dd" }).val()      
$("#enddate1").datepicker({ dateFormat: "yy-mm-dd" }).val()   
});   
</script>
<script>
function dateClear()
{    
   document.getElementById("startdate1").value= "";
   document.getElementById("enddate1").value= "";
}
function daysClear()
{    
   document.getElementById("days").value= "";
}
</script>
</head><body>
<style>
fieldset
{
	float:left;
	width:8%;
	min-height:130px;
}
.search-field > span {
  bottom: 21px;
  position: absolute;
}
.search-field {
  position: relative;
}
.ContentData select {
  border: medium none;
}

.notes{
	background: none repeat scroll 0 0 #fff;
    border: 1px solid;
    border-radius: 5px;
    box-shadow: 0 0 5px #000;
    display: none;
    padding: 7px;
    position: absolute;
    z-index: 1;

	margin-top:7px;
	}

.notesb
{ 	text-decoration:underline;
}
table{
	border-collapse:collapse;
}
</style>
<div class="addData">
<div id="myDiv">
</div>
<div class="searchDiv">
<form action="searchResults.php" method="get">
<fieldset>
Owner:<select  name="owner[]" multiple="multiple" class="owner" id="multiple"><option selected value=''>---Select Owner---</option>
<?php $allOwner="select  distinct * from webadmin where userRole = 3 and status = 1 and employeeType = 1 order by name";
		$getAllOwner=mysql_query($allOwner);
		?>
				<?php
					while($rownerArr=mysql_fetch_array($getAllOwner))
				{
					?><option value="<?php echo $rownerArr['adminID'];?>"><?php echo $rownerArr['name'];?></option>
				<?php
				}
					?>
		</select>
</fieldset><fieldset>
Queue:<select name="queue[]" multiple="multiple" class="queue" id="multipleQueue"><option value=''>---Select Queue---</option>	<?php
		$allQueue="select distinct queue from tracking order by queue";
		$getAllQueue=mysql_query($allQueue);
	
					while($queueArr=mysql_fetch_array($getAllQueue))
				{
					?><option value="<?php echo $queueArr['queue'];?>"><?php echo $queueArr['queue'];?></option>
				<?php
				}
					?></select></fieldset><fieldset>
Service:<select name="service[]" multiple="multiple" class="service" id="multipleService"><option value=''>---Select Service---</option>
	<?php
		$allService="select distinct service from tracking order by service";
		$getAllService=mysql_query($allService);
	
					while($serviceArr=mysql_fetch_array($getAllService))
				{
					?><option value="<?php echo $serviceArr['service'];?>"><?php echo $serviceArr['service'];?></option>
				<?php
				}
					?></select></fieldset><fieldset>
Status:<select  name="status[]" multiple="multiple"   class="status" id="multipleStatus">
<option value=''>---Select Status---</option>
		<?php  getAllStatusOption() ?>
						</select>
</fieldset><fieldset>
		First Reviewer:<select  name="firstReviewer[]" multiple="multiple" class="firstReviewer" id="multipleFirstReviewer"><option value=''>---Select First Reviewer---</option>
<?php $firReviewer="select  distinct firstReviewer from tracking where firstReviewer != 0";
		$getfirReviewer=mysql_query($firReviewer);
		?>
				<?php
					while($rowfirArr=mysql_fetch_array($getfirReviewer))
				{
					?><option value="<?php echo $rowfirArr['firstReviewer'];?>">
					<?php $getFRName1=mysql_query("select * from webadmin where adminID ='$rowfirArr[firstReviewer]'");
						$firstRArr1=mysql_fetch_array($getFRName1);
						$firstRName1 = $firstRArr1['name'];?>
					
					<?php echo $firstRName1;?></option>
				<?php
				}
					?>
		</select></fieldset><fieldset>

Second Reviewer:<select    name="secondReviewer[]" multiple="multiple" class="secondReviewer" id="multipleSecondReviewer"><option value=''>---Select Second Reviewer---</option>
<?php $secReviewer="select  distinct secondReviewer from tracking where secondReviewer != 0";
		$getsecReviewer=mysql_query($secReviewer);
		?>
				<?php
					while($rowsecArr=mysql_fetch_array($getsecReviewer))
				{
					?><option value="<?php echo $rowsecArr['secondReviewer'];?>">
					<?php $getSRName1=mysql_query("select * from webadmin where adminID ='$rowsecArr[secondReviewer]'");
						$secondRArr1=mysql_fetch_array($getSRName1);
						$secondRName1= $secondRArr1['name'];?>

					<?php echo $secondRName1;?></option>
				<?php
				}
					?>
		</select></fieldset>
		<fieldset>Start Date: <input type='text' onClick="daysClear();" name="date1" id="startdate1" ><br/>End Date: <input type="text" onClick="daysClear();" name="date2" id="enddate1"><br/><br/>
		<button type="button" onClick="priorityFunc(1)">Priority</button>

		</fieldset>
		
		<fieldset>
		Elapsed days:<select name="days" onClick="dateClear();" id="days">
						<option value="">Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">>10</option>

					</select>
		</fieldset>
		
		<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
			  
			
			
			<script>
			function displayVals() {
			  
			  var multipleValues = $( "#multiple" ).val() || [];
			  $( ".data" ).html( "  " + multipleValues.join( ", " ) );
			}
			$( "select" ).change( displayVals );
			displayVals();
		</script>		
		
<fieldset class="search-field">	
<span>
<input type="submit" value="Search"></span></fieldset>
</form>
</div>
<div id="priority"></div>
</body></html>
<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } 
?>