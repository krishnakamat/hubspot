<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
include("config.php");
include("function.php");
$target=$_GET['target'];
//$adminID=$_GET['adminID'];
$getPriority = "select * from tracking where target = '$target'";
$resultPriority = mysql_query($getPriority);
//$rowPriority = mysql_fetch_assoc($resultPriority);

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

<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th class="elapsed">E</th><th >SSB-ID</th><th class="custsubname">Customer Subscription Name</th><th>Queue</th><th>Service</th>	<?php // if($_SESSION['adminID']=='18' || $_SESSION['adminID']=='19'){ ?><th>Due Date</th><?php// } ?><th>URL To Migrate</th><th class="pages">Pages</th><th>Status</th><th class="owner-data">Owner</th><th>First Reviewer</th><th>Second Reviewer</th>
<?php  if($_SESSION['userRole']==1){ ?>
<th>Priority</th>
<?php } ?>
<th>Action</th></tr></thead>
<?php
$x=0;
while($rowPriority=mysql_fetch_array($resultPriority))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';

?>
<tr onmouseover="getNotes(<?php echo $rowPriority['trackID'];?>)"   class='<?php echo $class; ?>' id='<?php echo $rowPriority['trackID']; ?>' <?php if($rowPriority['target']==1){ echo "style='background-color:#BFBF19;'";} ?>>
<td>
<?php
  $today=date('Y-m-d');

//if(!empty($today)){
	//$startDay = "$today";
//}else{
    $startDay=$rowPriority['startDate']; 
//}

$getDateDiff=mysql_query("SELECT DATEDIFF(now(),'$startDay') AS DiffDate"); 
//echo "<br/>";
$arrDate=mysql_fetch_assoc($getDateDiff);
//echo "<br/>";
//echo $arrDate['DiffDate']+1;

 $beginday=date($startDay);
//echo "<br/>";

$lastday=date("Y-m-d");
//echo "<br/>";
/*echo $beginday;
echo "<br/>";
echo $lastday;*/

//echo getBusinessDays($beginday, $lastday);

//echo "Business days: " . getBusinessDays("11/10/2014", "11/10/2014");

if ($beginday != $lastday)
	echo $numOfDays = getBusinessDays($beginday, $lastday);
else 
	  echo $numOfDays = 1;
//echo $numOfDays ;
/*$beginday=date($startDay);
$lastday=date("Y-m-d");
//echo $lastday;
$nr_work_days = getWorkingDays($beginday,$lastday);
echo $nr_work_days;*/

?></td><td>

<?php echo $rowPriority['ssbID'];?>

<?php $queryStat = "SELECT * FROM openssbtime WHERE ssbID = '{$rowPriority['ssbID']}' and owner='{$rowPriority['owner']}'";
					
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
</td><td class="custsubname"><?php echo $rowPriority['custSubName'];?></td>
		<td><?php echo $rowPriority['queue'];?></td><td><?php echo $rowPriority['service'];?></td><?php //if($_SESSION['adminID']=='18' || $_SESSION['adminID']=='19'){ ?><td><?php echo date("d-M-Y",strtotime($rowPriority['dueDate']));?></td><?php// } ?>
		<td><a href="<?php echo $rowPriority['migrateUrl'];?>" target="_blank"><?php echo $rowPriority['migrateUrl'];?></a>
		
			<?php if($rowPriority['notes'] !='' || $rowPriority['notes'] != null || $rowPriority['comments'] !='' || $rowPriority['comments'] != null)
	{
			?>
		<div class="notes" id="notes<?php echo $rowPriority['trackID'];?>" style="display:none">
		
		<p>	<?php echo $rowPriority['notes'];?></p>
			<p>	<?php echo $rowPriority['comments'];?></p>
																																																											
		</div>
	<?php } else {}
		?>
		
		</td>
				<td><?php echo $rowPriority['pages'];?></td><td class="<?php  echo str_replace('>','',str_replace('.','',str_replace(' ', '-',$rowPriority['status'])));?>" id="status<?php echo $rowPriority['trackID'];?>" >
				<select   style='border: medium none;' class='<?php echo $class; ?> <?php  echo str_replace('>','',str_replace('.','',str_replace(' ', '-',$rowPriority['status'])));?>' id="status<?php echo $rowPriority['trackID'];?><?php echo $rowPriority['trackID']."stat";?>"  onchange="updateOwner(this.value,<?php echo $rowPriority['trackID'];?>,1)">
						<option value="<?php echo $rowPriority['status'];?>"><?php echo $rowPriority['status'];?></option>
							<?php  getAllStatusOption() ?>
							<?php if($rowPriority['status'] == 'Blocked')
	{
			if($rowPriority['blockedMailSent'] == '1')
		{?>
							<input type="checkbox" name="mailSent" checked onclick="mailSentSsb(this.value,<?php echo $rowPriority['trackID'];?>)" />Mail Sent

		<?php }
		else
		{
			?>
			<input type="checkbox" name="mailSent" onclick="mailSentSsb(this.value,<?php echo $rowPriority['trackID'];?>)" />
	<?php }
	}?>
				
							
				</select></td>
		<td  >
		<?php
		$allUser="select  * from webadmin where userRole = 3 and status = 1 and employeeType = 1 order by name";
		$getAllUser=mysql_query($allUser);
		?>
		<select  style='border: medium none;'  class='<?php echo $class; ?>'  onchange="updateOwner(this.value,<?php echo $rowPriority['trackID'];?>,2)" >
			<option value="<?php echo $rowPriority['owner'];?>">
			<?php
						 $getOwnerName=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$rowPriority[owner]'");
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
		$allReviewer1="select  * from webadmin where (userRole=1 or userRole = 2) and status = 1 and employeeType = 1 order by name";
		$getAllReviewer1=mysql_query($allReviewer1);
		?>
		<select  style='border: medium none;'  class='<?php echo $class; ?>' onchange="updateOwner(this.value,<?php echo $rowPriority['trackID'];?>,3)" >
		<option value="<?php echo $rowPriority['firstReviewer'];?>">
			 <?php $getFRName=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$rowPriority[firstReviewer]'");
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
		$allReviewer2="select  * from webadmin where (userRole=1 or userRole = 2) and status = 1 and employeeType = 1 order by name";
		$getAllReviewer2=mysql_query($allReviewer2);
		?>
		<select   style='border: medium none;' class='<?php echo $class; ?>' onchange="updateOwner(this.value,<?php echo $rowPriority['trackID'];?>,4)" >
		<option value="<?php echo $rowPriority['secondReviewer'];?>">
			<?php $getSRName=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$rowPriority[secondReviewer]'");
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
<?php  if($_SESSION['userRole']==1){ ?>

		<td>
<input type="checkbox" name="ssbIDCheck" id="ssbIDChk<?php echo $rowPriority['trackID'];?>" <?php if($rowPriority['target']==1){ echo "checked";} ?> onclick="ssbIDChecks(<?php echo $rowPriority['trackID'];?>)">
		</td>
		<?php } ?>

<td>  <a href="getDetails.php?ssbID=<?php echo $rowPriority['ssbID'];?>">Edit   </a>|<a href="getHistory.php?trackID=<?php echo $rowPriority['trackID'];?>">   History</a> </td>
		</tr>
<?php
}?>

</table>
