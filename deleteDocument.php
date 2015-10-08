
<?php
include("config.php");


$docID = $_GET['docID'];
$empID=$_GET['employeeID'];
$getDocName=mysql_query("select * from documents where docID='$docID'");
$docName=mysql_fetch_array($getDocName);
$docDetail=$docName['docDetail'];
$empID=$docName['empID'];
$deleteDoc=$empID."_".$docDetail;
$query = "delete from documents where docID='$docID'";

$result = mysql_query($query) or die("Could not execute query");
if($result)
{
	unlink("documents/".$deleteDoc);
}
echo "<script language=javascript>";
echo "location.href='saveDocuments.php?adminID=$empID&msg=Deleted Successfully'";
echo "</script>";

?>