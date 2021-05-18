<!DOCTYPE html>

<html lang = "en">
	<head>
		<title> Homepage | Security/PHP </title>
		<style>
		input [type=text]
		{
			border-style:none;
			width:100%;
			height:100%		
		}
		textarea
		{
			border-style:none;
			width:97%;
		}
		textarea:focus
		{
			outline-width:0;
		}
		.alternative
		{
			border-style:none;
		}
		</style>
	</head>
	
	<body>
		<form style = "margin:100px 0px 0px 400px;" action = "<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>" method = "post">
			<table border="2px" style = "border-collapse: collapse" width = "350px" height = "150px">
				<tr>
					<td> Name </td>
					<td> <input class = "alternative" type = "text" name = "name"> </td>
				</tr>
				<tr>
					<td> Gender </td>
					<td> <input type = "radio" name = "gender" value = "male"> Male <input type = "radio" name = "gender" value = "female"> Female <input type = "radio" name = "gender" value = "other"> Other
						 </td>
				</tr>
				<tr>
					<td> Class </td>
					<td> <input class = "alternative" type = "text" name = "class"> </td>
				</tr>
				<tr>
					<td> Roll Number </td>
					<td> <input class = "alternative" type = "text" name = "roll"> </td>
				</tr>
				<tr>
					<td> Address </td>
					<td> <textarea name = "address"> </textarea> </td>
				</tr>
				<tr>
				<td colspan = "2"> <center> <input type = "submit" name = "submit" value = "Confirm"> </center> </td>
				</tr>
			</table>
		</form>
		
		<?php
			if(isset($_POST['submit'])){
				if(empty($_POST['name']) or empty ($_POST['gender']) or empty ($_POST['class']) or empty ($_POST['roll']) or empty ($_POST['address'])){
					echo '<script> alert("All Fields Must Be Required"); </script>';
					exit(1);
				} else {
					
					function checkinp($inp){
						$inp = trim($inp);
						$inp = stripslashes($inp);
						$inp = htmlspecialchars($inp);
						return $inp;
					}
					
					$name = checkinp($_POST['name']);
					$gender = checkinp($_POST['gender']);
					$class = checkinp($_POST['class']);
					$roll = checkinp($_POST['roll']);
					$address = checkinp($_POST['address']);
					
					
		?>
			<h1> Your Form has been Submitted </h1>
				<table>
					<tr>
						<td> Name: </td>
						<td> <?php echo $name; ?> </td>
					</tr>
					<tr>
						<td> Gender: </td>
						<td> <?php echo $gender; ?> </td>
					</tr>
					<tr>
						<td> Class: </td>
						<td> <?php echo $class; ?> </td>
					</tr>
					<tr>
						<td> Roll: </td>
						<td> <?php echo $roll; ?> </td>
					</tr>
					<tr>
						<td> Address: </td>
						<td> <?php echo $address; ?> </td>
					</tr>
				</table>
		<?php
				}
			}
		?>
		
	</body>
</html>