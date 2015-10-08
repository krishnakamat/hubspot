<?php
include("config.php");

$openssbID= $_GET['openssbID'];

$deleteTime="delete from openssbtime where openssbID='$openssbID'";
mysql_query("$deleteTime");

echo "<script> window.history.go(-1); </script>";
?>