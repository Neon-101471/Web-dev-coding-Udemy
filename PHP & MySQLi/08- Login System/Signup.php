<?php
	include "Connection.php";
	if (isset($_POST['signup']))
	{
		$uname = mysqli_real_escape_string($connection, $_POST['username']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$pword = mysqli_real_escape_string($connection, $_POST['password']);
		
		if(empty($uname) OR empty($name) OR empty($pword))
		{
			header("LOCATION: Index.php?message=emptyFields");
			exit();
		}
		
		$sql = "SELECT * FROM `users` WHERE username='$uname'";
		$result = mysqli_query($connection, $sql); 
		
		if(mysqli_num_rows($result)>0)
		{
			header ("LOCATION: Index.php?message=usernameExists");
			exit ();
		}
		else
		{
			$hash = password_hash($pword, PASSWORD_DEFAULT);
			$sql2 = "INSERT INTO `users` (`username`, `name`, `password`) VALUES ('$uname', '$name', '$hash');";
			if(mysqli_query($connection, $sql2))
			{
				header ("LOCATION: Index.php?message=registrationSuccess");
			}
			else
			{
				header ("LOCATION: Index.php?message=registrationFailed");
			}
		}
	}
	else
	{
		header ("LOCATION: Index.php");
	}
?>