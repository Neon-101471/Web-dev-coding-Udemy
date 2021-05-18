	<?php
		session_start();
		include_once "../Includes/Functions.php";
		include_once "../Includes/Connection.php";
	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> Signin </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../Style/Bootstrap.min.css">
		<link rel="stylesheet" href="../Style/Style.css">
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
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				'.$msg.'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>';
			}
		?>
		
		<div id = "signup">
			<form method="post" class="form-signin">
				<h1 class="h3 mb-3 font-weight-normal"> Please Login </h1>
				<input type="email" name="AuthorEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
				<input type="password" name="AuthorPassword" id="inputPassword" class="form-control" placeholder="Password" required>
				<button class="btn btn-lg btn-primary btn-block" name="signup" type="submit">Sign In</button>
			</form>
		</div>
		
		<?php 
			if(isset($_POST['signup']))
			{
				$AuthorEmail = mysqli_real_escape_string($connection, $_POST['AuthorEmail']);
				$AuthorPassword = mysqli_real_escape_string($connection, $_POST['AuthorPassword']);
				
				//checking for empty fields
				if(empty($AuthorEmail) OR empty($AuthorPassword))
				{
					header("LOCATION: Login.php?message=Empty+Fields");
					Exit();
				}
				
				//checking for validity of email
				if(!filter_var($AuthorEmail,FILTER_VALIDATE_EMAIL))
				{
					header("LOCATION: Login.php?message=Please+Enter+A+Valid+email");
					Exit();
				}
				else

				{
					//If email exists
					$sql = "SELECT * FROM `author` WHERE `AuthorEmail`='$AuthorEmail'";
					$result = mysqli_query($connection, $sql);
					if(mysqli_num_rows($result)<=0)
					{
						header("LOCATION: Login.php?message=Login+Error");
						Exit();
					}
					else
					{
						while($row = mysqli_fetch_assoc($result))
						{
							//checking if password matches
							if(!password_verify($AuthorPassword, $row['AuthorPassword']))
							{
								header("LOCATION: Login.php?message=Login+Error");
								Exit();
							}
							else if(password_verify($AuthorPassword, $row['AuthorPassword']))
							{
								$_SESSION['AuthorId'] = $row['AuthorId'];
								$_SESSION['AuthorName'] = $row['AuthorName'];
								$_SESSION['AuthorEmail'] = $row['AuthorEmail'];
								$_SESSION['AuthorBio'] = $row['AuthorBio'];
								$_SESSION['AuthorRole'] = $row['AuthorRole'];
								
								header("LOCATION: Index.php");
								Exit();
							}
						}
					}
				}
			}
		?>
	
	<script src ="../JavaScript/jQuery.js"> </script>
	<script src ="../JavaScript/Bootstrap.min.js"> </script>
	<script src ="../JavaScript/Scroll.js"></script>
	</body>
</html>