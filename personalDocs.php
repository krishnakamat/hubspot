<?php
		session_start();

		if(!isset($_SESSION['loggedIn'])){

		echo "<script>location.href='index.php';</script>";
		}

		if(($_SESSION['userRole']==1 && $_SESSION['status']==1 || ($_SESSION['userRole']==2 && $_SESSION['status']==1)) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}
include("config.php");

?>
<?php

$getEmployeeDetails="select * from webadmin where adminID='".$_SESSION['adminID']."'";
$emoloyeeDetailsQuery=mysql_query($getEmployeeDetails) or die(mysql_error());
$getEmployeeDetailsArr=mysql_fetch_array($emoloyeeDetailsQuery);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Personal Informations</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
</head>
<body>
<br/>
<br/>
<div class="leave_tracking_container-wrapper">
<div class="leave_tracking_container">
	<!--<div id="personal" style="border:1px solid #000;padding-left:20px;">-->
<form method="post" class="appnitro" enctype="multipart/form-data" autocomplete="off">
<!--<div class="form_description">-->
<div class="heading" style="background: none repeat scroll 0 0 #9bbb59;border-bottom-color: #ffffff; color: #ffffff; font-size: 20px; padding: 15px;text-align: center;">
<h2><a href="personalInfo.php?empID=<?php echo $getEmployeeDetailsArr['empID']; ?>">Personal Details</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="personalDocs.php?empID=<?php echo $getEmployeeDetailsArr['empID']; ?>">Documents</a></h2>
</div>
<br/>
<h2 style="font-size:20px;" align="center"><?php 	echo $getEmployeeDetailsArr['name']."(".$getEmployeeDetailsArr['empID']." )"; ?></h2>
<div class="content">

<style>
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
		<!--<span onclick='deleteDocument("<?php echo $documents['docID']; ?>","<?php echo $documents['docType']; ?>","<?php echo $documents['empID']; ?>")' class="close-icon"></span>--></div>
	
	
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
		<!--<span onclick='deleteDocument("<?php echo $documents['docID']; ?>","<?php echo $documents['docType']; ?>","<?php echo $documents['empID']; ?>")' class="close-icon"></span>--></div>
	
	
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
		<!--<span onclick='deleteDocument("<?php echo $documents['docID']; ?>","<?php echo $documents['docType']; ?>","<?php echo $documents['empID']; ?>")' class="close-icon"></span>--></div>
	
	
<?php } } ?>

<br/><br/>

<input type="hidden" name="employeeID" value="<?php echo $_REQUEST['empID']; ?>">

<!--<select name="docType" required>
		<option value="" selected>Document Type</option>
		<option value="1">Address Proof</option>
		<option value="2">Education</option>
		<option value="3">Photo ID Proof</option>
</select>
<a style="cursor:pointer" onclick="appendText()"><h2>Add Documents  +</h2>
</a>
<p class="addDocument" width="200px"></p>
<br/><br/>
<input type="submit" name="submit" value="Submit" align="center">-->
</form>
</div>
<!--</div>-->
</div>
</div>

<?php include("Footer.php"); ?>
