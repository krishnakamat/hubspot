<?php

include('config.php');

	$followerID = $_GET['followerID'];
	$ssbID = $_GET['ssbID'];
		 $query = mysql_query("delete from followers where followerID='$followerID'") or die(mysql_error()); 
		 $getName = mysql_query("select * from followers where ssbID='$ssbID'");
		 echo "<b>Followers Updated:</b>";
		echo "<ul class='followers'>";
		 while($getEmpName = mysql_fetch_array($getName))
		 {	
				$empID = $getEmpName['owner'];
				$getNameEmp = mysql_query("select * from webadmin where adminID='$empID'");
				$name = mysql_fetch_assoc($getNameEmp);
				echo "<li>".$name['name']."<span class='remove' onclick='removeEntry(".$getEmpName['followerID'].")'><img src='images/delete-18.png'/></span></li>";
		 }
		echo "</ul>";

?>