<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){			echo "<script>location.href='index.php';</script>";		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){			include_once ("HeaderAdmin.php");		}		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 				include_once ("Header.php");		}
?>
<style>
iframe {
  background: none repeat scroll 0 0 #ccc;
  border-radius: 10px;
  margin: 10px;
  padding: 10px;
    overflow-y:hidden;
	height:200px;
	width:400px;
	
}
.statusChange
{
	height:445px;
	bottom:0;
}
tbody {
  font-size: 13px;

}
</style>
<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
<table><tr>
<td><iframe src="statusReport.php"></iframe></td>
<td><iframe src="ownerReport.php"></iframe></td>
<td rowspan="2"><iframe class="statusChange" src="statusChange.php"></iframe></td></tr>
<tr><td><iframe src="blockedSsb.php"></iframe></td>
<td><iframe src="notAssigned.php"></iframe></td></tr>
<tr> <td><iframe src="teamLeadStatus.php"></iframe></td> <td></td><td></td></tr></table>
 
<?php } else { echo "You are not permitted to Access this Page"; } ?>
<?php include("Footer.php"); ?>