<?php
		include("config.php");
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$comment=$_POST['comment'];
		$role=$_POST['role'];
		
		$insertOwner="insert into webadmin(name,email,password,comment,type)values('$name','$email','$password','$comment','$role')";
		mysql_query($insertOwner);
		echo "<script> document.location.href='addOwner.php?msg=Added Successfully';</script>"; 
		
