<?php
		session_start();
		if(!isset($_SESSION['loggedIn']))
		echo "<script>location.href='index.php';</script>";
				if($_SESSION['type']=='2'){
					include_once ("Header.php");
				}
				else{
					include_once ("HeaderAdmin.php");
				}

include("config.php");
?>
<style>


.loginReport  table{
width:100%;
}

.loginReport{
	float: left;
    height: 300px;
    margin: 0 5px;
    width: 450px;
	padding-left:20px;
	padding-top:20px;
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
.users {
  background: none repeat scroll 0 0 #dfebc7;
  color: green;
  font: 14px Trebuchet MS;
  margin: 1px;
  padding: 8px 10px;
}
	.users td{
	padding:10px 7px;
	line-height:10px;
	}
.users th {
  font-weight: bold;
  padding: 10px 7px;
}
</style>
<?php include("function.php"); ?>
<?php 	if($_SESSION['type']=='1'||$_SESSION['type']=='2'){?>
	<div class="Reportwrapper">

	<div class="loginReport">
	<p>Owner Login Report</p>
		<?php date_default_timezone_set('Asia/Kolkata');
$now=date("Y-m-d H:m:s");?>

	<table   border="1" style="border-collapse:collapse;" ><tr class="users"><th>Name</th><th>Last Login </th><th>Team Lead</th></tr>
<?php     $allAdUsers="SELECT * FROM webadmin WHERE lastlogin <= DATE_SUB('$now', INTERVAL 24 HOUR)  AND lastlogin < '$now' and (type='1' or type ='2') order by teamLead";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>
									<tr   class="users" style="height:30px"><td><?php echo $userAdArr['name'];?></td><td><?php echo $userAdArr['lastlogin'];?></td><td>
									
									<?php	 $getLeadName=mysql_query("select * from webadmin where adminID ='$userAdArr[teamLead]'");
						$leadArr=mysql_fetch_array($getLeadName);
						$leadName = $leadArr['name'];
						 ?>
									
									<?php	echo $leadName; ?></td></tr>


	<?php 	}	?>
</table>
	</div>
	
</div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
