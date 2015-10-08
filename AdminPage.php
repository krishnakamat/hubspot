<?php
session_start();
		if(!isset($_SESSION['loggedIn']))
		echo "<script>location.href='index.php';</script>";
if($_SESSION['type']=='2'){
	include_once ("Header.php");
}
else{
	include_once ("HeaderAdmin.php");
}

?>

<div class="content">
<div class="content-header">
	<table cellspacing="0" class="grid-header">
		<tr>
			<td>
				<h3>Home</h3>

			</td>
		</tr>
	</table>
</div>
<?php 

//echo $_SESSION['type'];?>

<p style="font-weight: bold">Welcome</p><br />

</div>

<?php
	include_once ("Footer.php");
?>