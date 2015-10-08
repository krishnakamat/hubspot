<?php
		session_start();

		if(!isset($_SESSION['loggedIn']))

		echo "<script>location.href='index.php';</script>";

						if($_SESSION['type']=='2'){

							include_once ("Header.php");

						}

						else{

							include_once ("HeaderAdmin.php");

}
include("config.php");
?>

<html>
<body>
<?php
$date = date('y-m-d');
$empleaveTotal = "select distinct(appliedFor), empID, status, appliedFor from empleavedetails where appliedFor >= '$date' and (status = 1 or status = 3) order by appliedFor asc";
$resultempleaveTotal = mysql_query($empleaveTotal);
$num = mysql_num_rows($resultempleaveTotal);
if($num > 0){
?><br/>
<form method="post" action>
<table border="1px" align="center" 	style = "border-collapse: collapse;">
<tr><td>Date</td><td>Day</td></tr>
<?php 
while($rowempleaveTotal = mysql_fetch_array($resultempleaveTotal)){
$empName = "select * from webadmin where adminID = '".$rowempleaveTotal[empID]."'";
$resultempName = mysql_query($empName);
$rowempName = mysql_fetch_array($resultempName);
?>
<tr><td><?php echo $rowempleaveTotal['appliedFor']; ?></td>
<?php
$samedate = "select * from empleavedetails where appliedFor = '".$rowempleaveTotal[appliedFor]."' and empID = '".$rowempName[adminID]."'";
$resultsamedate = mysql_query($samedate);
while($rowsamedate = mysql_fetch_array($resultsamedate)){
?>
<td><?php if($rowempleaveTotal['status']==3){?>
<span style="background-color:#99CC00;color:#fff"><?php echo $rowempName['name'];?></span>
<?php }else{?>
 <span style="background-color:#FF6600;color:#ffffff"><?php  echo $rowempName['name']; ?></span><?php } ?></td>
 <?php } ?>
 </tr>
<?php } ?>
</table>
</form>
<?php } ?>
</body>
</html>
<?php include("Footer.php"); ?>