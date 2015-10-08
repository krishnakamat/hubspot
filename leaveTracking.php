<?php
		session_start();

		if(!isset($_SESSION['loggedIn'])){

		echo "<script>location.href='index.php';</script>";
		}

		if(($_SESSION['userRole']==1 && $_SESSION['status']==1 || ($_SESSION['userRole']==2 && $_SESSION['status']==1)) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 	
			include_once ("Header.php");
		}
include("config.php");

?>
<?php
$query="select * from webadmin where adminID='".$_SESSION['adminID']."'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Leave Tracking</title>

<script type="text/javascript">

function validate(){
if($('input[name="type"]:checked').length == 0) {
    alert('Please select your type!');
	return false;
}
var da = document.leav.type.value;
var dat =document.leav.date1.value;
if(da==1 && dat==''){
alert("Please select your date!");
document.leav.date1.focus();
return false;
}

var da = document.leav.type.value;
var dat2 =document.leav.date2.value;
if(da==2 && dat2==''){
alert("Please select your from date!");
document.leav.date2.focus();
return false;
}

var da = document.leav.type.value;
var dat3 =document.leav.date3.value;
if(da==2 && dat3==''){
alert("Please select your to date!");
document.leav.date3.focus();
return false;
}
var notes = document.leav.notes.value;
if(notes==''){
alert("Please enter your leave notes!");
document.leav.notes.focus();
return false;
}
var permission = document.leav.permission.checked;
if(permission==false){
	alert('Make sure that your leave is approved by your TeamLeader/Manager.');
	return false;
	}
	  //alert(datediff("day", startdate1, enddate1)); // what goes here?



//Usage
   //var d1 = new Date(2015,08,01);
   //var d2 = new Date(2015,08,05);
  /* var start = document.getElementById("startdate1").value;
   var d1 = new Date(start);
   alert(d1);
   var y1 = d1.getFullYear();
   alert(y1);
   var m1 = d1.getMonth();
   alert(m1);
   var dd1 = d1.getDate();
   alert(dd1)
   var end = document.getElementById("enddate1").value;
   var d2 = new Date(end);
   var y2 = d2.getFullYear();
   var m2 = d2.getMonth();
   var dd2 = d2.getDate();
   
   var d1 = new Date(y1,m1,dd1);
   var d2 = new Date(y2,m2,dd2);
   
   var flag=true;
   var day,daycount=0;
   while(flag) 
   {
      day=d1.getDay();
      if(day != 0 && day != 6)
         daycount++;
      d1.setDate(d1.getDate()+1) ;
      if(d1.getDate() == d2.getDate() && 
                  d1.getMonth()== d2.getMonth())
      {
          flag=false;
      }
 }
 alert(daycount);*/
//document.write("Work Day COunt"+daycount);
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf())
    date.setDate(date.getDate() + days);
    return date;
}
function getBusinessDatesCount(startDate, endDate) {
    var count = 0;
    var curDate = startDate;
    while (curDate <= endDate) {
        var dayOfWeek = curDate.getDay();
        var isWeekend = (dayOfWeek == 6) || (dayOfWeek == 0); 
        if(!isWeekend)
           count++;
        curDate = curDate.addDays(1);
    }
    return count;
}


//Usage
var start = document.getElementById("startdate1").value;
//var d1 = new Date(start);
var startDate = new Date(start);
var end = document.getElementById("enddate1").value;
  // var d2 = new Date(end);
var endDate = new Date(end);
var numOfDates = getBusinessDatesCount(startDate,endDate);
//alert(numOfDates)
if(numOfDates > 5){
 if (confirm("You have applied the "+numOfDates+" leaves. For smooth approval, It should be 5. Are you sure you want to apply!") == true) {
        return true;
    } else {
		document.leav.date1.focus();
        return false;
    }

}
}

</script>
<script>
/*alert("hi");
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf())
    date.setDate(date.getDate() + days);
    return date;
}

function getBusinessDatesCount(startDate, endDate) {
    var count = 0;
    var curDate = startDate;
    while (curDate <= endDate) {
        var dayOfWeek = curDate.getDay();
        var isWeekend = (dayOfWeek == 6) || (dayOfWeek == 0); 
        if(!isWeekend)
           count++;
        curDate = curDate.addDays(1);
    }
    return count;
}
//var startDate = new Date('7/16/2015');
//var endDate = new Date('7/20/2015');
var startDate = document.getElementById("startdate1").value;
var endDate = document.getElementById("enddate1").value;
var numOfDates = getBusinessDatesCount(startDate,endDate);
alert(numOfDates);*/
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  

   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 


<!--
   <script type="text/javascript">

       $(function() {

               $("#startdate").datepicker({ dateFormat: "yy-mm-dd" }).val()
			   $("#startdate1").datepicker({ dateFormat: "yy-mm-dd" }).val()

               $("#enddate1").datepicker({ dateFormat: "yy-mm-dd" }).val()

       });



   </script>  -->
   
   
   <script type="text/javascript">
