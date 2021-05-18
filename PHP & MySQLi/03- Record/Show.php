<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Show The All Record </title>
	</head>
	<body>
		<form action = "Search.php">
			<input type = "text" name = "search" placeholder = "Search Here">
			<input style = "margin-left:50px" type = "submit" name "submit" Value = "Search Here"> </br> </br>
		</form>
	
		<?php
			include "connection.php";
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
					<th> Delete </th>
					<th> Edit </th>
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
				echo "<td> <a href='Delete.php?id= ".$row['id']."' onClick = 'return confirm (".'"Ary you sure? you would like to delete this?"'.")'> Delete </a> </td>";
				echo "<td> <a href='Edit.php?id= ".$row['id']."' onClick = 'return confirm (".'"Ary you sure? you would like to edit this?"'.")'> Edit </a> </td>";
				echo "</tr>";
			}
		?>
			</table>
	</body>
</html>