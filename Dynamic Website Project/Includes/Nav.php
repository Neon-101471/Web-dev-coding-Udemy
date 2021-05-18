<?php
	include_once "Includes/Connection.php";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">RGMC</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls=		"navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mx-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="Index.php"> Home </a>
			  </li>
			  	<?php
					$SqlPage = "SELECT * FROM page";
					$ResultPage = mysqli_query($connection, $SqlPage);
					while($RowPage = mysqli_fetch_assoc($ResultPage))
					{
						$PageId = mysqli_real_escape_string($connection, $RowPage['PageId']);
						$PageTitle = mysqli_real_escape_string($connection, $RowPage['PageTitle']);
						
				?>
					<li class="nav-item">
						<a class="nav-link" href="Page.php?id= <?php echo $PageId; ?>"> <?php echo $PageTitle; ?> </a>
					</li>
				<?php
					}
				?>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> All Categories </a>
				
				<div class = "dropdown-menu" aria-labelledby = "navbarDropdown">
				<?php
					$sql = "SELECT * FROM category";
					$result = mysqli_query($connection, $sql);
					while($row = mysqli_fetch_assoc($result))
					{
						$CategoryId = mysqli_real_escape_string($connection, $row['CategoryId']);
						$CategoryName = mysqli_real_escape_string($connection, $row['CategoryName']);
						
				?>
						<a class="dropdown-item" href = "Category.php?id=<?php echo $CategoryId; ?>"> <?php echo $CategoryName; ?> </a>
				<?php
					}
				?>
				</div>
			  </li>
			</ul>
			<form action = "Search.php" class="form-inline my-2 my-lg-0">
			  <input name = "search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Search </button>
			</form>
		</div>
</nav>