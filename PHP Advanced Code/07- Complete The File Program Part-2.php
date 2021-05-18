<!DOCTYPE html>
<html>
	<head>
		<title> PHP | File </title>
	</head>
	<body>
	
		<form method = "post">
			File name:	<input type = "text" name = "filename"> </br> </br>
	Chosse an option:	<select name = "action">
							<option value = "w"> Creating a new file  </option>
							<option value ="a"> Appending a file </option>
							<option value = "r"> Read the file </option>
						</select> </br> </br>
			Content:	<textarea type = "text" name = "content"> </textarea> </br> </br>
						<input style = "margin-left:50px;" type = "submit" name = "submit" value = "Submit">
		</form>
		
		<?php
		
			if (isset($_POST['submit']))
			{
				$filename = $_POST['filename'];
				$content = $_POST['content'];
				$action = $_POST['action'];
				
				switch ($action)
				{
					case "w":
						$file = fopen ($filename, "w") or die ("Sory! This file does not exist");
						fwrite($file, $content);
						fclose($file);
						echo "Your file is write successfully";
					break;
					
					case "a":
						$file = fopen ($filename, "a") or die ("Sory! This file does not exist");
						fwrite($file, "\r\n");
						fwrite($file, $content);
						fclose($file);
						echo "Your file is appended successfully";
					break;
					
					case "r":
						$file = fopen($filename, "r") or die ("This file is not exist now.");
						while (!feof($file))
						{
							echo fgets ($file);
						}
						fclose($file);
					
				}
			}
		?>
	
	</body>
</html>