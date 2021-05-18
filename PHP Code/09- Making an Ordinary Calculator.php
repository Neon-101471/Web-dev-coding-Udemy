<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage </title>
	</head>
	<body>
	
		<?php
		$number1 = 54;
		$number2 = 10;
		$operator = "/";

		if ($operator == '+')
			{
				echo "$number1 + $number2 = ".($number1+$number2);
			}
		else if ($operator == '-')
			{
				echo "$number1 - $number2 = ".($number1-$number2);
			}
		else if ($operator == '*')
			{
				echo "$number1 &times $number2 = ".($number1*$number2);
			}
		else if ($operator == '/')
			{
				echo "$number1 / $number2 = ".($number1/$number2);
			}
		else if ($operator == '%')
			{
				echo "$number1 % $number2 = ".($number1%$number2);
			}
		else
			{
				echo "Sorry! This is invalid. Please enter +, -, &times, / or % operator"; 
			}?>
	
	</body>
</html>