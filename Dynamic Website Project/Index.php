<?php
	include_once "Includes/Functions.php";
	include_once "Includes/Connection.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> My Dynamic Website </title>		
		<link rel = "stylesheet" href = "Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "Style/Style.css">
		<style>
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
	<!-- Navbar is start here -->
	<?php include_once "Includes/Nav.php"; ?>
	<!-- Navbar is end here -->

			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4"> <?php GetSetValue ("DynamicJumbo"); ?> </h1>
					<p class="lead"> <?php GetSetvalue ("JumboDescription"); ?> </p>
				</div>
			</div>

	<div class = "container">
		<?php
		//Determine how many posts are in the website.
			$sqlPage = "SELECT * FROM post";
			$resultPage = mysqli_query($connection, $sqlPage);
			$TotalPosts = mysqli_num_rows ($resultPage);			
			$MaxPosts = ceil($TotalPosts/6);

			if(isset($_GET['page']))
				{
					$PageNumber = $_GET['page'];
					$Start = ($PageNumber*6)-6;
					$sql = "SELECT * FROM post ORDER BY PostId DESC LIMIT $Start,6";
				}
			else
				{
					$sql = "SELECT * FROM post ORDER BY PostId DESC LIMIT 0,6";
				}
		?>
	<div class = "card-columns">
	
		<?php
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
		
		<div class="card" style="width: 18rem;">
		  <img src="<?php echo $PostImage; ?>" class="card-img-top" alt="...">
		  <div class="card-body">
			<h5 class="card-title"> <?php echo $PostTitle; ?> </h5>
			<h6 class="card-subtitle mb-2 text-muted"><?php echo $PostAuthorName; ?></h6>
			<p class="card-text"> <?php echo substr(strip_tags($PostContent),0,60)."..."; ?> </p>
			<a href="LearnMore.php?id=<?php echo $PostId; ?>" class="btn btn-primary">Learn more</a>
		  </div>
		</div>
			<?php } }?>
	</div>
		<?php
			echo "<center>";
			for ($i=1; $i<=$MaxPosts; $i++)
			{
		?>
			<a href = "?page=<?php echo $i; ?>"><button class = "btn btn-success"><?php echo $i; ?></button></a> &nbsp;
		<?php
			}
			echo "</center>";
		?>
	</div> </br> </br>

	<script src = "JavaScript/jQuery.js"> </script>
	<script src = "JavaScript/Bootstrap.min.js"> </script>
	<script src = "JavaScript/Scroll.js"> </script>
	</body>
</html>