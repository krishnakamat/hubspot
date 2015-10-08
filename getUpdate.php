<?php

include('config.php');
$getData = "select * from updatedata where id='1'";
$getDataUpdate = mysql_query($getData);
$getDat = mysql_fetch_assoc($getDataUpdate);
echo strip_tags($getDat['data']);

?>