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

?>
<head>
<!--<meta http-equiv="refresh" content="30">-->
</head>
<style>
.sortable{width:100%;
}
</style>	

 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 

   <script type="text/javascript">
       $(function() {
               $("#startdate").datepicker({ dateFormat: "yy-mm-dd" }).val()
               $("#enddate").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });

   </script>  
<?php include("function.php");?>
	<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
		<?php $today=date("Y-m-d");
		$month=$_GET['mon'];

		$year=$_GET['year'];
		if(!isset($month) || !isset($year))
	{
			$month=date("m");
			$year=date("Y");
	}

		?>

<?php
include("config.php");

$allSsb="select *,sum(hours2) as hours,max(closedID) as maxID,count(closedID) as totaloccurence from closedssb where status ='Closed' and MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year' and isManual='1' group by ssbID,closedOn order by closedOn desc";

/*$allSsb="select
    a.*,sum(hours2) as hours
from
    closedssb a
    inner join 
        (select owner, max(closedID) as maxid from closedssb group by ssbID) as b on
        a.closedID = b.maxid";*/

$ssb=mysql_query($allSsb);
?>


<div class="addData">
<div id="myDiv">
</div>
<!--<div class="searchDiv">
<form action="searchClosedResults.php" method="get">
Owner:<select  name="owner[]" multiple="multiple" class="owner" id="multiple"><option  value=''>---Select Owner---</option>
<?php $allOwner="select  distinct * from webadmin where userRole = 3 and status = 1";
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

Queue:<select name="queue"><option value=''>---Select Queue---</option>	<?php
		$allQueue="select distinct queue from tracking";
		$getAllQueue=mysql_query($allQueue);
	
					while($queueArr=mysql_fetch_array($getAllQueue))
				{
					?><option value="<?php echo $queueArr['queue'];?>"><?php echo $queueArr['queue'];?></option>
				<?php
				}
					?></select>
Service:<select name="service"><option value=''>---Select Service---</option>
	<?php
		$allService="select distinct service from tracking";
		$getAllService=mysql_query($allService);
	
					while($serviceArr=mysql_fetch_array($getAllService))
				{
					?><option value="<?php echo $serviceArr['service'];?>"><?php echo $serviceArr['service'];?></option>
				<?php
				}
					?></select>
Status:<select name="status">
<option value=''>---Select Status---</option>
	<option value="Started">Started</option>
						<option value="Not Started">Not Started</option>
						<option value="In Progress">In Progress</option>
						<option value="Closed">Closed</option>
						<option value="Ready For Review">Ready For Review</option>
						<option value="First Rev. Issues Sent">First Rev. Issues Sent</option>
						<option value="First Review Done">First Review Done</option>
						<option value="Second Rev. Issues Sent">Second Rev. Issues Sent</option>
						<option value="Second Review Done">Second Review Done</option>
						<option value="Ready To Close">Ready To Close</option>
						<option value="Blocked">Blocked</option>
						</select>

	First Reviewer:<select  name="firstReviewer"><option value=''>---Select First Reviewer---</option>
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
			<?php	}
					?>
		</select>


		Start Date: <input type='text' name="date1" id="startdate" >
		End Date: <input type="text" name="date2" id="enddate" >
			
			
			<script>
			function displayVals() {
			  
			  var multipleValues = $( "#multiple" ).val() || [];
			  $( ".data" ).html( " <b>Owner:</b> " + multipleValues.join( ", " ) );
			}
			$( "select" ).change( displayVals );
			displayVals();
		</script>
		
<input type="submit" value="Search">
</form>
<div class="ownersData"><span class="data"></span></div>
</div>-->
<p style="clear:both"><?php echo "Total ". mysql_num_rows($ssb)." Rows Found";?>
<br/>
<?php
$getMonthYear="select distinct MONTH(closedOn) as month, YEAR (closedOn) as year from closedssb where isManual='1' order by closedOn";
$monthYear=mysql_query($getMonthYear);
while($monthYearVal=mysql_fetch_array($monthYear))
	{?>
		<a href="allManual.php?mon=<?php echo $monthYearVal['month']; ?>&year=<?php echo $monthYearVal['year']; ?>"><span><?php echo $monthYearVal['month']." - ".$monthYearVal['year']; ?></span></a>
	<?php }

?>


</p>
<div class="ContentData">
<p style="clear:both"></p>

<form action="insertTracking.php"  method="get">
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>Sr. No.</th><th >SSB-ID</th><th>Customer Subscription Name</th><th>Queue</th><th>Service</th><th>URL To Migrate</th><th>Pages</th><!--<th>Owner</th>--><th>Hours 2</th><th>Added On</td></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
	?>
<tr  class='<?php echo $class; ?>' ><td><b><?php echo $x;?></b></td><td><?php echo $ssbArr['ssbID'];?></td><td><?php echo $ssbArr['custSubName'];?></td>
		<td><?php echo $ssbArr['queue'];?></td>
		<td><?php echo $ssbArr['service'];?></td>
		<td><?php echo $ssbArr['migrateUrl'];?></td>
				<td><?php echo $ssbArr['pages'];?></td>
			
	<!--<td  >
		
		<?php 
						$ownID=$ssbArr['maxID'];
					 	$totaloccurence=$ssbArr['totaloccurence'];
								if($totaloccurence >1)
									{
										$ownID=$ownID-1;
									}
									else { 		
										$ownID=$ownID;
									}

	//	echo $ownID;

						$ownerHere=mysql_query("select owner from closedssb where closedID='$ownID'");
						$ownerArr=mysql_fetch_assoc($ownerHere);


						 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ownerArr[owner]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerName = $ownerArr['name'];?>

			
			
			<?php echo $ownerName;?>
		</td>-->
		<td ><?php  echo $ssbArr['hours'];
	 
		
		?></td><td ><?php  echo $ssbArr['closedOn'];
	 
		
		?></td>
		</tr>
<?php
$var += $ssbArr['hours'];
		
}
echo "<b>Total ".$var. " Hours</b>";?>
</table>

</form>
</div>
</div>
<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } ?>