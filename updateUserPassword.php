<?php
 $password1=md5($_POST['password2']);
 $empID=$_POST['empID'];
include("config.php");
if(isset($password1) && isset($empID))
{
$updatePassword="update webadmin set password='$password1' where adminID='$empID'";
mysql_query($updatePassword);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 

<head> 

<title>Password Updated</title> 

<meta http-equiv=Content-Type content="text/html; charset=windows-1252" /> 

<link  href="css/reset.css" rel="stylesheet" type="text/css" /> 

<link  href="css/login.css" rel="stylesheet" type="text/css" /> 
<style>
 .login-container h1 {
 color: #ffffff;
 display: block;
 font-size: 28px;
 margin-left: 0;
 text-align: center;
}
  a {
 background: none repeat scroll 0 0 #8cc751;
 border-radius: 5px;
 color: #ffffff;
 font-family: "arial";
 padding: 5px 41px;
 text-decoration: none;
}
a:hover {
 opacity: 0.7;
}
</style>
</head> 

<body id="page-login"> 


<div class="login-container"> 

<h1>Password Updated</h1> 

  <div class="login-box">
<h2 style="text-align:center;font-weight:bold;font-size:20px;color:#66668A"><a href="index.php">Click Here To Login</a></h2>
</div>

</body>

<?php
}
?>

