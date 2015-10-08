<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}	
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
					include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 	
					include_once ("Header.php");
		}
?>
<style>
.mismatch
{
font-weight:bold;
border-collapse:collapse;
padding:5px;
}
.mismatch td{
padding:5px;
}

.sortable tr:hover {
          background-color: #E0E0D1;
    }
.mismatched-data
{
          background-color: #F5A278;
}
</style>

<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){

include("config.php");



$emptyTemp="truncate trackingtemp";
mysql_query("$emptyTemp");

$takeBackup="INSERT INTO trackingtemp (queue,ssbID, custSubName,  startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink) SELECT queue,ssbID, custSubName,  startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink FROM tracking";
mysql_query("$takeBackup");


$ssbData=$_POST['ssbDetail'];

$dataReplacedQuote=str_replace("'","", $ssbData);

//echo $ssbData;
echo "<br/>";
$dataReplaced=str_replace("\n","	", $dataReplacedQuote);
//$dataReplacedNew=trim("$dataReplaced","\n");
?>
<!--<table class="mismatch"  border="1">
<tr ><td>SSB</td><td>S.F. Status</td><td>Tracking Status</td><td>Service</td><td>Notes / Comments</td></tr>-->
<table class="mismatch"  border="1">
<tr ><td>SSB ID</td><td>Mismatch</td><td>Before</td><td>Now</td></tr>
<?php
$ssbDataNew=explode("	",$dataReplaced);
//print_r($ssbDataNew);
$data= array_chunk($ssbDataNew,11);
echo "Total  ".count(array_keys($data))  . "  Rows Added";
//print_r($data);
$items = array();
		foreach($data as $datasNew){ 
		
		$checkSsb="SELECT count( ssbID ) ssbIds
FROM tracking
WHERE ssbID = '$datasNew[1]' && queue='$datasNew[0]' ";
$ssbAvailability=mysql_query("$checkSsb");
//echo	"$datasNew[1]";
$startDate=date("Y-m-d",strtotime( $datasNew['3']));  
$dueDate=date("Y-m-d",strtotime( $datasNew['4']));  

while ($row=mysql_fetch_array($ssbAvailability))
{
	$ifBlocked="select status,service,notes,comments,migrateUrl,blogUrl,pages,portalLoginLink from tracking where ssbID= '$datasNew[1]'";
	//echo $ifBlocked;
		$blockedSsb=mysql_query($ifBlocked);
		$blockArr=mysql_fetch_assoc($blockedSsb);
		

		?>
<!--</table>-->
		<?php
			if($blockArr['service'] != $datasNew['5'] )
				{
					if(($blockArr['service'] != '' )|| ($blockArr['service'] != null ) ){
						echo "<tr><td>".$datasNew['1']."</td><td>Service </td><td>".$blockArr['service']."</td><td>".$datasNew['5']."</td></tr>";
					}
				}
				if($blockArr['migrateUrl'] != $datasNew['6'] )
				{
					if(($blockArr['migrateUrl'] != '' )|| ($blockArr['migrateUrl'] != null ) ){
						echo "<tr><td>".$datasNew['1']."</td><td>Migrate URL </td><td>".$blockArr['migrateUrl']."</td><td>".$datasNew['6']."</td></tr>";
					}
				}
				if($blockArr['blogUrl'] != $datasNew['7'] )
				{
					if(($blockArr['blogUrl'] != '' )|| ($blockArr['blogUrl'] != null ) ){
						echo "<tr><td>".$datasNew['1']."</td><td>Blog URL </td><td>".$blockArr['blogUrl']."</td><td>".$datasNew['7']."</td></tr>";
					}
				}
				if($blockArr['pages'] != $datasNew['8'] )
				{
					if(($blockArr['pages'] != '' )|| ($blockArr['pages'] != null ) ){
						echo "<tr><td>".$datasNew['1']."</td><td>Pages</td><td>".$blockArr['pages']."</td><td>".$datasNew['8']."</td></tr>";
					}
				}
				if($blockArr['portalLoginLink'] != $datasNew['9'] )
				{
					if(($blockArr['portalLoginLink'] != '' )|| ($blockArr['portalLoginLink'] != null ) ){
						echo "<tr><td>".$datasNew['1']."</td><td>Portal Login Link</td><td>".$blockArr['portalLoginLink']."</td><td>".$datasNew['9']."</td></tr>";
					}
				}


			?>
<?php

$updateSsb=mysql_query("update tracking set queue='$datasNew[0]',dueDate='$dueDate',service='$datasNew[5]',migrateUrl='$datasNew[6]',blogUrl='$datasNew[7]',pages='$datasNew[8]',portalLoginLink='$datasNew[9]' where ssbID='$datasNew[1]'");

$availability= $row['ssbIds'];
//echo $availability;
}

 $items[ ] = $datasNew[1];



if($availability<1)
{


$sql = "INSERT INTO tracking (queue,ssbID, custSubName,  startDate,dueDate,service,migrateUrl,blogUrl,pages,portalLoginLink,status)  VALUES ('$datasNew[0]', '$datasNew[1]', '$datasNew[2]', '$startDate','$dueDate','$datasNew[5]','$datasNew[6]','$datasNew[7]','$datasNew[8]','$datasNew[9]','Not Started')"; 
	mysql_query($sql);
//	echo $sql;
			
}  
}
//print_r($items);
?></table>
<style>
.addSsb
{
	padding-left:30px;
	}
</style>
<div class="addSsb">
<?php
//echo "<br/>";
//echo "<br/>";
$ssbInDB= array();
$getUpdatedSsb=mysql_query("select * from tracking");
while($ssbArr=mysql_fetch_array($getUpdatedSsb))
{
	array_push($ssbInDB,$ssbArr['ssbID']); 
}

//print_r($ssbInDB);

$ssbList = '"' . implode('", "', $items) . '"';
//echo "<br/>";
//echo $tagList;
//echo "<br/>";

$qs = mysql_query('SELECT ssbID FROM tracking WHERE ssbID NOT IN (' . $ssbList . ')');
if(mysql_num_rows($qs) != 0 )
{
	echo "Data Added Successfully";
 	echo "<br/>";
	echo "SSB ID Mismatch";
	echo "<br/>";
	echo "Result SSB IDs Below:";
		echo "<br/>";

while($ssbExistArr=mysql_fetch_array($qs))
{
	echo "<br/>";
	echo "<a target='_blank' href='searchSsb.php?ssbID=".$ssbExistArr['ssbID']."'>".$ssbExistArr['ssbID']."</a>";
}
}
else
	{
	echo "Data Added Successfully";
	}
//echo "<script> document.location.href='addTracking.php';</script>"; 
?>
</div>
<?php 

///*******************SEND OUT NOT STARTED MAIL*********************************///

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

while($rowMail=mysql_fetch_array($getNotStartedData))
{
$message .= "<tr align=center><td style='width:15%;padding:5px 10px;'>{$rowMail['ssbID']}</td>
	<td style='width:20%;padding:5px 10px;'>{$rowMail['queue']} </td>
	<td style='width:30%;padding:5px 10px;'>{$rowMail['custSubName']}</td>
	<td style='width:20%;padding:5px 10px;'>{$rowMail['service']} </td>
	<td style='width:15%;padding:5px 10px;'>{$rowMail['status']} </td>
	</tr>";
	}

$message .="</table>";

echo $message;
$notStartedPresent=mysql_num_rows($getNotStartedData);
echo $notStartedPresent;
if($notStartedPresent >'0' )
{
mail($to, $subject, $message, $headers);
echo "<br/>";
echo "NOT STARTED MAIL SENT";
}

else
{

}
//*****************************SEND OUT MAIL END *****************************//

} else { echo "You Are Not Permitted To Access This Page"; } ?>
<?php include("Footer.php"); ?>