			<?php
				session_start ();
			?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage | Login </title>
		<style>
			#topbar
			{
				width:80%;
				height:100px;
				margin:auto;
				background-color: lightblue;
			}
			#login-form
			{
				margin: auto;
				padding-top:20px;
				text-align:center;
			}
			body
			{
				background-color: lightgray;
			}
			#container
			{
				width:80%;
				height: 250px;
				margin:auto;
				text-align: center;
				background-color: #ebebeb;
				padding-top: 50px;
			}
		</style>
	</head>
	
	<body>
			<!-- Login Section -->
		<div id = "topbar">
			<?php
				if(isset($_SESSION['id']))
				{
			?>
				<a href = "Logout.php"> <button> Log Out </button> </a>
			<?php
				}
				else
				{
			?>
				<div id = "login-form">
				<form action = "Login.php" method = "post">
					Username:	<input type = "text" name = "username">
					Password:	<input type = "password" name = "password">
								<input type = "submit" name = "login" value = "Log In">					
				</form>
				</div>
			<?php } ?>
		</div>
			<!-- Sign Up Section -->
		<div id = "container">
			<?php
			if(isset($_SESSION['id']))
			{
				?>
						<h1> Welcome to our website! </h1>
						<p> You are logged in as <?php echo $_SESSION ['name'] ?>  </p>
				<?php
			}
			else
			{
			?>
				<form action = "Signup.php" method = "post">
					Username:	<input type = "text" name = "username"> </br> </br>
					Name:		<input type = "text" name = "name"> </br> </br>
					Password	<input type = "password" name = "password"> </br> </br>
								<input type = "submit" name = "signup" value = "SUBMIT">
				</form>
			<?php } ?>
		</div>
	</body>
</html>