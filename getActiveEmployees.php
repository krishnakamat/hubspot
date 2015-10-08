<?php
session_start();
if(!isset($_SESSION['loggedIn']))
	{
		echo "<script>location.href='index.php';</script>";
	}
include("config.php");
$status = $_GET['q'];
?>
<table class="sortable" border="2"  ><thead><tr style="background:#9bbb59; color:#fff;height:25px;font-size:16px !important"><th>Sr. No.</th><th >Name</th><th>Email</th><th>Role</th><th>Action</th></tr></thead>

<?php

			$allUsers="select * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3) and status = '$status' order by name";

			$users=mysql_query("$allUsers");

			$x=0;



			while($userArr=mysql_fetch_array($users))

	{ if($userArr['userRole']== 1){
		$role = "Admin";
		}elseif($userArr['userRole']== 2){
		$role = "Team Leader";
		}else{
		$role = "Employee";
		}
		

				$x++; 



				$class = ($x%2 == 0)? 'Background1': 'Background2';

				?>

				<tr class="<?php echo $class; ?>" ><td ><?php echo $x; ?></td><td ><?php echo $userArr['name'];?></td><td ><?php echo $userArr['email'];?></td><!--<td contenteditable="true" onblur="updateUser(this.innerHTML,1,<?php echo $userArr['adminID'];?>);"><?php echo $userArr['email'];?></td>--><!--<td ><?php

		$allReviewer1="select  distinct * from webadmin where userRole = 1 or userRole = 2";

		$getAllReviewer1=mysql_query($allReviewer1);

		$adminID= $userArr['adminID'];

		$adUsrName= $userArr['name'];

		?>

		<select name="teamLead"  onchange="updateUser(this.value,2,<?php echo $userArr['adminID'];?>);">

			<?php

					$getLead=mysql_query("select * from webadmin where adminID='$userArr[teamLead]'");

					$leadArr=mysql_fetch_assoc($getLead);

					$leadName=$leadArr['name'];

					

		

		?>

				

		<option value="<?php echo $userArr['teamLead'];?>" selected><?php echo $leadName;?></option>

				<?php

					while($reviewerArr1=mysql_fetch_array($getAllReviewer1))

				{

					?><option value="<?php echo $reviewerArr1['adminID'];?>"><?php echo $reviewerArr1['name'];?></option>

				<?php

				}

					?>

		</select></td>--><!--<td ><select name="role" onchange="updateUser(this.value,3,<?php echo $userArr['adminID'];?>);"><option value="<?php echo $userArr['userRole']; ?>"><?php echo $role;?></option><option value="1">Admin</option><option value="2">Team Leader</option><option value="3">Employee</option></td>--><td><?php echo $role;?></td></td>

		<td><a style="cursor:pointer" href="editUser.php?adminID=<?php echo $adminID; ?>">View/Edit User</a><!--&nbsp;|
			<a style="cursor:pointer" onclick='resignUser( "<?php echo $adminID; ?>","<?php echo $adUsrName; ?>")'>Resigned</a>&nbsp;|
			<a style="cursor:pointer" onclick='abscondUser( "<?php echo $adminID; ?>","<?php echo $adUsrName; ?>")'>Absconded</a>-->
		</td></tr>

	<?php

	}

	?>

	

	
</table>
	
