<?php
$empID=$_REQUEST['userID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 

<head> 

<title>WebPlant Admin Login</title> 

<meta http-equiv=Content-Type content="text/html; charset=windows-1252" /> 

<link  href="css/reset.css" rel="stylesheet" type="text/css" /> 

<link  href="css/login.css" rel="stylesheet" type="text/css" /> 

</head> 

<body id="page-login"> 

<div class="login-container"> 

<h1>Please Update your Password</h1> 

  <div class="login-box">
<form action="updateUserPassword.php" method="POST">
     <fieldset class="login-form"> 
 <div class="input-box username"> 


        <label for=#>New Password:</label> 

        <br> 

        <input type="password" name="password1"  required  onchange="form.password2.pattern = this.value;" class="input-text" value=""> 
<br><br>

 <label for=#>Confirm Password:</label> 

        <br>  

<input type="password"  name="password2" required title="Please match the Above Password Format"  class="input-text">
<input type="hidden" name="empID" value="<?php echo $empID; ?>"> 
  <div class="submit"> 

          <input type="submit" name="mysubmit" value="Update Password" class="submit-btn" /> 

        </div> 


      </div> 

</fieldset> 

    </form> 

  </div> 

</div>

</body>

