	<?php
		ob_start();
		include_once "../Includes/Functions.php";
		include_once "../Includes/Connection.php";
		session_start ();
		
		if(isset($_SESSION['AuthorRole']))
		{
			if($_SESSION['AuthorRole']=="Admin")
			{
				if(isset($_GET['id']))
				{
	?>
	
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> Edit Post </title>		
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
				$PostId = $_GET['id'];
				$FormSql = "SELECT * FROM `post` WHERE PostId='$PostId'";
				$FormResult = mysqli_query($connection, $FormSql);
				
				while ($FormRow = mysqli_fetch_assoc($FormResult))
				{
					$PostTitle = $FormRow['PostTitle'];
					$PostContent = $FormRow['PostContent'];
					$PostImage = $FormRow['PostImage'];
					$PostKeywords = $FormRow['PostKeywords'];
			  ?>

				<form enctype = "multipart/form-data" method = "post">
					<div class="form-group">
						<label for="exampleInputEmail1">Enter post title</label>
						<input type="text" name = "PostTitle" class="form-control" placeholder = "Post Title" value = "<?php echo $PostTitle; ?>">
					</div>
		
					<div class="form-group">
						<label for="exampleInputEmail1">Enter post content</label>
						<textarea type="text" name = "PostContent" class="form-control"> <?php echo $PostContent; ?></textarea>
					</div>
					<div class="form-group">
						<img src= "../<?php echo $PostImage; ?>" height="60px" width="100px"> </br>
						<label for="exampleFormControlFile1">Post image</label>
						<input type="file" name = "PostImage" class="form-control-file" id="exampleFormControlFile1">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Enter post keywords</label>
						<input type="text" name = "PostKeywords" class="form-control" placeholder = "Post keywords" value="<?php echo $PostKeywords; ?>">
					</div>
					<button type="submit" class="btn btn-primary" name = "submit"> Update </button>
				</form>
				<?php } ?>
				
				<?php
					if(isset($_POST['submit']))
					{
						$PostTitle = mysqli_real_escape_string($connection, $_POST['PostTitle']);
						$PostContent = mysqli_real_escape_string($connection, $_POST['PostContent']);
						$PostKeywords = mysqli_real_escape_string($connection, $_POST['PostKeywords']);
						
						//Checking if any fields are empty:
						if(empty($PostTitle) OR empty($PostContent) OR empty($PostKeywords))
						{
							header("LOCATION: Newpost.php?message=Empty+fields.");
							Exit ();
						}
						if(is_uploaded_file($_FILES['PostImage']['tmp_name']))
						{
							//User want to update the file:
							$file = $_FILES['PostImage'];
							$fileName = $file['name'];
							$fileType = $file['type'];
							$fileTemp = $file['tmp_name'];
							$fileError = $file['error'];
							$fileSize = $file['size'];
							$fileDestination = "File/".$fileName;						
							$fileExtension = explode('.', $fileName);
							
							//print_r($fileExtension);
							
							$LastIndexExtension = strtolower(end($fileExtension));
							//strtolower() function is used for grab the extension with lower case.
							
							$allowedExtension = array("jpg", "jpeg", "png", "pdf", "doc", "odt", "svg", "gif");				
							if(in_array($LastIndexExtension, $allowedExtension))
							{
								if($fileError === 0)
								{
									if($fileSize < 10000000)
									{
										$newFileName = uniqid('', true).'.'.$LastIndexExtension;
										//echo "$newFileName";
										
										$destination = "../Uploads/$newFileName";
										$dbdestination = "Uploads/$newFileName";
										move_uploaded_file($fileTemp, $destination);
										
										$sql = "UPDATE `post` SET PostTitle='$PostTitle', PostContent='$PostContent', PostKeywords='$PostKeywords', PostImage='$dbdestination' WHERE PostId='$PostId'";
										
										if(mysqli_query($connection, $sql))
										{
											header ("LOCATION: Post.php?message=Your+post+is+Updated+successfully.");
											Exit ();
										}
										else
										{
											header ("LOCATION: Post.php?message=Error+Something.+Please+recheck+again.");
											Exit();
										}
									}
									else
									{
										header("LOCATION: Newpost.php?message=Your+file+is+too+much+large,+so+that+it+can't+be+uploaded.");
										Exit ();
									}								
								}
								else
								{
									header("LOCATION: Newpost.php?message=Sorry!+Your+file+can't+be+uploaded+successfully.");
									Exit ();
								}							
							}
							else
							{
								header("LOCATION: Newpost.php?message=You+uploaded+A+file+which+type+of+extension+aren't+allowed+in+this+website.");
								Exit ();
							}								
							}
						else
						{
							//User don't want to update the file:
							$sql = "UPDATE `post` SET PostTitle='$PostTitle', PostContent='$PostContent', PostKeywords='$PostKeywords' WHERE PostId='$PostId'";
							
							if(mysqli_query($connection, $sql))
								{
									header ("LOCATION: Post.php?message=Your+post+is+Updated+successfully.");
									Exit ();
								}
								else
								{
									header ("LOCATION: Post.php?message=Error+Something.+Please+recheck+again.");
									Exit();
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
	<script src="https://cdn.tiny.cloud/1/fcwoha4h4z16wi2r3swtr242uhz1bumhj8e029m0rbso8u2v/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>tinymce.init({selector:'textarea'});</script>
	</body>
</html>
	<?php
		}
		else
		{
			header("LOCATION: Index.php");
			Exit ();
		}
		}
		else
		{
			header("LOCATION: Index.php");
			Exit ();
		}
		}
		else
		{
			header("LOCATION: Login.php?message=Please+Login.");
			Exit ();
		}
	?>