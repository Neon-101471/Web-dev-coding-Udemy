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
				$name = $_POST['name'];
				$class = $_POST['class'];
				$fees = $_POST['fees'];
				$status = $_POST['status'];
				
				$connection = mysqli_connect("localhost", "root", "", "databaseone");
				$sql = "INSERT INTO `Price` (`StudentName`, `Class`, `Fees`, `Status`) VALUES ('$name', '$class', '$fees', '$status');";
				mysqli_query($connection, $sql);
		?>
			<h1> Your data is Updated successfully. </h1>
		<?php
			}
		?>
	</body>
</html>