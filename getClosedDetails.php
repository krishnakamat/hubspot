<?php

session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
				include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 	
				include_once ("Header.php");
		}

?>
<?php 
include("config.php");
$ssbID=$_GET['ssbID'];
$allSsbs="select * from closedssb where ssbID='$ssbID'";
$ssbs=mysql_query($allSsbs);
$ssbArray=mysql_fetch_array($ssbs);?>
<style>
	.editTime{
	font-size:14px;
  font-weight:bold;
}
.editTimeHead{
background-color:#9BBB59;
color:#fff;
width:800px;
}
.updateDetails {
  margin: 0 auto;
  overflow: hidden;
  padding-top:30px;
  padding-left:30px;
  font-size:13px;
}
.avgServices{
margin: 0 auto;
  overflow: hidden;
  padding-top:30px;
  padding-left:30px;
  font-size:13px;
  float:left;
  }
.avgServices td {
padding:3px;
}
.updateDetails td{
padding:3px;
}
.editTiming{
	maggin:0 auto;
	background-color:#DFEBC7;
	width:600px;
}

</style>
<script>
function updateTime(closedID)
{
	var answer = confirm("You have selected to update the given hour. Are you sure you want to continue?")
		var newValue= document.getElementById("time"+closedID).value;
		if (answer){
			location.href="updateClosedTime.php?closedID="+closedID+"&newValue="+newValue;
	//	alert(newValue);
	//	alert(closedID);
		}
	else{
		return false;
		}

	
}

</script>

<div class="updateDetails" style="float:left">
<form action="updateClosedSsb.php" name="updateQueue"  method="post">
<table>
<tr><td>SSB ID: </td><td><?php echo $ssbArray['ssbID'];?></td></tr>

<tr><td>Customer Subscription Name</td><td><?php echo $ssbArray['custSubName'];?></td></tr>

<tr><td>URL To Migrate:  </td><td><a href="<?php echo $ssbArray['migrateUrl'];?>" target="_blank"><?php echo $ssbArray['migrateUrl'];?></a></td></tr>

<tr><td>Portal Link</td><td><a href="<?php echo $ssbArray['portalLoginLink'];?>" target="_blank"><?php echo $ssbArray['portalLoginLink'];?></a></td></tr>

<tr><td>Blog URL</td><td><a href="<?php echo $ssbArray['blogUrl'];?>" target="_blank"><?php echo $ssbArray['blogUrl'];?></a></td></tr>
<tr><td>Comments: </td><td><textarea name="comments"><?php echo $ssbArray['comments'];?></textarea><td></tr>
<tr><td>Status: </td><td><select name="status">
						<option value="<?php echo $ssbArray['status'];?>"><?php echo $ssbArray['status'];?></option>
						<option value="Started">Started</option>
						<option value="Not Started">Not Started</option>
						<option value="In Progress">In Progress</option>
						<option value="Closed">Closed</option>
						<option value="Ready For Review">Ready For Review</option>
						<option value="First Rev. Issues Sent">First Rev. Issues Sent</option>
						<option value="First Review Done">First Review Done</option>
						<option value="Second Review Done">Second Review Done</option>
						<option value="Second Rev. Issues Sent">Second Rev. Issues Sent</option>						
						<option value="Ready To Close">Ready To Close</option>
						<option value="Blocked" >Blocked</option>		
		</select><td></tr>
<tr><td>Owner:</td><td> <select name="owner" >
<option value="<?php echo $ssbArray['owner'];?>">
	
				<?php		 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ssbArray[owner]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerName = $ownerArr['name'];?>

<?php echo $ownerName;?></option>
	<?php
					$allUser="select  * from webadmin where userRole = 2 and status = 1";
					$getAllUser=mysql_query($allUser);
					while($userArr=mysql_fetch_array($getAllUser))
 				{
					?>
				
				<option value="<?php echo $userArr['adminID'];?>"><?php echo $userArr['name'];?></option>
				<?php
				}
					?><td></tr>
