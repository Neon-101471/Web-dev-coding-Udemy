<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage </title>
	</head>
	<body>
	
		<?php
		$value1 = 10;
		$value2 = 12;

		if ($value1 = 10 && $value2 = 12)
		{
			echo "This is true </br> </br>";
		}
		
		$value3 = 15;
		$value4 = 20;
		if ($value3 = 15 || $value4 = 12)
		{
			echo "This is true, because at least one or both conditions are true </br> </br>";
		}
		
		$value5 = 25;
		$value6 = 50;
		if ($value5 == 11 xor $value6 == 50)
		{
			echo "XOR works, if one conditions must be wrong and another is true, but not both are true or false </br>";
		}?>

		<pre>
				Note: In XOR Logical Operator, you must use (==) in your condition.
				Otherwise it's may not working.
		</pre>
	
	</body>
</html>