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
<h1>WebPlant Admin Panel</h1> 
  <div class="login-box"> 
    <form action="ValidateUser.php" method="post" autocomplete="off"> 
      <fieldset class="login-form"> 
	  <?php 
							if(isset($_GET['error'])){
								if($_GET['error']=='1'){
								echo "<p><label class=h_error>Please enter a User ID and pasword</label>";
								}
								
								if($_GET['error']=='2'){
								echo "<p><label class=h_error>Invalid User ID or password. <br>Please try again</label>";
								}	

								if($_GET['loginerror']=='y'){
								echo "<p><label class=h_error>Please login before proceeding.</label>";
								}	
							}	
							?>
      <div class="input-box username"> 
        <div id="message"> 
                            </div> 
        <label for=#>User Id:</label> 
        <br> 
        <input name="employee_id1" 
class="input-text" value="" required> 
      </div> 
      <div class="input-box password"> 
        <div id="message"> 
                            </div> 
        <label for=#>Password:</label> 
        <br> 
        <input name="password1" type=password 
class="input-text" required> 
        <div class="submit"> 
          <input type="submit" name="mysubmit" value="Login" class="submit-btn" /> 
        </div> 
      </div> 
      </fieldset> 
    </form> 
  </div> 
</div>
</body>
<script>
document.getElementsByName('employee_id1')[0].focus();
</script>
</html>