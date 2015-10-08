<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){			echo "<script>location.href='index.php';</script>";		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){			include_once ("HeaderAdmin.php");		}		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 				include_once ("Header.php");		}

include("config.php");
?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
<style>
.allUsers {
    float: left;
    margin: 10px;
}

.users {
    background: none repeat scroll 0 0 #dfebc7;
    display: block;
    font-family: arial;
    font-size: 14px;
    margin: 1px;
    padding: 8px 16px;
    text-transform: uppercase;
	color:green;
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

.admins{
	
	min-height:260px;
	width:200px;
	display:inline-block;
	vertical-align:top;
	}
.struct{
float:left;
}
.lead{

}
.resourc{
	float:right;
}
</style>


	
	<div class="wrapper"><div class="allUsers">
		<?php
			$allAdUsers="select * from webadmin where (userRole = 2) and status = 1 and employeeType = 1";
			$usersAd=mysql_query("$allAdUsers");?>
			<p class="teamCount"><span class="struct" >Team Structure</span><span class="lead">Total Team Leads: <?php echo  mysql_num_rows($usersAd);?></span><span class="resourc">Total Resources:<?php 	$allOwn="select * from webadmin as w1 where w1.userRole ='3' and w1.employeeType = 1 and w1.status='1' and w1.adminID != 0 and w1.adminID != w1.teamLead and w1.teamLead !='0' and w1.teamLead != 'Null' and w1.teamLead != ''";
								$own=mysql_query("$allOwn"); echo mysql_num_rows($own); ?> </span></p>
	
<?php
			while($userAdArr=mysql_fetch_array($usersAd))
	{
				$allUsers="select * from webadmin where teamLead='$userAdArr[adminID]' and userRole = 3 and status = 1";
								$users=mysql_query("$allUsers");
								?>
				<div class="admins" >
				<?php  $resources=mysql_num_rows($users);
						if($resources !=0)
		{?>
				<p><?php echo $userAdArr['name']; ?>&nbsp;(<?php echo $resources;?>)</p>
				
						
						<?php
						
								while($userArr=mysql_fetch_array($users))
						{?>
									<span class="users" ><?php echo $userArr['name'];?></span>
									
						<?php
						}}
						?></div>
					
	<?php
	}
	?>
	
	</div>


</div></div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>

