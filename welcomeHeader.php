<?php
ob_start();
	include("config.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Admin</title>

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style1.css">

<link href="css/search.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style_tb.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script src="sorttable.js"></script>
<script type="text/javascript">
$(function() {		
	$("#tablesorter-demo").tablesorter({sortList:[[0,1]], widgets: ['zebra']});
	$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
});	
</script>
<style>
.zone {
    display: inline-block;
    font-size: 14px;
    padding: 14px 20px 0;
    color:#fff;
}</style>
</head>
<body>

<div class="wrapper">

<div class="header">

  <div class="inner-header page-center">
<div class="custom-logo">
<a href="http://thewebplant.com/" />
<img src="images1/logo.png"  title="The Webplant" alt="The Webplant" />
</a>
</div>
  <div class="header-left">
   <style>
   .header-left {
padding: 3px 0 50px 24px;
}</style>

  </div>
   
  
  <div class="clear"></div>
</div>
</div>

<!-- menu start -->
<div class="header-bottom" >
  <div class="page-center">

<div class="header-right"> 
	<a class="link logout" href="logout.php">Logout</a>
  </div>
  </div>
  </div>