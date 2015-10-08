<?php

		session_start();

		if(!isset($_SESSION['loggedIn'])){
			echo "<script>location.href='index.php';</script>";
		}
		if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){
			include_once ("HeaderAdmin.php");
		}
		if($_SESSION['userRole']==3 && $_SESSION['status']==1){ 	
			include_once ("Header.php");
		}



include("config.php");

?>



	<script>

	function updateUser(val,update,adminID)

	{
			var xmlhttp;

			if (window.XMLHttpRequest)

			  {

			  xmlhttp=new XMLHttpRequest();

			  }

			else

			  {

			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

			  }

			xmlhttp.onreadystatechange=function()

			  {

			  if (xmlhttp.readyState==4 && xmlhttp.status==200)

				{

				document.getElementById("myDiv").innerHTML=xmlhttp.responseText;

				}

			  }

			xmlhttp.open("GET",'updateUserProfile.php?value='+val+'&adminID='+adminID+'&toUpdate='+update,true);

			xmlhttp.send();

	





	}

	</script>

	<script>

		function deleteUser(userId,usrName) {

		

	var answer = confirm("You have selected to delete "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="deleteUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
	
		<script>

		function resignUser(userId,usrName) {



	var answer = confirm("You have selected to resign "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="resignUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>
	
		<script>

		function abscondUser(userId,usrName) {


	var answer = confirm("You have selected to abscond "+usrName+". Are you sure you want to continue?")

		

		if (answer){

		location.href="abscondUser.php?userId="+userId;

		}

		else{

		return false;

		}

	}

	</script>



<?php 	if(($_SESSION['userRole']==1 && $_SESSION['status']==1) || ($_SESSION['userRole']==2 && $_SESSION['status']==1)){?>

<?php include("function.php");?>

<div id="myDiv"></div>

<table class="sortable" border="2"  ><thead><tr style="background:#9bbb59; color:#fff;height:25px;font-size:16px !important"><th>Sr. No.</th><th >Name</th><th>Email</th><th>Team Lead</th><th>Role</th><th>Action</th></tr></thead>

<?php

			$allUsers="select * from webadmin where (userRole = 1 or userRole = 2 or userRole = 3) and status = 1 order by name";

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

				<tr class="<?php echo $class; ?>" ><td ><?php echo $x; ?></td><td ><?php echo $userArr['name'];?></td><td contenteditable="true" onblur="updateUser(this.innerHTML,1,<?php echo $userArr['adminID'];?>);"><?php echo $userArr['email'];?></td><td ><?php

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

		</select></td><td ><select name="role" onchange="updateUser(this.value,3,<?php echo $userArr['adminID'];?>);"><option value="<?php echo $userArr['userRole']; ?>"><?php echo $role;?></option><option value="1">Admin</option><option value="2">Team Leader</option><option value="3">Employee</option></select></td>

		<td><a style="cursor:pointer" onclick='deleteUser( "<?php echo $adminID; ?>","<?php echo $adUsrName; ?>")'>Delete</a></td></tr>

	<?php

	}

	?>

	

	
</table>
	

	<?php } else { echo "You are not permitted to Access this Page"; } ?>

<?php include("Footer.php"); ?>

