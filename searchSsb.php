<?php


session_start();
if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}	
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1)|| ($_SESSION['userRole']==2 && $_SESSION['status']==1) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}
?>
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


	
	<?php include("function.php");?>
	<div class="addData">
<div id="myDiv">
</div>

 <?php/*
$page = "searchResults.php?queue=$queue&service=$service&status=$status&owner=$owner&firstReviewer=$firstReviewer&secondReviewer=$secondReviewer&owners=$owner&sevices=$service";
 $sec = "10";
 header("Refresh: $sec; url=$page");*/
?>
<div class="searchDiv">
   
<form action="searchResults.php" method="get"><input type="hidden" value="<?php  echo $owner2; ?>" name="owners" id="owners"><input type="hidden" value="<?php  echo $service2; ?>" id="services" name="services"><input type="hidden" value="<?php  echo $status2; ?>" id="statuses" name="statuses"><input type="hidden" value="<?php  echo $queue2; ?>" id="queues" name="queues"><input type="hidden" value="<?php  echo $firstReviewer2; ?>" id="firstReviewers" name="firstReviewers"><input type="hidden" value="<?php  echo $secondReviewer2; ?>" id="secondReviewers" name="secondReviewers">
Owner:<select  name="owner[]" multiple="multiple" class="owner" id="multiple"><option class="blank" value=''>---Select Owner---</option><option value='Not Assigned'>Not Assigned</option>
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
Queue:<select name="queue[]" multiple="multiple" class="queue" id="multipleQueue">
<option value="" class="blank">---Select Queue---</option><?php
		$allQueue="select distinct queue from tracking";
		$getAllQueue=mysql_query($allQueue);
	
					while($queueArr=mysql_fetch_array($getAllQueue))
				{
					?><option value="<?php echo $queueArr['queue'];?>"><?php echo $queueArr['queue'];?></option>
				<?php
				}
					?></select>
Service:<select name="service[]" multiple="multiple" class="service" id="multipleService">
	<option value="" class="blank">---Select Services---</option><?php
		$allService="select distinct service from tracking";
		$getAllService=mysql_query($allService);
	
					while($serviceArr=mysql_fetch_array($getAllService))
				{
					?><option value="<?php echo $serviceArr['service'];?>"><?php echo $serviceArr['service'];?></option>
				<?php
				}
					?></select>
Status:<select  name="status[]" multiple="multiple"  class="status" id="multipleStatus">
<option value="" class="blank">---Select Status---</option>
	<?php  getAllStatusOption() ?>
	</select>

First Reviewer:<select    name="firstReviewer[]" multiple="multiple" class="firstReviewer" id="multipleFirstReviewer"><option value="" class="blank">---Select First Reviewer---</option>
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

					<?php echo $firstRName1;?>
</option>
				<?php
				}
					?>
		</select>

Second Reviewer:<select  name="secondReviewer[]" multiple="multiple" class="secondReviewer" id="multipleSecondReviewer"><option value="" class="blank">---Select Second Reviewer---</option>
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


					<?php echo $secondRName1;?>

</option>
				<?php
				}
					?>
		</select>
		<button class="reset" onclick="return false">Clear</button>

<?php $firstService= $_REQUEST['service'][0];
$secondService=$_REQUEST['service'][1];
$thirdService=$_REQUEST['service'][2];
$fourthService=$_REQUEST['service'][3];
$fifthService=$_REQUEST['service'][4];
$sixthService=$_REQUEST['service'][5];
$seventhService=$_REQUEST['service'][6];
?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
            $('.reset').click(function(){
               $('#multipleQueue').find('option').removeAttr("selected");
				$('#multiple').find('option').removeAttr("selected");
				$('#multipleService').find('option').removeAttr("selected");
				$('#multipleStatus').find('option').removeAttr("selected");
				$('#multipleFirstReviewer').find('option').removeAttr("selected");
				$('#multipleSecondReviewer').find('option').removeAttr("selected");
                $(' .blank').attr('selected','selected');					
            });
        });
    </script>
		<script>
//alert("hi")
var firstService='<?= $firstService ?>';
var secondService='<?= $secondService ?>';
var thirdService='<?= $thirdService ?>';
var fourthService='<?= $fourthService ?>';
var fifthService='<?= $fifthService ?>';
var sixthService='<?= $sixthService ?>';
var seventhService='<?= $seventhService ?>';
var valArr = [firstService,secondService,thirdService,fourthService,fifthService,sixthService,seventhService],
    i = 0, size = valArr.length,
    $options = $('#multipleService option');
//alert(valArr);
for(i; i < size; i++){
    $options.filter('[value="'+valArr[i]+'"]').prop('selected', true);
}
                $(' .blank').attr('selected',false);					

</script>
			  
			  <script type="text/javascript">

var toSelectQueue = "<?php echo  $queueData; ?>";
var toSelectOwner = "<?php echo  $ownerData; ?>";
var toSelectService = "<?php echo  $serviceData; ?>";
var toSelectStatus = "<?php echo  $statusData; ?>";
var toSelectFR = "<?php echo  $frData; ?>";
var toSelectSR = "<?php echo  $srData; ?>";

