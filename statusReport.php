<?php 
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php"); ?>
<p> Status Report</p>

<table  border="0" style="border-collapse:collapse;">
	<?php $getCategory=mysql_query("select * from service group by category");
	while($allCategory=mysql_fetch_array($getCategory))
	{
			$category = $allCategory['category'];
			$getCategoryName=mysql_query("select catName from category where catID='$category'");
			$catName=mysql_fetch_assoc($getCategoryName);?>
			<tr>
	<td>
	<p></p>
	<?php
	$getServiceName="select serviceName,category from service where category='$category'";
			$serviceNameQuery=mysql_query($getServiceName);
			while($serviceName=mysql_fetch_array($serviceNameQuery))
		{
				if($serviceName['category']=='1')
			{
			$services1 .= "&service[]=".$serviceName['serviceName'];
			$services=$services1;
			}
			elseif($serviceName['category']=='2')
			{
			$services2 .= "&service[]=".$serviceName['serviceName'];
			$services=$services2;
			}
		}
		
			?>
	<table>
	<tr><th><?php echo $catName['catName']; ?></th></tr>
	<tr><th>Status</th><th>Count</th></tr>
	<?php $allServices="select count(tracking.status) as count ,tracking.status from tracking,service where (tracking.service=service.serviceName && service.category='$category') group by tracking.status "; 
								  $service=mysql_query($allServices);
								  while($serviceArr=mysql_fetch_array($service))
										{?>
										<tr><td><a target="_blank" href="searchResults.php?status[]=<?php	echo $serviceArr['status']; ?><?php echo $services; ?>" ><?php	echo $serviceArr['status']; ?></a></td><td><?php 	echo $serviceArr['count']; ?></td></tr>
							
									<?php	}
	
	?></table>
	</td></tr>
	<?php } ?>
	

