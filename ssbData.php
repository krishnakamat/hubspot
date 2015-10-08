<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";		}		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){					include_once ("HeaderAdmin.php");		}		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 						include_once ("Header.php");		}

?><?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
<div class="addSsb">


<form action="insertSsb.php"  method="post">
<p>Add SSb Detail Carefully Below</p>
<textarea name="ssbDetail" style="width:98%;height:520px;background:#f9f9d9" required></textarea>
<br/>
<input type="submit"  value="Add Detail">
</form>


</div>
<?php } else { echo "You Are Not Permitted To Access This Page"; } ?>
<?php include("Footer.php"); ?>