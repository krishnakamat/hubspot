<?php
		session_start();

		if(!isset($_SESSION['loggedIn'])){

			echo "<script>location.href='index.php';</script>";
		}

		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){ 	
			include_once ("Header.php");
		}
include("config.php");

?>
<?php if($_SESSION['userRole']=='1')
{
?>
<?php
$query="select * from webadmin where (userRole = 1  or userRole = 2 or userRole = 3) and status = 1 and employeeType = 1 order by name asc";
$result=mysql_query($query);
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

}

</script>

 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  

   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 



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
	
	<script>
function leaveBalance(empid)
{
var xmlhttp;    
if (empid=="")
  {
  document.getElementById("leave").innerHTML="";
  return;
  }
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
    document.getElementById("leave").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","leaveBalance.php?q="+empid,true);
xmlhttp.send();
}
</script>


</head>
<body>
<div class="leave_tracking_container-wrapper">


<?php @$msg=$_GET['msg']; 
	@$status=$_GET['status']; 
	@$appliedFor=$_GET['appliedFor']; 
	@$weekend=$_GET['weekend'];
	@$holiday=$_GET['holiday'];
	@$name=$_GET['name'];
	@$adminid=$_GET['adminid'];
	if(!empty($adminid)){
		$fetchName = "select * from webadmin where adminID = '$adminid'";
		$resultfetchName = mysql_query($fetchName);
		$rowfetchName = mysql_fetch_array($resultfetchName);
		$name = $rowfetchName['name'];	
	}
	if($msg=='Err'){

			echo "<div align='center' class='error-message'> <h3>You are not provided the leave because you have no leave balance!</h3>  </div>";
		
	}elseif($msg=='Twice'){
	
			echo "<div align='center' class='error-message'> <h3>$name has already applied leave on this date!</h3>   </div>";
	
	}elseif($weekend=='true'){
	
			echo "<div align='center' class='error-message'> <h3>Already Weekend!</h3> </div>";
	
	}elseif($holiday=='true'){
	
			echo "<div align='center' class='error-message'> <h3>Already Holiday!</h3> </div>";
	
	}else{
			if(!empty($msg) && empty($status)){
		
?>
			 <div align='center' class='success-message'> <h3><?php echo "$name's Leave Is Applied Successfully!" ;?></h3>  </div>
<?php 		}
			if(!empty($msg) && !empty($status)){
?>		 
			<div align='center'> <h3> <?php echo "$name's Leave Is Applied Successfully And Already $status Employees Applied Leaves!";?></h3>  </div>

<?php 		}  
	
	} 
?>
	
<div class="leave_tracking_container">
<form method="post" name="leav" action="adminInsertLeaves.php" onsubmit="return validate();">
<table align="center" border="1px" style="border-collapse:collapse" class="applyemployeeleaves">
<tr class="heading"><td colspan="2" align="center" >Leave Form</td>
</tr>

<tr><td>Name:</td></tr>
<tr><td>
<select name="adminid" onChange="leaveBalance(this.value)">
<option value="">Select a employee:</option>
<?php
while($row=mysql_fetch_array($result)){
?>
<option value="<?php echo $row['adminID']; ?>"><?php echo $row['name'];?></option>
<?php } ?>
</select>
<!--<input type="hidden" name="adminid" value="<?php echo $row['adminID']; ?>">--></td>
</tr>
<tr><td>Leave Balance</td></tr><tr><td id="leave"><?php //leaveBalance(); ?></td></tr>
<tr>
<td colspan='2'>Type: &nbsp;<input type="radio" name="type" value="1">Half Day &nbsp;&nbsp;<input type="radio" name="type" value="2">Full Day &nbsp;&nbsp;<input type="checkbox" name="planned" value="2"> Unplanned Leave</td></tr>
<tr id="lead1" style="display:none">

<td><input type='text' name="date1" id="startdate" placeholder="Date:"></td></tr>

<tr  id="lead" style="display:none"><td><input type='text' placeholder="From:" name="date2" id="startdate1"><input placeholder="To:" type="text" name="date3" id="enddate1"></td></tr>
<tr><td>Notes:</td></tr><tr><td><textarea name="notes" rows="5" cols="30"></textarea></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>
</tr>

</table>
</form>
</div>
</div>
<?php
}
else
{
	echo "You are not Permitted to Access this Page";
}
?><?php include("Footer.php"); ?>
