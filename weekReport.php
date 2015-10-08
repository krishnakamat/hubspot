<?php
		session_start();
		//ini_set('session.gc_maxlifetime', 3600);
		if(!isset($_SESSION['loggedIn'])){			echo "<script>location.href='index.php';</script>";		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){			include_once ("HeaderAdmin.php");		}		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 				include_once ("Header.php");		}

include("config.php");
?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>
<style>
.dayReport{
float:left;
width:300px;
height:300px;
margin:0 5px 0  0;
}
.dayReport table{
width:100%;
}
.allUsers {
    margin: 10px;
}


.allUsers p {
    background: none repeat scroll 0 0 #9bbb59;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    margin: 1px;
    padding: 5px;
    text-align: center;
    text-transform: capitalize;
}

.struct{
float:left;
}
.lead{

}
.resourc{
	float:right;
}
.users {
  background: none repeat scroll 0 0 #dfebc7;
  color: green;
  font: 14px Trebuchet MS;
  margin: 1px;
  padding: 8px 10px;
}
	.users td{
	padding:10px 7px;
	line-height:30px;
	}
.users th {
  font-weight: bold;
  padding: 10px 7px;
}
.Reportwrapper p {
  background: none repeat scroll 0 0 #9bbb59;
  border-color: #000;
  border-style: solid;
  border-width: 1px 1px 0 ;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  margin: 0;
  padding: 5px;
  text-align: center;
  text-transform: capitalize;
}
</style>


	
	<div class="Reportwrapper"><div class="allUsers">
		<?php
		$today=date("Y-m-d");
	
			 $oneWeek=date("Y-m-d", strtotime('-6 days'));
			$allAdUsers="SELECT closedOn FROM closedssb WHERE (closedOn BETWEEN  '$oneWeek' AND  '$today') group by closedOn";
			$usersAd=mysql_query("$allAdUsers");?>
			<p class="teamCount">Week Report: <?php echo $today."  To  ".$oneWeek; ?></p>
	
<?php
			while($userAdArr=mysql_fetch_array($usersAd))
	{
				$allUsers="select distinct ssbID from closedssb where closedOn='$userAdArr[closedOn]'";
								$users=mysql_query("$allUsers");
								?>
				<div class="admins" >
				<?php  $resources=mysql_num_rows($users);
						if($resources !=0)
		{?>
			<div class="dayReport">
				<p><?php echo $userAdArr['closedOn']; ?>&nbsp;(<?php echo $resources;?>)</p>
				
		

						<table  border="1" style="border-collapse:collapse;"><tr class="users"><th>Project</th><th>Count </th><th>Hours</th></tr>
	<tr  class="users" style="height:180px" ><td><?php $allServices="select distinct service from closedssb where closedOn='$userAdArr[closedOn]' group by service "; 
								  $service=mysql_query($allServices);
								  while($serviceArr=mysql_fetch_array($service))
										{
											echo $serviceArr['service'];
											echo "<br/>";
										}
	
	
	
	?></td>
	
			<td><?php $allServices2="select count(distinct ssbID) as servicecount from closedssb where closedOn='$userAdArr[closedOn]' group by service"; 
								  $service2=mysql_query($allServices2);
								  while($serviceArr2=mysql_fetch_array($service2))
										{
											echo $serviceArr2['servicecount'];
											echo "<br/>";
										}
	
	
	
	?> </td>	
			<td><?php $allServices1="select sum(hours2) as hrs from closedssb where closedOn='$userAdArr[closedOn]' group by service"; 
								  $service1=mysql_query($allServices1);
								  while($serviceArr1=mysql_fetch_array($service1))
										{
											echo round($serviceArr1['hrs'],2);
											echo "<br/>";
										}
	
	
	
	?></td></tr>
	<tr class="users" ><td>Total</td><td><?php echo $resources;?></td><td><?php $allServices3="select sum(hours2) as allhrs from closedssb where closedOn='$userAdArr[closedOn]'"; 
								  $service3=mysql_query($allServices3);
								  while($serviceArr3=mysql_fetch_array($service3))
										{
											echo round($serviceArr3['allhrs'],2);
											echo "<br/>";
										}
	
	
	
	?></td></tr>

	</table></div>
						<?php
						}}
						?></div>
					
	
	
	</div>


</div></div>

<?php
echo ini_get("session.gc_maxlifetime");
} else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
