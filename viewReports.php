<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){			echo "<script>location.href='index.php';</script>";		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){			include_once ("HeaderAdmin.php");		}		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 				include_once ("Header.php");		}		

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
<script>
function getOwner(lead)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("projectReports").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","projectReport.php?lead="+lead,true);
xmlhttp.send();
}
</script>
<?php include("function.php"); ?>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1) || ($_SESSION['userRole']==3 && $_SESSION['status']==1)){?>

<script>
function getHistory(trackID)
	{

var elems = document.getElementsByClassName('history');
for(var i = 0; i < elems.length; i++) {
    elems[i].style.display = 'none';
}

	document.getElementById("history"+trackID).style.display="block";
	}

	
	</script>
	<script>
	function closeHistory(trackID)
	{
		//alert("hi");
		//document.getElementById("history"+trackID).style.display="block";	
		}</script>
		
	<div class="Reportwrapper">

	<div class="projectReport">
	<p>Owner Current Report</p>
		<?php date_default_timezone_set('Asia/Kolkata');
		$now=date("Y-m-d H:m:s");?>

	<select name="teamLead" onchange="getOwner(this.value);" ><option value="">---Select Team Lead---</option>
   <?php
			$allAdUsers="select * from webadmin where (userRole = 1 or userRole = 2) and status = 1";
			$usersAd=mysql_query("$allAdUsers");
			while($userAdArr=mysql_fetch_array($usersAd))
	{?>		<option value="<?php echo $userAdArr['adminID'];?>"><?php echo $userAdArr['name'];?></option>
				

	<?php 	}	?>
</select>	</div>
	
</div>
<div id="projectReports"></div>

<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>
