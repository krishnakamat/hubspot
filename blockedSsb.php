<?php 
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php"); ?>
<div class="ownerReport">
	<table>
		<?php $allBlockedSsb="select ssbID from tracking  where status ='Blocked' and blockedMailSent ='0'";
//		echo $allBlockedSsb;
								  $blockedSsb=mysql_query($allBlockedSsb);
						 echo "<b>Mail Not Sent Blocked SSB (".mysql_num_rows($blockedSsb). ")</b><br/><br/>";
						 $x=0;
								  while($ownerArr=mysql_fetch_array($blockedSsb))
										{
														$x++;
											?><td><b><?php echo $x.". "; ?></b></td><td><a target="_blank" href="searchSsb.php?ssbID=<?php echo $ownerArr['ssbID']; ?>"><?php echo $ownerArr['ssbID']; ?></a></td></tr>

									<?php 	 	}
	
	
	
	?>
</table>
	</div>
