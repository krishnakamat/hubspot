<?php
		ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);

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

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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


<?php 
 $days=$_REQUEST['days'];
 $start_date=$_REQUEST['date1'];
 $end_date=$_REQUEST['date2'];
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

if(!empty($days)){
  $today=date('Y-m-d');
 //echo $today = date("Y-m-d",strtotime("-1 days",strtotime($today)));

	$i = 0;
while($i<$days){
	$i++;
	 $daysName = date("l",strtotime($today));
	$lower = strtolower($daysName);
	if($lower == 'monday' || $lower == 'tuesday' || $lower == 'wednesday' || $lower == 'thursday' || $lower == 'friday'){
	 $today = date("Y-m-d",strtotime("-1 days",strtotime($today)));
	$daysName = date("l",strtotime($today));
	}
	if($lower == 'saturday' || $lower == 'sunday'){
	 $today = date("Y-m-d",strtotime("-1 days",strtotime($today)));
	$daysName = date("l",strtotime($today));
	$i--;
	}
	
}
 $today = date("Y-m-d",strtotime("+1 days",strtotime($today)));
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

<form action="searchResults.php" method="get"><input type="hidden" value="<?php  echo $owner2; ?>" name="owners" id="owners"><input type="hidden" value="<?php  echo $service2; ?>" id="services" name="services"><input type="hidden" value="<?php  echo $status2; ?>" id="statuses" name="statuses"><input type="hidden" value="<?php  echo $queue2; ?>" id="queues" name="queues"><input type="hidden" value="<?php  echo $firstReviewer2; ?>" id="firstReviewers" name="firstReviewers"><input type="hidden" value="<?php  echo $secondReviewer2; ?>" id="secondReviewers" name="secondReviewers"><fieldset>
Owner:<select  name="owner[]" multiple="multiple" class="owner" id="multiple"><option class="blank" value=''>---Select Owner---</option>
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
		</select></fieldset><fieldset>
Queue:<select name="queue[]" multiple="multiple" class="queue" id="multipleQueue">
<option value="" class="blank">---Select Queue---</option><?php
		$allQueue="select distinct queue from tracking order by queue";
		$getAllQueue=mysql_query($allQueue);
	
					while($queueArr=mysql_fetch_array($getAllQueue))
				{
					?><option value="<?php echo $queueArr['queue'];?>"><?php echo $queueArr['queue'];?></option>
				<?php
				}
					?></select></fieldset><fieldset>
Service:<select name="service[]" multiple="multiple" class="service" id="multipleService">
	<option value="" class="blank">---Select Services---</option><?php
		$allService="select distinct service from tracking order by service";
		$getAllService=mysql_query($allService);
	
					while($serviceArr=mysql_fetch_array($getAllService))
				{
					?><option value="<?php echo $serviceArr['service'];?>"><?php echo $serviceArr['service'];?></option>
				<?php
				}
					?></select></fieldset><fieldset>
Status:<select  name="status[]" multiple="multiple"  class="status" id="multipleStatus">
<option value="" class="blank">---Select Status---</option>
		<?php  getAllStatusOption() ?>
						</select>
</fieldset><fieldset>
First Reviewer:<select    name="firstReviewer[]" multiple="multiple" class="firstReviewer" id="multipleFirstReviewer"><option value="" class="blank">---Select First Reviewer---</option>
<?php $firReviewer="select  distinct firstReviewer from tracking  where firstReviewer != 0 ";
		$getfirReviewer=mysql_query($firReviewer);
		?>
				<?php
					while($rowfirArr=mysql_fetch_array($getfirReviewer))
				{
					?><option value="<?php echo $rowfirArr['firstReviewer'];?>">
					<?php $getFRName1=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$rowfirArr[firstReviewer]'  order by name");
						$firstRArr1=mysql_fetch_array($getFRName1);
						$firstRName1 = $firstRArr1['name'];?>
					
					<?php echo $firstRName1;?></option>
				<?php
				}
					?>
		</select>
</fieldset><fieldset>
Second Reviewer:<select  name="secondReviewer[]" multiple="multiple" class="secondReviewer" id="multipleSecondReviewer"><option value="" class="blank">---Select Second Reviewer---</option>
<?php $secReviewer="select  distinct secondReviewer from tracking  where secondReviewer != 0";
		$getsecReviewer=mysql_query($secReviewer);
		?>
				<?php
					while($rowsecArr=mysql_fetch_array($getsecReviewer))
				{
					?><option value="<?php echo $rowsecArr['secondReviewer'];?>">
					<?php $getSRName1=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$rowsecArr[secondReviewer]'  order by name");
						$secondRArr1=mysql_fetch_array($getSRName1);
						$secondRName1= $secondRArr1['name'];?>

					<?php echo $secondRName1;?></option>
				<?php
				}
					?>
		</select></fieldset>

		<fieldset>Start Date: <input type='text' onClick="daysClear();" value="<?php echo $start_date; ?>" name="date1" id="startdate1" ><br/>End Date: <input type="text" onClick="daysClear();" name="date2" value="<?php echo $end_date; ?>" id="enddate1"><br/><br/><button type="button" onClick="priorityFunc(1)">Priority</button>
		</fieldset>		
			<fieldset>
		Elapsed days:<select name="days" onClick="dateClear();" id="days">
						<option value="">Select</option>
						<option value="1" <?php if($_REQUEST['days']==1){ echo "selected";} ?>>1</option>
						<option value="2" <?php if($_REQUEST['days']==2){ echo "selected";} ?>>2</option>
						<option value="3" <?php if($_REQUEST['days']==3){ echo "selected";} ?>>3</option>
						<option value="4" <?php if($_REQUEST['days']==4){ echo "selected";} ?>>4</option>
						<option value="5" <?php if($_REQUEST['days']==5){ echo "selected";} ?>>5</option>
						<option value="6" <?php if($_REQUEST['days']==6){ echo "selected";} ?>>6</option>
						<option value="7" <?php if($_REQUEST['days']==7){ echo "selected";} ?>>7</option>
						<option value="8" <?php if($_REQUEST['days']==8){ echo "selected";} ?>>8</option>
						<option value="9" <?php if($_REQUEST['days']==9){ echo "selected";} ?>>9</option>
						<option value="10" <?php if($_REQUEST['days']==10){ echo "selected";} ?>>10</option>
						<option value="11" <?php if($_REQUEST['days']==11){ echo "selected";} ?>>>10</option>

					</select>
		</fieldset>

		
		<fieldset>
		<button class="reset" onclick="return false">Clear</button>

			  <?php $firstService= $_REQUEST['service'][0];
$secondService=$_REQUEST['service'][1];
$thirdService=$_REQUEST['service'][2];
$fourthService=$_REQUEST['service'][3];
$fifthService=$_REQUEST['service'][4];
$sixthService=$_REQUEST['service'][5];
$seventhService=$_REQUEST['service'][6];
?>

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
				$('#startdate1').val("");
				$('#enddate1').val("");
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

</style>
<input type="submit" value="Search"></fieldset>
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

if($today != '' && $days <= 10){
	 $allSsb=$allSsb." "."and startDate = '$today'";
}
if($today != '' && $days > 10){
	 $allSsb=$allSsb." "."and startDate <= '$today'";
}

if($start_date !=''|| $end_date!= '')

{
		if( $end_date == '')
	{
			$allSsb=$allSsb." "."and dueDate >= '$start_date'";
	}
	elseif( $start_date == '')
	{
			$allSsb=$allSsb." "."and dueDate <= '$end_date'";
	}else{
		$allSsb=$allSsb." "."and dueDate >= '$start_date' and dueDate <='$end_date'";
	}

}

$ssb=mysql_query($allSsb."order by startDate,queue" );
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
<?php 
function getWorkingDays($startDate, $endDate){
 $begin=strtotime($startDate);
 $end=strtotime($endDate);
 if($begin>$end){
  echo "startdate is in the future! <br />";
  return 0;
 }else{
   $no_days=0;
   $weekends=0;
  while($begin<=$end){
    $no_days++; // no of days in the given interval
    $what_day=date("N",$begin);
     if($what_day>5) { // 6 and 7 are weekend days
          $weekends++;
     };
    $begin+=86400; // +1 day
  };
  $working_days=$no_days-$weekends;
  return $working_days;
 }
}
?>

<div class="ContentData">

<div id="priority">
<form action="insertTracking.php"  method="post"> 
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th class="elapsed">E</th><th >SSB-ID</th><th class="custsubname">Customer Subscription Name</th><th>Queue</th><th>Service</th>	<?php // if($_SESSION['adminID']=='18' || $_SESSION['adminID']=='19'){ ?><th>Due Date</th><?php// } ?><th>URL To Migrate</th><th class="pages">Pages</th><th>Status</th><th class="owner-data">Owner</th><th>First Reviewer</th><th>Second Reviewer</th>

<?php  if($_SESSION['userRole']==1){ ?>
<th>Priority</th>
<?php } ?>
<th>Action</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';

?>
<tr  onmouseover="getNotes(<?php echo $ssbArr['trackID'];?>)"   class='<?php echo $class; ?>' id='<?php echo $ssbArr['trackID']; ?>' <?php if($ssbArr['target']==1){ echo "style='background-color:#BFBF19;'";} ?>><td><?php
if(!empty($today) && $days <= 10){
	$startDay = "$today";
}else if(!empty($today) && $days > 10)
    $startDay=$ssbArr['startDate']; 
else{
    $startDay=$ssbArr['startDate']; 
}

//$startDay=$ssbArr['startDate']; 
$getDateDiff=mysql_query("SELECT DATEDIFF(now(),'$startDay') AS DiffDate"); 
$arrDate=mysql_fetch_assoc($getDateDiff);
//echo $arrDate['DiffDate']+1;

/*************************************************************************************************/

$beginday=date($startDay);
$lastday=date("Y-m-d");
/*echo $beginday;
echo "<br/>";
echo $lastday;*/

//echo getBusinessDays($beginday, $lastday);

//echo "Business days: " . getBusinessDays("11/10/2014", "11/10/2014");

if ($beginday != $lastday)
	echo getBusinessDays($beginday, $lastday);
else 
	  echo 1;
  


/*************************************************************************************************/








/*$beginday=date($startDay);
$lastday=date("Y-m-d");
//echo $lastday;
$nr_work_days = getWorkingDays($beginday,$lastday);
echo $nr_work_days;*/

?></td><td>

<?php echo $ssbArr['ssbID'];?>

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
		<td><?php echo $ssbArr['queue'];?></td><td><?php echo $ssbArr['service'];?></td><?php //if($_SESSION['adminID']=='18' || $_SESSION['adminID']=='19'){ ?><td><?php echo date("d-M-Y",strtotime($ssbArr['dueDate']));?></td><?php// } ?>
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
		$allUser="select  * from webadmin where userRole = 3 and status = 1 and employeeType = 1 order by name";
		$getAllUser=mysql_query($allUser);
		?>
		<select   class='<?php echo $class; ?>'  onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,2)" >
			<option value="<?php echo $ssbArr['owner'];?>">
			<?php
						 $getOwnerName=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$ssbArr[owner]'");
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
		<select    class='<?php echo $class; ?>' onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,3)" >
		<option value="<?php echo $ssbArr['firstReviewer'];?>">
			 <?php $getFRName=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$ssbArr[firstReviewer]'");
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
		<select   class='<?php echo $class; ?>' onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,4)" >
		<option value="<?php echo $ssbArr['secondReviewer'];?>">
			<?php $getSRName=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$ssbArr[secondReviewer]'");
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
			<input type="checkbox" name="ssbIDCheck" id="ssbIDChk<?php echo $ssbArr['trackID'];?>" <?php if($ssbArr['target']==1){ echo "checked";} ?> onclick="ssbIDChecks(<?php echo $ssbArr['trackID'];?>)">
		</td>
<?php } ?>

<td>  <a href="getDetails.php?ssbID=<?php echo $ssbArr['ssbID'];?>">Edit   </a>|<a href="getHistory.php?trackID=<?php echo $ssbArr['trackID'];?>">History</a> </td>
		</tr>
<?php
}?>

</table>

</form>
</div>
<div>
</div>

<?php include("Footer.php"); ?>

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
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  

   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 



   <script type="text/javascript">

       $(function() {

               $("#startdate1").datepicker({ dateFormat: "yy-mm-dd" }).val()

               $("#enddate1").datepicker({ dateFormat: "yy-mm-dd" }).val()

       });



   </script>