	<?php 
	include("config.php");
					 $days = $_GET['days']; 
					 $days=$days-1;
				$numDaysBack=date("Y-m-d", strtotime("- $days days"));
		if(isset($_REQUEST['reviewer']) && $_REQUEST['reviewer'] != 'undefined' )
	{
	$firstReviewer=$_REQUEST['reviewer'];
	$getAllTracking=mysql_query("Select *,count(ssbID) as allSsb from tracking where (status !='Blocked') and startDate    <  '$numDaysBack' and firstReviewer='$firstReviewer' order by startDate ");
		}
	else
	{
			$getAllTracking=mysql_query("Select *,count(ssbID) as allSsb from tracking where (status !='Blocked') and startDate    <  '$numDaysBack' order by startDate ");
		//echo "Select *,count(ssbID) as allSsb from tracking where (status !='CMS->COS Template Done' and status !='Not Started') and startDate    <  '$numDaysBack' order by startDate ";
	}
	while($getAllTrackingArr=mysql_fetch_array($getAllTracking))
	{
		echo $getAllTrackingArr['allSsb'];
	}





	?>
	