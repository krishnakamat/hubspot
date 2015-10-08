<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 

<head> 

<title>Forgot Password</title> 

<meta http-equiv=Content-Type content="text/html; charset=windows-1252" /> 

<link  href="css/reset.css" rel="stylesheet" type="text/css" /> 

<link  href="css/login.css" rel="stylesheet" type="text/css" /> 

</head> 

<body id="page-login"> 


<div class="login-container"> 

<h1>Forgot Password?</h1> 

  <div class="login-box">
        <fieldset class="login-form"> 


  <form action="forgotPasswordMail.php" method="post">
  <div class="input-box username"> 

        <label for=#>Enter Your Email ID:</label> 

        <br> 

<input type="text"  name="emailid" required class="input-text">
<div class="submit"> 

          <input type="submit" name="mysubmit" value="Login" class="submit-btn" /> 

        </div> 
      </div> 



</form>
</fieldset>
</div>

</body>



