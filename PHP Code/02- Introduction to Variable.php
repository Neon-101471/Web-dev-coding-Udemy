<?php
$title = "Homepage";
$welcomeHeader = "Welcome to Learning PHP Language";
$example = "It's just an example";
?>

<!DOCTYPE html>
<html lang = "en">

	<head>
		<title> <?php echo "$title"; ?> </title>
	</head>
	<body>
		<?php
		echo "<h4>$welcomeHeader</h4>";
		echo "This is not a special code ".$example;
		?>
		<h4> This is written only useing HTML </h4>
	</body>
	
</html>