<?php
	include_once "../Includes/Connection.php";
	include_once "../Includes/Functions.php";
	ob_start ();
	session_start ();
	
	if(!isset($_GET['id']))
	{
		header ("LOCATION: EditPage.php?message=Didn't+get+any+id.");
		Exit ();
	}
	else
	{
		if(!isset($_SESSION['AuthorRole']))
		{
			header ("LOCATION: Index.php?message=Please+login.");
			Exit ();
		}
		else
		{
			if($_SESSION['AuthorRole'] == "Admin")
			{
				$id = mysqli_real_escape_string($connection, $_GET['id']);
				$sql = "SELECT * FROM page WHERE PageId='$id'";
				$result = mysqli_query($connection, $sql);
				
				if(mysqli_num_rows($result)<=0)
				{
					header ("LOCATION: EditPage.php?message=No+results+found.");
					Exit ();
				}
				else
				{
					?>					
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> Edit Page </title>		
		<link rel = "stylesheet" href = "../Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "../Style/Style.css">
		<style>
			#welcome
			{
				font-family: comic sans ms;
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
			<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
			<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target=	"#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
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
				<h3 class="h2"> Edit Post</h3>
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
			  <?php
				$PageId = $_GET['id'];
				$FormSql = "SELECT * FROM page WHERE PageId='$PageId'";
				$FormResult = mysqli_query($connection, $FormSql);
				
				while ($FormRow = mysqli_fetch_assoc($FormResult))
				{
					$PageTitle = $FormRow['PageTitle'];
					$PageContent = $FormRow['PageContent'];
			  ?>

				<form enctype = "multipart/form-data" method = "post">
					<div class="form-group">
						<label for="exampleInputEmail1">Enter page title</label>
						<input type="text" name = "PageTitle" class="form-control" placeholder = "Page Title" value = "<?php echo $PageTitle; ?>">
					</div>
		
					<div class="form-group">
						<label for="exampleInputEmail1">Enter page content</label>
						<textarea type="text" name = "PageContent" class="form-control"> <?php echo $PageContent; ?></textarea>
					</div>
					<button type="submit" class="btn btn-primary" name = "PageUpdate"> Update </button>
				</form>
				<?php } ?>
				
				<?php
					if(isset($_POST['PageUpdate']))
					{
						$PageTitle = mysqli_real_escape_string($connection, $_POST['PageTitle']);
						$PageContent = mysqli_real_escape_string($connection, $_POST['PageContent']);
						
						//Checking if any fields are empty:
						if(empty($PageTitle) OR empty($PageContent))
						{
							header("LOCATION: EditPage.php?message=Empty+fields.");
							Exit ();
						}
						
							//User don't want to update the file:
							$sql = "UPDATE page SET PageTitle='$PageTitle', PageContent='$PageContent' WHERE PageId='$PageId'";
							
							if(mysqli_query($connection, $sql))
								{
									header ("LOCATION: Page.php?message=Your+page+is+Updated+successfully.");
									Exit ();
								}
								else
								{
									header ("LOCATION: Page.php?message=Error+Something.+Please+recheck+again.");
									Exit();
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
	<script src="https://cdn.tiny.cloud/1/fcwoha4h4z16wi2r3swtr242uhz1bumhj8e029m0rbso8u2v/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>tinymce.init({selector:'textarea'});</script>
	</body>
</html>					
				<?php
				}
			}
			else
			{
				header ("LOCATION: EditPage.php?message=SORRY!+You+can't+access+this+page.");
				Exit ();
			}
		}
	}
?>