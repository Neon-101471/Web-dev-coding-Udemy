<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage </title>
	</head>
	<body>
	
		<?php
		$number1 = 10;
		$number2 = $number1%2;
		switch ($number2)
		{
			case 0:
			echo "$number1 is a Even Number";
			break;
				
			case 1:
			echo "$number1 is an Odd Number";
			break;
		}?>

<pre> You must entered positive integer value. </pre>
	
	</body>
</html>