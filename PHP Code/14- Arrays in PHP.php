<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage </title>
	</head>
	<body>
	
		<?php
		$name = array ("Helium", "Neon", "Argon", "Krypton", "Xenon", "Radon");
		echo "$name[1] </br>";
		
		$Length = count($name);
		echo "The length of this array = $Length </br> </br>";
		echo "The element of this array are as follows: </br>";
		
		for ($x=0; $x<count($name); $x++)
		{
			echo "$name[$x]</br>";
		}
		?>
	
	</body>
</html>