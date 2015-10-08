<?php
		session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}	
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1)|| ($_SESSION['userRole']==2 && $_SESSION['status']==1) ){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1 ){ 	
			include_once ("Header.php");
		}
include("config.php");
 if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' || $_SESSION['userRole']=='3')
{
?>
<?
$todayDate=date("Y-m-d");
$maximumDate=mysql_query("select max(appliedFor) as maxApplied from empleavedetails");
$maxApplied=mysql_fetch_assoc($maximumDate);
$maxDate=$maxApplied['maxApplied'];
echo "<br/>";

    $date_from = $todayDate;   
    $date_from = strtotime($date_from); 
      
    $date_to = $maxDate;  
    $date_to = strtotime($date_to);  
     ?>
	 <style>
	 /*.status-1
	 {
	 background-color:#d4c606;
	 color:#fff;
	 font-weight:bold;
	 vertical-align:top;
	 }*/
	 
	 /*.status-2
	 {
	 background-color:#ff1612;
	 color:#fff;
	 font-weight:bold;
	 vertical-align:top;
	 }*/
	 
	 /*.status-3
	 {
	  background-color: #73D601;
	  font-weight: bold;
	 }*/
	 
	 /*.type-1
	 {
	   background-color: #000000;
      color: #ffffff;
      display: block;
      left: 0;
      min-height: 5px;
      position: absolute;
      top: -1px;
      width: 100%;
	 }*/
	 
	 /*.Sat 
	 {
	 background-color:#ccc;
	 }*/
	 
	 /*.Sun
	 {
	 background-color:#ccc;
	 }*/

	 </style>
	 
	 <div class="leave-calendar-wrapper">
<div class="leave_tracking_container">
	 
<table border="1" style="border-collapse:collapse">
   <?php for ($i=$date_from; $i<=$date_to; $i+=86400) {  ?>
        <tr><?php  $ddd=date("Y-m-d", $i);
		$date = date("D",strtotime($ddd));
		
		?>
		<td class="<?php echo $date; ?>" id="content-headings2"><?php echo  $ddd; ?></td>
				<td class="<?php echo $date; ?>" id="content-headings2"><?php echo $date;  ?></td>
		<?php
		$allEmployee=mysql_query("select distinct empID,typeLeave,status from empleavedetails where appliedFor='$ddd' and (status ='1' || status ='2' || status ='3') order by empID desc");

		while($rowAllEmp=mysql_fetch_array($allEmployee))
		 {
		?>
		<td  class="<?php echo "status-".$rowAllEmp['status'];  ?>" >
		<span class="<?php echo 'type-'.$rowAllEmp['typeLeave'];  ?>"></span>
		<?php //echo $rowAllEmp['empID'];
		$getEmpName=mysql_query("select name from webadmin where adminID='$rowAllEmp[empID]'");
		$empname=mysql_fetch_assoc($getEmpName);
		echo $empname['name'];
		
		
		?></td>
		<?php } ?>
		</tr>  
   <?php }  
?></table>

</div>
</div>
<?php

}
else
{
	echo "You are not Permitted to Access this Page";
}

 include("Footer.php"); ?>