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
<?php
/*$page = 'searchResults.php?queue=Govind Jee';
 $sec = "10";
 header("Refresh: $sec; url=$page");*/
?>
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

	
	<?php include("function.php");?>
	<div class="addData">
<div id="myDiv">
</div>



<?php 


 $allQueue=$_REQUEST['queue'];
 @$allQueue1=implode(",",$allQueue);
 $queue2=str_replace(",","' ||  queue='",$allQueue1);
 $queue=$queue2;
 if (strpos($allQueue1,',') != false) {
}else{//echo 'false';
$queue=$_REQUEST['queues'];
if($queue=='')
	{
	$queue=$allQueue1;
	}
}

 $allService=$_REQUEST['service'];
 @$allService1=implode(",",$allService);
 $service2=str_replace(",","' ||  service='",$allService1);
 $service=$service2;
 if (strpos($allService1,',') != false) {
}else{//echo 'false';
$service=$_REQUEST['services'];
if($service=='')
	{
	$service=$allService1;
	}
}



 $allStatus=$_REQUEST['status'];
 @$allStatus1=implode(",",$allStatus);
 $status2=str_replace(",","' ||  status='",$allStatus1);
 $status=$status2;
 if (strpos($allStatus1,',') != false) {
}else{//echo 'false';
$status=$_REQUEST['statuses'];
if($status=='')
	{
	$status=$allStatus1;
	}
}

$allOwner=$_REQUEST['owner']; 

//print_r($allOwner);

@$allOwner1=implode(",",$allOwner);

//echo "11".$allOwner1;

//echo $allOwner1;
$owner2=str_replace(",","' ||  owner='",$allOwner1);
$owner=$owner2;
//echo "22".$owner2;
//echo "33".$owner;
if (strpos($allOwner1,',') != false) {
 //   echo 'true';
//$owner=$owner2;
//echo "111".$owner;
}else{//echo 'false';
$owner=$_REQUEST['owners'];

//$owner2=$owner;
//echo "222".$owner;
if($owner=='')
	{
	$owner=$allOwner1;
	}
}

 $allFirstReviewer=$_REQUEST['firstReviewer'];
 @$allFirstReviewer1=implode(",",$allFirstReviewer);
 $firstReviewer2=str_replace(",","' ||  firstReviewer='",$allFirstReviewer1);
 $firstReviewer=$firstReviewer2;
 if (strpos($allFirstReviewer1,',') != false) {
}else{//echo 'false';
$firstReviewer=$_REQUEST['firstReviewers'];
if($firstReviewer=='')
	{
	$firstReviewer=$allFirstReviewer1;
	}
}

  $allSecondReviewer=$_REQUEST['secondReviewer'];
 @$allSecondReviewer1=implode(",",$allSecondReviewer);
 $secondReviewer2=str_replace(",","' ||  secondReviewer='",$allSecondReviewer1);
 $secondReviewer=$secondReviewer2;
 if (strpos($allSecondReviewer1,',') != false) {
}else{//echo 'false';
$secondReviewer=$_REQUEST['secondReviewers'];
if($secondReviewer=='')
	{
	$secondReviewer=$allSecondReviewer1;
	}
}


 @$arr_queue=implode($allQueue,"','");
 $queueData= "'".$arr_queue."'";

 @$arr_owner=implode($allOwner,"','");
 $ownerData= "'".$arr_owner."'";

  @$arr_service=implode($allService,"','");
 $serviceData= "'".$arr_service."'";

 @$arr_status=implode($allStatus,"','");
  $statusData= "'".$arr_status."'";
 
 @$arr_fr=implode($allFirstReviewer,"','");
 $frData= "'".$arr_fr."'";
 
 @$arr_sr=implode($allSecondReviewer,"','");
 $srData= "'".$arr_sr."'";
?>


 <?php/*
$page = "searchResults.php?queue=$queue&service=$service&status=$status&owner=$owner&firstReviewer=$firstReviewer&secondReviewer=$secondReviewer&owners=$owner&sevices=$service";
 $sec = "10";
 header("Refresh: $sec; url=$page");*/
