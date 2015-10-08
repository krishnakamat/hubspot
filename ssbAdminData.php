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
<style>
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
</style>
</head>

	<?php include("function.php");?>
	<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
<?php

//echo "Welcome ". $_SESSION['name'];

$getAdmin=mysql_query("select * from webadmin where name ='$_SESSION[name]'");
						$getAdminData=mysql_fetch_array($getAdmin);
						$adminOwner = $getAdminData['adminID'];?>

<?php $allSsb="select * from tracking where firstReviewer='$adminOwner' and status !='Closed' order by startDate";

$ssb=mysql_query($allSsb);
$allRows=mysql_num_rows($ssb);

?>

<div class="addData">
<div id="myDiv">
</div>
<div class="searchDiv">
<form action="searchResults.php" method="get">
Owner:<select  name="owner[]" multiple="multiple" class="owner" id="multiple"><option selected value=''>---Select Owner---</option>
<?php $allOwner="select  distinct * from webadmin where userRole='3' and status='1'";
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

Queue:<select name="queue[]" multiple="multiple" class="queue" id="multipleQueue"><option value=''>---Select Queue---</option>	<?php
		$allQueue="select distinct queue from tracking";
		$getAllQueue=mysql_query($allQueue);
	
					while($queueArr=mysql_fetch_array($getAllQueue))
				{
					?><option value="<?php echo $queueArr['queue'];?>"><?php echo $queueArr['queue'];?></option>
				<?php
				}
					?></select>
Service:<select name="service[]" multiple="multiple" class="service" id="multipleService"><option value=''>---Select Service---</option>
	<?php
		$allService="select distinct service from tracking";
		$getAllService=mysql_query($allService);
	
					while($serviceArr=mysql_fetch_array($getAllService))
				{
					?><option value="<?php echo $serviceArr['service'];?>"><?php echo $serviceArr['service'];?></option>
				<?php
				}
					?></select>
Status:<select  name="status[]" multiple="multiple"   class="status" id="multipleStatus">
<option value=''>---Select Status---</option>
		<?php  getAllStatusOption() ?>
						</select>

	First Reviewer:<select  name="firstReviewer[]" multiple="multiple" class="firstReviewer" id="multipleFirstReviewer"><option value=''>---Select First Reviewer---</option>
<?php $firReviewer="select  distinct firstReviewer from tracking ";
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
		</select>

Second Reviewer:<select    name="secondReviewer[]" multiple="multiple" class="secondReviewer" id="multipleSecondReviewer"><option value=''>---Select Second Reviewer---</option>
<?php $secReviewer="select  distinct secondReviewer from tracking ";
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
		</select>

		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			  
			
			
			<script>
			function displayVals() {
			  
			  var multipleValues = $( "#multiple" ).val() || [];
			  $( ".data" ).html( "  " + multipleValues.join( ", " ) );
			}
			$( "select" ).change( displayVals );
			displayVals();
		</script>
			<script>

	function showTime(status)
		{
	//	alert("showTimeDiv"+status);
			document.getElementById("showTimeDiv"+status).style.display="block";
		}
	
	function hideTime(status)
		{
			document.getElementById("showTimeDiv"+status).style.display="none";
		}
</script>
<style>
	.timeAdded{
	display:none;
	position:absolute;
	background:#fff;
	border:3px;
	border-radius:3px;
	box-shadow: 0 0 10px #000;
	padding:5px;



	}
</style>
		
<input type="submit" value="Search">
</form>
<a href="addTracking.php"><img src="images/reload.png" class="reload" height="30" width="30"></a>
</div>
<span class="rowsFound" >Total <b><?php echo $allRows; ?></b> Rows Found</span><div class="ownersData"><span class="data"></span></div>

<?php
function getBusinessDays($date1, $date2){

    if(!is_numeric($date1)){
        $date1 = strtotime($date1);
    }

    if(!is_numeric($date2)){
        $date2 = strtotime($date2);
    }

    if($date2 < $date1){
        $temp_date = $date1;
        $date1 = $date2;
        $date2 = $temp_date;
        unset($temp_date);
    }

    $diff = $date2 - $date1;

    $days_diff = intval($diff / (3600 * 24));
    $current_day_of_week = intval(date("N", $date1));
    $business_days = 0;

    for($i = 1; $i <= $days_diff; $i++){
        if(!in_array($current_day_of_week, array("Sunday" => 7, "Saturday" => 6))){
            $business_days++;
        }

        $current_day_of_week++;
        if($current_day_of_week > 7){
            $current_day_of_week = 1;
        }
    }

    return $business_days+1;
}

?>
<div class="ContentData">

<form action="insertTracking.php"  method="post">
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>Sr. No.</th><th>E</th><th >SSB-ID</th><th>Customer Subscription Name</th><th>Queue</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th>Pages</th><th>Status</th><th>Owner</th><th>First Reviewer</th><th>Second Reviewer</th><th>Action</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
	?>
<tr  onmouseover="getNotes(<?php echo $ssbArr['trackID'];?>)"    class='<?php echo $class; ?>' ><td><b><?php echo $x;?></b></td><td><?php

$startDay=$ssbArr['startDate']; 

$beginday=date($startDay);
$lastday=date("Y-m-d");

//$getDateDiff=mysql_query("SELECT DATEDIFF(now(),'$startDay') AS DiffDate"); 
//$arrDate=mysql_fetch_assoc($getDateDiff);
//echo $arrDate['DiffDate']+1;

/*$beginday=date($startDay);
$lastday=date("Y-m-d");
//echo $lastday;
$nr_work_days = getWorkingDays($beginday,$lastday);
echo $nr_work_days;*/

if ($beginday != $lastday)
	echo getBusinessDays($beginday, $lastday);
