<?php
	session_start ();
	if(!isset($_SESSION['id']))
	{
		header ("LOCATION: Show.php");
		exit ();
	}
	else {
	include "Connection.php";
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$sql = "SELECT * FROM `Price` WHERE id='$id'";
		
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result))
		{
	?>
		<form method = "post">
			Name:		<input type = "text" name = "name" value = "<?php echo $row['StudentName']; ?>" required> </br> </br>
			Class:		<input type = "text" name = "class" value = "<?php echo $row['Class']; ?>" required> </br> </br>
			Fees:		<input type = "number" name = "fees" value = "<?php echo $row['Fees']; ?>" required> </br> </br>
			Status:
					<select name = "status">
						<option value = "paid" <?php if ($row['Status'] == "paid") {echo "selected";} ?>> Paid </option>
						<option value = "unpaid" <?php if ($row['Status'] == "unpaid") {echo "selected";} ?>> Unpaid </option>
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
		$sql1 = "UPDATE `price` SET `StudentName`= '$name',`Class`= '$class',`Fees`= '$fees',`Status`= '$status' WHERE id = '$id'";
				if(mysqli_query($connection, $sql1))
				{
					header ("LOCATION: Show.php");
				}
		}
		}
	}
	else
	{
		header ("LOCATION: Show.php");
	}
	}
?>