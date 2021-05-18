	<?php
		ob_start();
		include_once "../Includes/Functions.php";
		include_once "../Includes/Connection.php";
		session_start ();
		
		if(isset($_SESSION['AuthorRole']))
		{
			if($_SESSION['AuthorRole'] == "Admin")
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
			body
			{
				font-family: Georgia;
			}
			#welcome
			{
				color: #b56e6e;
			}
			#NewPageForm
			{
				display: none;
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
				<h1 class="h2">Pages</h1>
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

				<h4> All Pages: </h4>
				<button id = "ToggleForm" class = "btn btn-info"> Add New </button>
				<hr>
				
				<div id = "NewPageForm">
					<form action = "NewPage.php" method = "post">
						<div class="form-group">
							<label for="exampleInputEmail1"> Page Title </label>
							<input type="text" name = "PageTitle" class="form-control" placeholder = "Enter page title">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"> Page Content </label>
							<textarea name = "PageContent" class="form-control" rows="3"> </textarea>
						</div>
						<div>
							<button name = "AddPage" type = "submit" class = "btn btn-primary"> Add Page </button> </br> </br>
						</div>
					</form>
				</div>
				
				<table class="table table-striped">
				<thead>
					<tr class = "table-info">
					<th scope="col">PageId</th> 
					<th scope="col">PageTitle</th>
					<th scope="col">Actions</th>
					</tr>
				</thead>
				  <tbody>
					<?php
					$sql = "SELECT * FROM page ORDER BY PageId ASC";
					$result = mysqli_query($connection, $sql);
					
					while ($row = mysqli_fetch_assoc($result))
					{
						$PageId = $row['PageId'];
						$PageTitle = $row['PageTitle'];
					?>
						<tr>
						  <th scope="row"> <?php echo $PageId; ?> </th>
						  <td> <?php echo $PageTitle; ?></td>
							<td> <a href="EditPage.php?id=<?php echo $PageId; ?>"> <button class="btn btn-info"> Edit </button></a> <a onclick = "return confirm('Are you sure, you want to delete?')" href="DeletePage.php?id=<?php echo $PageId; ?>"> <button class="btn btn-danger"> Delete </button> </a> </td>
						</tr>
		
					<?php } ?>
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
			$("#ToggleForm").click(function ()
			{
				$("#NewPageForm").slideToggle ();
			});
		});
	</script>
	</body>
</html>
	<?php
		}
		}
		else
		{
			header("LOCATION: Login.php?message=Please+Login");
			Exit ();
		}
	?>