<tr><td>First Reviewer:</td><td> 	<?php
		$allReviewer1="select  * from webadmin where (userRole = 1 and status = 1) or (userRole = 2 and status = 1)";
		$getAllReviewer1=mysql_query($allReviewer1);
		?>
		<select name="firstReviewer" onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,3)" >
			<option value="<?php echo $ssbArray['firstReviewer'];?>">
			
			 <?php $getFRName=mysql_query("select * from webadmin where adminID ='$ssbArray[firstReviewer]'");
						$firstRArr=mysql_fetch_array($getFRName);
						$firstRName = $firstRArr['name'];?>

			<?php echo $firstRName;?></option>
				<?php
					while($reviewerArr1=mysql_fetch_array($getAllReviewer1))
				{?>
					

					<option value="<?php echo $reviewerArr1['adminID'];?>"><?php echo $reviewerArr1['name'];?></option>
				<?php
				}
					?>
		</select><td></tr>
		<tr><td>Queue: </td><td>

		<select name="queue" ><option value="<?php echo $ssbArray['queue']; ?>"><?php echo $ssbArray['queue']; ?></option>
				<?php $getQueue="select distinct queue from tracking";
		$queueQuery=mysql_query($getQueue);
		while($queueArr=mysql_fetch_array($queueQuery))
		{?>
			<option value="<?php echo $queueArr['queue']; ?>"><?php echo $queueArr['queue']; ?></option>
<?php
		}
		?>
		</select>

<tr><td>Second Reviewer: </td><td><?php
		$allReviewer2="select  * from webadmin where (userRole = 1 and status = 1) or (userRole = 2 and status = 1)";
		$getAllReviewer2=mysql_query($allReviewer2);
		?>
		<select name="secondReviewer"     onchange="updateOwner(this.value,<?php echo $ssbArray['trackID'];?>,4)" >
			<option value="<?php echo $ssbArray['secondReviewer'];?>">
			
			<?php	$getSRName=mysql_query("select * from webadmin where adminID ='$ssbArray[secondReviewer]'");
						$secondRArr=mysql_fetch_array($getSRName);
						$secondRName = $secondRArr['name']; ?>

			<?php echo $secondRName;?></option>
				<?php
					while($reviewerArr2=mysql_fetch_array($getAllReviewer2))
				{
				

					?><option value="<?php echo $reviewerArr2['adminID'];?>"><?php echo $reviewerArr2['name'];?></option>
				<?php
				}
					?>
		</select><td></tr>
<tr><td>Notes: </td><td><textarea name="notes"><?php echo $ssbArray['notes'];?></textarea></td></tr>

<tr><td></td></tr>
<?php //Get previous owners
			$prevOwner=mysql_query("select * from openssbtime where ssbID='$ssbID'");
			if(mysql_num_rows($prevOwner ) >0){
			while($getOwner=mysql_fetch_array($prevOwner))
			{?>
					<?php $getOwnerName=mysql_query("select * from webadmin where adminID='$getOwner[owner]'");
									$ownerNameArr=mysql_fetch_assoc($getOwnerName);?>
					<tr>
					<td><label><?php echo $ownerNameArr['name']; ?></label></td>
					
					<td><label><?php echo $getOwner['timeTaken']; ?>&nbsp;Hrs.</label></td>
					</tr>		
			<?php
			}
			}else {}
?>
<input type="hidden" value="<?php echo $ssbArray['custSubName']; ?>" name="custSubName">
<input type="hidden" value="<?php echo $ssbArray['startDate']; ?>" name="startDate">
<input type="hidden" value="<?php echo $ssbArray['dueDate']; ?>" name="dueDate">
<input type="hidden" value="<?php echo $ssbArray['service']; ?>" name="service">
<input type="hidden" value="<?php echo $ssbArray['migrateUrl']; ?>" name="migrateUrl">
<input type="hidden" value="<?php echo $ssbArray['blogUrl']; ?>" name="blogUrl">
<input type="hidden" value="<?php echo $ssbArray['pages']; ?>" name="pages">
<input type="hidden" value="<?php echo $ssbArray['portalLoginLink']; ?>" name="portalLoginLink">

