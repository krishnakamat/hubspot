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



include("config.php");

?>
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Update Employee</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!--
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
$(function() {
var date = new Date();
var currentMonth = date.getMonth();
var currentDate = date.getDate();
var currentYear = date.getFullYear();
//$('#startdate,#startdate1,#enddate1').datepicker({minDate: new Date(currentYear, currentMonth, currentDate),dateFormat: "yy-mm-dd"});

$('#startdate').datepicker({dateFormat: "yy-mm-dd"});
   
});
</script>-->
<script>

function dol(type)

	{

		if(type==2 || type==3)

		{

			document.getElementById("lead").style.display="table-row";

		

		}

		else {

	

			document.getElementById("lead").style.display="none";

		

		}



	}

	</script>
<script>
function getUser(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	document.getElementById("personal").style.display="none";

    }
  }
xmlhttp.open("GET","getEmployees.php?q="+str,true);
xmlhttp.send();
}
</script>

	<script>
function getActiveEmployee(str)
{

var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getActiveEmployees.php?q="+str,true);
xmlhttp.send();
}
</script>

	<script>

	function updateUser(val,update,empID)

	{

	//	alert(val);

	//	alert(update);

		//alert(empID);



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

			xmlhttp.open("GET",'updateUserProfile.php?value='+val+'&empID='+empID+'&toUpdate='+update,true);

			xmlhttp.send();

	





	}

	</script>

	<script>

		function deleteUser(userId,usrName) {

			//alert(userId);

	var answer = confirm("You have selected to delete "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="deleteUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
	
		<script>

		function resignUser(userId,usrName) {

			//alert(userId);

	var answer = confirm("You have selected to resign "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="resignUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
	
		<script>

		function abscondUser(userId,usrName) {

			//alert(userId);

	var answer = confirm("You have selected to abscond "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="abscondUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
	$.ajax({
	type: "POST",
	url: "search.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#result").html(html).show();
	}
	});
}return false;    
});

jQuery("#result").live("click",function(e){ 
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#result").fadeOut(); 
	}
});
$('#searchid').click(function(){
	jQuery("#result").fadeIn();
});
});
</script>
<script>
function getEmployee(empID)
{
	//alert(empID);
	   window.location.href="editUser.php?empID="+empID;
	document.getElementById("employeeNumber").value=empID;
}
</script>
<style type="text/css">
	.content{
		width:250px;
		
	}
	#searchid
	{
		width:250px;
		border:solid 1px #000;
		padding:10px;
		font-size:14px;
		margin-right:50px;
	}
	#result
	{
		position:absolute;
		width:250px;
		padding:10px;
		display:none;
		margin-top:-1px;
		border-top:0px;
		overflow:hidden;
		border:1px #CCC solid;
		background-color: white;
	}
	.show
	{
		padding:10px; 
		border-bottom:1px #999 dashed;
		font-size:15px; 
		height:50px;
	}
	.show:hover
	{
		background:#4c66a4;
		color:#FFF;
		cursor:pointer;
	}
</style>
<?php

if(isset($_POST['submit'])){
$idd=$_REQUEST['empID'];
$docType = $_POST['docType'];	//
$docNames = $_POST['docName'];
$docDetail =  $_FILES['doc']['name'];
//$father = $_POST['father'];
//$mother = $_POST['mother'];
//$PAN_Card = $_POST['PAN_Card'];
//$personal_details = "update personal_details set father_name = '$father', mother_name = '$mother', PAN_Card = '$PAN_Card' where empID = '$idd'";
//$result = mysql_query($personal_details);
$items = array();

$size = count($docNames);

for($i = 0 ; $i < $size ; $i++){
if (empty($docNames[$i]) || empty($docDetail[$i])) {
    continue;
}
$items[]=array(
	"idd"		=> $idd,
	"docType"    => $docType,	
	"docName"    => $docNames[$i],  
	"docDetail"  => $docDetail[$i],	//
     
			//
);
}

if (!empty($items)) {
$values = array();
foreach($items as $item){
    $values[] = "('{$item['idd']}','{$item['docType']}','{$item['docName']}','{$item['docDetail']}')";
}

$values = implode(", ", $values);

$sql = "INSERT INTO documents(empID,docType,docName,docDetail) VALUES{$values}" ;
$result = mysql_query($sql);

}

foreach($_FILES['doc']['tmp_name'] as $key => $tmp_name ){
    $file_name = $idd._.$_FILES['doc']['name'][$key];
	$file_tmp =$_FILES['doc']['tmp_name'][$key];
	move_uploaded_file($file_tmp,"documents/".$file_name);
}
}
?>

