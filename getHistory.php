<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}	
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1)|| ($_SESSION['userRole']==2 && $_SESSION['status']==1) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}
?>

<style>
		table.sortable thead {
			background-color:#eee;
			color:#666666;
			font-weight: bold;
			cursor: default;

		}
		.sortable{
			border-collapse:collapse;
			}
			

		.sortable td{
			padding:5px;
			}
		.firstBackground
			{
				background-color:#DDFFDE;
			}
		.secondBackground
			{
			background-color:#BED1E5;
			}
	
	
	</style>
<script src="sorttable.js"></script>


<?php 	
include("config.php");
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1)|| ($_SESSION['userRole']==2 && $_SESSION['status']==1) ){?>
<?php

	$trackID=$_GET['trackID'];
	echo $trackID;

	$selectHistory="Select * from trackinghistory where trackID='$trackID'";
	$getHistory=mysql_query($selectHistory);
?>
<table border="1" class="sortable" style="border-collapse:collapse"><thead><th>Updated Data</th><th>Updated To</th><th>Date</th></thead>
<?php
$x=0;
	while($historyArr=mysql_fetch_array($getHistory))
	{
	$x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
	?>
		<tr class='<?php echo $class; ?>' ><td><?php echo $historyArr['updates'];?></td><td>
		<?php

		if(is_numeric($historyArr['status']))
		{
		 $getOwnerName=mysql_query("select * from webadmin where adminID ='$historyArr[status]'");
						$ownerArr=mysql_fetch_array($getOwnerName);
						$statusName = $ownerArr['name'];
							echo $statusName;

		}
		else{
		
?>
		<?php echo $historyArr['status']; ?>
	<?php 	} ?></td><td><?php echo $historyArr['date'];?></td></tr>
	
	<?php
	}

	?>
	</table>
	<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } ?>

