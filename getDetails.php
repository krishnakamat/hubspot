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
include("config.php");
$ssbID=$_GET['ssbID'];
$allSsbs="select * from tracking where ssbID='$ssbID'";
$ssbs=mysql_query($allSsbs);
$ssbArray=mysql_fetch_array($ssbs);?>
<style>
.updateDetails #selectedEmp {
  float: right;
  margin-top: 50%;
}
.followers li {
  background: #f1f1f1;
  border: 1px solid #000;
  margin: 2px;
  padding: 4px;
  border-radius: 12px;
}
.remove {
  cursor: pointer;
  float: right;
  height: 16px;
  width: 16px;
}
.addFollower input {
  border: 1px solid #ccc;
  border-radius: 5px;
  height: 25px;
  padding: 5px;
  width: 150%;
}
.addFollower {
  padding: 22px 0 0;
}
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
#total {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
  border: 0 none;
  font-weight: bold;
}



</style>
<link type="text/css" rel="stylesheet" href="css/example.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
        function lookup(inputString) {
            if(inputString.length == 0) {
                // Hide the suggestion box.
                $('#suggestions').hide();
            } else {
                $.post("searchOwner.php", {queryString: ""+inputString+""}, 
    function(data){
                    if(data.length >0) {
                        $('#suggestions').show();
                        $('#autoSuggestionsList').html(data);
                    }
                });
            }
        } // lookup
        function fill(thisValue,id) {
            $('#inputString').val(thisValue);
            setTimeout("$('#suggestions').hide();", 200);
			var ssbID = document.getElementById('ssbID').value;
			getData(id,ssbID);
        }
		function getData(id,ssbID){
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
				document.getElementById("selectedEmp").innerHTML=xmlhttp.responseText;
				document.getElementById('inputString').value ='';
				}
			  }
			xmlhttp.open("GET","selectedEmp.php?empID="+id+"&ssbID="+ssbID,true);
			xmlhttp.send();


		}
		function removeEntry(followerID){
			var ssbID = document.getElementById('ssbID').value;
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
				document.getElementById("selectedEmp").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","removeFollower.php?followerID="+followerID+"&ssbID="+ssbID,true);
			xmlhttp.send();
		}
    </script>
	<style>
	  h3 {
            margin: 0px;
            padding: 0px;   
        }
        .suggestionsBox {
		  background-color: #212427;
		  border: 2px solid #000;
		  color: #fff;
		  margin: 10px 0 0;
		  position: absolute;
		  width: 200px;
		}
        .suggestionList {
            margin: 0px;
            padding: 0px;
        }
        .suggestionList li {
            margin: 0px 0px 3px 0px;
            padding: 3px;
            cursor: pointer;
        }
        .suggestionList li:hover {
            background-color: #659CD8;
        }
		</style>
<script>
        // rating script
        $(function(){ 
           /* $('.rate-btn').hover(function(){
                $('.rate-btn').removeClass('rate-btn-hover');
                var therate = $(this).attr('id');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-hover');
                };
            });*/
                            
            $('.rate-btn').click(function(){    
                var therate = $(this).attr('id');
                //var dataRate = 'act=rate&post_id=<?php echo $post_id; ?>&rate='+therate; //
                //var dataRate = 'act=rate&ssbID=<?php echo $ssbID; ?>&rate='+therate; //
				var rate = therate;
				document.getElementById('rating').value = rate;
                $('.rate-btn').removeClass('rate-btn-active');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };
                /*$.ajax({
                    type : "POST",
                    url : "http://thewebplant.in/~tracker/ajax.php",
                    data: dataRate,
                    success:function(){}
                });*/
                
            });
        });
 </script>
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
<script>
function readyClose(str, preStatus) {
	//alert("hi");
	var readyClose;
	var xmlhttp;
	var cann;
	var val;
   /* if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { */
	if(str == "Ready To Close"){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                readyClose = xmlhttp.responseText;
				if(readyClose!=''){
				cann = confirm(readyClose);
				}else{
					val = 'Ready To Close';
				}
				
				if(readyClose!=''){
					if(cann == true)
					{		//alert("ready");
							val = 'Ready To Close';
					}
					else
					{	//alert("other");
						val = preStatus;
						//return false;
					}
				}	
					var xmlhttp1;
					if (window.XMLHttpRequest)
					  {// code for IE7+, Firefox, Chrome, Opera, Safari
					  xmlhttp1=new XMLHttpRequest();
					  }
					else
					  {// code for IE6, IE5
					  xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					xmlhttp1.onreadystatechange=function()
					  {
					  if (xmlhttp1.readyState==4 && xmlhttp1.status==200)
						{
						document.getElementById("status").innerHTML=xmlhttp1.responseText;
						}
					  }
					//xmlhttp1.open("GET",'updateOwner.php?value='+val+'&trackId='+trackId+'&toUpdate='+update,true);
					xmlhttp1.open("GET",'updateStatus.php?value='+val,true);
					xmlhttp1.send();
            }
        }
        xmlhttp.open("GET","getUpdate.php",true);
        xmlhttp.send();
    //}
}
}
</script>
<?php $sta = $ssbArray['status'];?>
<div class="updateDetails" style="float:left">
<form action="updateDetails.php" method="post">
<table>
<tr><td>SSB ID: </td><td><?php echo $ssbArray['ssbID'];?></td></tr>

