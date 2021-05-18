<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage </title>
	</head>
	<body>
		<?php
		$value = 11;
		if ($value == 8)
			{
				echo "This number is invalid";
			}
		else if ($value == 10)
			{
				echo "<script>alert('Invalid Number')</script>";
			}
		else
			{
				echo "This number is wrong also";
			}
		?>
	</body>
</html>


