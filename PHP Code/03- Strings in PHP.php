<?php
$title = "Homepage";
$welcomeHeader = "Welcome to Learning PHP Language";
$length = "check length";
$example = "an example";
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> <?php echo "$title"; ?> </title>
	</head>
		<?php echo str_word_count("$welcomeHeader"); ?>
		<h4> This is written only using HTML </h4>
		<?php echo strrev("$example"); ?> </br> </br>
		<?php echo strlen("$length"); ?>
		
	
	<body>
	</body>
</html>