<tr><td>Customer Subscription Name</td><td><?php echo $ssbArray['custSubName'];?></td></tr>

<tr><td>URL To Migrate:  </td><td><a href="<?php echo $ssbArray['migrateUrl'];?>" target="_blank"><?php echo $ssbArray['migrateUrl'];?></a></td></tr>

<tr><td>Portal Link</td><td><a href="<?php echo $ssbArray['portalLoginLink'];?>" target="_blank"><?php echo $ssbArray['portalLoginLink'];?></a></td></tr>

<tr><td>Blog URL</td><td><a href="<?php echo $ssbArray['blogUrl'];?>" target="_blank"><?php echo $ssbArray['blogUrl'];?></a></td></tr>
<tr><td>Comments: </td><td><textarea name="comments"><?php echo $ssbArray['comments'];?></textarea><td></tr>
<tr><td>Status: </td><td><select name="status" id="status" onchange="javascript: readyClose(this.value,'<?php echo $sta; ?>');">
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
	
				<?php		 $getOwnerName=mysql_query("select * from webadmin where employeeType = 1 and adminID ='$ssbArray[owner]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$ownerName = $ownerArr['name'];?>

<?php echo $ownerName;?></option>
	<?php
					$allUser="select  * from webadmin where employeeType = 1 and userRole='3' and status='1' order by name";
					$getAllUser=mysql_query($allUser);
					while($userArr=mysql_fetch_array($getAllUser))
 				{
					?>
				
				<option value="<?php echo $userArr['adminID'];?>"><?php echo $userArr['name'];?></option>
				<?php
				}
					?><td></tr>
<tr><td>First Reviewer:</td><td> 	<?php
		$allReviewer1="select  * from webadmin where (userRole='1' or userRole='2') and status='1' order by name";
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
			
<tr><td>Second Reviewer: </td><td><?php
		$allReviewer2="select  * from webadmin where (userRole='1' or userRole='2') and status='1' order by name";
		$getAllReviewer2=mysql_query($allReviewer2);
		?>
		<select name="secondReviewer"  class='<?php echo $class; ?>'   onchange="updateOwner(this.value,<?php echo $ssbArr['trackID'];?>,4)" >
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
			<tr><td>Queue: </td><td>

		<select name="queue" ><option value="<?php echo $ssbArray['queue']; ?>"><?php echo $ssbArray['queue']; ?></option>
				<?php $getQueue="select distinct queue from tracking order by queue";
		$queueQuery=mysql_query($getQueue);
		while($queueArr=mysql_fetch_array($queueQuery))
		{?>
			<option value="<?php echo $queueArr['queue']; ?>"><?php echo $queueArr['queue']; ?></option>
<?php
		}
		?>
		</select></td></tr>
<tr><td>Notes: </td><td><textarea name="notes"><?php echo $ssbArray['notes'];?></textarea></td></tr>
<tr><td>Rating:</td><td><!--<select name="rating" style="width:60px !important;">
						<option value="0" <?php if($ssbArray['rating']==0){ echo 'selected="selected"';} ?>>0</option>
						<option value="1" <?php if($ssbArray['rating']==1){ echo 'selected="selected"';} ?>>1</option>
						<option value="2" <?php if($ssbArray['rating']==2){ echo 'selected="selected"';} ?>>2</option>
						<option value="3" <?php if($ssbArray['rating']==3){ echo 'selected="selected"';} ?>>3</option>
						<option value="4" <?php if($ssbArray['rating']==4){ echo 'selected="selected"';} ?>>4</option>
						<option value="5" <?php if($ssbArray['rating']==5){ echo 'selected="selected"';} ?>>5</option>
						</select>-->
		<div class="rate-ex1-cnt">
            <div id="1" class="rate-btn-1 rate-btn"></div>
            <div id="2" class="rate-btn-2 rate-btn"></div>
            <div id="3" class="rate-btn-3 rate-btn"></div>
            <div id="4" class="rate-btn-4 rate-btn"></div>
            <div id="5" class="rate-btn-5 rate-btn"></div>
        </div>
		<input type="hidden" name="rating" value="" id="rating">
		    <div class="box-result-cnt">
            <?php
                $query = mysql_query("select * from tracking where ssbID='$ssbID'"); 
                while($data = mysql_fetch_assoc($query)){
                    $rate_db[] = $data;
                    $sum_rates[] = $data['rating'];
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
            ?>

		  <div class="rate-result-cnt">
                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                <div class="rate-stars"></div>
            </div>

			</div>
						
</td></tr>
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
<tr  class="editTime"><td >Owner</td><td>Time Taken</td></tr>


<?php //Get previous owners for entering hours
			$prevOwner1=mysql_query("select sum(timeTaken) as timeTaken,owner,teamLead,openssbID,notes from openssbtime where ssbID='$ssbID' group by owner");
			if(mysql_num_rows($prevOwner1 ) >0){
			while($getOwner1=mysql_fetch_array($prevOwner1))
			{?>
									<?php $getOwnerName1=mysql_query("select * from webadmin where adminID='$getOwner1[owner]'");
									$ownerNameArr1=mysql_fetch_assoc($getOwnerName1);?>
		
					<tr>
					<td ><label  class="editTime" ><input type="hidden" value="<?php echo $getOwner1['owner']; ?>"  name="owners[]"><input type="hidden" value="<?php echo $getOwner1['teamLead']; ?>"  name="teamLeads[]"> <?php echo $ownerNameArr1['name']; ?></label></td>
				
					<td><label><input type="text" onkeyup="findTotal()"   name="hours2[]" value="<?php echo $getOwner1['timeTaken']; ?>"  ></label></td>
					<td><a   onclick="deleteTime(<?php echo $getOwner1['openssbID']; ?>)">Delete</a></td>
					</tr>		
			<?php
			}
			}else {}
?>
<tr><td>
<?php $getOwnerId=mysql_query("select * from webadmin where name ='$_SESSION[name]'");
$ownerId=mysql_fetch_array($getOwnerId);
 $ownerID = $ownerId['adminID'];?>
 <select name="owners[]" ><option value="<?php echo $ownerID; ?>"><?php echo $owner=$_SESSION['name']; ?></option>
 <?php
		$allMembers="select  * from webadmin where employeeType = 1 order by name";
		$getAllMembers=mysql_query($allMembers);
		
					while($memberArr=mysql_fetch_array($getAllMembers))
				{
					?><option value="<?php echo $memberArr['adminID'];?>"><?php echo $memberArr['name'];?></option>
				<?php
				}
?>
 </select>
</td>

<td><input type="number" onkeyup="findTotal()" name="hours2[]"  step="0.1" min='0' /><input type="hidden" value="<?php echo $ssbID; ?>" name="ssbID">
</td></tr>

<tr><td><input type="submit"  value="Add Detail"></td><td>
<?php
	$totalTime=mysql_query("select sum(timeTaken) as total from openssbtime where ssbID='$ssbID'");
	$timeTaken=mysql_fetch_assoc($totalTime);
		 $timeTaken['total'];
	?>

<b>Total : </b> <input type="text" name="total" id="total" value="<?php echo $timeTaken['total']." Hrs."; ?>"/></td></tr></table>
</div>
</form>
 <script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByName('hours2[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value = tot+ ' Hrs.';
}

    </script>

</div>
<style>
.readyClose{
  float: left;
  padding: 30px 0 0 30px;
  color:red;
  font-size:20px;
}
</style>
<div class="readyClose">
<b>
<?php 
  date_default_timezone_set("Asia/Kolkata"); 
 $date = date('Y-m-d');
 if($date > $ssbArray['dueDate']){
    echo "DueDate Is Back From Current Date: ".$ssbArray['dueDate'];
    
    
 }
?>
</b>
</div>
<?php
if(($ssbArray['service']=='First-Time Template Setup') || ( $ssbArray['service']=='Template Setup'))
{
	?>
<div class="avgServices"  >
<?php
$month=date('m'); 
$year=date('Y');
$day=date('d');
$workingDaysFirstTimeTemplate = 0;
$j=0;
$getNoDaysFirstTimeTemp="select distinct(ssbID) as ssbID, startDate, dueDate, closedOn from closedssb where service='First-Time Template Setup' and MONTH(closedOn) = '$month' and YEAR (closedOn) = '$year'";
$resultNoDaysFirstTimeTemp=mysql_query($getNoDaysFirstTimeTemp);
while($rowNoDaysFirstTimeTemp=mysql_fetch_assoc($resultNoDaysFirstTimeTemp)){
	$j++;
	$startDateFirstTimeTemp = $rowNoDaysFirstTimeTemp['startDate'];
	$endDateFirstTimeTemp = $rowNoDaysFirstTimeTemp['closedOn'];
	//$startDate = "2014-06-03";
	//$endDate = "2014-06-26";

 
	$startTimestamp = strtotime($startDateFirstTimeTemp);
	$endTimestamp = strtotime($endDateFirstTimeTemp);
 
	for($i=$startTimestamp; $i<=$endTimestamp; $i = $i+(60*60*24) ){	
		if(date("N",$i) <= 5){
			$workingDaysFirstTimeTemplate = $workingDaysFirstTimeTemplate + 1;
		}
	}
	
}
$averageWorkingDaysFirstTimeTemplate = $workingDaysFirstTimeTemplate/$j ;

$workingDaysTemp = 0;
$k=0;
$getNoDaysTemp="select distinct(ssbID) as ssbID, startDate, dueDate, closedOn from closedssb where service='Template Setup' and MONTH(closedOn) = '$month' and YEAR (closedOn) = '$year'";
$resultNoDaysTemp=mysql_query($getNoDaysTemp);
while($rowNoDaysTemp=mysql_fetch_assoc($resultNoDaysTemp)){
	$k++;
	$startDateTemp = $rowNoDaysTemp['startDate'];
	$endDateTemp = $rowNoDaysTemp['closedOn'];
	//$startDate = "2014-06-03";
	//$endDate = "2014-06-26";

 
	$startTimestamp = strtotime($startDateTemp);
	$endTimestamp = strtotime($endDateTemp);
 
	for($i=$startTimestamp; $i<=$endTimestamp; $i = $i+(60*60*24) ){	
		if(date("N",$i) <= 5){
			$workingDaysTemp = $workingDaysTemp + 1;
		}
	}
	
}
$averageWorkingDaysTemp = $workingDaysTemp/$k ;


$workingDaysFullMig = 0;
$l=0;
$getNoDaysFullMig="select distinct(ssbID) as ssbID, startDate, dueDate, closedOn from closedssb where service='Full Migration' and MONTH(closedOn) = '$month' and YEAR (closedOn) = '$year'";
$resultNoDaysFullMig=mysql_query($getNoDaysFullMig);
while($rowNoDaysFullMig=mysql_fetch_assoc($resultNoDaysFullMig)){
	$l++;
	$startDateFullMig = $rowNoDaysFullMig['startDate'];
	$endDateFullMig = $rowNoDaysFullMig['closedOn'];
	//$startDate = "2014-06-03";
	//$endDate = "2014-06-26";

 
	$startTimestamp = strtotime($startDateFullMig);
	$endTimestamp = strtotime($endDateFullMig);
 
	for($i=$startTimestamp; $i<=$endTimestamp; $i = $i+(60*60*24) ){	
		if(date("N",$i) <= 5){
			$workingDaysFullMig = $workingDaysFullMig + 1;
		}
	}
	
}
$averageWorkingDaysFullMig = $workingDaysFullMig/$l ;


$workingDaysCMS = 0;
$m=0;
$getNoDaysCMS="select distinct(ssbID) as ssbID, startDate, dueDate, closedOn from closedssb where service='CMS>COS Full Migration' and MONTH(closedOn) = '$month' and YEAR (closedOn) = '$year'";
$resultNoDaysCMS=mysql_query($getNoDaysCMS);
while($rowNoDaysCMS=mysql_fetch_assoc($resultNoDaysCMS)){
	$m++;
	$startDateCMS = $rowNoDaysCMS['startDate'];
	$endDateCMS = $rowNoDaysCMS['closedOn'];
	//$startDate = "2014-06-03";
	//$endDate = "2014-06-26";

 
	$startTimestamp = strtotime($startDateCMS);
	$endTimestamp = strtotime($endDateCMS);
 
	for($i=$startTimestamp; $i<=$endTimestamp; $i = $i+(60*60*24) ){	
		if(date("N",$i) <= 5){
			$workingDaysCMS = $workingDaysCMS + 1;
		}
	}
	
}
$averageWorkingDaysCMS = $workingDaysCMS/$m ;

$getServiceTime="select  count(distinct ssbID) as numberServices ,sum(hours2) as hoursTime from closedssb where ((service='First-Time Template Setup' || service='Template Setup' ) and (MONTH(closedOn) = '$month'  && YEAR (closedOn) = '$year'))";
$runQuery=mysql_query($getServiceTime);
$totalServiceTime=mysql_fetch_assoc($runQuery);
?>

<table class="editTiming" >
<tr><td colspan="3" class="editTime editTimeHead">Average First-Time Template Setup & Template Setup</td></tr>
<tr  class="editTime"><td >Total Templates </td><td style="font-weight:normal"><?php echo  $totalServiceTime['numberServices']; ?></td></tr>

<tr  class="editTime"><td >Total Time</td><td style="font-weight:normal"> <?php echo  round($totalServiceTime['hoursTime'],2). " Hrs";?></td></tr>

<tr  class="editTime"><td > Average Time</td><td style="font-weight:normal"><?php echo round($totalServiceTime['hoursTime']/$totalServiceTime['numberServices'],2) ." Hrs"; ?></td></tr>

<tr><td colspan="3" class="editTime editTimeHead">Average TurnAround</td></tr>

<tr  class="editTime"><td >Template Setup</td><td style="font-weight:normal"><?php echo round($averageWorkingDaysTemp,2)." Days"; ?></td></tr>
<tr  class="editTime"><td >Full Migration</td><td style="font-weight:normal"><?php echo round($averageWorkingDaysFullMig,2)." Days"; ?></td></tr>
<tr  class="editTime"><td >CMS>COS Full Migration</td><td style="font-weight:normal"><?php echo round($averageWorkingDaysCMS,2)." Days"; ?></td></tr>
<tr  class="editTime"><td >First-Time Template Setup</td><td style="font-weight:normal"><?php echo round($averageWorkingDaysFirstTimeTemplate,2)." Days"; ?></td></tr>
</table>

</div>

<?php } else {} ?>
<table class='addFollower'>

<tr><td><b>Add Follower:</b></td><td>
		<input type="text" name="" placeholder='Type Follower Name Here' size="20" id="inputString"   onkeyup="lookup(this.value);"   >
		<input type='hidden' id='ssbID' value='<?php echo $ssbArray['ssbID'];?>'>
		<div class="suggestionsBox" id="suggestions" style="display: none;">
                    <div class="suggestionList" id="autoSuggestionsList">
                        &nbsp;
                    </div>
                </div></td></tr>
				<tr><td><div id='selectedEmp'>
				<?php
				$ssbID = $ssbArray['ssbID'];
				$getName = mysql_query("select * from followers where ssbID='$ssbID'");
				if(mysql_num_rows($getName) > 0){
					echo "<b>Followers:</b>";
				echo "<ul class='followers'>";
				 while($getEmpName = mysql_fetch_array($getName))
				 {	
						$empID = $getEmpName['owner'];
						$getNameEmp = mysql_query("select * from webadmin where adminID='$empID'");
						$name = mysql_fetch_assoc($getNameEmp);
						echo "<li>".$name['name']."<span class='remove' onclick='removeEntry(".$getEmpName['followerID'].")'><img src='images/delete-18.png'/></span></li>";
				 }
				echo "</ul>";
				}
				?>
				</div></td>
		</tr>
</table>
<?php include("Footer.php"); ?>