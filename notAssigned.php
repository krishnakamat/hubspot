<?php 
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php"); ?>
<div class="ownerReport">
	<p>Not Assigned Report</p>
	<table>
		<?php $allOwners="select count(queue) as ownercount,queue from tracking  where owner ='0' group by queue order by ownercount desc";
								  $owner=mysql_query($allOwners);
								  $x=0;
								  while($ownerArr=mysql_fetch_array($owner))
										{
										
									  $x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
									  ?>
									  
				<tr class='<?php echo $class; ?>'><td > <b><?php echo $x." . "; ?></b>
				<?php echo $ownerArr['queue']; ?> </td><td><a href="searchResults.php?queue[]=<?php echo $ownerArr['queue']; ?>&owner[]=0"> <?php echo $ownerArr['ownercount']; ?></a></td></tr>

									<?php 	}
	
	
	
	?>
</table>
	</div>