$(function() {
var date = new Date();
var currentMonth = date.getMonth();
var currentDate = date.getDate();
var currentYear = date.getFullYear();
$('#startdate,#startdate1,#enddate1').datepicker({dateFormat: "yy-mm-dd"});   
});
</script>
   
    <!--<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>-->

    <script type="text/javascript">

        $(document).ready(function(){

            $('input[type="radio"]').click(function(){

                if($(this).attr("value")=="1"){

                    $("#lead").hide();

                    $("#lead1").show();
				

                }

                if($(this).attr("value")=="2"){

                    $("#lead1").hide();

                    $("#lead").show();
				
										
                }

                
            });

        });

    </script>

</head>
<body>
<div class="leave_tracking_container-wrapper">

<?php @$msg=$_GET['msg']; 
	@$status=$_GET['status']; 
	@$appliedFor=$_GET['appliedFor']; 
	@$weekend=$_GET['weekend'];
	@$holiday=$_GET['holiday'];
	if($msg=='Err')

	{

			echo "<div class='error-message'><h3>You are not provided the leave because you have no leave balance!</h3>  </div>";
		
	}elseif($msg=='Twice'){
	echo "<div class='error-message'><h3>You have already applied leave on this date!</h3>  </div>";
	
	}elseif($weekend=='true'){
	?>
	<div class='error-message'><h3><?php echo "Already Weekend!" ;?></h3>  </div>
	<?php
	}elseif($holiday=='true'){
	?>
	<div class='error-message'><h3><?php echo "Already Holiday!" ;?></h3>  </div>
	<?php
	}else{
			if(!empty($msg) && empty($status)){
		
?>
			<!--<div align='center'> <b><?php //echo $msg.' '.$status;?></b>  </div>-->
			<div class='success-message'><h3><?php echo "Your Leave Is Applied Successfully!" ;?></h3>  </div>
<?php		}
			if(!empty($msg) && !empty($status)){
?>
			<div class='success-message'><h3><?php echo "Your Leave Is Applied Successfully And Already $status Employees Applied Leaves!";?></h3>  </div>
<?php	
			} 
			
		} 
?>
	
<?php
function leaveBalance(){
//$dateCount1="select count(appliedFor) as count, Notes, leaveID, status, typeLeave, appliedFor from empleavedetails where empID='".$_SESSION['adminID']."' and typeLeave = 1 and appliedFor >= '$appliedOn' and status = 1";
$dateCount1="select count(appliedFor) as count, Notes, leaveID, status, typeLeave, appliedFor from empleavedetails where empID='".$_SESSION['adminID']."' and typeLeave = 1 and status = 1";
$resultdateCount1=mysql_query($dateCount1);
$rowdateCount1=mysql_fetch_array($resultdateCount1);
$balcount = $rowdateCount1['count']/2;

//$dateCount2="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where empID='".$_SESSION['adminID']."' and typeLeave = 2 and appliedFor >= '$appliedOn' and status = 1";
$dateCount2="select count(appliedFor) as count, Notes, leaveID, status, typeLeave from empleavedetails where empID='".$_SESSION['adminID']."' and typeLeave = 2 and status = 1";
$resultdateCount2=mysql_query($dateCount2);
$rowdateCount2=mysql_fetch_array($resultdateCount2);
$balcount1 = $rowdateCount2['count'];

$balcount2 = $balcount + $balcount1;

$leaveBalance="select * from empleavebalance where empID='".$_SESSION['adminID']."'";
$resultleaveBalance=mysql_query($leaveBalance);
$rowleaveBalance=mysql_fetch_array($resultleaveBalance);
$accuratebal = $rowleaveBalance['accrued'] - $rowleaveBalance['leaveUsed']+$rowleaveBalance['salaryAdjustment'] - $balcount2;
if($accuratebal > 0){
echo $accuratebal;
}else{
echo "0";
}
}
?>
<div class="leave_tracking_container">
<form method="post" name="leav" action="insertLeave.php" onsubmit="return validate();">
<table align="center" border="1px" class="leave_tracking_table">
<tr class="heading"><td colspan="2"><h1>Leave Form</h1></td>
</tr>

<tr><td colspan="2"><label>Name:</label></td></tr>
<tr>
<td colspan="2"><input readonly type="text" name="na" value="<?php echo $row['name']; ?>">
<input type="hidden" name="adminid" value="<?php echo $row['adminID']; ?>"></td>
</tr>
 <tr><td>Leave Balance</td><td><?php leaveBalance(); ?></td></tr>

<tr>
<td colspan="2"><label>Type:</label><input type="radio" name="type" value="1">Half Day &nbsp;&nbsp;<input type="radio" name="type" value="2">Full Day</td>
</tr>
<tr id="lead1" style="display:none">
<td colspan="2"><input type='text' placeholder="Date" name="date1" id="startdate"></td>
</tr>

<tr  id="lead" style="display:none"><td>

	
		<input type='text' placeholder="From: " name="date2" id="startdate1">

		<input type="text" placeholder="To: " name="date3" id="enddate1">

</td></tr>
<tr><td colspan="2"><label>Notes:</label></td></tr>
<tr><td><textarea name="notes" rows="5" cols="30"></textarea></td></tr>
<tr>
<td><input type="checkbox" name="permission" id="permission" >&nbsp;&nbsp;Approved By TeamLead/Manager</td>
<td colspan="2"><input type="submit" name="submit" value="Apply"></td>
</tr>

</table>
</form>


</div>
</div>

<?php include("Footer.php"); ?>