<script>

function appendText() {
   var txt1 = "<div class='parentClass' style='width:400px;' ><br/><input type='text' name='docName[]' required placeholder='Document Name'>  <input required type='file' name='doc[]' accept='image/jpeg,image/gif,image/png,.pdf' >&nbsp;&nbsp;<img src='images/close-doc.png' width='15px' height='15px' class='close1'><br/></div>";              // Create text with HTML
   var txt2 = $("<p></p>").text("Text.");  // Create text with jQuery
   var txt3 = document.createElement("p");
   txt3.innerHTML = "Text.";               // Create text with DOM
   $(".addDocument").append(txt1);     // Append new elements
}
</script>
<script>
$(".close1").live("click",function(){
    $(this).closest('div.parentClass').remove();
});
</script>
	<script>
			function deleteDocument(docID,docType,empID)
			{	
					var txt;
					var r = confirm("You Selected to Delete "+ docType +" Are You Sure ?" );
					if (r == true) {
						location.href="deleteDocument.php?docID="+docID+"&employeeID="+empID;

					} else {
					return false;
					}
					//document.getElementById("demo").innerHTML = txt;

			}
			</script>
</head>
</body>


<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>

<?php include("function.php");?>


<div id="myDiv"></div>
<div style="border:1px solid #000;margin:5px 280px 0px 280px;padding-bottom:24px"><span style="margin-left:20px;">Employee Status</span>
<select name="employeeStatus" onchange="getUser(this.value)" style="margin:20px 0 0 1px;height:35px !important;">
	<option value="">Select</option>
	<option value="1">Active</option>
	<option value="2" >Resigned</option>
	<option value="3" >Absconded</option>
	</option>
</select>

<div class="content"  style="margin-top:-32px;margin-left:300px">
<input type="text" class="search" id="searchid" placeholder="Search for Employee" /><br /> 
<div id="result">
</div>
</div>
<div style='float:right;margin-right:50px;margin-top:-35px'>
<form method="post" action="">
<table >
<input name="search" type="button" value="Search Active User" onclick= "getUser(1);">
</table>
</form>
</div>
</div>
<br/>
<div style="margin-left:180px;margin-right:180px;" id="txtHint"></div>

