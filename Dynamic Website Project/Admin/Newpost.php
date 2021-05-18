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
				font-family: Georgia;
				color: #b56e6e;
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
				<h3 class="h2"> Add New Post</h3>
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

				<form enctype = "multipart/form-data" method = "post">
					<div class="form-group">
						<label for="exampleInputEmail1">Enter post title</label>
						<input type="text" name = "PostTitle" class="form-control" placeholder = "Post Title">
					</div>
					<div class="form-group">
					<label for="exampleFormControlSelect1">Post category</label>
						<select class="form-control" id="exampleFormControlSelect1" name = "PostCategory">
						<?php
							$sql = "SELECT * FROM `category`";
							$result = mysqli_query($connection, $sql);
							
							while ($row = mysqli_fetch_assoc($result))
							{
						?>
							<option value = "<?php echo $row['CategoryId']; ?>"> <?php echo $row['CategoryName']; ?> </option>
						<?php
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Enter post content</label>
						<textarea type="text" name = "PostContent" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Post image</label>
						<input type="file" name = "PostImage" class="form-control-file" id="exampleFormControlFile1">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Enter post keywords</label>
						<input type="text" name = "PostKeywords" class="form-control" placeholder = "Post keywords">
					</div>
					<button type="submit" class="btn btn-primary" name = "submit"> Submit </button>
				</form>
				
				<?php
					if(isset($_POST['submit']))
					{
						$PostTitle = mysqli_real_escape_string($connection, $_POST['PostTitle']);
						$PostCategory = mysqli_real_escape_string($connection, $_POST['PostCategory']);
						$PostContent = mysqli_real_escape_string($connection, $_POST['PostContent']);
						$PostKeywords = mysqli_real_escape_string($connection, $_POST['PostKeywords']);
						$PostAuthor = $_SESSION['AuthorId'];
						$PostDate = date("d-m-y");
						
						//Checking if any fields are empty:
						if(empty($PostTitle) OR empty($PostCategory) OR empty($PostContent))
						{
							header("LOCATION: Newpost.php?message=Empty+fields.");
							Exit ();
						}
						
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
									
									$sql = "INSERT INTO `post` (`PostTitle`, `PostContent`, `PostCategory`, `PostAuthor`, `PostDate`, `PostKeywords`, `PostImage`) VALUES ('$PostTitle', '$PostContent', '$PostCategory', '$PostAuthor', '$PostDate', '$PostKeywords', '$dbdestination');";
									
									if(mysqli_query($connection, $sql))
									{
										header ("LOCATION: Post.php?message=Your+post+is+published.");
										Exit ();
									}
									else
									{
										header ("LOCATION: Newpost.php?message=Error+Something.+Please+recheck+again.");
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
			header("LOCATION: Login.php?message=Please+Login.");
			Exit ();
		}
	?>