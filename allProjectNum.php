<?php
$days=$_GET['days'];
$days=$days-1;

if(isset($_REQUEST['reviewer'])&& $_REQUEST['reviewer'] != 'undefined' )
	{?>
			<a target="_blank" href="getMaxElapsedSSb.php?days=<?php echo $days; ?>&&firstReviewer=<?php echo $_REQUEST['reviewer'] ; ?>">
		<?php } else {?>
		<a target="_blank" href="getMaxElapsedSSb.php?days=<?php echo $days; ?>">
	<?php 
	}
	?> Go To All Projects SSBs</a>