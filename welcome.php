<?php


session_start();
	
		

		if(!isset($_SESSION['loggedIn']))
		{
		echo "<script>location.href='index.php';</script>";
		}
							include_once ("welcomeHeader.php");

		
?>
<?php
include("config.php");
?>

<link  href="css/reset.css" rel="stylesheet" type="text/css" /> 

<link  href="css/login.css" rel="stylesheet" type="text/css" /> 



<div class="login-container"> 

<h1>Select Your Action</h1> 

  <div class="login-box">
<form action="updateUserPassword.php" method="POST">
     <fieldset class="login-form"> 
	 <?php
	mysql_query("update webadmin set lastlogin='$now' where email='$employeeid'");

if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1))
			{
			header("location:dashboard.php");
			
			}
			elseif($_SESSION['userRole']==3 && $_SESSION['status']==1){ 			
				header("location:viewData.php");
			}
			else{ 			
				header("location:notAuthUser.php");
			}
			
			?>
</fieldset> 

    </form> 

  </div> 

</div>



			<?php include("Footer.php"); ?>
			