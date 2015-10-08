<?php 
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php"); ?>
<div class="ownerReport">
<p>Ready For Review Status</p>
	<table><tr>	<td><b></b></td><td>First Reviewer</td><td>Count</td>
											</tr>
											<?php $getStatus="select count(ssbID) as countssb,firstReviewer from tracking where  status='Ready For Review' group by firstReviewer order by countssb desc";
											$status=mysql_query($getStatus);
											$x=0;
											while($statusArr=mysql_fetch_array($status))
											{ $x++;?>
											<tr>	<td><b><?php echo $x." . "; ?></b></td>
											<td>
											
											<?php $reviewerID= $statusArr['firstReviewer'];
											//echo $reviewerID;
											$getReviewer="select name from webadmin where adminID='$reviewerID'";
											$reviewer=mysql_query($getReviewer);
											$reviewerArr=mysql_fetch_assoc($reviewer);
											$firstReviewer= $reviewerArr['name'];
											
											?><a target="_blank" href="searchResults.php?firstReviewer[]=<?php echo $reviewerID; ?>&status[]=Ready For Review"><?php echo $firstReviewer; ?></a></td>
											
											<td><?php echo $statusArr['countssb']; ?></td>
											</tr>
												<?php	
												}
											?>

									
</table>
	</div>
