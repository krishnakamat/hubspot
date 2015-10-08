
<?php
include("config.php");

$getAllAdmins=mysql_query("select email from webadmin where type='1'");
while($allAdmins=mysql_fetch_array($getAllAdmins))
{
	 $allAdmins['email'];
	$emails .=$allAdmins['email'].",";
}
$allEmails= rtrim($emails,",");
//echo $allEmails;
//$to = $allEmails;
$to = "deepti@thewebplant.com,vikram@thewebplant.com,webplantapp@gmail.com";
$subject = "Reminder For Not Started Projects";
$headers ="MIME-Version: 1.0\r\n" 
. "Content-Type: text/html; charset=\"iso-8859-1\"\r\n" 
. "Content-Transfer-Encoding: 7bit\r\n";
$headers .= "From: krishna@thewebplant.in" ;


$getNotStarted="select * from tracking where status='Not Started'";
$getNotStartedData=mysql_query($getNotStarted);

$message="
<p>Below is the SSBs which is Not Stated</p>
<table  border='1' align=center cellpadding='0' cellspacing='0' border='1'> 
<tr bgcolor=#999999 align=center> <th>SSB ID</th><th>Queue</th><th>Customer Sub Name</th><th>Service</th><th>Status</th></tr>";

while($row=mysql_fetch_array($getNotStartedData))
{
$message .= "<tr align=center><td style='width:15%;padding:5px 10px;'>{$row['ssbID']}</td>
	<td style='width:20%;padding:5px 10px;'>{$row['queue']} </td>
	<td style='width:30%;padding:5px 10px;'>{$row['custSubName']}</td>
	<td style='width:20%;padding:5px 10px;'>{$row['service']} </td>
	<td style='width:15%;padding:5px 10px;'>{$row['status']} </td>
	</tr>";
	}

$message .="</table>";

echo $message;
$notStartedPresent=mysql_num_rows($getNotStartedData);
echo $notStartedPresent;
if($notStartedPresent >'0' )
{
mail($to, $subject, $message, $headers);
}
else
{

}
?>