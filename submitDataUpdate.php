<?php 
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
//ob_start();
include("config.php");
$data = mysql_real_escape_string($_POST['data']);
$updateData="update updatedata set data='$data' where id='1'";
$dataUpdate=mysql_query("$updateData")or die(mysql_error());

if($dataUpdate)
{
	
echo "<script> window.history.go(-1); </script>";

}
?>

