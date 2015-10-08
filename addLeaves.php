<?php
include("config.php");

$query = "UPDATE empleavebalance SET accrued = accrued + 1.5";
$result=mysql_query($query);


if($result)
{
	$getAllAdmins="select email from webadmin where userRole = '1' and status='1'";
	$allAdminsArr=mysql_query($getAllAdmins);
	while($allAdmins=mysql_fetch_array($allAdminsArr)){
		$admins .= $allAdmins['email'].",";
	}
	
	$admin_email=rtrim($admins,',');

 // $admin_email = "krishnakumarkamat@gmail.com";
  $email = 'krishna@thewebplant.in';
  $subject = "Leaves Added to all Employees Leave Balance" ;
  $comment = "Leaves Are Added to the balance of all employees on  ".date("d-m-Y h:i:s");
  
  //send email
  mail($admin_email, "$subject", $comment, "From:" . $email);
  
}
else
{
    echo mysql_error();

	$getAllAdmins="select email from webadmin where userRole = '1' and status='1'";
	$allAdminsArr=mysql_query($getAllAdmins);
	while($allAdmins=mysql_fetch_array($allAdminsArr)){
		$admins .= $allAdmins['email'].",";
	}
	
	//$admin_email=rtrim($admins,',');

  $admin_email = "krishnakumarkamat@gmail.com";
  $email = 'krishna@thewebplant.in';
  $subject = "Error in Leaves Added to all Employees Leave Balance" ;
  $comment = "Leaves Are Not Added to the balance of all employees on  ".date("d-m-Y h:i:s");
  $comment .= "Error". mysql_error();
  //send email
  mail($admin_email, "$subject", $comment, "From:" . $email);
  

    return 0;   
}

?>