<!DOCTYPE html>
<html>
	<head>
		<title> Homepage | SignUp </title>
	</head>
	<body>
		<form action = "Signup.php" method = "post">
					Username:	<input type = "text" name = "username"> </br> </br>
					Email:		<input type = "email" name = "email"> </br> </br>
					Password	<input type = "password" name = "password"> </br> </br>
								<input type = "submit" name = "signup" value = "SUBMIT">
				</form>
	</body>

</html>

<?php
	include "Connection.php";
	if (isset($_POST['signup']))
	{
		$uname = mysqli_real_escape_string($connection, $_POST['username']);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$pword = mysqli_real_escape_string($connection, $_POST['password']);
		
		if(empty($uname) OR empty($email) OR empty($pword))
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
			$sql2 = "INSERT INTO `users` (`user_username`, `user_email`, `user_password`) VALUES ('$uname', '$email', '$hash');";
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
?>