<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Show The All Record </title>
	</head>
	<body>
	
		<?php
			$connection = mysqli_connect("localhost", "root", "", "databaseone");
			$sql = "SELECT * FROM `Price`";
			// $sql = "SELECT * FROM `Price` WHERE Status = 'paid'";
			
			$result = mysqli_query($connection, $sql);
		?>
			<table border = "1px" style = "border-collapse:collapse; height:300px; width:500px; text-align:center; padding:5px;">
				<tr bgcolor = "lightgray">
					<th> Student ID </th>
					<th> Student Name </th>
					<th> Class </th>
					<th> Fees </th>
					<th> Status </th>
				</tr>
		<?php
			while ($row = mysqli_fetch_assoc($result))
				// mysqli_fetch_assoc & mysqli_fetch_array are the same function.
			{
				//print_r($row);
				//echo $row['StudentName'];
				
				echo "<tr>";
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['StudentName']."</td>";
				echo "<td>".$row['Class']."</td>";
				echo "<td>".$row['Fees']."</td>";
				echo "<td>".$row['Status']."</td>";
				echo "</tr>";
			}
		?>
			</table>
	</body>
</html>