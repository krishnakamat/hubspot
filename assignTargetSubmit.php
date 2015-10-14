<?php
include('config.php');
if(isset($_POST['submit'])){
	$teamLead = $_POST['adminID'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$time = $_POST['target'];
	
	$removeExisting = "delete from assigntarget where month ='$month' and year='$year'";
	mysql_query($removeExisting);
	$items = array();

	$size = count($teamLead);

	for($i = 0 ; $i < $size ; $i++){
	if (empty($teamLead[$i])) {
		continue;
	}
	$items[]=array(
	"year"		=> $year,
	"month"    => $month,	
	"teamLead"    => $teamLead[$i],  
	"time"  => $time[$i],
     );
	}

	if (!empty($items)) {
	$values = array();
	foreach($items as $item){
		$values[] = "('{$item['teamLead']}','{$item['month']}','{$item['year']}','{$item['time']}')";
	}

	$values = implode(", ", $values);

	 $sql = "INSERT INTO assigntarget(teamLead,month,year,time) VALUES{$values}" ;
	$result = mysql_query($sql);

	}
	echo "<script>location.href='assignTarget.php';</script>";

}

	?>