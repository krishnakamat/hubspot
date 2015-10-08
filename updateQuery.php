
<?php
include("config.php");
?>

<?php
$getUsers=mysql_query("select * from webadmin");
while($getUserArr=mysql_fetch_array($getUsers))
{
	$owner=$getUserArr['name'];
	$adminID=$getUserArr['adminID'];
mysql_query("UPDATE  `thewebpl_hubspot`.`closedssb` SET  `owner` =  '$adminID' WHERE  `closedssb`.`owner` ='$owner'");
mysql_query("UPDATE  `thewebpl_hubspot`.`closedssb` SET  `firstReviewer` =  '$adminID' WHERE  `closedssb`.`firstReviewer` ='$owner'");
mysql_query("UPDATE  `thewebpl_hubspot`.`closedssb` SET  `secondReviewer` =  '$adminID' WHERE  `closedssb`.`secondReviewer` ='$owner'");
mysql_query("UPDATE  `thewebpl_hubspot`.`tracking` SET  `owner` =  '$adminID' WHERE  `tracking`.`owner` ='$owner'");
mysql_query("UPDATE  `thewebpl_hubspot`.`tracking` SET  `firstReviewer` =  '$adminID' WHERE  `tracking`.`firstReviewer` ='$owner'");
mysql_query("UPDATE  `thewebpl_hubspot`.`tracking` SET  `secondReviewer` =  '$adminID' WHERE  `tracking`.`secondReviewer` ='$owner'");
mysql_query("UPDATE  `thewebpl_hubspot`.`trackinghistory` SET  `status` =  '$adminID' WHERE  `trackinghistory`.`status` ='$owner'");
mysql_query("UPDATE  `thewebpl_hubspot`.`webadmin` SET  `teamLead` =  '$adminID' WHERE  `webadmin`.`teamLead` ='$owner'");


}
?>