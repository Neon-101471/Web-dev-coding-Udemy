<?php
	function substraction ($x,$y)
	{
		return ($x - $y);
	}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title> Homepage | PHP </title>
</head>
<body>
	<?php
	$cricketer = array ("Shakib", "Tamim", "Mushfique", "Mahmudullah", "Mashrafee");
	rsort($cricketer);
	foreach ($cricketer as $cricket)
	echo "$cricket</br>";
	echo "</br> </br>";
	
	$score = array ("Mostafa" => "87.5", "Morshed" => "82.5", "Sayeka" => "83.5", "Nowshin" => "82.5", "Saif" => "83.5");
	ksort($score);
	foreach ($score as $student => $result)
	echo "$student $result </br>";
	?>
	
	<pre>
	<font color = "green" face = "comic sans ms">
		Note: You may also use these function:
				
		sort ()- Sort arrays in ascending order.
		rsort ()- Sort arrays in descending order.
		asort ()- Sort associative arrays in ascending order, according to the value.
		ksort ()- Sort associative arrays in ascending order, according to the key.
		arsort ()- Sort associative arrays in descending order, according to the value.
		krsort ()- Sort associative arrays in descending order, according to the key.
	</font>
	</pre>
</body>
</html>