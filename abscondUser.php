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
$userId = $_GET['userId'];
$query = "update  webadmin set status = 3 WHERE adminID = $userId";
$result = mysql_query($query) or die("Could not execute query");
echo "<script language=javascript>";
echo "location.href='editUser.php?msg=Absconded Successfully'";
echo "</script>";
?>