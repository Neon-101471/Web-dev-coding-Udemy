<DOCTYPE html>
<html lang = "en">
	<head>
		<title> Homepage | PHP </title>
	</head>
	
	<body>
		<form method = "post">
			Name:  <input type = "text" name = "name"> </br> </br>
			Email: <input type = "email" name = "email"> </br> </br>
				   <input type = "submit" name ="submit" value = "Submit">
		</form>
		
		<?php
			if(isset($_POST['submit']))
			{
				echo $_POST['email'];
			}?>
	</body>
	
</html>