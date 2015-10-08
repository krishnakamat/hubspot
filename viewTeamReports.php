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
.sortable{
		width:100%
		}
#projectReports
{
clear:both;
}

.lead {
    background: none repeat scroll 0 0 #9bbb59;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    margin: 5px;
    padding: 5px;
    width: 100%;
}
.projectReport{
 background-color:#DFEBC7;
 	float: left;
    height: 60px;
    margin: 0 5px;
    width: 100%;

}

.projectReport select {
  height: 27px !important;
  padding: 5px;
  width: 170px !important;
}

.ownerProjectReports {
  padding: 5px;
}
.leadOwner {
  background: none repeat scroll 0 0 #DFEBC7;
  color: #678725;
  font-size: 14px;
  font-weight: bold;
}
.leadOwner :hover {
  background: none repeat scroll 0 0 #DFEBC7;
color:#678725;
}
.ownerProjectReports p {
  background: none repeat scroll 0 0 #9bbb59;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  height: 20px;
  padding:5px;
}
.Reportwrapper p {
  background: none repeat scroll 0 0 #9bbb59;
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
.history{
background: none repeat scroll 0 0 #fff;
    border: 2px solid;
    border-radius: 5px;
    box-shadow: 0 0 12px #000;
    display: none;
    padding: 5px;
    position: absolute;
    z-index: 1}

.history button {
  background: url("images/close_pop.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
  float: right;
  margin-right: -21px;
  margin-top: -23px;
  height: 34px;
  width: 34px;
  border: 0;

}

</style>

<?php include("function.php"); ?>
<?php 	if($_SESSION['type']=='1' || $_SESSION['type']=='2'){?>

	<div class="Reportwrapper">

	<div class="projectReport">
	<p>Owner Current Report</p>
		<?php date_default_timezone_set('Asia/Kolkata');
		$now=date("Y-m-d H:m:s");?>
<form name="teamLeads" action="teamReport.php" method="post" >
	<select name="lead" onchange="this.form.submit()"><option value="">---Select Team Lead---</option>
   <?php
			$allAdUsers="select * from webadmin where type='1'";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>		<option value="<?php echo $userAdArr['adminID'];?>"><?php echo $userAdArr['name'];?></option>
				

	<?php 	}	?>
</select>	</div>
	
</div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
