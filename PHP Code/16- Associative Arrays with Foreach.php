<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage </title>
	</head>
	<body>
	
		<?php
		$age = array("Neon" => "24.5", "Cobalt" => "23.7", "Hydrogen" => "25.6");
		foreach ($age as $cobalt=>$cobaltvalue)
		{
			echo "$cobalt is $cobaltvalue years old.</br>";
		}
		?>
	
	</body>
</html>