<?php
	include_once "../Includes/Functions.php";
	include_once "../Includes/Connection.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> Sign up </title>
		<link rel = "stylesheet" href = "../Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "../Style/Style.css">
		<style>
			#signup
			{
				width: 350px;
				margin: auto;
				margin-top: 200px;
			}
			body
			{
				font-family: Georgia;
			}
		</style>
	</head>
	<body>
		<?php
			if(isset($_GET['message']))
			{
				$msg = $_GET['message'];
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						'.$msg.'
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					  </div>';
			}
		?>
		
		<div id = "signup">
			<form class="form-signin" method = "post">
				<h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
				<input type="text" name = "AuthorName" id="input" class="form-control" placeholder="Enter name" required autofocus>
				<input type="email" name = "AuthorEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
				<input type="password" name = "AuthorPassword" id="inputPassword" class="form-control" placeholder="Password" required>
				<div class="checkbox mb-3">
					<label>
						<input type="checkbox" value="remember-me"> Remember me
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" name = "signup" type="submit">Sign up</button>
			</form>
		</div>
		
		<?php
			if(isset($_POST['signup']))
				{
					$AuthorName = mysqli_real_escape_string($connection, $_POST['AuthorName']);
					$AuthorEmail = mysqli_real_escape_string($connection, $_POST['AuthorEmail']);
					$AuthorPassword = mysqli_real_escape_string($connection, $_POST['AuthorPassword']);
				//Checking for empty fields:
				if(empty($AuthorName) OR empty($AuthorEmail) OR empty($AuthorPassword))
					{
						header ("LOCATION: Signup.php?message=Empty+Fields");
						Exit ();
					}
				//Checking for validity of email:
				if(!filter_var($AuthorEmail, FILTER_VALIDATE_EMAIL))
					{
						header ("LOCATION: Signup.php?message=Please+enter+A+valid+email");
						Exit ();
					}
					else
					{
					//If email exist:
						$sql2 = "SELECT * FROM `author` WHERE AuthorEmail='$AuthorEmail'";
						$result = mysqli_query($connection, $sql2);
						
						if(mysqli_num_rows($result)>0)
						{
							header ("LOCATION: Signup.php?message=Email+is+already+exists");
							Exit ();
						}
						else
						{
						//Hashing password:
							$hash = password_hash($AuthorPassword, PASSWORD_DEFAULT);
						//Signing up the users:
							$sql = "INSERT INTO `author` (`AuthorName`, `AuthorEmail`, `AuthorPassword`, `AuthorBio`, `AuthorRole`) VALUES ('$AuthorName', '$AuthorEmail', '$hash', 'Enter Bio', 'Author')";
							
							if(mysqli_query($connection, $sql))
							{
								header ("LOCATION: Signup.php?message=Successfully+registered");
								Exit ();	
							}
							else
							{
								header ("LOCATION: Signup.php?message=Registered+failed");
								Exit ();
							}
						}
					}
				}
		?>
	<script src = "../JavaScript/jQuery.js"> </script>
	<script src = "../JavaScript/Bootstrap.min.js"> </script>
	<script src = "../JavaScript/Scroll.js"> </script>
	</body>
</html>