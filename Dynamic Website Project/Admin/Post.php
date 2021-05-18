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
			<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Neon-10</a>
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
				<h1 class="h2">Posts</h1>
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

				<h4> All Posts: </h4>
				<a href = "Newpost.php"> <button class = "btn btn-info"> Add New </button> </a>
				<hr>
				
				<table class="table table-striped">
				<thead>
					<tr class = "table-info">
					<th scope="col">PostId</th>
					<th scope="col">PostImage</th>
					<th scope="col">PostTitle</th>
					<th scope="col">PostAuthor</th>
					<?php if($_SESSION['AuthorRole']=="Admin"){ ?>
						<th scope="col">Actions</th>
					<?php } ?>
					</tr>
				</thead>
				  <tbody>
					<?php
					$sql = "SELECT * FROM `post` ORDER BY PostId DESC";
					$result = mysqli_query($connection, $sql);
					
					while ($row = mysqli_fetch_assoc($result))
					{
						$PostTitle = $row['PostTitle'];
						$PostAuthor = $row['PostAuthor'];
						$PostImage = $row['PostImage'];
						$PostContent = $row['PostContent'];
						$PostTitle = $row['PostTitle'];
						$PostId = $row['PostId'];
						
						$sqlAuthor = "SELECT * FROM `author` WHERE AuthorId='$PostAuthor'";
						$resultAuthor = mysqli_query($connection, $sqlAuthor);
						while($rowAuthor = mysqli_fetch_assoc($resultAuthor))
						{
							$PostAuthorName = $rowAuthor['AuthorName'];
					?>
						<tr>
						  <th scope="row"> <?php echo $PostId; ?> </th>
						  <td> <img src="../<?php echo $PostImage; ?>" height= "60px" width= "90px"> </td>
						  <td> <?php echo $PostTitle; ?></td>
						  <td> <?php echo $PostAuthorName; ?></td>
						  <?php if($_SESSION['AuthorRole']=="Admin"){ ?>
							<td> <a href="EditPost.php?id=<?php echo $PostId; ?>"> <button class="btn btn-info"> Edit </button></a> <a onclick = "return confirm('Are you sure, you want to delete?')" href="DeletePost.php?id=<?php echo $PostId; ?>"> <button class="btn btn-danger"> Delete </button> </a> </td>
						  <?php } ?>
						</tr>
		
					<?php } }?>
				  </tbody>
				</table>
				
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