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
<head>
<!--<meta http-equiv="refresh" content="30">-->
</head>
<style>
.sortable{
	width:100%;
}
td {
padding:5px;
font-size:14px;
}
th {
padding:5px;
font-size:14px;
font-weight:bold;
width:200px;
}
.ready-close-container {
  background: none repeat scroll 0 0 #ffffff;
  margin: auto;
  padding: 40px;
  width: 91%;
  height:800px;
}
.reviews
{
	float:left;
	margin-left:50px;
	
}
</style>	

<?php include("function.php");?>
	<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>
		<?php $today=date("Y-m-d");
		$month=$_GET['mon'];

		$year=$_GET['year'];
		if(!isset($month) || !isset($year))
	{
			$month=date("m");
			$year=date("Y");
	}

		?>

<?php
include("config.php");
?>


<div class="addData">
<div id="myDiv">
</div>

<br/>
<div align="center" >
<?php
$getMonthYear="select distinct MONTH(date) as month, YEAR (date) as year from trackinghistory  order by date";
$monthYear=mysql_query($getMonthYear);
while($monthYearVal=mysql_fetch_array($monthYear)){ ?>
		<a href="starRating.php?mon=<?php echo $monthYearVal['month']; ?>&year=<?php echo $monthYearVal['year']; ?>">
		<span style="font-size:14px;font-weight:bold"><?php echo $monthYearVal['month']." - ".$monthYearVal['year']; ?></span></a>
<?php } ?>
</div>


</p>
<div class="ContentData" >
<p style="clear:both"></p>

<?php
 
$getCloseProjects = "select teamLead, COUNT(distinct closedssb.trackID) as counter, closedOn 
FROM closedssb where MONTH(closedOn)=$month and YEAR(closedOn)=$year and teamLead!=0 and 
(service='Template Setup' or service='First-Time Template Setup') GROUP BY teamLead order by counter DESC";
$resultCloseProjects = mysql_query($getCloseProjects);
$numProjects = mysql_num_rows($resultCloseProjects);
?>
<div class="ready-close-container">

