<!DOCTYPE html>
<html>
	<head>
		<title> Homepage | Login </title>
	</head>
	<body>
		<?php include "connection.php"; session_start ();?>
		<form method = "post">
					Username:	<input type = "text" name = "username"> </br> </br>
					Password	<input type = "password" name = "password"> </br> </br>
								<input type = "submit" name = "login" value = "SUBMIT">
		</form>
		<?php
			if(isset($_POST['login']))
			{
				$user_username = mysqli_real_escape_string($connection, $_POST['username']);
				$user_password = mysqli_real_escape_string($connection, $_POST['password']);
				
				$sql = "SELECT * FROM `users` WHERE user_username='$user_username'";
				$result = mysqli_query($connection, $sql);
				
				if(mysqli_num_rows($result)>0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						if(password_verify($user_password, $row['user_password']))
						{
							$_SESSION['id'] = $row['user_id'];
							
							echo "<h3> You are logged in </h3>";
							header ("LOCATION: Show.php");
						}
					}
				}
			}
		?>
	</body>

</html>