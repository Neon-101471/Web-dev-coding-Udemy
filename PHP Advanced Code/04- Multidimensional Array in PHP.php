<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> PHP Advanced </title>
	</head>
	<body>
	<h4> 1. Display with row & column. </h4>
	
		<?php
			$cricketer = array (
			array ("Shakib", 33, "Magura"),
			array ("Mushfique", 33, "Bogra"),
			array ("Tamim", 32, "Chittagong"),
			array ("Mashrafee", 36, "Narail"),
			array ("Mahmudullah", 35, "Mymensingh"),
			);
			
			for ($m=0; $m<=4; $m++)
			{
				for ($n=0; $n<=2; $n++)
				{
					echo $cricketer [$m][$n]. " ";
				}
					echo "</br>";
			}
		?>
		
	<h4> 2. Display with table. </h4>
		<table border = "1" style = "border-collapse:collapse; height:150px; width:250px; text-align:center; padding:5px;">
			<tr>
				<th> Cricketer </th>
				<th> Age </th>
				<th> Hometown </th>
			</tr>
			<?php
			for($x=0; $x<5; $x++)
			{
				echo "<tr>";
					for($z=0; $z<3; $z++)
					{
						echo "<td>";
							echo $cricketer [$x][$z];
						echo "</td>";
					}
				echo "</tr>";
				
			}
			?>
		</table>
	</body>
</html>