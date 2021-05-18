<?php
	include_once "Includes/Connection.php";
	ob_start ();
	
	if(!isset($_GET['search']))
	{
		header ("LOCATION: Index.php");
		Exit ();
	}
	else
	{
		$Search = mysqli_real_escape_string($connection, $_GET['search']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> My Dynamic Website </title>		
		<link rel = "stylesheet" href = "Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "Style/Style.css">
	</head>
	
	<body>
	<style>
		body
		{
			font-family: Georgia;
		}
	</style>
	
	<!-- Navbar is start here -->
	<?php include_once "Includes/Nav.php"; ?>
	<!-- Navbar is end here -->

	<div class = "container">
		<h3> Showing All Results for '<?php echo $Search; ?>' </h3> </br>
	<div class = "card-columns">
	
		<?php
			$sql = "SELECT * FROM post WHERE PostTitle LIKE '%$Search%' OR PostContent LIKE '%$Search%' OR PostKeywords LIKE '%$Search%'";
			$result = mysqli_query($connection, $sql);
			
			if (mysqli_num_rows($result)<=0)
			{
				header ("LOCATION: Index.php?message=No+results+found.");
				Exit ();
			}
			else
			{
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
?>