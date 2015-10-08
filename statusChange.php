<?php
session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
include("config.php");
?>
<p>Status Not Changed</p>
<script type="text/javascript" >
function getElapsedDays(days)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("statusData").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","statusData.php?days="+days,true);
xmlhttp.send();
}
</script>
<form action="#" >
<select onchange="javascript:getElapsedDays(this.value);" name="elapsedDay">
			<option value="1">1</option>
			<option value="2">2</option>
			<option selected value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option  value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			</select> Days</td>	
	</form>

	<div id="statusData">
<?php
date_default_timezone_set('Asia/Kolkata'); 
 $today=date("Y-m-d");
 $dayBefore= date('Y-m-d', strtotime('-3 days', strtotime("$today")));
 echo "After  :  ".$dayBefore;
 echo "<br/>";
 $getCategory=mysql_query("select * from service group by category");
 while($allCategory=mysql_fetch_array($getCategory))
	{
		 	$category = $allCategory['category'];
$statusSsb=mysql_query("select distinct trackID from trackinghistory where date < '$dayBefore' order by date desc");
//echo $statusSsb;
?>
<table >
<tr><th colspan="5"><?php
	$getCategoryName=mysql_query("select catName from category where catID='$category'");
			$catName=mysql_fetch_assoc($getCategoryName);?>
<?php echo $catName['catName']; ?>
</th></tr>
<tr><th>Owner</th><th>SSB ID</th><!--<td>Service</td>--><th>Days</th><th>Status</th></tr>

<?php while($getSsb=mysql_fetch_array($statusSsb))
{   $trackID= $getSsb['trackID'];
				$getStatus=mysql_query("select status,updates,date from trackinghistory where trackID='$trackID' order by historyID desc");
			$statusArr=mysql_fetch_assoc($getStatus);
     $date1 = strtotime("$today");
	 $date2=strtotime($statusArr['date']);
     $datediff = $date1 - $date2;
	 if(floor($datediff/(60*60*24))+1 > '0')
	{
			$getSsb=mysql_query("select * from tracking,service where tracking.trackID='$trackID'  && (tracking.service=service.serviceName && service.category='$category') group by tracking.status");
			$ssbArr=mysql_fetch_assoc($getSsb);
			if( $ssbArr['ssbID'] != '')
	{?>
			<tr><td><?php	//echo $ssbArr['owner']; 
			 $getOwnerName=mysql_query("select * from webadmin where adminID ='$ssbArr[owner]'");
						$ownerArr1=mysql_fetch_array($getOwnerName);
						$ownerName= $ownerArr1['name'];

				
				echo $ownerName ;
			
			?></td><td style="text-align:center"><a href="searchSsb.php?ssbID=<?php echo $ssbArr['ssbID']; ?>" ><?php echo $ssbArr['ssbID']; ?></a></td><!--<td><?php echo $ssbArr['service']; ?></td>-->
	
      <td><?php echo floor($datediff/(60*60*24))+1; ?></td><td>

		<?php echo $ssbArr['status']; ?>
	<?php 	
?>
	  
	  </td></tr>

<?php	}
	}

	}
}?>
</div>