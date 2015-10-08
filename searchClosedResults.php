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


 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 

   <script type="text/javascript">
       $(function() {
               $("#startdate").datepicker({ dateFormat: "yy-mm-dd" }).val()
               $("#enddate").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });

   </script>  <style>
   .searchDiv form {
width:100% !important;
}</style>
	
	<?php include("function.php");?>
	<div class="addData">
<div id="myDiv">
</div>



<?php $queue=$_REQUEST['queue']; 
 $service=$_REQUEST['service'];
 $status=$_REQUEST['status']; 


$start_date= $_REQUEST['date1'];
$end_date=$_REQUEST['date2'];
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

 $firstReviewer=$_REQUEST['firstReviewer'];
 $secondReviewer=$_REQUEST['secondReviewer'];?>



<div class="searchDiv">
   <script type="text/javascript">
      $(document).ready(function(){
            $('.reset').click(function(){
                $(' .blank').attr('selected','selected');			
            });
        });
    </script>
<form action="searchClosedResults.php" method="get"><input type="hidden" value="<?php  echo $owner2; ?>" name="owners">
Owner:<select  name="owner[]" multiple="multiple" class="owner" id="multiple"><option value=''>---Select Owner---</option>
<?php $allOwner="select  distinct * from webadmin where userRole = 3 and status = 1 and employeeType = 1";
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
Queue:<select name="queue">
<option value="<?php echo $queue; ?>"><?php echo $queue; ?> </option><option value="" class="blank">---Select Queue---</option><?php
		$allQueue="select distinct queue from tracking";
		$getAllQueue=mysql_query($allQueue);
	
					while($queueArr=mysql_fetch_array($getAllQueue))
				{
					?><option value="<?php echo $queueArr['queue'];?>"><?php echo $queueArr['queue'];?></option>
				<?php
				}
					?></select>
Service:<select name="service">
	<option value="<?php echo $service; ?>"><?php echo $service; ?> </option><option value="" class="blank">---Select Queue---</option><?php
		$allService="select distinct service from tracking";
		$getAllService=mysql_query($allService);
	
					while($serviceArr=mysql_fetch_array($getAllService))
				{
					?><option value="<?php echo $serviceArr['service'];?>"><?php echo $serviceArr['service'];?></option>
				<?php
				}
					?></select>
Status:<select name="status">
<option value="<?php echo $status; ?>"> <?php echo $status; ?></option><option value="" class="blank">---Select Queue---</option>
	<option value="Started">Started</option>
						<option value="Not Started">Not Started</option>
						<option value="In Progress">In Progress</option>
						<option value="Closed">Closed</option>
						<option value="Ready For Review">Ready For Review</option>
						<option value="First Rev. Issues Sent">First Rev. Issues Sent</option>
						<option value="First Review Done">First Review Done</option>
						<option value="Second Rev. Issues Sent">Second Rev. Issues Sent</option>
						<option value="Ready To Close">Ready To Close</option>
						<option value="Blocked">Blocked</option>
						</select>

	First Reviewer:<select  name="firstReviewer"><option value='<?php echo $firstReviewer; ?>'>
	
					<?php $getFRName=mysql_query("select * from webadmin where adminID ='$firstReviewer'");
						$firstRArr=mysql_fetch_array($getFRName);
						$firstRName = $firstRArr['name'];?>
					
					<?php echo $firstRName;?>

	</option>
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

		Start Date: <input type='text' name="date1" id="startdate" >
		End Date: <input type="text" name="date2" id="enddate" >
		<button class="reset" onclick="return false">Clear</button>
			  
			
			
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
</div>
<?php

include("config.php");


/////////////1

if($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
	//		echo "1";
			$allSsb="select *,sum(hours2) as hours from closedssb where owner='$owner'";
			//echo $allSsb;

}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status'";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
	//	echo "3";
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status' && (owner='$owner')";
		echo  $allSsb;
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
	//	echo "4";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service'";
}

/////////////2

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
	//	echo "5";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && (owner='$owner')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
	//	echo "6";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status' ";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
	//	echo "7";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status' && (owner='$owner')";
}

///////3

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
	//	echo "8";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' ";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
//		echo "9";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && (owner='$owner')";
}



elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
		//echo "10";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status'";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
	//	echo "11";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status' && (owner='$owner')";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
	//	echo "12";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service'";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
	//	echo "13";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && (owner='$owner')";
}

///////3

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
//		echo "14";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status'";
}

elseif($firstReviewer == '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
//		echo "15";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status' && (owner='$owner')";
}
elseif($firstReviewer == '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{//All Blank
		$allSsb="select *,sum(hours2) as hours from closedssb where status ='Closed'";
}

/////////////next

if($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
		//	echo "1";
			$allSsb="select *,sum(hours2) as hours from closedssb where (owner='$owner') && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status && secondReviewer='$secondReviewer''";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
	//	echo "3";
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status' && (owner='$owner') && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
	//	echo "4";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && secondReviewer='$secondReviewer'";
}

/////////////2

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
	//	echo "5";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && (owner='$owner') && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
	//	echo "6";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status' && secondReviewer='$secondReviewer' ";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
//		echo "7";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status' && (owner='$owner') && secondReviewer='$secondReviewer'";
}

///////3

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
//		echo "8";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && secondReviewer='$secondReviewer' ";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
//		echo "9";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && (owner='$owner') && secondReviewer='$secondReviewer'";
}



elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
//		echo "10";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
	//	echo "11";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status' && (owner='$owner') && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
	//	echo "12";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
//		echo "13";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && (owner='$owner') && secondReviewer='$secondReviewer'";
}

///////3

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
		//echo "14";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer == '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
	//	echo "15";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status' && (owner='$owner') && secondReviewer='$secondReviewer'";
}
elseif($firstReviewer == '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{
		$allSsb="select *,sum(hours2) as hours from closedssb where secondReviewer='$secondReviewer'";
}

