<!DOCTYPE html>
<html lang = "en">
<head>
	<title> Homepage </title>
</head>
<body>
	<table border = "1px" width: = "250px" align = "center">
		<tr>
			<th> Employee Name </th>
			<th> Salary </th>
		</tr>
		
		<?php
			$employee = array ("Shakib" => "15,000", "Mushfique" => "14,775", "Mahmud" => "12,025", "Mustafiz" => "10,575");
			foreach($employee as $name => $salary)
			
			echo '<tr> <td> '.$name.' </td> <td> '.$salary.' </td> </tr>'
		?>
	</table>
</body>
</html>