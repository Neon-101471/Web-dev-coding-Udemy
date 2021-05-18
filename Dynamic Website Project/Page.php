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
			$sql = "SELECT * FROM page WHERE PageId='$id'";
			$result = mysqli_query($connection, $sql);
			
			//Check if posts are exists or not:
			if(mysqli_num_rows($result)<=0)
			{
				//No results:
				header ("LOCATION: Index.php?message=No+page+found.");
				Exit ();
			}
			else if (mysqli_num_rows($result)>0)
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$PageTitle = $row['PageTitle'];
					$PageTitle1 = $row['PageTitle'];
					$PageContent = $row['PageContent'];
?>
					
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title> <?php echo $PageTitle; ?> </title>
		<link rel = "stylesheet" href = "Style/Bootstrap.min.css">
		<link rel = "stylesheet" href = "Style/Style.css">
		<style>
			#LightBlue
			{
				color:Blue;
				font-family: Georgia;
			}
			#AboutUs
			{
				text-align: center;
				width:100%;
				background-color: lightgreen;
				font-family: Georgia;
				padding:10px;
				color:dark;
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
		<h4 id = "AboutUs"> <?php echo $PageTitle1; ?> </h4>
		<hr>
		<h6 id = "LightBlue"> <?php echo $PageContent; ?> </h6>
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