?>
<div class="searchDiv">

<form action="searchResults2.php" method="get"><input type="hidden" value="<?php  echo $owner2; ?>" name="owners" id="owners"><input type="hidden" value="<?php  echo $service2; ?>" id="services" name="services"><input type="hidden" value="<?php  echo $status2; ?>" id="statuses" name="statuses"><input type="hidden" value="<?php  echo $queue2; ?>" id="queues" name="queues"><input type="hidden" value="<?php  echo $firstReviewer2; ?>" id="firstReviewers" name="firstReviewers"><input type="hidden" value="<?php  echo $secondReviewer2; ?>" id="secondReviewers" name="secondReviewers">
Owner:<select  name="owner[]" multiple="multiple" class="owner" id="multiple"><option class="blank" value=''>---Select Owner---</option>
<?php $allOwner="select  distinct * from webadmin where type='2'";
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
					
					<?php echo $firstRName1;?></option>
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

					<?php echo $secondRName1;?></option>
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
</div>
<?php

include("config.php");


/////////////1

if($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
			//echo "1";
			$allSsb="select * from tracking where owner='$owner'";
			//echo $allSsb;

}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select * from tracking where (status='$status')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
		//echo "3";
		$allSsb="select * from tracking where (status='$status') && (owner='$owner')";
		//echo  $allSsb;
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
		//echo "4";
		$allSsb="select * from tracking where (service='$service')";
}

/////////////2

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
		//echo "5";
		$allSsb="select * from tracking where (service='$service') && (owner='$owner')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
		//echo "6";
		$allSsb="select * from tracking where (service='$service') && (status='$status') ";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
		//echo "7";
		$allSsb="select * from tracking where (service='$service') && (status='$status') && (owner='$owner')";
}

///////3

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
		//echo "8";
		$allSsb="select * from tracking where (queue='$queue') ";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
		//echo "9";
		$allSsb="select * from tracking where (queue='$queue') && (owner='$owner')";
}



elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
		//echo "10";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
		//echo "11";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status') && (owner='$owner')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
		//echo "12";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
		//echo "13";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (owner='$owner')";
}

///////3

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
		//echo "14";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
		//echo "15";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status') && (owner='$owner')";
}
elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{
		$allSsb="select * from tracking where status !='Closed'";
}

/////////////next

if($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
			//echo "1";
			$allSsb="select * from tracking where (owner='$owner') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select * from tracking where status='$status && (secondReviewer='$secondReviewer')'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
		//echo "3";
		$allSsb="select * from tracking where (status='$status') && (owner='$owner') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
		//echo "4";
		$allSsb="select * from tracking where (service='$service') && (secondReviewer='$secondReviewer')";
}

/////////////2

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
		//echo "5";
		$allSsb="select * from tracking where (service='$service') && (owner='$owner') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
		//echo "6";
		$allSsb="select * from tracking where (service='$service') && (status='$status') && (secondReviewer='$secondReviewer') ";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
		//echo "7";
		$allSsb="select * from tracking where (service='$service') && (status='$status') && (owner='$owner') && (secondReviewer='$secondReviewer')";
}

///////3

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
		//echo "8";
		$allSsb="select * from tracking where (queue='$queue') && (secondReviewer='$secondReviewer') ";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
		//echo "9";
		$allSsb="select * from tracking where (queue='$queue') && (owner='$owner') && (secondReviewer='$secondReviewer')";
}



elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
		//echo "10";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
		//echo "11";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status') && (owner='$owner') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
		//echo "12";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
		//echo "13";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (owner='$owner') && (secondReviewer='$secondReviewer')";
}

///////3

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
		//echo "14";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
		//echo "15";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status') && (owner='$owner') && (secondReviewer='$secondReviewer')";
}
elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{
		$allSsb="select * from tracking where (secondReviewer='$secondReviewer')";
}

/////next2

if($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
			//echo "1";
			$allSsb="select * from tracking where (owner='$owner') && (firstReviewer='$firstReviewer')";
			//echo $allSsb;
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select * from tracking where (status='$status') && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
		//echo "3";
		$allSsb="select * from tracking where (status='$status') && (owner='$owner') && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
		//echo "4";
		$allSsb="select * from tracking where (service='$service') && (firstReviewer='$firstReviewer')";
}

