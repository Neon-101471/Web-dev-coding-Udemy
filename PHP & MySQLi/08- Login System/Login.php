<?php
	session_start();
	include "Connection.php";
	if (isset($_POST['login']))
	{
		$uname = mysqli_real_escape_string($connection, $_POST['username']);
		$pword = mysqli_real_escape_string($connection, $_POST['password']);
		
		if(empty($uname) OR empty($pword))
		{
			header("LOCATION: Index.php?message=emptyFields");
			exit();
		}
		$sql = "SELECT * FROM `users` WHERE username='$uname'";
		$result = mysqli_query($connection, $sql); 
		
		if(mysqli_num_rows($result)<=0)
		{
			header ("LOCATION: Index.php?message=LoginError");
			exit ();
		}
		else
		{
			while($row=mysqli_fetch_assoc($result))
			{
				if(!password_verify($pword, $row['password']))
				{
					header ("LOCATION: Index.php?message=LoginError");
			exit ();
				}
				else if(password_verify($pword, $row['password']))
				{
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['password'] = $row['password'];
					
					header ("LOCATION: Index.php?message=LoginSuccess");
				}
			}
		}
	}
	else
	{
		header ("LOCATION: Index.php");
	}
?>