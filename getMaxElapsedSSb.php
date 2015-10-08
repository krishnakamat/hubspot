<?php

		session_start();
		if(!isset($_SESSION['loggedIn']))
		{
		echo "<script>location.href='index.php';</script>";
		}
						elseif($_SESSION['type']=='2'){
							include_once ("Header.php");
						}
						else{
							include_once ("HeaderAdmin.php");
}
		
?>


	<?php include("function.php");?>
	<?php 	if($_SESSION['type']=='1'){?>
<?php
include("config.php");
	 $days = $_GET['days']; 
					
				$numDaysBack=date("Y-m-d", strtotime("- $days days"));
		if(isset($_REQUEST['firstReviewer']))
	{
			//echo $_REQUEST['firstReviewer'];
	$firstReviewer=$_REQUEST['firstReviewer'];
	$allSsb="Select * from tracking where (status !='Blocked') and startDate    <  '$numDaysBack' and firstReviewer='$firstReviewer' order by startDate ";
		}
	else
	{
			$allSsb="Select * from tracking where (status !='Blocked') and startDate    <  '$numDaysBack' order by startDate ";

		//echo "Select *,count(ssbID) as allSsb from tracking where (status !='CMS->COS Template Done' and status !='Not Started') and startDate    <  '$numDaysBack' order by startDate ";
	}
$ssb=mysql_query($allSsb);
$allRows=mysql_num_rows($ssb);

?>

<div class="addData">
<div id="myDiv">
</div>
<div class="searchaDiv">
<form action="searchResults.php" method="get">








		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			  
			<script>
			function getNotes(noteID)
		{

				var elems = document.getElementsByClassName('notes');
					for(var i = 0; i < elems.length; i++) {
						elems[i].style.display = 'none';
					}

				//alert(noteID);
				document.getElementById("notes"+noteID).style.display="block";
		}
		</script>
			
			<script>
			function displayVals() {
			  
			  var multipleValues = $( "#multiple" ).html();
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
<script>
	function mailSentSsb( value,trackID)
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
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","sendBlockedMail.php?trackID="+trackID,true);
xmlhttp.send();
		}
</script>


</form>
</div>
<span class="rowsFound" >Total <b><?php echo $allRows; ?></b> Rows Found</span><div class="ownersData"><span class="data"></span></div>

<div class="ContentData">

<form action="insertTracking.php"  method="post">
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th class="serial">Sr. No.</th><th class="elapsed">E</th><th >SSB-ID</th><th class="custsubname">Customer Subscription Name</th><th>Queue</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th class="pages">Pages</th><th>Status</th><th class="owner-data" >Owner</th><th>First Reviewer</th><th>Second Reviewer</th><th>Action</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
	?>
<tr onmouseover="getNotes(<?php echo $ssbArr['trackID'];?>)" class='<?php echo $class; ?>' ><td class="serial"><b><?php echo $x;?></b></td><td  class="elapsed"><?php

$startDay=$ssbArr['startDate']; 
$getDateDiff=mysql_query("SELECT DATEDIFF(now(),'$startDay') AS DiffDate"); 
$arrDate=mysql_fetch_assoc($getDateDiff);
echo $arrDate['DiffDate']+1;



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
</td><td  class="custsubname"><?php echo $ssbArr['custSubName'];?></td>
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
				<td ><?php echo $ssbArr['pages'];?></td><td  class="<?php  echo str_replace('>','',str_replace('.','',str_replace(' ', '-',$ssbArr['status'])));?>" id="status<?php echo $ssbArr['trackID'];?>" >
				<select   class='<?php echo $class; ?> <?php  echo str_replace('>','',str_replace('.','',str_replace(' ', '-',$ssbArr['status'])));?>'  id="status<?php echo $ssbArr['trackID'];?><?php echo $ssbArr['trackID']."stat";?>"  onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,1)">
						<option value="<?php echo $ssbArr['status'];?>"><?php echo $ssbArr['status'];?></option>
							<?php  getAllStatusOption() ?>
				</select>
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
				
				</td>
		<td class="statuses"   >
		<?php
		$allUser="select  * from webadmin where type='2'";
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
		$allReviewer1="select  * from webadmin where type='1'";
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
		$allReviewer2="select  * from webadmin where type='1'";
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