<?php
	include_once "Includes/Connection.php";
	include_once "Includes/Functions.php";
	ob_start ();
	
	if(!isset($_GET['id']))
	{
		header("LOCATION: Index.php?message=Couldn't+get+any+id.");
		Exit ();
	}
	else
	{
		$id = mysqli_real_escape_string($connection, $_GET['id']);
		if(!is_numeric($id))
		{
			header("LOCATION: Index.php?message=Numeric+error.");
			Exit ();
		}
		else if (is_numeric($id))
		{
			$sql = "SELECT * FROM `category` WHERE CategoryId='$id'";
			$result = mysqli_query($connection, $sql);
			
			//Check if category are exists or not:
			if(mysqli_num_rows($result)<=0)
			{
				//No category:
				header ("LOCATION: Index.php?message=No+results found.");
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
			<title> My Dynamic Website </title>		
		<link rel = "stylesheet" href = "Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "Style/Style.css">
		<style>
			#CategoryTitle
			{
				color: dark;
				font-family: georgia;
				margin-top:10px;
				margin-bottom:20px;
			}
			body
			{
				font-family: Georgia;
			}
		</style>
	</head>
	
	<body>
	<!-- Navbar is start here -->
	<?php include_once "Includes/Nav.php"; ?>
	<!-- Navbar is end here -->
	
	<div class = "container" id = "CategoryTitle">
		<h4> Showing all the posts where category: <?php getCategoryName ($id); ?> </h4>
	</div>

	<div class = "container">
	<div class = "card-columns">
	
		<?php
			$sql = "SELECT * FROM `post` WHERE PostCategory = '$id' ORDER BY PostId DESC";
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
	</div>

	<script src = "JavaScript/jQuery.js"> </script>
	<script src = "JavaScript/Bootstrap.min.js"> </script>
	<script src = "JavaScript/Scroll.js"> </script>
	</body>
</html>			
			<?php
			}
		}
	}
?>