var selectQueue = document.getElementById('multipleQueue' );

for ( var i= 0, l = selectQueue.options.length, o; i < l; i++ )
{
  o = selectQueue.options[i];
  if ( toSelectQueue.indexOf( o.text ) != -1 )
  {
    o.selected = true;
  }
}


var selectOwner = document.getElementById('multiple' );

for ( var i= 0, l = selectOwner.options.length, o; i < l; i++ )
{
  o = selectOwner.options[i];
  if ( toSelectOwner.indexOf( o.text ) != -1 )
  {
    o.selected = true;
  }
}


var selectStatus = document.getElementById('multipleStatus' );

for ( var i= 0, l = selectStatus.options.length, o; i < l; i++ )
{
  o = selectStatus.options[i];
  if ( toSelectStatus.indexOf( o.text ) != -1 )
  {
    o.selected = true;
  }
}



var selectFR = document.getElementById('multipleFirstReviewer' );


for ( var i= 0, l = selectFR.options.length, o; i < l; i++ )
{
  o = selectFR.options[i];
  if ( toSelectFR.indexOf( o.text ) != -1 )
  {
    o.selected = true;
  }
}


var selectSR = document.getElementById('multipleSecondReviewer' );

for ( var i= 0, l = selectSR.options.length, o; i < l; i++ )
{
  o = selectSR.options[i];
  if ( toSelectSR.indexOf( o.text ) != -1 )
  {
    o.selected = true;
  }
}


</script>
			
			<script>
			function displayVals() {
			  
			$('#owners').removeAttr('value');
			  
			  var multipleValues = $( "#multiple" ).val() || [];
			  $( ".data" ).html( "  " + multipleValues.join( ", " ) );

			
			}
			
			$( ".owner" ).change( displayVals );
			displayVals();

		

			function displayValsServ() {
				
				$('#services').removeAttr('value');
				 var multipleValuesServ = $( "#multipleService" ).val() || [];
			  $( ".serviceData" ).html( " " + multipleValuesServ.join( ", " ) );
			}
			
			$( ".serviceData" ).change( displayValsServ );
			displayValsServ();

			function displayValsStat() {
				
				$('#statuses').removeAttr('value');
				 var multipleValuesStat = $( "#multipleStatus" ).val() || [];
			  $( ".statusData" ).html( " <b>Status:</b> " + multipleValuesStat.join( ", " ) );
			}
			
			$( ".statusData" ).change( displayValsStat );
			displayValsStat();

						  
		function displayValsQue() {
				
				$('#queues').removeAttr('value');
				 var multipleValuesQue = $( "#multipleQueue" ).val() || [];
			  $( ".queueData" ).html( " <b>Queue:</b> " + multipleValuesQue.join( ", " ) );
			}
			
			$( ".queueData" ).change( displayValsQue );
			displayValsQue();

			function displayValsFR() {
				
				$('#firstReviewers').removeAttr('value');
				 var multipleValuesFR = $( "#multipleFirstReviewer" ).val() || [];
			  $( ".firstReviewerData" ).html( " <b>First Rev:</b> " + multipleValuesFR.join( ", " ) );
			}
			
			$( ".firstReviewerData" ).change( displayValsFR );
			displayValsFR();

	function displayValsSR() {
				
				$('#secondReviewers').removeAttr('value');
				 var multipleValuesSR = $( "#multipleSecondReviewer" ).val() || [];
			  $( ".secondReviewerData" ).html( " <b>Sec Rev:</b> " + multipleValuesSR.join( ", " ) );
			}
			
			$( ".firstReviewerData" ).change( displayValsSR );
			displayValsSR();

		</script>


<input type="submit" value="Search">
</form>
</div>
<?php

include("config.php");
$ssbID=$_REQUEST['ssbID'];
			$allSsb="select * from tracking where ssbID='$ssbID' or custSubName like '%$ssbID%' or migrateUrl like '%$ssbID%' ";

$ssb=mysql_query($allSsb."order by startDate" );
$allRows=mysql_num_rows($ssb);

?>
<span class="rowsFound" >Total <b><?php echo $allRows; ?></b> Rows Found</span><div class="ownersData"><span class="data"></span></div>

<div class="ContentData">


<form action="insertTracking.php"  method="post"> 
<table class="sortable" border="2" ><thead><tr class="searchedSsb" style="background:#ccc;"><th class="serial">Sr. No.</th><th class="elapsed">E</th><th >SSB-ID</th><th class="custsubname">Customer Subscription Name</th><th>Queue</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th class="pages">Pages</th><th>Status</th><th class="owner-data">Owner</th><th>First Reviewer</th><th>Second Reviewer</th><th>Action</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';

?>
<tr   class='<?php echo $class; ?>'><td><b><?php echo $x;?></b></td><td><?php