<input type="hidden" value="<?php echo $ssbArray['ssbID']; ?>" name="ssbID">
</table>
<table>

</table>
<div class="editTiming">

<table class="editTiming" >
<tr><td colspan="3" class="editTime editTimeHead">Edit Employee Timing</td></tr>
<tr  class="editTime"><td >Owner</td><td>Time Taken</td><td> Action</td></tr>


<?php //Get previous owners for entering hours
			$prevOwner1=mysql_query("select * from closedssb where ssbID='$ssbID'");
		
			if(mysql_num_rows($prevOwner1 ) >0){
			while($getOwner1=mysql_fetch_array($prevOwner1))
			{?>
									<?php $getOwnerName1=mysql_query("select *   from webadmin where adminID='$getOwner1[owner]'");
									$ownerNameArr1=mysql_fetch_assoc($getOwnerName1);?>
		
					<tr>
					<td ><label  class="editTime" ><input type="hidden" value="<?php echo $getOwner1['owner']; ?>"  name="owners[]"> <?php echo $ownerNameArr1['name']; ?></label></td>
				
					<td><label><input type="text" onkeyup="findTotal()" id="time<?php echo $getOwner1['closedID']; ?>"  name="hours2[]" value="<?php echo $getOwner1['hours2']; ?>"  ></label></td>
					<td ><a  onclick="updateTime(<?php echo $getOwner1['closedID']; ?>)"><span style="cursor:pointer" >Update</span></a></td>
					</tr>		
			<?php
			}
			}else {}
?>

<style>

	#total {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
  border: 0 none;
  font-weight: bold;
}

</style>
<script type="text/javascript" >

function updateQueue1()
{
	var selection = confirm("You have selected to update the given Queue. Time for Owners will not be updated. Are you Sure to make changes?");
		if (selection){
			document.forms["updateQueue"].submit();
		}
}</script>
<tr><td><a onclick='updateQueue1();return false;' href="#" > Update Data</a></td><td>
<?php
	$totalTime=mysql_query("select sum(timeTaken) as total from openssbtime where ssbID='$ssbID'");
	$timeTaken=mysql_fetch_assoc($totalTime);
		 $timeTaken['total'];
	?>

<b>Total </b> <input type="text" name="total" id="total" value="<?php echo $timeTaken['total']; ?>"/></td></tr>
</table>
</div>
 <script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByName('hours2[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value = tot;
}

    </script>
</form>
</div>
</div>
<?php
if(($ssbArray['service']=='First-Time Template Setup') || ( $ssbArray['service']=='Template Setup'))
{
	?>
<div class="avgServices"  >
<?php $month=date('m'); 
	$year=date('Y');
	$day=date('d');
	?>
<?php
$getServiceTime="select distinct count(ssbID) as numberServices ,sum(hours2) as hoursTime from closedssb where ((service='First-Time Template Setup' || service='Template Setup' ) and (MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year'))";
$runQuery=mysql_query($getServiceTime);
$totalTime=mysql_fetch_assoc($runQuery);
?>

<table class="editTiming" >
<tr><td colspan="3" class="editTime editTimeHead">Average First-Time Template Setup & Template Setup</td></tr>
<tr  class="editTime"><td >Total Templates</td><td style="font-weight:normal"><?php echo  $totalTime['numberServices']; ?></td></tr>

<tr  class="editTime"><td >Total Time</td><td style="font-weight:normal"> <?php echo  $totalTime['hoursTime']. " Hrs";?></td></tr>

<tr  class="editTime"><td > Average Time</td><td style="font-weight:normal"><?php echo $totalTime['hoursTime']/$totalTime['numberServices'] ." Hrs"; ?></td></tr>
</table>


</div>
<?php } else {} ?>
<?php include("Footer.php"); ?>