<?php 
	include("config.php");
	$getEmployeeDetails="select * from webadmin where empID= '$_GET[empID]'";
					$emoloyeeDetailsQuery=mysql_query($getEmployeeDetails) or die(mysql_error());
					$getEmployeeDetailsArr=mysql_fetch_array($emoloyeeDetailsQuery);
					 //$getEmployeeDetailsArr['firstName'];
					// $getEmployeeDetailsArr['medical_allowance'];
					?>
					<?php if(isset($_GET['empID']) || ($_GET['empID'] != '')) { ?>
					<div id="personal" style="border:1px solid #000;padding-left:20px;">
					<form method="post" class="appnitro" enctype="multipart/form-data" autocomplete="off">
<div class="form_description">
<h2><a href="editUser.php?empID=<?php echo $_GET['empID']; ?>">Personal Details</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="saveDocuments.php?empID=<?php echo $_GET['empID']; ?>">Documents</a></h2><br/>
<h2><?php 	echo $getEmployeeDetailsArr['name']."(".$getEmployeeDetailsArr['empID']." )"; ?></h2><p></p></div>
<div class="content">

		<style>
			
			
			h2{font-size:13px; margin:15px 0 0 0;}
			.image-container {
  display: inline-block;
  margin-right: 10px;
  position: relative;
}
.image-container .close-icon {
  background: url("images/Close-icon.png") no-repeat scroll 0 0 / cover  rgba(0, 0, 0, 0);
  height: 20px;
  position: absolute;
  right: -8px;
  top: -8px;
  width: 20px;
  z-index: 2;
}
		</style>
		<link rel="stylesheet" href="colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
	
<?php 
$queryPersonalDetails = "select * from webadmin where empID	= '".$_GET['empID']."'";
$resultPersonalDetails = mysql_query($queryPersonalDetails);
$rowPersonalDetails = mysql_fetch_array($resultPersonalDetails);
?>		
		
<?php
echo "<br/>";
$getDocuments="select * from documents where empID='$_REQUEST[empID]' and docType = 1";
$document=mysql_query($getDocuments);
$documentNum=mysql_num_rows($document);
if($documentNum > 0){
echo "<span  style='margin-top:-15px;position:absolute'><b>Address Proof Documents</b></span>";
echo "<br/>";	

while($documents=mysql_fetch_array($document))
{ ?>
		<div class="image-container"><a class="group3" href="documents/<?php echo $_REQUEST['empID']."_".$documents['docDetail'];?>" title="<?php echo $documents['docName']; ?>"><img height="100px" width="100px" src="documents/<?php echo $_REQUEST['empID']."_".$documents['docDetail'];?>">
		<p><?php echo $documents['docName']; ?></p>
		</a>
		<span onclick='deleteDocument("<?php echo $documents['docID']; ?>","<?php echo $documents['docType']; ?>","<?php echo $documents['empID']; ?>")' class="close-icon"></span></div>
	
	
<?php } } ?>
<br/>
<?php 
echo "<br/>";
$getDocuments="select * from documents where empID='$_REQUEST[empID]' and docType = 2";
$document=mysql_query($getDocuments);
$documentNum=mysql_num_rows($document);
if($documentNum > 0){
echo "<span style='margin-top:-15px;position:absolute'><b>Education Documents</b></span>";
echo "<br/>";

while($documents=mysql_fetch_array($document))
{ ?>
		<div class="image-container"><a class="group3" href="documents/<?php echo $_REQUEST['empID']."_".$documents['docDetail'];?>" title="<?php echo $documents['docName']; ?>"><img height="100px" width="100px" src="documents/<?php echo $_REQUEST['empID']."_".$documents['docDetail'];?>">
		<p><?php echo $documents['docName']; ?></p>
		</a>
		<span onclick='deleteDocument("<?php echo $documents['docID']; ?>","<?php echo $documents['docType']; ?>","<?php echo $documents['empID']; ?>")' class="close-icon"></span></div>
	
	
<?php } } ?>

<br/>
<?php
echo "<br/>"; 
$getDocuments="select * from documents where empID='$_REQUEST[empID]' and docType = 3";
$document=mysql_query($getDocuments);
$documentNum=mysql_num_rows($document);
if($documentNum > 0){
echo "<span style='margin-top:-15px;position:absolute'><b>Photo ID Proof Documents</b></span>";
echo "<br/>";

while($documents=mysql_fetch_array($document))
{ ?>
		<div class="image-container"><a class="group3" href="documents/<?php echo $_REQUEST['empID']."_".$documents['docDetail'];?>" title="<?php echo $documents['docName']; ?>"><img height="100px" width="100px" src="documents/<?php echo $_REQUEST['empID']."_".$documents['docDetail'];?>">
		<p><?php echo $documents['docName']; ?></p>
		</a>
		<span onclick='deleteDocument("<?php echo $documents['docID']; ?>","<?php echo $documents['docType']; ?>","<?php echo $documents['empID']; ?>")' class="close-icon"></span></div>
	
	
<?php } } ?>

<br/><br/>

<input type="hidden" name="employeeID" value="<?php echo $_REQUEST['empID']; ?>">

<select name="docType" required>
		<option value="" selected>Document Type</option>
		<option value="1">Address Proof</option>
		<option value="2">Education</option>
		<option value="3">Photo ID Proof</option>
</select>
<a style="cursor:pointer" onclick="appendText()"><h2>Add Documents  +</h2>
</a>
<p class="addDocument" width="200px"></p>
<br/><br/>
<input type="submit" name="submit" value="Submit" align="center">
</form>
</div>
	</div>
	
	
	

	<?php } } else { echo "You are not permitted to Access this Page"; } ?>

<?php include("Footer.php"); ?>