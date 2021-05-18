	<?php
		ob_start();
		include_once "../Includes/Functions.php";
		include_once "../Includes/Connection.php";
		session_start ();
		
		if(isset($_SESSION['AuthorRole']))
		{
	?>
	
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> Admin Panel </title>		
		<link rel = "stylesheet" href = "../Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "../Style/Style.css">
		<style>
			#welcome
			{
				color: blue;
			}
			body
			{
				font-family: Georgia;
			}
		</style>
	</head>
	
	<body>
		<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow">
			<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"> Neon-10 </a>
			<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target=	"#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<ul class="navbar-nav px-3">
				<li class="nav-item text-nowrap">
					<a class="nav-link" href="Logout.php">Sign out</a>
				</li>
			</ul>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<?php include_once "Nav.inc.php"; ?>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Dashboard</h1>
				<h5 id = "welcome"> Welcome to <?php echo $_SESSION['AuthorName']; ?> | Your role is <?php echo $_SESSION['AuthorRole']; ?> </h5>
				<div class="btn-toolbar mb-2 mb-md-0">
				  <div class="btn-group mr-2">
					<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
					<button type="button" class="btn btn-sm btn-outline-secondary">Review</button>
				  </div>
				</div>
			  </div>
			  <div id = "admin-index-form">
			  
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

				<h5> Your Profile </h5>
				<form method = "post">
				  <div class="form-group">
					<label for="exampleInputEmail1"> Name </label>
					<input name = "AuthorName" value = "<?php echo $_SESSION['AuthorName']; ?>" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder ="Enter name">
				  </div>
				  <div class="form-group">
					<label for="exampleInputEmail1"> Email address </label>
					<input name = "AuthorEmail" value = "<?php echo $_SESSION['AuthorEmail']; ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder ="Enter email">
				  </div>
				  <div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input name = "AuthorPassword" type="password" class="form-control" id="exampleInputPassword1" placeholder = "Password">
				  </div>
				  <div class="form-group">
					<label for="exampleFormControlTextarea1">Users bio</label>
					<textarea name = "AuthorBio" class="form-control" id="exampleFormControlTextarea1" rows="3"> <?php echo $_SESSION['AuthorBio']; ?> </textarea>
				  </div>
				  <button type="submit" class="btn btn-primary" name = "update"> Update </button>
				</form>
				<?php
					if(isset($_POST['update']))
					{
						$AuthorName = mysqli_real_escape_string($connection, $_POST['AuthorName']);
						$AuthorEmail = mysqli_real_escape_string($connection, $_POST['AuthorEmail']);
						$AuthorPassword = mysqli_real_escape_string($connection, $_POST['AuthorPassword']);
						$AuthorBio = mysqli_real_escape_string($connection, $_POST['AuthorBio']);
						
						//Checking if any fields are empty:
						if(empty($AuthorName) OR empty($AuthorEmail) OR empty($AuthorBio))
						{
							header ("LOCATION: Index.php?message=Empty+fields.");
							Exit ();
						}
						else
						{
							//Checking the validity of email:
							if (!filter_var($AuthorEmail, FILTER_VALIDATE_EMAIL))
							{
								header ("LOCATION: Index.php?message=Please+enter+A+valid+email.");
								Exit ();
							}
							else
							{
								//Check if new password is enter:
								if(empty($AuthorPassword))
								{
									//User don't want to change his password:
									$AuthorId = $_SESSION['AuthorId'];
									$sql = "UPDATE `author` SET AuthorName='$AuthorName', AuthorEmail='$AuthorEmail', AuthorBio='$AuthorBio' WHERE AuthorId='$AuthorId';";
									if(mysqli_query($connection, $sql))
									{	
										$_SESSION['AuthorName'] = $AuthorName;
										$_SESSION['AuthorEmail'] = $AuthorEmail;
										$_SESSION['AuthorBio'] = $AuthorBio;										
										header ("LOCATION: Index.php?message=Record+updated+successfully");
										Exit ();
									}
									else
									{
										header ("LOCATION: Index.php?message=Something+error");
										Exit ();
									}
								}
								else
								{
									//user wants to change his password:
									$hash = password_hash($AuthorPassword, PASSWORD_DEFAULT);
									$AuthorId = $_SESSION['AuthorId'];
									$sql = "UPDATE `author` SET AuthorName='$AuthorName', AuthorEmail='$AuthorEmail', AuthorBio='$AuthorBio', AuthorPassword='$hash' WHERE AuthorId='$AuthorId';";
									if(mysqli_query($connection, $sql))
									{											
										session_unset ();
										session_destroy ();
										header ("LOCATION: Login.php?message=Record+updated.+You+should+login+agin");
										Exit ();
									}
									else
									{
										header ("LOCATION: Index.php?message=Something+error");
										Exit ();
									}
								}
							}
						}
					}
				?>
			</div>
			</div>
			</main>
		</div>

	<script src = "../JavaScript/jQuery.js"> </script>
	<script src = "../JavaScript/Bootstrap.min.js"> </script>
	<script src = "../JavaScript/Scroll.js"> </script>
	</body>
</html>
	<?php
		}
		else
		{
			header("LOCATION: Login.php?message=Please+Login");
			Exit ();
		}
	?>
