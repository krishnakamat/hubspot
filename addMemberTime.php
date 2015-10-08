<?php
		session_start();
		if(!isset($_SESSION['loggedIn']))
		echo "<script>location.href='index.php';</script>";
					if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}

?>
<?php 
include("config.php");
$ssbID=$_GET['ssbID'];
$allSsbs="select * from tracking where ssbID='$ssbID'";
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
width:600px;
}
.updateDetails {
  margin: 0 auto;
  overflow: hidden;
  padding-top:30px;
  padding-left:30px;
  font-size:13px;
}

.updateDetails td{
padding:6px;
}
.editTiming{
	maggin:0 auto;
	background-color:#DFEBC7;
	width:800px;
}

</style>
<script>
function deleteTime(openssbID)
{
	var answer = confirm("You have selected to delete the selected hour. Are you sure you want to continue?")
		
		if (answer){
			location.href="deleteMemberTime.php?openssbID="+openssbID;
		}
	else{
		return false;
		}

	
}
</script>

<div class="updateDetails">
<form action="updateMemberTime.php" method="post">
<table>
<tr><td>SSB ID: </td><td><?php echo $ssbArray['ssbID'];?></td></tr>

<tr><td>Customer Subscription Name:</td><td><?php echo $ssbArray['custSubName'];?></td></tr>

<tr><td>URL To Migrate:  </td><td><a href="<?php echo $ssbArray['migrateUrl'];?>" target="_blank"><?php echo $ssbArray['migrateUrl'];?></a></td></tr>

<tr><td>Portal Link</td><td><a href="<?php echo $ssbArray['migrateUrl'];?>" target="_blank"><?php echo $ssbArray['portalLoginLink'];?></a></td></tr>

<tr><td>Blog URL</td><td><a href="<?php echo $ssbArray['blogUrl'];?>" target="_blank"><?php echo $ssbArray['blogUrl'];?></a></td></tr>
<tr><td>Comments: </td><td><?php echo $ssbArray['comments'];?><td></tr>
<tr><td>Status: </td><td>
						<?php echo $ssbArray['status'];?><td></tr>
<tr><td>First Reviewer:</td><td> 
<?php $getFRName=mysql_query("select * from webadmin where adminID='$ssbArray[firstReviewer]'");
									$firstRNameArr=mysql_fetch_assoc($getFRName);?>


	<?php echo $firstRNameArr['name'];?></td></tr>
<tr><td>Second Reviewer: </td><td>
<?php $getSRName=mysql_query("select * from webadmin where adminID='$ssbArray[secondReviewer]'");
									$secondRNameArr=mysql_fetch_assoc($getSRName);?>
		<?php echo $secondRNameArr['name'];?></td></tr>
<tr><td>Notes: </td><td><textarea name="notes" ><?php echo $ssbArray['notes'];?></textarea></td></tr>
<tr><td>Time Taken</td><td></td></tr>
</table>



<div class="editTiming">
<table class="editTime editTiming" >
<tr><td class="editTime editTimeHead" colspan="3">Add Your Timing</td></tr>

<tr  class="editTime"><td >Owner</td><td>Time Taken</td><td> Action</td></tr>

<?php //Get previous owners
			$prevOwner=mysql_query("select * from openssbtime where ssbID='$ssbID'");
			if(mysql_num_rows($prevOwner ) >0){
			while($getOwner=mysql_fetch_array($prevOwner))
			{?>
					<tr>
					<td>
					<label>
					<?php $getOwnerName=mysql_query("select * from webadmin where adminID='$getOwner[owner]'");
									$ownerNameArr=mysql_fetch_assoc($getOwnerName);?>

					<?php   echo $ownerNameArr['name']; ?></label></td>
				
					<td><label><?php echo $getOwner['timeTaken']; ?></label></td>
					<td><a  style="text-decoration:underline;cursor:pointer"  onclick="deleteTime(<?php echo $getOwner['openssbID']; ?>)">Delete</a></td>
					</tr>		
			<?php
			}
			}else {}
?>

<?php 
$getOwnerId=mysql_query("select * from webadmin where name ='$_SESSION[name]'");
$ownerId=mysql_fetch_array($getOwnerId);


?>
<tr><td><label>
<input type='hidden' name="owner" value='<?php echo $_SESSION['adminID']; ?>'  ><?php echo $_SESSION['name']; ?>
 </label>
</td>
<td><input type="number" name="hours1"  step="0.1" min='0' value=""/><input type="hidden" value="<?php echo $ssbID; ?>" name="ssbID">
</td></tr>

<tr><td colspan="2"><input type="submit"  value="Add Detail"></td></tr>
</table>


</form>
</div>
</div>
<?php include("Footer.php"); ?>