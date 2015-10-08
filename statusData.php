	<div id="statusData">
<?php
include("config.php");
$day=$_GET['days'];
//echo $day;
date_default_timezone_set('Asia/Kolkata'); 
 $today=date("Y-m-d");
 $dayBefore=date("Y-m-d", strtotime("-$day days"));
 echo "After  :  ".$dayBefore;
 echo "<br/>";
 $getCategory=mysql_query("select * from service group by category");
 while($allCategory=mysql_fetch_array($getCategory))
	{
		 	$category = $allCategory['category'];
$statusSsb=mysql_query("select distinct trackID from trackinghistory where date <  '$dayBefore' order by date desc");
?>
<table >
<tr><th colspan="5"><?php
	$getCategoryName=mysql_query("select catName from category where catID='$category'");
			$catName=mysql_fetch_assoc($getCategoryName);?>
<?php echo $catName['catName']; ?></th></tr>
<tr><th>Owner</th><th>SSB ID</th><!--<td>Service</td>--><th>Days</th><th>Status</th></tr>
<?php while($getSsb=mysql_fetch_array($statusSsb))
{   $trackID= $getSsb['trackID'];
		
					$getStatus=mysql_query("select status,updates,date from trackinghistory where trackID='$trackID' order by historyID desc");
			$statusArr=mysql_fetch_assoc($getStatus);
     $date1 = strtotime("$today");
	// echo $today;
//	 echo "<br/>";
	 $date2=strtotime($statusArr['date']);
	// echo $statusArr['date'];
     $datediff = $date1 - $date2;
	 if(floor($datediff/(60*60*24))+1 > '0')
	{
			$getSsb=mysql_query("select * from tracking,service where tracking.trackID='$trackID'  && (tracking.service=service.serviceName && service.category='$category') group by tracking.status");
			$ssbArr=mysql_fetch_assoc($getSsb);
			if( $ssbArr['ssbID'] != '')
	{?>
		<tr><td><?php	//echo $ssbArr['owner']; 
			 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ssbArr[owner]'");
						$ownerArr1=mysql_fetch_array($getOwnerName);
						$ownerName= $ownerArr1['name'];

				
				echo $ownerName ;
			
			?></td><td style="text-align:center"><a href="searchSsb.php?ssbID=<?php echo $ssbArr['ssbID']; ?>" ><?php echo $ssbArr['ssbID']; ?></a></td><!--<td><?php echo $ssbArr['service']; ?></td>-->
		
	
     <td><?php echo floor($datediff/(60*60*24))+1; ?></td><td>

		<?php echo $ssbArr['status']; ?>
	</td></tr>
<?php
	}
	}

	}
}?>
</table>
</div>