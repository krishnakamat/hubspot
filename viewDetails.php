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

?>
<head>
<meta http-equiv="refresh" content="30">
</head>
<?php include("function.php");?>
	<script src="sorttable.js"></script>
	<style>
	.sortable{
	width:100%;
	}
	</style>
	<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
	
<?php
$owner=$_GET['owner'];
include("config.php");
$allSsb="select * from tracking where status !='Closed' && owner='$owner' ";
//echo $allSsb;
$ssb=mysql_query($allSsb);
?>

<div class="addData">
<div id="myDiv">
</div>
<div class="ContentData">
<form action="insertTracking.php"  method="post">
<table class="sortable" border="2" ><thead><tr style="background:#ccc;"><th >SSB-ID</th><th>Customer Subscription Name</th><th>Queue</th><th>Start Date</th><th>Due Date</th><th>Service</th><th>URL To Migrate</th><th>Pages</th><th>Status</th><th>Owner</th><th>First Reviewer</th><th>Second Reviewer</th></tr></thead>
<?php
$x=0;
while($ssbArr=mysql_fetch_array($ssb))
{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
	?>
<tr  class='<?php echo $class; ?>  <?php echo str_replace(' ', '-',$ssbArr['status']);?>' ><td><?php echo $ssbArr['ssbID'];?></td><td><?php echo $ssbArr['custSubName'];?></td>
		<td><?php echo $ssbArr['queue'];?></td><td><?php echo $ssbArr['startDate'];?></td>	
		<td><?php echo $ssbArr['dueDate'];?></td><td><?php echo $ssbArr['service'];?></td>
		<td><?php echo $ssbArr['migrateUrl'];?></td>
		<td><?php echo $ssbArr['pages'];?></td><td >
				<?php echo $ssbArr['status'];?></td>
		<td  >
		<?php echo $ssbArr['owner'];?>
		</td>
		<td>
<?php echo $ssbArr['firstReviewer'];?></td>
		<td ><?php echo $ssbArr['secondReviewer'];?></td>
		</tr>
<?php
}?>

</table>

</form>
</div>
</div>
<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } ?>

