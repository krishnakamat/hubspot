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

?>
<head>
<style>
.sortable{
width:100%;
}
</style>
<!--<meta http-equiv="refresh" content="30">-->
</head>

	<script src="sorttable.js"></script>
	<?php include("function.php");?>
	<?php 	if($_SESSION['type']=='1'){?>
<?php
include("config.php");
	 $month=date('m'); 
	  $year=date('Y'); 
$allSsb="select * from closedssb where status ='Closed' and MONTH(closedOn) = '$month' and YEAR(closedOn) = '$year'";
$ssb=mysql_query($allSsb);
?>


<div class="ContentData">
<form action="insertTracking.php"  method="post">
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th>Sr. No.</th><th >SSB-ID</th><th>Customer Subscription Name</th><th>Queue</th><th>Service</th><th>Hours</th><th>Closed On</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
	?>
<tr  class='<?php echo $class; ?>' ><td><b><?php echo $x;?></b></td><td><?php echo $ssbArr['ssbID'];?></td><td><?php echo $ssbArr['custSubName'];?></td>
		<td><?php echo $ssbArr['queue'];?></td><td><?php echo $ssbArr['service'];?></td>	
		<td><?php echo $ssbArr['hours2'];?></td><td><?php echo $ssbArr['closedOn'];?></td>
		</tr>
<?php
}?>

</table>

</form>
</div>
</div>
<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } ?>