<div class="reviews">
<div>
<?php 
$monthName = date("M", mktime(0, 0, 0, $month, 10));
echo "<b style='font-size:15px;'>".$monthName." ".$year."</b>"; ?>
</div>
<table class="sortable" border="2">
<thead><tr style="background:#ccc;">
<th style="padding-left:10px;">Team Leader</th><th style="padding-left:10px;">Total</th>
<th style="padding-left:10px;" ><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /></th>
<th style="padding-left:10px;" ><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /></th>
<th style="padding-left:10px;" ><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /></th>
<th style="padding-left:10px;" ><img src="img/rate-btn3-hover.png" /><img src="img/rate-btn3-hover.png" /></th>
<th style="padding-left:10px;" ><img src="img/rate-btn3-hover.png" /></th>
<th style="padding-left:10px;" >Not Rated</th>
</tr></thead>
<?php
while($rowProjects = mysql_fetch_array($resultCloseProjects)){
$teamLead1 = $rowProjects['teamLead'];
$getName = "select * from webadmin where adminID = '".$rowProjects['teamLead']."'";
$resultName = mysql_query($getName);
$rowName = mysql_fetch_array($resultName);	

$getCloseProjects11 = "select GROUP_CONCAT(A.comma_id) as trackID,A.teamLead,count(A.counter) as trackCounter
from (SELECT GROUP_CONCAT(DISTINCT trackinghistory.trackID) as comma_id, closedssb.teamLead, COUNT(trackinghistory.trackID) as counter 
FROM trackinghistory INNER JOIN closedssb on trackinghistory.trackID=closedssb.trackID
where MONTH(date)=$month and YEAR(date)=$year and closedssb.hours2>0 and trackinghistory.status = 'Second Rev. Issues Sent' 
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1' 
GROUP BY closedssb.trackID) A where A.counter = 1 and teamLead = '$teamLead1'";

$getCloseProjects5 = "select COUNT(distinct closedssb.trackID) as fiveStar, closedOn FROM closedssb where MONTH(closedOn)=$month 
and YEAR(closedOn)=$year and rating = 5 
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1'";
$resultCloseProjects5 = mysql_query($getCloseProjects5);
$numProjects5 = mysql_num_rows($resultCloseProjects5);
$rowProjects5 = mysql_fetch_array($resultCloseProjects5);

$getCloseProjects22 = "select GROUP_CONCAT(A.comma_id) as trackID,A.teamLead,count(A.counter) as trackCounter
from (SELECT GROUP_CONCAT(DISTINCT trackinghistory.trackID) as comma_id, closedssb.teamLead, COUNT(trackinghistory.trackID) as counter 
FROM trackinghistory INNER JOIN closedssb on trackinghistory.trackID=closedssb.trackID
where MONTH(date)=$month and YEAR(date)=$year and closedssb.hours2>0 and trackinghistory.status = 'Second Rev. Issues Sent' 
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1' 
GROUP BY closedssb.trackID) A where A.counter > 1 and teamLead = '$teamLead1'";

$getCloseProjects4 = "select COUNT(distinct closedssb.trackID) as fourStar, closedOn FROM closedssb where MONTH(closedOn)=$month 
and YEAR(closedOn)=$year and rating = 4
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1'";
$resultCloseProjects4 = mysql_query($getCloseProjects4);
$numProjects4 = mysql_num_rows($resultCloseProjects4);
$rowProjects4 = mysql_fetch_array($resultCloseProjects4);

$getCloseProjects3 = "select COUNT(distinct closedssb.trackID) as threeStar, closedOn FROM closedssb where MONTH(closedOn)=$month 
and YEAR(closedOn)=$year and rating = 3
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1'";
$resultCloseProjects3 = mysql_query($getCloseProjects3);
$numProjects3 = mysql_num_rows($resultCloseProjects3);
$rowProjects3 = mysql_fetch_array($resultCloseProjects3);

$getCloseProjects2 = "select COUNT(distinct closedssb.trackID) as twoStar, closedOn FROM closedssb where MONTH(closedOn)=$month and 
YEAR(closedOn)=$year and rating = 2
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1'";
$resultCloseProjects2 = mysql_query($getCloseProjects2);
$numProjects2 = mysql_num_rows($resultCloseProjects2);
$rowProjects2 = mysql_fetch_array($resultCloseProjects2);

$getCloseProjects1 = "select COUNT(distinct closedssb.trackID) as oneStar, closedOn FROM closedssb where MONTH(closedOn)=$month and 
YEAR(closedOn)=$year and rating = 1
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1'";
$resultCloseProjects1 = mysql_query($getCloseProjects1);
$numProjects1 = mysql_num_rows($resultCloseProjects1);
$rowProjects1 = mysql_fetch_array($resultCloseProjects1);

$getCloseProjects0 = "select COUNT(distinct closedssb.trackID) as zeroStar, closedOn FROM closedssb where MONTH(closedOn)=$month and 
YEAR(closedOn)=$year and rating = 0
and (closedssb.service='Template Setup' or closedssb.service='First-Time Template Setup') and teamLead = '$teamLead1'";
$resultCloseProjects0 = mysql_query($getCloseProjects0);
$numProjects0 = mysql_num_rows($resultCloseProjects0);
$rowProjects0 = mysql_fetch_array($resultCloseProjects0);
//$directlyClosed = $rowProjects['counter'] - $rowProjects1['trackCounter'] - $rowProjects2['trackCounter'] ;
//$secReviewEffi1 = ($rowProjects1['trackCounter']/$rowProjects['counter'])*100;  
//$secReviewEffi2 = ($rowProjects2['trackCounter']/$rowProjects['counter'])*100;  
?>
<tr><td><?php echo $rowName['name']; ?></td><td><?php echo $rowProjects['counter'] ; ?></td>
<td><?php echo $rowProjects5['fiveStar'] ; ?></td><td><?php echo $rowProjects4['fourStar'] ; ?></td>
<td><?php echo $rowProjects3['threeStar'] ?></td><td><?php echo $rowProjects2['twoStar'] ; ?></td>
<td><?php echo $rowProjects1['oneStar'] ?></td><td><?php echo $rowProjects0['zeroStar'] ; ?></td></tr>

<?php 
 }
 //} }?>
</table>
</div>
</div>
</div>
<?php include("Footer.php"); ?>
<?php }else{ echo "You Are Not Permitted to Access This Page"; } ?>