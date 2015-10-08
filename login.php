<?php
session_start();
?>
<?php // login.php
include("config.php");
require_once "openid.php";
//$openid = new LightOpenID("my-domain.com");
$openid = new LightOpenID("http://www.thewebplant.in/~tracker");

if ($openid->mode) {
    if ($openid->mode == 'cancel') {
        echo "User has canceled authentication!";
    } elseif($openid->validate()) {
        $data = $openid->getAttributes();
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
		$_SESSION['Email'] = $email;
		//$emailID=$_SESSION['Email'];
		 $getUserDetail="select * from webadmin where email='$_SESSION[Email]'";
		$query=mysql_query($getUserDetail);
		if(mysql_num_rows($query) > 0)
		{
		$dataArr=mysql_fetch_assoc($query);
		$_SESSION['loggedIn'] = "Y";
		$_SESSION['type']=$dataArr['type'];
		$_SESSION['name']=$dataArr['name'];
		$_SESSION['adminID']=$dataArr['adminID'];
		//$_SESSION['empID']=$dataArr['empID'];
		$_SESSION['userRole']=$dataArr['userRole'];
       // echo "Identity: $openid->identity <br>";
        //echo "Email: $email <br>";
       // echo "First name: $first";
		//header('Location: ' . $openid->authUrl());
		header("location:welcome.php");
		
		}
		else{
		echo "Sorry You are not an authorised user";
		}
    } else {
        echo "The user has not logged in";
    }
} else {
    echo "Go to index page to log in.";
}
?>