else 
	  echo 1;

?></td><td><?php echo $ssbArr['ssbID'];?>
<?php $queryStat = "SELECT * FROM openssbtime WHERE ssbID = '{$ssbArr['ssbID']}' and owner='{$ssbArr['owner']}'";
					
$resultStat = mysql_query($queryStat);
if(mysql_num_rows($resultStat) == 0) 
	{?> 
			<img src="images/addTime.png" height="12px" width="12px" onmouseover="showTime(<?php echo $x; ?>)" onmouseout="hideTime(<?php echo $x; ?>)">
	<?php }
	else
	{
	}

?><div id="showTimeDiv<?php echo $x; ?>" style="display:none;position:absolute" class="timeAdded">
	Time Not Added Yet
</div>
</td><td><?php echo $ssbArr['custSubName'];?></td>
		<td><?php echo $ssbArr['queue'];?></td><td><?php echo  date("d-M-Y", strtotime($ssbArr['startDate']));?></td>	
		<td><?php echo  date("d-M-Y", strtotime($ssbArr['dueDate']));?></td><td><?php echo $ssbArr['service'];?></td>
		<td><a href="<?php echo $ssbArr['migrateUrl'];?>" target="_blank"><?php echo $ssbArr['migrateUrl'];?></a>
		
			<?php if($ssbArr['notes'] !='' || $ssbArr['notes'] != null || $ssbArr['comments'] !='' || $ssbArr['comments'] != null)
	{
			?>
		<div class="notes" id="notes<?php echo $ssbArr['trackID'];?>" style="display:none">
		
		<p>	<?php echo $ssbArr['notes'];?></p>
			<p>	<?php echo $ssbArr['comments'];?></p>
																																																											
		</div>
	<?php } else {}
		?>
		
		</td>
				<td><?php echo $ssbArr['pages'];?></td><td class="<?php  echo str_replace('>','',str_replace('.','',str_replace(' ', '-',$ssbArr['status'])));?>" id="status<?php echo $ssbArr['trackID'];?>" >
				<select   class='<?php echo $class; ?> <?php  echo str_replace('>','',str_replace('.','',str_replace(' ', '-',$ssbArr['status'])));?>' id="status<?php echo $ssbArr['trackID'];?><?php echo $ssbArr['trackID']."stat";?>"  onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,1)">
						<option value="<?php echo $ssbArr['status'];?>"><?php echo $ssbArr['status'];?></option>
							<?php  getAllStatusOption() ?>
							<?php if($ssbArr['status'] == 'Blocked')
	{
			if($ssbArr['blockedMailSent'] == '1')
		{?>
							<input type="checkbox" name="mailSent" checked onclick="mailSentSsb(this.value,<?php echo $ssbArr['trackID'];?>)" />Mail Sent

		<?php }
		else
		{
			?>
			<input type="checkbox" name="mailSent" onclick="mailSentSsb(this.value,<?php echo $ssbArr['trackID'];?>)" />
	<?php }
	}?>	
							
				</select></td>
		<td  >
		<?php
		$allUser="select  * from webadmin where userRole='3' and status='1'";
		$getAllUser=mysql_query($allUser);
		?>
		<select  class='<?php echo $class; ?>'   onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,2)" >
			<option value="<?php echo $ssbArr['owner'];?>">
			<?php
						 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ssbArr[owner]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerName = $ownerArr['name'];?>

			
			
			<?php echo $ownerName;?></option>
				<?php
					while($userArr=mysql_fetch_array($getAllUser))
				{
					?><option value="<?php echo $userArr['adminID'];?>"><?php echo $userArr['name'];?></option>
				<?php
				}
					?>
		</select>
		</td>
		<td>	<?php
		$allReviewer1="select  * from webadmin where (userRole='2' or userRole='1') and status='1'";
		$getAllReviewer1=mysql_query($allReviewer1);
		?>
		<select class='<?php echo $class; ?>'    onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,3)" >
			<option value="<?php echo $ssbArr['firstReviewer'];?>">
			 <?php $getFRName=mysql_query("select * from webadmin where adminID ='$ssbArr[firstReviewer]'");
						$firstRArr=mysql_fetch_array($getFRName);
						$firstRName = $firstRArr['name'];?>

			<?php echo $firstRName;?></option>
			
				<?php
					while($reviewerArr1=mysql_fetch_array($getAllReviewer1))
				{
					?><option value="<?php echo $reviewerArr1['adminID'];?>"><?php echo $reviewerArr1['name'];?></option>
				<?php
				}
					?>
		</select></td>
		<td ><?php
		$allReviewer2="select  * from webadmin where (userRole='2' or userRole='1') and status='1'";
		$getAllReviewer2=mysql_query($allReviewer2);
		?>
		<select  class='<?php echo $class; ?>'   onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,4)" >
			<option value="<?php echo $ssbArr['secondReviewer'];?>">
			<?php $getSRName=mysql_query("select * from webadmin where adminID ='$ssbArr[secondReviewer]'");
						$secondRArr=mysql_fetch_array($getSRName);
						$secondRName = $secondRArr['name'];?>

			
			<?php echo $secondRName;?></option>
				<?php
					while($reviewerArr2=mysql_fetch_array($getAllReviewer2))
				{
					?><option value="<?php echo $reviewerArr2['adminID'];?>"><?php echo $reviewerArr2['name'];?></option>
				<?php
				}
					?>
		</select></td>
		<td> <a href="getDetails.php?ssbID=<?php echo $ssbArr['ssbID'];?>">Edit   </a>|<a href="getHistory.php?trackID=<?php echo $ssbArr['trackID'];?>">   History</a> </td>
		</tr>
<?php
}?>

</table>

</form>
</div>
</div>
<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } ?>