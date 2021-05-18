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
			$sql = "SELECT * FROM `post` WHERE PostId='$id'";
			$result = mysqli_query($connection, $sql);
			
			//Check if posts are exists or not:
			if(mysqli_num_rows($result)<=0)
			{
				//No results:
				header ("LOCATION: Index.php?message=No+results found.");
				Exit ();
			}
			else if (mysqli_num_rows($result)>0)
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$PostTitle = $row['PostTitle'];
					$PostCategory = $row['PostCategory'];
					$PostContent = $row['PostContent'];
					$PostKeywords = $row['PostKeywords'];
					$PostDate = $row['PostDate'];
					$PostImage = $row['PostImage'];
					$PostAuthor = $row['PostAuthor'];
?>
					
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> <?php echo $PostTitle; ?> </title>		
		<link rel = "stylesheet" href = "Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "Style/Style.css">
		<style>
			#LightBlue
			{
				color:Blue;
			}
			#ImageDesign
			{
				height: 200px;
				width: 300px;
			}
			body
			{
				font-family: Georgia;
			}
		</style>
	</head>
	
	<body>

	<?php include_once "Includes/Nav.php"; ?>
	<?php Jumbotron (); ?>

	<div class = "container">
		<img id = "ImageDesign" src="<?php echo $PostImage; ?>">
		<h2> <?php echo $PostTitle; ?> </h2>
		<hr>
		<h6> <b> Posted on <?php echo $PostDate; ?> | By <?php getAuthorName ($PostAuthor); ?> </b> </h6>
		<h5> Category: <a href = "Category.php?id=<?php echo $PostCategory; ?>"> <?php getCategoryName($PostCategory); ?> </a> </h5>
		<small id = "LightBlue"> <?php echo $PostContent; ?> </small>
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
	}
?>