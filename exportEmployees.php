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
.loginReport  table{
width:100%;
}

.loginReport{
	float: left;
    margin: 0 5px;
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
	line-height:30px;
}

.users th {
 font-weight: bold;
 padding: 10px 7px;
 line-height:10px;
}

.users input{
padding:7px 7px;
line-height:10px;
}

</style>

<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
<form method="post" action="exportEmpFile.php">
<input type="submit" value="Export" name="export">
</form>
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>