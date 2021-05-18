	<?php
		ob_start();
		include_once "../Includes/Functions.php";
		include_once "../Includes/Connection.php";
		session_start ();
		
		if(isset($_SESSION['AuthorRole']))
		{
			if($_SESSION['AuthorRole']== "Admin")
			{
	?>
	
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> Category </title>		
		<link rel = "stylesheet" href = "../Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "../Style/Style.css">
		<style>
			#welcome
			{
				font-family: Georgia;
				color: blue;
			}
			.Font-family
			{
				font-family: Georgia;
			}
			#addCatetoryForm
			{
				display:none;
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
		<div class="container-fluid Font-family">
			<div class="row">
				<?php include_once "Nav.inc.php"; ?>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h3 class="h2">Category</h3>
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

				<h5> All Categories: </h5>
				<button class = "btn btn-info" id = "addCategory"> Add New </button>
				<hr>
				
				<div id = "addCatetoryForm">
					<form action = "AddCategory.php" method = "post">
						<div class="form-group">
						<input type="text" class="form-control" id="exampleInputEmail1" placeholder = "Category Name" name = "CategoryName"> </br>
						<button name = "AddCategory" class = "btn btn-success"> Add Category </button>
						</div>
					</form>
				</div>
				
				<table class="table table-striped">
				<thead>
					<tr class = "table-info">
					<th scope="col">CategoryId</th>
					<th scope="col">CategoryName</th>
					<?php } ?>
					</tr>
				</thead>
				  <tbody>
					<?php
					$sql = "SELECT * FROM `category` ORDER BY CategoryId ASC";
					$result = mysqli_query($connection, $sql);
					
					while ($row = mysqli_fetch_assoc($result))
					{
						$CategoryId = $row['CategoryId'];
						$CategoryName = $row['CategoryName'];
					?>
						<tr class="table-active">
						  <th scope="row"> <?php echo $CategoryId ?> </th>
						  <td> <?php echo $CategoryName; ?></td>
						</tr>
		
					<?php }?>
				  </tbody>
				</table>
				
			</div>
			</div>
			</main>
		</div>

	<script src = "../JavaScript/jQuery.js"> </script>
	<script src = "../JavaScript/Bootstrap.min.js"> </script>
	<script src = "../JavaScript/Scroll.js"> </script>
	<script>
		$(document).ready(function ()
		{
			$("#addCategory").click(function()
			{
				$("#addCatetoryForm").slideToggle();
			});
		});
	</script>
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