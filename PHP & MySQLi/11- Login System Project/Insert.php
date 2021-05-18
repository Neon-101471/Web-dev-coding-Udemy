<?php 
	session_start ();
	include "connection.php";
	if(!isset($_SESSION['id']))
	{
		header ("LOCATION: Show.php");
		exit ();
	}
	else {
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Adding Record into Database </title>
	</head>
	<body>
	
		<form method = "post">
			Name:		<input type = "text" name = "name" required> </br> </br>
			Class:		<input type = "text" name = "class" required> </br> </br>
			Fees:		<input type = "number" name = "fees" required> </br> </br>
			Status:
					<select name = "status">
						<option value = "paid"> Paid </option>
						<option value = "unpaid"> Unpaid </option>
					</select> </br> </br>
						<input type = "submit" name = "submit" value = "Submit">
		</form>
		<?php
			if(isset($_POST['submit']))
			{
				$name = mysqli_real_escape_string($connection, $_POST['name']);
				$class = mysqli_real_escape_string($connection, $_POST['class']);
				$fees = mysqli_real_escape_string($connection, $_POST['fees']);
				$status = mysqli_real_escape_string($connection, $_POST['status']);
				
				$connection = mysqli_connect("localhost", "root", "", "databaseone");
				$sql = "INSERT INTO `Price` (`StudentName`, `Class`, `Fees`, `Status`) VALUES ('$name', '$class', '$fees', '$status');";
				mysqli_query($connection, $sql);
				
			echo "<h1> Your data is Updated successfully.</h1>";
			header ("LOCATION: Show.php");
			}
		?>
	</body>
</html>
	<?php } ?>