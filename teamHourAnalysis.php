<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 	
			include_once ("Header.php");
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
 display: inline-block;

}

.projectReport form {
  float: left;
  padding: 29px 38px 0;
}

.projectReport select {
  -moz-appearance: none;
  background: url("images1/select-arrow.jpg") no-repeat scroll right top rgba(0, 0, 0, 0);
  border: 1px solid #515151;
  color: #818181;
  font-family: open sans;
  font-size: 17px;
  height: 45px !important;
  line-height: 18px;
  outline: medium none;
  overflow: hidden;
  padding: 5px;
  text-indent: 0.01px;
  text-overflow: "";
  width: 302px !important;
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









.main-container-efficiency {
  margin: 0 auto;
  max-width: 1263px;
  position: relative;
}

.Reportwrapper:after {
  background: url("images1/border-arrow.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
  bottom: -33px;
  content: "";
  height: 33px;
  left: 0;
  position: absolute;
  width: 38px;
}

.Reportwrapper {
  background: none repeat scroll 0 0 #333333;
  margin: 0 auto !important;
  max-width: 1203px;
  padding: 0 36px;
  position: relative;
  width: 100%;
  display: inline-block;
}

.team-report-right {
  background: url("images1/border-arrow.jpg") no-repeat scroll left top -1px, url("images1/border-arrow.jpg") no-repeat scroll right top -1px rgba(0, 0, 0, 0);
  float: left;
  padding: 2px 10px 0 40px;
}

.team-report-right.time-tracking {
	padding: 2px 10px 22px 40px;
}

.team-report-right ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

.team-report-right ul li:first-child {
    background: url("images1/for-team-img.jpg") no-repeat scroll left center rgba(0, 0, 0, 0);
    padding-left: 60px;
}

.team-report-right ul li:nth-child(2) {
    background: url("images1/calender-img.jpg") no-repeat scroll left center rgba(0, 0, 0, 0);
    padding-left: 60px;
}


.team-report-right ul li {
	float: left;
	color: #8AC750;
	font-family: open sans;
    font-size: 19px;
    font-weight: normal;
    line-height: 22px;
    padding: 26px 60px;
    text-decoration: none;
}

</style>



<?php include("function.php"); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>
<div class="main-container-efficiency">
	<div class="Reportwrapper">
		
	<div class="projectReport">
	
		<?php date_default_timezone_set('Asia/Kolkata');
		$now=date("Y-m-d H:m:s");?>
<form name="teamLeads" action="ownerHourAnalysis.php" method="post" >
	<select name="lead" onchange="this.form.submit()"><option value="">---Select Team Lead---</option>
   <?php
			$allAdUsers="select * from webadmin where (userRole = 1 or userRole = 2) and status = 1";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>		<option value="<?php echo $userAdArr['adminID'];?>"><?php echo $userAdArr['name'];?></option>
				

	<?php 	}	?>
</select>
</form>	<div class="team-report-right time-tracking"><ul><li>Owner Time Analysis Report</li></ul></div></div>
	
</div>
</div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>

