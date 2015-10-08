<?php
$adminID=$_GET['userID'];
include("config.php");
$getUser="select * from webadmin where adminID='$adminID'";
$selectUser=mysql_query($getUser);
$user=mysql_fetch_assoc($selectUser);
if($user['type']== 1)
{$role='Admin';}
else{$role="User";}



?>

<form action="updateUserProfile.php" class="user"  method="post">
<table>
<tr><td>Name:</td><td><input type="text" name="name" required value="<?php echo $user['name'];?>"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" required value="<?php echo $user['email'];?>"></td></tr>
<tr><td>Comment:</td><td><input type="text" name="comment"  value="<?php echo $user['comment'];?>"></td></tr>
<tr><td>User Role:</td><td><select name="role" required onchange="getUserType(this.value)">
<option value="<?php echo $user['type'];?>" ><?php echo $role;?></option>
<option value="1">Admin</option>
<option value="2">User</option>
</select></td></tr>
<tr><td>Team Lead</td><td><?php
		$allReviewer1="select  * from webadmin where type='1'";
		$getAllReviewer1=mysql_query($allReviewer1);
		?>
		<select name="teamLead" >
		<option value="<?php echo $user['teamLead'];?>" selected><?php echo $user['teamLead'];?></option>
				<?php
					while($reviewerArr1=mysql_fetch_array($getAllReviewer1))
				{
					?><option value="<?php echo $reviewerArr1['name'];?>"><?php echo $reviewerArr1['name'];?></option>
				<?php
				}
					?>
		</select></td></tr>
		<input type ="hidden" name="adminID" value="<?php echo  $adminID; ?>">
<tr><td colspan="2"><input type="submit" value="Add User"></td>
</table>

</form>