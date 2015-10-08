<?php 
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php"); ?>
<div class="ownerReport">
	<p >Owner Report</p>
	<table>
		<?php $allOwners="select count(owner) as ownercount,owner from tracking  where status !='Blocked' group by owner order by ownercount desc";
								  $owner=mysql_query($allOwners);
								  $x=0;
								  while($ownerArr=mysql_fetch_array($owner))
										{
											if($ownerArr['ownercount'] >'2')
											{
									  $x++; 

$class = ($x%2 == 0)? 'firstBackground': 'secondBackground';
									  ?>
									  
				<tr class='<?php echo $class; ?>'><td > <b><?php echo $x." . "; ?></b> <?php
				 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ownerArr[owner]'");
						$ownerArr1=mysql_fetch_array($getOwnerName);
						$ownerName= $ownerArr1['name'];

				
				echo $ownerName ;?></td><td><a href="searchResults.php?owner[]=<?php echo $ownerArr['owner']; ?>"><?php echo $ownerArr['ownercount']; ?></a></td></tr>

										

									<?php 	} 	}
	
	
	
	?>
</table>
	</div>