/////////////2

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
		//echo "5";
		$allSsb="select * from tracking where (service='$service') && (owner='$owner') && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
		//echo "6";
		$allSsb="select * from tracking where (service='$service') && (status='$status') && (firstReviewer='$firstReviewer') ";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
		//echo "7";
		$allSsb="select * from tracking where (service='$service') && (status='$status') && (owner='$owner') && (firstReviewer='$firstReviewer')";
}

///////3

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
		//echo "8";
		$allSsb="select * from tracking where (queue='$queue')  && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
		//echo "9";
		$allSsb="select * from tracking where (queue='$queue') && (owner='$owner') && (firstReviewer='$firstReviewer')";
}



elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
		//echo "10";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status') && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
		//echo "11";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status') && (owner='$owner') && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
		//echo "12";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
		//echo "13";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (owner='$owner') && (firstReviewer='$firstReviewer')";
}

///////3

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
		//echo "14";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status') && (firstReviewer='$firstReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
		//echo "15";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status') && (owner='$owner') && (firstReviewer='$firstReviewer')";
}
elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{
		$allSsb="select * from tracking where (firstReviewer='$firstReviewer')";
}

////next3

if($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
			//echo "1";
			$allSsb="select * from tracking where (owner='$owner') && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select * from tracking where (status='$status')  && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
		//echo "3";
		$allSsb="select * from tracking where (status='$status') && (owner='$owner')  && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
		//echo "4";
		$allSsb="select * from tracking where (service='$service')  && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

/////////////2

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
		//echo "5";
		$allSsb="select * from tracking where (service='$service') && (owner='$owner')  && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
		//echo "6";
		$allSsb="select * from tracking where (service='$service') && (status='$status')   && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
		//echo "7";
		$allSsb="select * from tracking where (service='$service') && (status='$status') && (owner='$owner')  && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

///////3

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
		//echo "8";
		$allSsb="select * from tracking where (queue='$queue')  && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer') ";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
		//echo "9";
		$allSsb="select * from tracking where (queue='$queue') && (owner='$owner') && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}



elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
		//echo "10";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status') && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
		//echo "11";
		$allSsb="select * from tracking where (queue='$queue') && (status='$status') && (owner='$owner') && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
		//echo "12";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
		//echo "13";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (owner='$owner') && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

///////3

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
		//echo "14";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status')  && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
		//echo "15";
		$allSsb="select * from tracking where (queue='$queue') && (service='$service') && (status='$status') && (owner='$owner') && (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}
elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{
		$allSsb="select * from tracking where (firstReviewer='$firstReviewer') && (secondReviewer='$secondReviewer')";
}
$ssb=mysql_query($allSsb."order by startDate" );
$allRows=mysql_num_rows($ssb);

?>
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
<span class="rowsFound" >Total <b><?php echo $allRows; ?></b> Rows Found</span><div class="ownersData"><span class="data"></span></div>

<div class="ContentData">


<form action="insertTracking.php"  method="post"> 
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th class="elapsed">E</th><th >SSB-ID</th><th class="custsubname">Customer Subscription Name</th><th>Queue</th><th>Service</th><th>URL To Migrate</th><th class="pages">Pages</th><th>Status</th><th>First Reviewer</th><th>Second Reviewer</th><th>Action</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';

?>
<tr  onmouseover="getNotes(<?php echo $ssbArr['trackID'];?>)"   class='<?php echo $class; ?>'><td><?php

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
</td><td class="custsubname"><?php echo $ssbArr['custSubName'];?></td>
		<td><?php echo $ssbArr['queue'];?></td><td><?php echo $ssbArr['service'];?></td>
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
	
		<td>	<?php
		$allReviewer1="select  * from webadmin where type='1'";
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
		$allReviewer2="select  * from webadmin where type='1'";
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

<?php include("Footer.php"); ?>