/////next2

if($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
		//	echo "1";
			$allSsb="select *,sum(hours2) as hours from closedssb where (owner='$owner') && firstReviewer='$firstReviewer'";
			//echo $allSsb;
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status' && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
	//	echo "3";
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status' && (owner='$owner') && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
		//echo "4";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && firstReviewer='$firstReviewer'";
}

/////////////2

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
	//	echo "5";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && (owner='$owner') && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
	//	echo "6";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status' && firstReviewer='$firstReviewer' ";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
	//	echo "7";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status' && (owner='$owner') && firstReviewer='$firstReviewer'";
}

///////3

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
	//	echo "8";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue'  && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
	//	echo "9";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && (owner='$owner') && firstReviewer='$firstReviewer'";
}



elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
	//	echo "10";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status' && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
		//echo "11";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status' && (owner='$owner') && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
		//echo "12";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
		//echo "13";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && (owner='$owner') && firstReviewer='$firstReviewer'";
}

///////3

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
		//echo "14";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status' && firstReviewer='$firstReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer =='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
		//echo "15";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status' && (owner='$owner') && firstReviewer='$firstReviewer'";
}
elseif($firstReviewer != '' && $secondReviewer =='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{
		$allSsb="select *,sum(hours2) as hours from closedssb where firstReviewer='$firstReviewer'";
}

////next3

if($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner !='')
{
		//	echo "1";
			$allSsb="select *,sum(hours2) as hours from closedssb where (owner='$owner') && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner =='')
{
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status'  && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status !='' && $owner !='')
{
		//echo "3";
		$allSsb="select *,sum(hours2) as hours from closedssb where status='$status' && (owner='$owner')  && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner =='')
{
	//	echo "4";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service'  && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

/////////////2

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status =='' && $owner !='')
{
		//echo "5";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && (owner='$owner')  && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner =='')
{
		//echo "6";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status'   && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service !='' && $status !='' && $owner !='')
{
	//	echo "7";
		$allSsb="select *,sum(hours2) as hours from closedssb where service='$service' && status='$status' && (owner='$owner')  && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

///////3

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner =='')
{
	//	echo "8";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue'  && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer' ";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status =='' && $owner !='')
{
		//echo "9";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && (owner='$owner') && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}



elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner =='')
{
		//echo "10";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status' && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service =='' && $status !='' && $owner !='')
{
	//	echo "11";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && status='$status' && (owner='$owner') && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner =='')
{
	//	echo "12";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status =='' && $owner !='')
{
	//	echo "13";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && (owner='$owner') && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

///////3

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner =='')
{
		//echo "14";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status'  && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}

elseif($firstReviewer != '' && $secondReviewer !='' && $queue != '' && $service !='' && $status !='' && $owner !='')
{
		//echo "15";
		$allSsb="select *,sum(hours2) as hours from closedssb where queue='$queue' && service='$service' && status='$status' && (owner='$owner') && firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}
elseif($firstReviewer != '' && $secondReviewer !='' && $queue == '' && $service =='' && $status =='' && $owner =='')
{
		$allSsb="select *,sum(hours2) as hours from closedssb where firstReviewer='$firstReviewer' && secondReviewer='$secondReviewer'";
}


if($start_date !=''|| $end_date!= '')

{
		if($end_date =='')
	{
			$end_date=$start_date;
	}
	elseif($start_date=='')
	{
			$start_date=$end_date;
	}

		$allSsb=$allSsb." "."and closedOn >= '$start_date' and closedOn <='$end_date' and isManual !='1'";

}


$ssb=mysql_query($allSsb." "." group by ssbID ");?>

<p style="clear:both"><?php echo "Total ". mysql_num_rows($ssb)." Rows Found";?></p>
<div class="ContentData">

<form action="insertclosedssb.php"  method="get">

<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th >SSB-ID</th><th>Customer Subscription Name</th><th>Queue</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th>Pages</th><th>Status</th><!--<th>Owner</th>--><th>Hours 2</th><th>Closed On</th><th>Action</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';

?>
<tr   class='<?php echo $class; ?>'><td><?php echo $ssbArr['ssbID'];?></td><td><?php echo $ssbArr['custSubName'];?></td>
		<td><?php echo $ssbArr['queue'];?></td><td><?php echo  date("d-M-Y", strtotime($ssbArr['startDate']));?></td>	
		<td><?php echo  date("d-M-Y", strtotime($ssbArr['dueDate']));?></td><td><?php echo $ssbArr['service'];?></td>
		<td><a href="<?php echo $ssbArr['migrateUrl'];?>" target="_blank"><?php echo $ssbArr['migrateUrl'];?></a></td>
				<td><?php echo $ssbArr['pages'];?></td><td class="<?php echo str_replace(' ', '-',$ssbArr['status']);?>" id="status<?php echo $ssbArr['trackID'];?>" >
				<?php echo $ssbArr['status'];?></td>
		<!--<td>
		<?php echo $ssbArr['owner'];?>

		</td>-->
		<td>	<?php echo $ssbArr['hours'];?></td>
		
		
		<td >
	<?php echo  date("d-M-Y", strtotime( $ssbArr['closedOn']));?></td>
<td>  <a href="getClosedDetails.php?ssbID=<?php echo $ssbArr['ssbID'];?>">Edit   </a>|<a href="getHistory.php?trackID=<?php echo $ssbArr['trackID'];?>">   History</a> </td>
		</tr>
<?php
$var += $ssbArr['hours'];
		
}
echo "<b>Total ".$var. " Hours</b>";?>

</table>

</form>
<div>
</div>
<?php include("Footer.php"); ?>