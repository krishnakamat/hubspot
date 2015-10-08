<?php
$emailID=$_REQUEST['emailid'];

include("config.php");
$getPassword="select * from webadmin where email = '$emailID'";
$getUserPassword=mysql_query($getPassword);
$userDetail=mysql_fetch_assoc($getUserPassword);

	$message="<p> Dear $userDetail[name]</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;This mail is regarding Password Change in Your Tracking Application: </p>
				<table border='0' cellpadding='0' cellspacing='0' width='100%' >
				 
				  <tr><td>According To Our Details, Your Password is &nbsp;</td><td> : </td><td>$userDetail[password]</td></tr>
				</table>
				<p>Thanks & best regards:<br/>
				   Webplant.com</p>";
	echo $to = "krishnakumarkamat@gmail.com";
	echo $subject = "Password Recovery From ";
	echo $Mailfrm = "krishna@thewebplant.in";
	function send_mail($to, $subject, $message, $Mailfrm)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: WebAdmin';
		mail($to, $subject, $message, $headers);	
		if(!mail($to, $subject, $message, $headers))
		{
	echo "Unable to send email. Please contact the website administrator.";
		}
		else
		{
			//echo "Mail Sent";
			echo $message;
		}

   	}
	$mailSending=send_mail($to, $subject, $message, $Mailfrm)


?>