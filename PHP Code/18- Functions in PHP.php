<?php
	function substraction ($x,$y)
	{
		return ($x - $y);
	}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title> Homepage </title>
</head>
<body>
	<?php
		function addition ($x,$y)
		{	
			$result = ($x + $y);
			echo "The Addition = $result</br>";
		}
		addition (10,4);
		$result = substraction (15,5);
		echo "The Substraction = $result";
	?>
</body>
</html>