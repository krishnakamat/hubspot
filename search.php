<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
include("config.php");
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysql_query("select * from webadmin where name like '%$q%' order by empID LIMIT 5");
while($row=mysql_fetch_array($sql_res))
{
$username=$row['name'];
$b_username='<strong>'.$q.'</strong>';
$final_username = str_ireplace($q, $b_username, $username);
$photograph=$row['photograph'];
$gender = $row['gender'];
if(empty($photograph) && $gender==1){
$photograph = "male_image.png" ;
}
if(empty($photograph) && $gender==2){
$photograph = "female_image.png" ;
}
$empID = $row['empID'];
?>
<div class="show" align="left" style="clear:both;height:50px;cursor:pointer;width:210px" onclick="getEmployee(<?php echo $empID; ?>)">
<img src='profileImages/<?php echo $photograph; ?>' style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php echo $final_username; ?></span>&nbsp;<br/><?php echo "Employee ID:". $empID; ?>
</div>
<br/>
<?php
}
}
?>