$startDay=$ssbArr['startDate']; 
$getDateDiff=mysql_query("SELECT DATEDIFF(now(),'$startDay') AS DiffDate"); 
$arrDate=mysql_fetch_assoc($getDateDiff);
// echo $arrDate['DiffDate']+1;
$beginday=date($startDay);
$lastday=date("Y-m-d");
if ($beginday != $lastday)
	echo $numOfDays = getBusinessDays($beginday, $lastday);
else 
	  echo $numOfDays = 1;


?></td><td><?php echo $ssbArr['ssbID'];?></td><td class="custsubname"><?php echo $ssbArr['custSubName'];?></td>
		<td><?php echo $ssbArr['queue'];?></td><td><?php echo  date("d-M-Y", strtotime($ssbArr['startDate']));?></td>	
		<td><?php echo  date("d-M-Y", strtotime($ssbArr['dueDate']));?></td><td><?php echo $ssbArr['service'];?></td>
		<td><a href="<?php echo $ssbArr['migrateUrl'];?>" target="_blank"><?php echo $ssbArr['migrateUrl'];?></a></td>
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
		<select   class='<?php echo $class; ?>'  onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,2)" >
			<option value="<?php echo $ssbArr['owner'];?>">

	<?php
						 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ssbArr[owner]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerName = $ownerArr['name'];?>

			
			
			<?php echo $ownerName;?>

</option>
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
		$allReviewer1="select  * from webadmin where (userRole='1' or userRole='2') and status='1'";
		$getAllReviewer1=mysql_query($allReviewer1);
		?>
		<select    class='<?php echo $class; ?>' onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,3)" >
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
		$allReviewer2="select  * from webadmin where (userRole='1' or userRole='2') and status='1'";
		$getAllReviewer2=mysql_query($allReviewer2);
		?>
		<select   class='<?php echo $class; ?>' onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,4)" >
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
<td>  <a href="getDetails.php?ssbID=<?php echo $ssbArr['ssbID'];?>">Edit   </a>|<a href="getHistory.php?trackID=<?php echo $ssbArr['trackID'];?>">   History</a> </td>
		</tr>
<?php
}?>

</table>

</form>
<div>

</div>
<div>
<?php 
if($allRows=='0')
{

	$allClosedSsb="select * from closedssb where ssbID='$ssbID' or custSubName like '%$ssbID%' or migrateUrl like '%$ssbID%'  order by trackID desc";
	$allClosedSsbQuery= mysql_query($allClosedSsb);
	
	?>
	<style>
	.searchedSsb
	{
		display:none;
		}
		.rowsFound
		{
		display:none;
		}
		.closedSsbHighlight {
  background: none repeat scroll 0 0 pink;
  display: inline-block;
  font-size: 24px;
  text-align: center;
  width: 100%;
}
	</style>
	<span class="closedSsbHighlight"> This SSB is closed</span>
	<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th >SSB-ID</th><th class="custsubname">Customer Subscription Name</th><th>Queue</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th class="pages">Pages</th><th>Status</th><th class="owner-data">Owner</th><th>First Reviewer</th><th>Second Reviewer</th><th>Time</th></tr></thead>
<?php
	while($allClosedSsbArr=mysql_fetch_array($allClosedSsbQuery))
	{?>
			<tr ><td ><?php echo $allClosedSsbArr['ssbID']; ?></td><td class="custsubname"><?php echo $allClosedSsbArr['custSubName']; ?></td><td><?php echo $allClosedSsbArr['queue']; ?></td><td><?php echo $allClosedSsbArr['startDate']; ?></td><td><?php echo $allClosedSsbArr['dueDate']; ?></td><td><?php echo $allClosedSsbArr['service']; ?></td><td><?php echo $allClosedSsbArr['migrateUrl']; ?></td><td class="pages"><?php echo $allClosedSsbArr['pages']; ?></td><td><?php echo $allClosedSsbArr['status']; ?></td><td class="owner-data">
				<?php
						 $getOwnerName=mysql_query("select * from webadmin where adminID ='$allClosedSsbArr[owner]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerName = $ownerArr['name'];?>

			
			
			<?php echo $ownerName;?>
</td><td>
			<?php $getFRName=mysql_query("select * from webadmin where adminID ='$allClosedSsbArr[firstReviewer]'");
						$firstRArr=mysql_fetch_array($getFRName);
						$firstRName = $firstRArr['name'];?>

			<?php echo $firstRName;?>
			
			
			</td><td>
			<?php $getSRName=mysql_query("select * from webadmin where adminID ='$allClosedSsbArr[secondReviewer]'");
						$secondRArr=mysql_fetch_array($getSRName);
						$secondRName = $secondRArr['name'];?>
		<?php echo $secondRName;?>
			</td><td><?php echo $allClosedSsbArr['hours2']; ?></td></tr>
	<?php }
	
	?>
	</table>
		<span class="closedSsbHighlight"><?php 
	
	echo "Owner : ".$ownerName;
	?></span>

	<?php

}

?></div>

<?php include("Footer.php"); ?>