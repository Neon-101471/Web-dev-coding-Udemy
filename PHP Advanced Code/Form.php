<?php
	if(isset($_GET['submit']))
	{
		$name = $_GET['name'];
		$email = $_GET['email'];
	}
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> <?php echo $name; ?> </title>
	</head>
	
	<body>
		Welcome to <?php echo $name; ?> </br>
		Your email is- <?php echo $email; ?>
	</body>
</html>