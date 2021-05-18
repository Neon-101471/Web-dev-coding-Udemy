<?php session_start (); ?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Show The All Record </title>
		<style>
			#container
			{
				width:80%;
				background-color: lightgray;
				margin:auto;
				height:auto;
			}
			body
			{
				paddidng:0px;
				margin:0px;
			}
			#sidebar
			{
				float:left;
				width:30%;
			}
			#content
			{
				float:right;
				width: 70%;
			}
			#footer
			{
				clear:both;
				background-color: lightblue;
				height:25px;
				text-align:center;
				padding: 5px;
			}
		</style>
	</head>
	<body>
	<div id = "container">
	<div id = "sidebar">
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
			<?php if(isset($_SESSION['id']))
			{
			?>
				<a href = "LogOut.php"> <button> Log Out </button> </a> &nbsp; &nbsp;
				<a href = "Insert.php"> <button> Insert </button> </a> </br> </br>
			<?php
				
			} else {
			?>
					<form action = "Login.php" method = "post">
								Username:	<input type = "text" name = "username"> </br> </br>
								Password	<input type = "password" name = "password"> </br> </br>
											<input type = "submit" name = "login" value = "Log In"> </br> </br>
					</form>
			<?php } ?>
	</div>
	<div id = "content">
		<table border = "1px" style = "border-collapse:collapse; height:300px; width:500px; text-align:center; padding:5px;">
				<tr bgcolor = "lightgray">
					<th> Student ID </th>
					<th> Student Name </th>
					<th> Class </th>
					<th> Fees </th>
					<th> Status </th>
				<?php if(isset($_SESSION['id'])) { ?>
					<th> Delete </th>
					<th> Edit </th>
				<?php } ?>
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
			if(isset($_SESSION['id'])) {
				echo "<td> <a href='Delete.php?id= ".$row['id']."' onClick = 'return confirm (".'"Ary you sure? you would like to delete this?"'.")'> Delete </a> </td>";
				echo "<td> <a href='Edit.php?id= ".$row['id']."' onClick = 'return confirm (".'"Ary you sure? you would like to edit this?"'.")'> Edit </a> </td>";
			}
				echo "</tr>";
			}
		?>
			</table>
	</div>
	<div id = "footer">
		&copy; Saif Uddin Ahmed
	</div>
	</div>
	</body>
</html>