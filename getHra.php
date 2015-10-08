<?php
session_start();
if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
include("config.php");
//$q = $_GET['q'];
$basic = $_GET['basic'];
$getSalary = "select value from config";
$resultSalary = mysql_query($getSalary);
$storeArray = Array();
while ($row = mysql_fetch_array($resultSalary, MYSQL_ASSOC)) {
    $storeArray[] =  $row['value'];  
}
//print_r($storeArray);
$Pf = $storeArray[0];
$Esi = $storeArray[1];
$Hra = $storeArray[2];
$conveyance = $storeArray[3];
$medical = $storeArray[4];

$calPf = ($basic/100)*$Pf ;
$calEsi = ($basic/100)*$Esi ;
$calHra = ($basic/100)*$Hra ;
$a = array();
$a[0]=$calPf;
$a[1]=$calEsi;
$a[2]=$calHra;
$a[3]=$conveyance;
$a[4]=$medical;
//print_r($a);
echo implode($a,',');

?>